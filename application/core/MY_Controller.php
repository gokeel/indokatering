<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $granted = false;

	public function __construct() {
		parent::__construct();
		
		$this->is_logged_in();
		//$this->check_privilege_page();
		//$this->load->library('common_lib');
		//$this->load->model('common');
	}	
	
	function is_logged_in() {
	   	$user = $this->session->userdata('logged');
	   	return isset($user);
	}

	function check_privilege_page(){
		$user_level = $this->session->userdata('user_level');
		$controller = $this->uri->segment(1);
		$action = $this->uri->segment(2);

		$this->db->select('*');
		$this->db->from('st_privileges');
		$this->db->where('user_level', $user_level);
		$this->db->where('controller', $controller);
		$this->db->where('action', $action);

		$query = $this->db->get();
		//print_r($this->db->last_query());
		if($query->num_rows() == 0)
			$this->granted = false;
		else
			$this->granted = true;
	}
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
