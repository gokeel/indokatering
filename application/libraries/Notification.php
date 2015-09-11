<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification {
	private $ci;
	
	public function __construct()
    {
        $this->ci =& get_instance();
    }
	
	function get_data($filter_by=null, $filter_value=null){
		$this->ci->db->select('a.*, b.first_name, b.last_name');
		$this->ci->db->from('notifications a');
		$this->ci->db->join('users b', 'a.sender_id=b.user_id', 'left');
		if($filter_by<>null)
			$this->ci->db->where($filter_by, $filter_value);
		$this->ci->db->order_by('id desc');
		$query = $this->ci->db->get();

		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function count_by_date($date){
		$this->ci->db->like('created_datetime', $date);
		$this->ci->db->order_by('category asc');
		$query = $this->ci->db->get('notifications');
		return $query->num_rows();
	}

	function insert($data){
		$data_insert = array(
			'category' => $data['category'],
			'title' => $data['title'],
			'content' => $data['content'],
			'sender_id' => $data['sender_id'],
			'receiver_id' => $data['receiver_id'],
			'has_been_read' => 'false'
		);
		$this->ci->load->model('common');
		$insert = $this->ci->common->add_to_table('notifications', $data_insert);

		return $insert;
	}

	function count_unread(){
		$this->ci->db->where('has_been_read', 'false');
		$query = $this->ci->db->get('notifications');
		return $query->num_rows();
	}

}

/* End of file Custom.php */
/* Location: ./application/libraries/Custom.php */