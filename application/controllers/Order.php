<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('Logging');
        $this->load->helper('timezone');
	}

	public function add_cart($id, $qty){
		/*
		 * check if the 'cart' session array was created
		 * if it is NOT, create the 'cart' session array
		 */
		if(!isset($_SESSION['cart_items'])){
			$_SESSION['cart_items'] = array();
		}

		if(array_key_exists($id, $_SESSION['cart_items']))
			$_SESSION['cart_items'][$id]=$qty+$_SESSION['cart_items'][$id];
		else
			$_SESSION['cart_items'][$id]=$qty;

		$response = $this->show_cart_items();

		echo json_encode($response);
	}

	public function dest(){
		$this->session->sess_destroy();
	}

	public function remove_item_from_cart($id){
		unset($_SESSION['cart_items'][$id]);

		$response = $this->show_cart_items();

		echo json_encode($response);
	}

	function show_cart_items(){
		$response['count'] = sizeof($_SESSION['cart_items']);
		// $response['total'] = 0;
		$price = 0;
		// fetch each product detail
		$this->load->model('Content_m', 'content');
		$response['cart'] = array();
		foreach($_SESSION['cart_items'] as $key => $value){
/* if cart is selling point */
			if(substr($key, 0, 2)=="SP"){
				$this->load->model('Commerce_m', 'comm');
				$point = $this->comm->get_selling_point_by_id($key);
				$response['cart'][] = array(
					'id' => $key,
					'title' => $point->title,
					'price' => $point->price,
					'point' => $point->point,
					'qty' => $value,
					'total_price_item' => $point->price * $value,
					'image' => 'point.jpg'
					);
				$price += intval($point->price * $value);
			}
			else{
				// get post detail
				$post_data = $this->content->get_post_data('product','a.id', $key);
				$post = $post_data->row();
				// get product detail
				$product = $this->content->get_product_detail_by_post_id($post->id);
				// get product image
				$image = $this->content->get_post_image($post->primary_image);
				// get which post belong to root category
				$get_root = $this->content->get_root_category_by_post_id($post->id);
				if($get_root->slug <> 'catering'){
					$response['cart'][] = array(
						'id' => $key,
						'title' => $post->title,
						'price' => $product->price,
						'qty' => $value,
						'total_price_item' => $product->price * $value,
						'image' => $image->file_name
						);
					$price += intval($product->price * $value);
				}
				else{
					$response['cart'][] = array(
						'id' => $key,
						'title' => $post->title,
						'price' => $product->equal_to_point,
						'qty' => $value,
						'total_price_item' => $product->equal_to_point * $value,
						'image' => $image->file_name
						);
				}
			}
		}
		$response['total'] = $price;

		return $response;
	}

	public function update_all_cart(){
		foreach($_POST['id'] as $key => $value){
			$_SESSION['cart_items'][$value]=$_POST['quantity'][$key];
		}
		redirect('frontpage/checkout');
	}

	public function place_order(){
		$this->load->model('Order_m', 'order');
		$this->load->model('Content_m', 'content');

		// shipping cost info
		$get_min_total = $this->content->get_option_by_param('min_total_free_ship_cost');
		$min_total = $get_min_total->parameter_value;

		$get_ship_cost = $this->content->get_option_by_param('ship_cost');
		$ship_cost = $get_ship_cost->parameter_value;

		$any_error = false;
		$any_error_msg = '';
		$cart_items = $this->show_cart_items();

		// insert into order_header
		if($cart_items['total'] < $min_total)
			$grand_total = $cart_items['total'] + $ship_cost;
		else
			$grand_total = $cart_items['total'];

		$data_order_header = array(
			'user_id' => $this->session->userdata('userid'),
			'total_items' => sizeof($cart_items['count']),
			'total_price' => $grand_total,
			'order_status' => 'Open'
			);
		$result_insert_order = false;
		while($result_insert_order==false){
			$date = date('Y-m');
			$prefix = 'RTW-'.$date.'-';
			$get_latest_id = $this->order->get_latest_order_id_this_month($prefix);
			if($get_latest_id==false)
				$new_id = $prefix.'0001';
			else{
				$latest_id = $get_latest_id->order_id;
				$latest_iteration = substr($latest_id, -4);
				
				$new_iteration = intval($latest_iteration) + 1;
				
				$new_id = $prefix.str_pad($new_iteration, 4, '0', STR_PAD_LEFT);
			}
			$data_order_header['order_id'] = $new_id;
			$insert = $this->order->insert_new_order($data_order_header);
			if($insert)
				$result_insert_order = true;
			else
				$result_insert_order = false;
		}
		// insert into order_detail
		foreach($cart_items['cart'] as $cart){
			$data_detail = array(
				'order_id' => $new_id,
				'post_id' => $cart['id'],
				'quantity' => $cart['qty'],
				'price_on_sale' => $cart['price'],
				'total_price' => $cart['total_price_item']
				);
			$insert = $this->order->insert_order_detail($data_detail);
			if(!$insert){ // if any error, rollback the transaction
				$any_error = true;
				$this->order->delete_order_id($new_id);
				$any_error_msg = 'Ada kesalahan data insertion di order detail';
				die();
			}
		}

		// insert shipping info
		$data_shipping = array(
			'order_id' => $new_id,
			'first_name' => $this->input->post('ship-fn', TRUE),
			'last_name' => $this->input->post('ship-ln', TRUE),
			'address_1' => $this->input->post('ship-address-1', TRUE),
			'address_2' => $this->input->post('ship-address-2', TRUE),
			'zip_code' => $this->input->post('ship-zip-code', TRUE),
			'city' => $this->input->post('ship-city', TRUE),
			'province' => $this->input->post('ship-province', TRUE),
			'phone' => $this->input->post('ship-phone', TRUE),
			'notes' => $this->input->post('ship-note', TRUE),
			);

		$insert = $this->order->insert_order_shipping($data_shipping);
		if(!$insert){ // if any error, rollback the transaction
			$any_error = true;
			$this->order->delete_order_id($new_id);
			$any_error_msg = 'Ada kesalahan data insertion di shipping';
		}

		if($any_error==false){
			unset($_SESSION['cart_items']);

			$this->load->model('Bank_m', 'bank');
			//preparing to send email
			$content = array(
				'order_id' => $new_id,
				'first_name' => $this->session->userdata('fn'),
				'last_name' => $this->session->userdata('ln'),
				'total_price' => $grand_total
			);
			$bank = $this->bank->get_bank_data('active', 'true');
			$content['bank'] = $bank->result();

			// send email to customer
			$this->load->library('My_PHPMailer');
	        $mail = new PHPMailer();
	        $mail->IsSMTP(); // we are going to use SMTP
	        $mail->SMTPAuth   = true; // enabled SMTP authentication
	        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
	        $mail->Host       = $this->config->item('smtp_host');      // setting GMail as our SMTP server
	        $mail->Port       = $this->config->item('smtp_port');                   // SMTP port to connect to GMail
	        $mail->Username   = $this->config->item('smtp_user');  // user email address
	        $mail->Password   = $this->config->item('smtp_pass');            // password in GMail
	        $mail->SetFrom('admin@indokatering.com', 'Admin IndoKatering');  //Who is sending the email
	        $mail->Subject    = "Pesanan anda telah diterima";

	        $mail->Body      = $this->load->view('email_tpl/new_order_request', $content, true);
	        $mail->AltBody    = "Plain text message";
	        $destino = $this->session->userdata('email'); // Who is addressed the email to
	        $mail->AddAddress($destino, "Customer");

	        if(!$mail->Send()) {
	        	$this->logging->insert_event_logging('send_email_order_place', '', 'false', $mail->ErrorInfo);
	        } else {
	            $this->logging->insert_event_logging('send_email_order_place', '', 'true', 'Message sent');
	        }

	        // give notification to admin
	        $this->load->library('notification');
	        $notif = array(
	        	'category' => 'new_order',
	        	'title' => 'New Order Request',
	        	'content' => 'New order request from '.$this->session->userdata('fn'),
	        	'sender_id' => $this->session->userdata('userid'),
	        	'receiver_id' => 'admin'
	        	);
	        $this->notification->insert($notif);
		}

		redirect('frontpage/checkout/'.$new_id);
	}

	public function change_order_status($order_id, $status){
		$this->load->model('Common', 'common');
		$this->load->model('Order_m', 'order');
		$data = array('order_status' => $status);
		$update = $this->common->update_data_on_table('orders', 'order_id', $order_id, $data);

		if($update){
			$response['status'] = "200";
			// get customer data
			$cust = $this->order->get_order_header($order_id);
			$content = array(
				'order_id' => $order_id,
				'first_name' => $cust->first_name,
				'last_name' => $cust->last_name,
				'total_price' => $cust->total_price
			);
			// send email to customer if status = accepted
			if($status=="Accept"){
				$this->load->library('My_PHPMailer');
		        $mail = new PHPMailer();
		        $mail->IsSMTP(); // we are going to use SMTP
		        $mail->SMTPAuth   = true; // enabled SMTP authentication
		        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
		        $mail->Host       = $this->config->item('smtp_host');      // setting GMail as our SMTP server
		        $mail->Port       = $this->config->item('smtp_port');                   // SMTP port to connect to GMail
		        $mail->Username   = $this->config->item('smtp_user');  // user email address
		        $mail->Password   = $this->config->item('smtp_pass');            // password in GMail
		        $mail->SetFrom('admin@indokatering.com', 'Admin IndoKatering');  //Who is sending the email
		        $mail->Subject    = "Pesanan anda telah diterima";

		        $mail->Body      = $this->load->view('email_tpl/order_accepted', $content, true);
		        $mail->AltBody    = "Plain text message";
		        $destino = $cust->email_login; // Who is addressed the email to
		        $mail->AddAddress($destino, "Customer");

		        if(!$mail->Send()) {
		        	$this->logging->insert_event_logging('send_email_change_status', '', 'false', $mail->ErrorInfo);
		        } else {
		            $this->logging->insert_event_logging('send_email_change_status', '', 'true', 'Message sent');
		        }
		    }
		}
			
		else
			$response['status'] = "204";

		echo json_encode($response);
	}

	public function adjust_point_to_user($order_id){
		$this->load->model('Order_m', 'order');
		$this->load->model('Commerce_m', 'comm');
		// get order header
		$header = $this->order->get_order_header($order_id);
		// get order detail
		$get_detail = $this->order->get_order_detail($order_id);
		foreach($get_detail as $row){ // fetching based on post_id
			$post_id = $row->post_id;
			if(substr($post_id, 0, 2)=="SP"){// user buying point
				$point = $this->comm->get_selling_point_by_id($post_id);
				$add = $this->comm->modify_point_to_user('+', $header->user_id, $point->point);
			}
			else{
				$this->load->model('Content_m', 'content');
				// get which post belong to root category
				$get_root = $this->content->get_root_category_by_post_id($post_id);
				if($get_root->slug == 'catering') // poin is used then substract point from user
					$substract = $this->comm->modify_point_to_user('-', $header->user_id, $row->total_price);
			}
		}

		$response['status'] = 'done';

		echo json_encode($response);
	}

	public function submit_payment_conf(){
		$this->load->library('Db_trans');

		$data = array(
			'order_id' => strtoupper($this->input->post('order-id', TRUE)),
			'sender_name' => $this->input->post('name', TRUE),
			'bank_dest_id' => $this->input->post('bank-dest', TRUE),
			'transfer_date' => $this->input->post('transfer-date', TRUE),
			'total_paid' => $this->input->post('total', TRUE),
			'note' => $this->input->post('note', TRUE),
			'status' => 'Open'
			);
		$last_id = $this->db_trans->insert_data('payment_transfer', $data);

		// give notification to admin
        $this->load->library('notification');
        $notif = array(
        	'category' => 'new_payment_conf',
        	'title' => 'New Payment Confirmation',
        	'content' => 'New payment confirmation for order ID '.strtoupper($this->input->post('order-id', TRUE)),
        	'receiver_id' => 'admin'
        	);
        $this->notification->insert($notif);

		redirect('frontpage/payment_confirmation');
	}

	public function lookup_order($order_id){
		$this->load->model('Order_m', 'order');
		// get order header
		$order = $this->order->get_order_header($order_id);
		if($order==false)
			$response['status'] = '204';
		else{
			$response = array(
				'status' => '200',
				'id' => $order->order_id,
				'total' => $order->total_price
				);
		}
		
		echo json_encode($response);
	}

	public function change_payment_status($payment_id, $status){
		$this->load->library('Db_trans');
		$data = array('status' => $status);
		$update = $this->db_trans->update_data_on_table('payment_transfer', 'payment_id', $payment_id, $data);

		if($update)
			$response['status'] = "200";
		else
			$response['status'] = "204";

		echo json_encode($response);
	}


	function mail_smtp(){
		$config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'smtp.gmail.com'; //change this
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'admin@indokatering.com'; //change this
		$config['smtp_pass'] = 'Big!30Y'; //change this
	    $config['mailtype'] = 'html';
	    $config['charset'] = 'iso-8859-1';
	    $config['wordwrap'] = TRUE;
	    $config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard
		$this->load->library('email', $config);

		$this->email->from('admin@indokatering.com', 'Administrator');
		$this->email->to('ocky.harli@gmail.com');
		$this->email->cc('ocky@infodata.co.id');

		$this->email->subject('Order telah diterima');
		$this->email->message('Testing the email class pakai smtp.');

		$this->email->send();

		print_r($this->email->print_debugger());
	}

	public function send_mail() {
		$this->load->library('My_PHPMailer');
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "srv12.niagahoster.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "admin@indokatering.com";  // user email address
        $mail->Password   = "Big!30Y";            // password in GMail
        $mail->SetFrom('admin@indokatering.com', 'Admin IndoKatering');  //Who is sending the email
        //$mail->AddReplyTo("ocky@infodata.co.id","Ocky Harliansyah");  //email address that receives the response
        $mail->Subject    = "Testing email lagi";
        $mail->Body      = "HTML message";
        $mail->AltBody    = "Plain text message";
        $destino = "ocky.harli@gmail.com"; // Who is addressed the email to
        $mail->AddAddress($destino, "Ocky");

        // $mail->AddAttachment("images/phpmailer.gif");      // some attached files
        // $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
        if(!$mail->Send()) {
            echo "Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent correctly!";
        }
        
    }
}
