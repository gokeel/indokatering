<?php

class User_m extends CI_Model {
	public function __construct() {
        parent::__construct();
		$this->load->library('Db_trans');
    }
	
	function get_user_data($filter_by=null, $filter_value=null){
		$this->db->select('*');
		$this->db->from('users');
		
		if($filter_by <> null)
			$this->db->where($filter_by, $filter_value);
		$this->db->order_by('first_name');
		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function get_user_info($user_id){
		$this->db->select('*');
		$this->db->from('user_data');
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();

		return $this->db_trans->return_select_first_row($query);
	}

	function get_user_by_id($userid){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $userid);
		
		$query = $this->db->get();

		return $this->db_trans->return_select_first_row($query);
	}

	function check_user_id_exist($userid){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $userid);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return true;
		else return false;
	}

	function check_exist_user($email, $pass){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("email_login ='".$email."' AND password = md5('".$pass."')");

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->row();
		else return false;
	}

	function update_password($email, $new_pass){
		$this->db->where('email_login', $email);
		$this->db->update('users', array('password' => md5($new_pass)));
		if($this->db->affected_rows() > 0)
			return true;
		else{
			$error = $this->db->error();
			if($error['code']<>0)
				return $error['message'];
		}
	}

	function get_reset_password($user_id){
		$this->db->select('password_generated');
		$this->db->from('request_reset_password');
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->row();
		else return false;
	}
}