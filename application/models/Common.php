<?php

class Common extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	function select_data($table, $orderby){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($orderby);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function add_to_table($table, $data){
		$insert = $this->db->insert($table, $data);
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		else return false;
	}
	
	function delete_from_table_by_id($table, $field_id, $id){
		$this->db->delete($table, array($field_id => $id));
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	public function get_detail_by_id($table, $field_id, $id){
		$this->db->where($field_id, $id);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	public function get_afield_by_id($table, $field_id, $id, $field){
		$this->db->select($field)->from($table)->where($field_id, $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function update_data_on_table($table, $field_id, $id, $data){
		$this->db->where($field_id, $id);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function check_exist_value_in_table($table, $field, $value){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field, $value);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
}