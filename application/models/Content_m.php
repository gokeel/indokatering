<?php

class Content_m extends CI_Model {
	public function __construct() {
        parent::__construct();
		$this->load->library('Db_trans');
    }
	
	function get_category($filter_by=null, $filter_value=null){
		$this->db->select('*');
		$this->db->from('post_categories');
		
		if($filter_by <> null)
			$this->db->where($filter_by, $filter_value);
		$this->db->order_by('category');
		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function get_category_by_id($id){
		$this->db->select('*');
		$this->db->from('post_categories');
		$this->db->where('id', $id);
		$this->db->order_by('category');

		$query = $this->db->get();
		
		return $this->db_trans->return_select_first_row($query);
	}

	function get_root_category(){
		$this->db->select('*');
		$this->db->from('post_categories');
		$this->db->where('parent_id', '0');
		$this->db->order_by('category');
		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}
	
	function get_post_data($type, $filter_by=null, $filter_value=null){
		$this->db->select('a.*, b.category as category_name, first_name, last_name');
		$this->db->from('posts a');
		$this->db->join('post_categories b', 'a.category=b.id', 'left');
		$this->db->join('users c', 'a.author = c.user_id');
		$this->db->where('type', $type);
		
		if($filter_by <> null)
			$this->db->where($filter_by, $filter_value);
		$this->db->order_by('id desc');
		
		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function get_product_detail_by_post_id($post_id){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('post_id', $post_id);

		$query = $this->db->get();
		
		return $this->db_trans->return_select_first_row($query);
	}

	function get_post_image($media_id){
		$this->db->select('*');
		$this->db->from('media_files');
		$this->db->where('id', $media_id);

		$query = $this->db->get();
		
		return $this->db_trans->return_select_first_row($query);
	}

	function get_post_additional_images($post_id){
		$this->db->select('a.*, b.file_name');
		$this->db->from('post_media a');
		$this->db->join('media_files b', 'a.media_id=b.id');
		$this->db->where('a.post_id', $post_id);
		$this->db->order_by('a.entry_datetime desc');

		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function get_category_data($filter_by=null, $filter_value=null){
		$this->db->select('*');
		$this->db->from('post_categories');
		
		if($filter_by <> null)
			$this->db->where($filter_by, $filter_value);
		$this->db->order_by('parent_id');
		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function get_all_options(){
		$query = $this->db->get('options');

		return $this->db_trans->return_select($query);
	}

	function get_option_by_param($param){
		$this->db->select('*');
		$this->db->from('options');
		$this->db->where('parameter_name', $param);
		$query = $this->db->get();

		return $this->db_trans->return_select_first_row($query);
	}

	function get_post_by_root_category($slug){ // khusus product
		$this->db->select('a.*, b.category as category_name');
		$this->db->from('posts a');
		$this->db->join('post_categories b', 'a.category=b.id');
		$this->db->join('post_categories c', 'b.parent_id=c.id');
		$this->db->where('c.slug', $slug);
		$this->db->order_by('a.id desc');

		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);	
	}
	
	function get_root_category_by_post_id($post_id){
		$this->db->select('c.slug');
		$this->db->from('posts a');
		$this->db->join('post_categories b', 'a.category=b.id');
		$this->db->join('post_categories c', 'b.parent_id=c.id');
		$this->db->where('a.id', $post_id);

		$query = $this->db->get();
		
		return $this->db_trans->return_select_first_row($query);
	}

	function get_product_category_noroot(){
		$this->db->select('*');
		$this->db->from('post_categories');
		$this->db->where('category_part', 'product');
		$this->db->where('parent_id <>', '0');
		$this->db->order_by('category');
		$query = $this->db->get();
		
		return $this->db_trans->return_select($query);
	}

	function get_rte_category_only_product_exist(){
		$query = $this->db->query('select pc.* from post_categories pc
				join post_categories pcb on pc.parent_id=pcb.id
				where pcb.slug = "ready-to-eat" and pc.id in (select distinct category from posts p)');

		return $this->db_trans->return_select($query);
	}

	function get_post_category_slug($slug, $limit_start=0, $limit_end=10){ // post umum
		$this->db->select('p.*, pc.category as category_name, pc.slug');
		$this->db->from('posts p');
		$this->db->join('post_categories pc', 'p.category=pc.id');
		$this->db->where('type', 'post');
		$this->db->where('slug', $slug);
		$this->db->limit($limit_end, $limit_start);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	function grouping_blog_month(){
		$query = $this->db->query("select date_format(creation_datetime, '%M %Y') as group_date, count(*) as count from posts
					where type='post' 
					group by date_format(creation_datetime, '%M %Y')");

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	function get_page_by_url($url){
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->where('url', $url);

		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}
}