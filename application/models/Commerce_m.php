<?php

class Commerce_m extends CI_Model {
	public function __construct() {
        parent::__construct();
		$this->load->library('Db_trans');
    }

    function get_selling_points(){
    	$this->db->select('*');
    	$this->db->from('selling_points');
    	$this->db->order_by('point');

    	$query = $this->db->get();
		
		return $this->db_trans->return_select($query);	
    }

    function get_selling_point_by_id($id){
        $this->db->select('*');
        $this->db->from('selling_points');
        $this->db->where('id', $id);

        $query = $this->db->get();
        
        return $this->db_trans->return_select_first_row($query);  
    }

    function modify_point_to_user($operation, $user_id, $point){
        $query = $this->db->query('
            UPDATE users SET point_balance = point_balance '.$operation.' '.$point.'
            WHERE user_id = "'.$user_id.'"
            ');
        $error = $this->db->error();
        if ($this->db->affected_rows() > 0)
            return true;
        else 
            return false;
        
    }

}