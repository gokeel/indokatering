<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('Logging');
	}

	/* pages begin */
	function open_page($file_name, $data=null){
		if($this->is_logged_in()){
			$this->load->view('admin_header', $data);
			$this->load->view('admin_sidebar_left');
			$this->load->view($file_name);
		}
		else
			redirect('users/login');
	}

	public function user_view(){
		$view = $this->input->get('v');
		$data = array(
			'am' => 'user',
			'asm_1' => 'view_all',
			'title_page' => 'View All Users'
			);

		$this->load->model('User_m', 'user');
		//get user data
		$data['users'] = $this->user->get_user_data();

		$this->open_page('admin_user_view_all', $data);
	}

	public function add_user(){
		$this->session->set_flashdata('curr_page', $this->uri->segment(1).'/'.$this->uri->segment(2));
		$data = array(
			'am' => 'user',
			'asm_1' => 'new',
			'title_page' => 'Add New User',
			'title' => 'add'
			);

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
		$data['captcha'] = $cap['image'];
				
		$this->open_page('admin_user_creation', $data);
	}

	public function edit_user(){
		$this->session->set_flashdata('curr_page', $this->uri->segment(1).'/'.$this->uri->segment(2));
		$data = array(
			'am' => 'user',
			'asm_1' => 'new',
			'title_page' => 'Edit User',
			'title' => 'edit'
			);

		//get user data
		$this->load->model('User_m', 'user');
		$data['user'] = $this->user->get_user_by_id($this->input->get('id', TRUE));

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
		$data['captcha'] = $cap['image'];
				
		$this->open_page('admin_user_creation', $data);
	}

	public function change_password_view(){
		$this->session->set_flashdata('curr_page', $this->uri->segment(1).'/'.$this->uri->segment(2));
		$data = array(
			'am' => 'user',
			'asm_1' => 'change-password',
			'title_page' => 'Change My Password'
			);

		$this->open_page('admin_change_password', $data);
	}

	// public function login(){
	// 	$this->load->view('admin_login');
	// }

	/* end pages */

	function generate_random_string($type, $length) {
		if($type=="letter")
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		else if($type=="number")
			$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function check_captcha(){
		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($this->input->post('captcha', TRUE) , $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		return $row;
	}

	public function user_add(){
		$current_page = $this->session->flashdata('curr_page');
		//check captcha
		$row = $this->check_captcha();
		if ($row->count == 0)
		{
			$this->session->set_flashdata('err_no', '204');
			$this->session->set_flashdata('err_msg', 'You must submit the word that appears in the image');
			redirect($current_page);
		}
		else{
			$this->load->model('User_m', 'user');
			$this->load->library('Db_trans');

			$check_exist_user = true;
			$data = array(
				'email_login' => $this->input->post('email', TRUE),
				'password' => md5($this->input->post('pass', TRUE)),
				'first_name' => $this->input->post('fn', TRUE),
				'last_name' => $this->input->post('ln', TRUE),
				'user_level' => $this->input->post('level', TRUE)
				);
			while ($check_exist_user==true){
				$random_letter = $this->generate_random_string('letter', 5);
				$random_number = $this->generate_random_string('number', 5);
				$new_user_id = $random_letter.$random_number;
				if(!$this->user->check_user_id_exist($new_user_id))
					$check_exist_user=false;
			}
			$data['user_id'] = $new_user_id;

			$create = $this->db_trans->insert_data('users', $data);
			if($this->input->post('level', TRUE)=="customer"){
				$this->session->set_userdata('logged', 'in');
				$this->session->set_userdata('userid', $new_user_id);
				$this->session->set_userdata('email', $this->input->post('email', TRUE));
				$this->session->set_userdata('fn', $this->input->post('fn', TRUE));
				$this->session->set_userdata('ln', $this->input->post('ln', TRUE));
				$this->session->set_userdata('level', $this->input->post('level', TRUE));

				$this->session->set_flashdata('err_no', '200');
				$this->session->set_flashdata('err_msg', 'Registrasi sukses, anda dapat melanjutkan pemesanan anda.');
			}
			

			redirect($current_page);
		}
	}

	public function user_update(){
		$userid = $this->input->post('user_id');
		//check captcha
		$row = $this->check_captcha();
		if ($row->count == 0)
		{
			$this->session->set_flashdata('err_no', '204');
			$this->session->set_flashdata('err_msg', 'You must submit the word that appears in the image');
			redirect('users/add_user');
		}
		else{
			$this->load->library('Db_trans');

			$data = array(
				'email_login' => $this->input->post('email', TRUE),
				'first_name' => $this->input->post('fn', TRUE),
				'last_name' => $this->input->post('ln', TRUE),
				'user_level' => $this->input->post('level', TRUE)
				);

			$update = $this->db_trans->update_data_on_table('users', 'user_id', $userid, $data);

			redirect('users/user_view');
		}
	}

	public function user_delete(){
		$id = $this->input->get('id', TRUE);
		$this->load->library('Db_trans');
		$this->db_trans->delete_from_table_by_id('users', 'user_id', $id);

		redirect('users/user_view');
	}

	public function do_login(){
		$current_page = $this->session->userdata('curr_page');

		$this->load->model('User_m', 'user');
		$user_data = $this->user->check_exist_user($this->input->post('email', TRUE), $this->input->post('password', TRUE));
		if(!$user_data)
			$response['status'] = '204'; 
		else{
			if($current_page=="cms/login"){
				if($user_data->user_level=="admin" or $user_data->user_level=="staff"){
					$response['status'] = '200';
					$this->session->set_userdata('logged', 'in');
					$this->session->set_userdata('userid', $user_data->user_id);
					$this->session->set_userdata('email', $user_data->email_login);
					$this->session->set_userdata('fn', $user_data->first_name);
					$this->session->set_userdata('ln', $user_data->last_name);
					$this->session->set_userdata('level', $user_data->user_level);
				}
				else
					$response['status'] = '205';
			}
			else{ // if not cms login
				$response['status'] = '200';
				$this->session->set_userdata('logged', 'in');
				$this->session->set_userdata('userid', $user_data->user_id);
				$this->session->set_userdata('email', $user_data->email_login);
				$this->session->set_userdata('fn', $user_data->first_name);
				$this->session->set_userdata('ln', $user_data->last_name);
				$this->session->set_userdata('level', $user_data->user_level);
			}
		}
			
		// if($current_page=="cms/login")
			echo json_encode($response);
		// else
		// 	redirect($current_page);
	}

	public function do_logout(){
		$this->session->sess_destroy();
		$current_page = $this->session->flashdata('curr_page');
		redirect($current_page);
	}

	function password_change(){
		$email = $this->input->post('email', TRUE);
		$old = $this->input->post('old', TRUE);
		$new = $this->input->post('new', TRUE);

		// check email and old password first
		$this->load->model('User_m', 'user');
		$check = $this->user->check_exist_user($email, $old);
		if(!$check){
			$response['status'] = '204';
			$response['message'] = 'Email/Password tidak sesuai';
		}
		else{
			$update = $this->user->update_password($email, $new);
			if($update)
				$response['status'] = '200';
			else{
				$response['status'] = '204';
				$response['message'] = $update;
			}
		}

		echo json_encode($response);
	}

	function change_profile(){
		$user_id = $this->input->post('userid', TRUE);
		$general = array(
			'first_name' => $this->input->post('fn', TRUE),
			'last_name' => $this->input->post('ln', TRUE)
			);
		$this->load->model('Common');
		$update_general = $this->Common->update_data_on_table('users', 'user_id', $user_id, $general);

		$meta = array(
			'address_1' => $this->input->post('ship-address-1', TRUE),
			'address_2' => $this->input->post('ship-address-2', TRUE),
			'zip_code' => $this->input->post('ship-zip-code', TRUE),
			'city' => $this->input->post('ship-city', TRUE),
			'province' => $this->input->post('ship-province', TRUE),
			'phone' => $this->input->post('ship-phone', TRUE)
			);
		//check if the user has meta data in table user_data. if not exist will create the new one, if exist will update
		$check = $this->Common->check_exist_value_in_table('user_data', 'user_id', $user_id);
		// var_dump($check);
		if($check) // exist
			$update = $this->Common->update_data_on_table('user_data', 'user_id', $user_id, $meta);
		else{
			$meta['user_id'] = $user_id;
			$insert = $this->Common->add_to_table('user_data', $meta);
			// print_r($this->db->last_query());
		}
		
		redirect('profile?tab=profile');
	}

	function request_reset_password(){
		$email = $this->input->post('email', TRUE);
		$this->load->model('User_m', 'user');

		$get = $this->user->get_user_data('email_login', $email);
		if($get==false){
			$this->session->set_flashdata('msg_reset', 'Email tidak ditemukan, harap memasukkan email anda saat melakukan registrasi.');
			redirect('frontpage/forgot_password');
		}
		else{
			$random_letter = $this->generate_random_string('letter', 5);
			$random_number = $this->generate_random_string('number', 5);
			$generated_password = $random_letter.$random_number;

			$user_id = $get->row()->user_id;
			$data = array( // insert to request reset password
				'user_id' => $user_id,
				'password_generated' => $generated_password
				);
			$this->load->model('Common');
			// delete the old requests
			$delete = $this->Common->delete_from_table_by_id('request_reset_password', 'user_id', $user_id);
			// then we insert the data
			$insert = $this->Common->add_to_table('request_reset_password', $data);

			// send email to user
			$content = array(
				'user_id' => $user_id,
				'new_password' => $generated_password
			);
			
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
	        $mail->Subject    = "Request Reset Password";

	        $mail->Body      = $this->load->view('email_tpl/request_reset_password', $content, true);
	        $mail->AltBody    = "Plain text message";
	        $destino = $email; // Who is addressed the email to
	        $mail->AddAddress($destino, "Customer");

	        if(!$mail->Send()) {
	        	$this->logging->insert_event_logging('send_email_request_reset_password', '', 'false', $mail->ErrorInfo);
	        } else {
	            $this->logging->insert_event_logging('send_email_request_reset_password', '', 'true', 'Message sent');
	        }

	        $this->session->set_flashdata('msg_reset', 'Kami telah mengirim link ke email anda, mohon ikuti petunjuk didalam email tersebut.');
			redirect('frontpage/forgot_password');
		}
	}

	function reset(){
		$user_id = $this->input->get('id', TRUE);
		$this->load->model('User_m', 'user');
		// get password in request reset password
		$get = $this->user->get_reset_password($user_id);
		$new_password = $get->password_generated;

		// then update in users
		$this->load->model('Common');
		$data = array('password' => md5($new_password));
		$update = $this->Common->update_data_on_table('users', 'user_id', $user_id, $data);

		redirect('frontpage/reset_done');
	}
}
