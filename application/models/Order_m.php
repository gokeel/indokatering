<?php

class Order_m extends CI_Model {
	public function __construct() {
        parent::__construct();
		$this->load->library('Db_trans');
    }
	
	function insert_new_order($data){
		$insert = $this->db->insert('orders', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	function get_latest_order_id_this_month($prefix){
		$query = $this->db->query("select * from orders
				where order_id like '".$prefix."%'
				order by order_id desc
				limit 0,1");

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	function insert_order_detail($data){
		$insert = $this->db->insert('order_details', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	function insert_order_shipping($data){
		$insert = $this->db->insert('order_shipping', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	function delete_order_id($id){
		$this->db->delete('orders', array('order_id' => $id));
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	function get_order_header($order_id){
		$this->db->select('a.*, b.email_login, b.first_name, b.last_name');
		$this->db->from('orders a');
		$this->db->join('users b', 'a.user_id=b.user_id');
		$this->db->where('a.order_id', $order_id);

		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row();
		else
			false;
	}

	function get_order_detail($order_id){
		$this->db->select('a.*');
		$this->db->from('order_details a');
		$this->db->where('order_id', $order_id);
		$this->db->order_by('detail_id');

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			false;
	}

	function get_order_shipping($order_id){
		$this->db->select('*');
		$this->db->from('order_shipping');
		$this->db->where('order_id', $order_id);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->row();
		else
			false;
	}

	function view_order_summary(){
		$this->db->select('a.*, b.email_login, b.first_name, b.last_name');
		$this->db->from('orders a');
		$this->db->join('users b', 'a.user_id=b.user_id');
		$this->db->order_by('a.entry_date desc');

		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function view_customer_payment(){
		$this->db->select('*');
		$this->db->from('payment_transfer a');
		$this->db->join('bank_accounts b', 'a.bank_dest_id=b.bank_id');
		$this->db->order_by('a.payment_id desc');

		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function view_order_by_userid($user_id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('entry_date desc');

		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function check_granted_order_view($order_id, $user_id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('order_id', $order_id);
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
}