<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontpage extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper('timezone');
	}

	/* pages begin */
	function open_page($file_name, $data=null){
		// set current page on session
		// since the homepage is home function and set to default route, I have to tweak a little bit
		if($file_name=="home")
			$this->session->set_flashdata('curr_page', $file_name);
		else
			$this->session->set_flashdata('curr_page', $this->uri->segment(1).'/'.$this->uri->segment(2));

		$this->load->model('Content_m', 'content');
		// get options
		$get_options = $this->content->get_all_options();
		foreach($get_options->result() as $param)
			$options[$param->parameter_name] = $param->parameter_value;
		
		$data['options'] = $options;
		$cart_count = 0;
		$price = 0;
		// get cart session
		if(isset($_SESSION['cart_items'])){
			$cart_count = sizeof($_SESSION['cart_items']);
			$price = 0;
			// fetch each product detail
			$this->load->model('Content_m', 'content');
			$data['cart']['data'] = array();
			
			foreach($_SESSION['cart_items'] as $key => $value){
	/* if cart is selling point */
				if(substr($key, 0, 2)=="SP"){
					$this->load->model('Commerce_m', 'comm');
					$point = $this->comm->get_selling_point_by_id($key);
					$data['cart']['data'][] = array(
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
						$data['cart']['data'][] = array(
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
						$data['cart']['data'][] = array(
							'id' => $key,
							'title' => $post->title,
							'price' => $product->equal_to_point,
							'qty' => $value,
							'total_price_item' => $product->equal_to_point * $value,
							'image' => $image->file_name
							);
					}
				}
				// $cart_total += intval($price);
			}
		}
		
		$data['cart']['count'] = $cart_count;
		$data['cart']['total'] = $price;	

		// generate captcha if not logged in
		if($this->session->userdata('logged')<>'in')
			$data['captcha'] = $this->generate_captcha();
		
		$this->load->view('organique/header', $data);
		$this->load->view('organique/'.$file_name);
		$this->load->view('organique/footer');
	}

	function generate_captcha(){
		//generate captcha
		$this->load->helper('captcha');
		$captcha_data = array(
			'word' => rand(1000, 9999),
			'img_path' => 'assets/captcha/',
			'img_url' => base_url().'assets/captcha/',
			//'font_path' => './path/to/fonts/texb.ttf',
			'img_width' => '150',
			'img_height' => 30,
			'expiration' => 7200
			);

		$cap = create_captcha($captcha_data);
		$insert_cap = array(
			'captcha_time' => $cap['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
		);
		$query = $this->db->insert_string('captcha', $insert_cap);
		$this->db->query($query);
		//echo $cap['image'];
		$captcha = $cap['image'];

		return $captcha;
	}

	public function home(){
		$this->load->model('Content_m', 'content');
		// get image slider
		$data['image_slider_data'] = $this->content->get_post_data('home_image_slider');
		foreach($data['image_slider_data']->result() as $row){
			if($row->primary_image<>""){
				// get image data for each
				$post_image = $this->content->get_post_image($row->primary_image);
				$data['image_on_slider'][$row->id] = $post_image->file_name;
				
			}
			else $data['image_on_slider'][$row->id] = null;
		}
		// get products by category root
		$data['menu_catering'] = $this->display_post_to_home($this->content->get_post_by_root_category('catering'));
		$data['menu_rte'] = $this->display_post_to_home($this->content->get_post_by_root_category('ready-to-eat'));

		// foreach($catering as $menu){
		// 	$data[$menu['category']][] = $menu;

		// }
		// print_r($data);

		$this->open_page('home', $data);
	}

	public function product_single(){
		$this->load->model('Content_m', 'content');
		$post_id = $this->input->get('po');

		// get post data by post id and return to client
		$post_data = $this->content->get_post_data('product','a.id', $post_id);
		
		$data['post_data'] = $post_data->row();
		// get product detail
		$data['prod_detail'] = $this->content->get_product_detail_by_post_id($data['post_data']->id);
		// get product image
		$data['prod_image'] = $this->content->get_post_image($data['post_data']->primary_image);
		// get additional images
		$data['more_images'] = $this->content->get_post_additional_images($post_id);
		// get which post belong to root category
		$get_root = $this->content->get_root_category_by_post_id($post_id);
		$data['root'] = $get_root->slug;

		$this->open_page('single_product', $data);
	}

	function selling_point(){
		$this->load->model('Commerce_m', 'comm');
		$data['points'] = $this->comm->get_selling_points();

		$this->open_page('selling_point', $data);
	}

	function checkout(){
		
		if($this->uri->segment(3)=="")
			$data['order_done'] = '';
		else{
			$order_id = $this->uri->segment(3);
			$this->load->model('Order_m', 'order');
			$this->load->model('Bank_m', 'bank');
			// get order header
			$data['header'] = $this->order->get_order_header($order_id);
			// get order detail
			// $data['detail'] = $this->order->get_order_detail($order_id);
			// // get order shipping
			// $data['ship'] = $this->order->get_order_shipping($order_id);
			// get list of bank
			$data['bank'] = $this->bank->get_bank_data('active', 'true');
			$data['order_done'] = 'yes';
		}

		$this->open_page('checkout', $data);
		
	}

	function show_error_page($error_no, $message){
		$data['error_no'] = $error_no;
		$data['error_message'] = $message;
		$this->open_page('error_message', $data);
	}

	public function order_received($order_id=null){
		if($this->session->userdata('logged')=="in"){
			$this->load->model('Order_m', 'order');
			$this->load->model('Bank_m', 'bank');
			// get order header
			$data['header'] = $this->order->get_order_header($order_id);
			// get order detail
			// $data['detail'] = $this->order->get_order_detail($order_id);
			// // get order shipping
			// $data['ship'] = $this->order->get_order_shipping($order_id);
			// get list of bank
			$data['bank'] = $this->bank->get_bank_data('active', 'true');

			$this->open_page('order_received', $data);
		}
		else
			$this->show_error_page(204, 'Anda harus membuat pesanan baru untuk mengakses halaman ini.');
		
	}

	function payment_confirmation(){
		$this->load->model('Bank_m', 'bank');
		$data['bank'] = $this->bank->get_bank_data('active', 'true');

		$this->open_page('payment_confirmation', $data);	
	}

	function display_catering(){
		$this->load->model('Content_m', 'content');
		// get products by category root
		$catering = $this->display_post_to_home($this->content->get_post_by_root_category('catering'));

		foreach($catering as $menu){
			$data['menu_catering'][$menu['category']][] = $menu;

		}
		// print_r($data);

		$this->open_page('catering_product', $data);
	}

	function display_ready_to_eat(){
		$category = $this->uri->segment(3);
		$this->load->model('Content_m', 'content');
		// get category data
		$data['category'] = $this->content->get_rte_category_only_product_exist();

		if($category==""){
			// get products by category root
			$data['menu_rte'] = $this->display_post_to_home($this->content->get_post_by_root_category('ready-to-eat'));
		}
		// else{

		// }
		

		// print_r($data);

		$this->open_page('readytoeat_product', $data);
	}

	function my_account_page(){
		if($this->session->userdata('logged')=="in"){
			$user_id = $this->session->userdata('userid');
			$data['tab'] = $this->input->get('tab');

			$this->load->model('Order_m', 'order');
			$this->load->model('User_m', 'user');

			$data['orders'] = $this->order->view_order_by_userid($user_id);
			$data['user_main'] = $this->user->get_user_by_id($user_id);
			$data['user_info'] = $this->user->get_user_info($user_id);

			$this->open_page('my_account', $data);
		}
		else
			$this->show_error_page('700', 'Anda harus melakukan login sebelum mengakses halaman ini.');
	}

	function detail_order($order_id){
		// give restriction if user not accessing his/her orders
		$this->load->model('Order_m', 'order');
		$auth = $this->order->check_granted_order_view($order_id, $this->session->userdata('userid'));
		if($auth){
			$this->load->model('Content_m', 'content');
			// get order header
			$data['header'] = $this->order->get_order_header($order_id);
			// get order detail
			$get_detail = $this->order->get_order_detail($order_id);
			foreach($get_detail as $row){ // fetching based on post_id
				$post_id = $row->post_id;
				if(substr($post_id, 0, 2)=="SP"){
					$this->load->model('Commerce_m', 'comm');
					$point = $this->comm->get_selling_point_by_id($post_id);
					$detail[] = array(
						'id' => $post_id,
						'title' => $point->title,
						'price' => $row->price_on_sale,
						'point' => $point->point,
						'qty' => $row->quantity,
						'total' => $row->total_price,
						'image' => 'point.jpg'
						);
				}
				else{
					// get post detail
					$post_data = $this->content->get_post_data('product','a.id', $post_id);
					$post = $post_data->row();
					// get product detail
					$product = $this->content->get_product_detail_by_post_id($post_id);
					// get product image
					$image = $this->content->get_post_image($post->primary_image);
					// get which post belong to root category
					$get_root = $this->content->get_root_category_by_post_id($post_id);
					if($get_root->slug <> 'catering'){
						$detail[] = array(
							'id' => $post_id,
							'title' => $post->title,
							'price' => $row->price_on_sale,
							'qty' => $row->quantity,
							'total' => $row->total_price,
							'image' => $image->file_name
							);
					}
					else{
						$detail[] = array(
							'id' => $post_id,
							'title' => $post->title,
							'price' => $product->equal_to_point,
							'qty' => $row->quantity,
							'total' => $row->total_price,
							'image' => $image->file_name
							);
					}
				}
			}

			$data['detail'] = $detail;
			// get order shipping
			$data['ship'] = $this->order->get_order_shipping($order_id);

			$this->open_page('order_detail', $data);
		}
		else
			$this->show_error_page('207', 'Anda tidak diperbolehkan mengakses pesanan orang lain.');

		
	}

	public function blog(){
		setlocale(LC_ALL, 'IND');
		$cat_slug = $this->uri->segment(3);
		$limit_start = $this->input->get('ls', TRUE);
		$limit_end = $this->input->get('le', TRUE);

		$this->load->model('Content_m', 'content');

		// get post
		if($limit_start=="")
			$get_post = $this->content->get_post_category_slug($cat_slug);
		else
			$get_post = $this->content->get_post_category_slug($cat_slug, $limit_start, $limit_end);

		if($get_post==false)
			$data['posts'] = false;
		else{
			// check if the post category match the slug
			foreach($get_post as $post){
				$image = $this->content->get_post_image($post->primary_image);
				$data['posts'][] = array(
					'id' => $post->id,
					'title' => $post->title,
					'content' => $post->content,
					'tags' => $post->tags,
					'category' => $post->category_name,
					'image' => ($image==false ? '': $image->file_name),
					'timestamp' => $post->creation_datetime
					);
			}
		}

		$data['group_month'] = $this->content->grouping_blog_month();

		$this->open_page('blog_view', $data);
	}

	public function page_view(){
		$url_page = $this->uri->segment(2);

		$this->load->model('Content_m', 'content');

		$data['page'] = $this->content->get_page_by_url($url_page);
		$data['group_month'] = $this->content->grouping_blog_month();

		$this->open_page('page_view', $data);
	}

	public function forgot_password(){
		$data['message'] = $this->session->flashdata('msg_reset');
		$this->open_page('forgot_password', $data);
	}

	public function reset_done(){
		$this->open_page('reset_password_completed');
	}

	/* end pages */

	function display_post_to_home($data){
		foreach($data->result() as $row){
			$product = $this->content->get_product_detail_by_post_id($row->id);
			$image = $this->content->get_post_image($row->primary_image);
			$result[] = array(
				'id' => $row->id,
				'title' => $row->title,
				'content' => $row->content,
				'tags' => $row->tags,
				'price' => $product->price,
				'point' => $product->equal_to_point,
				'discount' => $product->discount,
				'image' => $image->file_name,
				'category' => $row->category_name
				);
		}
		

		return $result;
	}

	function get_order_detail($order_id){
		// get order header
		$data['header'] = $this->order->get_order_header($order_id);
		// get order detail
		$data['detail'] = $this->order->get_order_detail($order_id);
		// get order shipping
		$data['ship'] = $this->order->get_order_shipping($order_id);

		return $data;
	}
}
