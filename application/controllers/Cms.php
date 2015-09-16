<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper('timezone');
	}

	/* pages begin */
	public function index(){
		redirect('cms/view_order');
	}

	function open_page($file_name, $data=null){
		if($this->is_logged_in()){
			// get notifications
			$this->load->library('notification');
			$data['notifications'] = $this->notification->get_data();
			$data['notif_unread'] = $this->notification->count_unread();

			$this->load->view('admin_header', $data);
			$this->load->view('admin_sidebar_left');
			$this->load->view($file_name);
		}
		else
			redirect('cms/login');
	}

	public function login(){
		$this->session->set_userdata('curr_page', $this->uri->segment(1).'/'.$this->uri->segment(2));
		$this->load->view('admin_login');
	}

	public function post_new(){
		$this->load->model('Content_m', 'content');
		$data = array(
			'am' => 'post',
			'asm_1' => 'new',
			'title_page' => 'Add new post',
			'title' => 'add'
			);
		// get category
		$data['category'] = $this->content->get_category('category_part', 'post');
		$this->open_page('admin_post_creation', $data);
	}

	public function view_post(){
		$type = $this->input->get('ty');
		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');
		
		$data = array(
			'am' => $type,
			'asm_1' => 'view_all',
			'title_page' => 'View all '.$type.'s',
			'title' => 'view'
			);
		$data['post'] = $this->content->get_post_data($type);
		//get the category name for each category id on all post
		if($data['post']<>false){
			// foreach($data['post']->result() as $row){
			// 	if($row->category<>""){
			// 		$cats = explode(',', $row->category);
			// 		// get category data for each
			// 		for($i=0;$i<sizeof($cats);$i++){
			// 			$get = $this->content->get_category('id', $cats[$i]);
			// 			$cat = $get->row();
			// 			$data['cats'][$row->id][] = $cat->category;
			// 		}
			// 	}
			// 	else $data['cats'] = null;
			// }
			//get detail data on post type
			if($type=="product")
				$data['prod_detail'] = $this->get_product_detail($data['post']->result());
		}
		//print_r($data['prod_detail']);

		$this->open_page('admin_'.$type.'_view_all', $data);
	}

	public function post_edit(){
		$this->load->model('Content_m', 'content');
		$data = array(
			'am' => 'post',
			'asm_1' => 'new',
			'title_page' => 'Edit post',
			'title' => 'edit'
			);
		// get category
		$data['category'] = $this->content->get_category('category_part', 'post');
		// get post data by post id and return to client
		$post_data = $this->content->get_post_data('post','a.id', $this->input->get('id', TRUE));
		$data['post_data'] = $post_data->row();
		// get post image
		$data['post_image'] = $this->content->get_post_image($data['post_data']->primary_image);
		// get additional images
		$data['more_images'] = $this->content->get_post_additional_images($this->input->get('id', TRUE));

		$this->open_page('admin_post_creation', $data);
	}

	public function product_new(){
		$this->load->model('Content_m', 'content');
		$data = array(
			'am' => 'product',
			'asm_1' => 'new',
			'title_page' => 'Add new product',
			'title' => 'add'
			);
		// get category
		$data['root_category'] = $this->content->get_root_category('category_part', 'product');
		$this->open_page('admin_product_creation', $data);
	}

	public function product_edit(){
		$this->load->model('Content_m', 'content');
		$data = array(
			'am' => 'product',
			'asm_1' => 'new',
			'title_page' => 'Edit product',
			'title' => 'edit'
			);
		
		// get category
		$data['root_category'] = $this->content->get_root_category('category_part', 'product');

		// get post data by post id and return to client
		$post_data = $this->content->get_post_data('product','a.id', $this->input->get('po_id', TRUE));
		$data['post_data'] = $post_data->row();
		// // get product detail
		$data['prod_detail'] = $this->content->get_product_detail_by_post_id($data['post_data']->id);
		// // get product image
		$data['prod_image'] = $this->content->get_post_image($data['post_data']->primary_image);
		// // get additional images
		$data['more_images'] = $this->content->get_post_additional_images($this->input->get('po_id', TRUE));
		// get root id of current category
		$get_root_of_current_category = $this->content->get_category_by_id($data['post_data']->category);
		$data['currenct_root_category'] = $get_root_of_current_category->parent_id;
		
		$this->open_page('admin_product_creation', $data);
	}

	public function category_view(){
		$type = $this->input->get('ty',TRUE);

		$this->load->model('Content_m', 'content');

		$data = array(
			'am' => $type,
			'asm_1' => 'view_category',
			'title_page' => 'Edit product',
			'title' => $type
			);
		// get category data
		$data['category'] = $this->content->get_category_data('category_part', $type);
		// get parent category

		if($data['category']<>false){
			foreach($data['category']->result() as $row){
				if($row->parent_id <> "" and $row->parent_id <> "0"){
					$parent = $this->content->get_category_data('id', $row->parent_id);
					//print_r($parent);
					$data['parent'][$row->id] = $parent->row()->category;
				}
				else
					$data['parent'][$row->id] = '';

			}
		}
		$this->open_page('admin_category_crud', $data);
	}

	public function set_options(){
		$data = array(
			'am' => 'setting',
			'asm_1' => 'general',
			'title_page' => 'Global Setting'
			);

		$this->load->model('Content_m', 'content');
		$get_options = $this->content->get_all_options();
		foreach($get_options->result() as $param){
			$options[$param->parameter_name]['desc'] = $param->description;
			$options[$param->parameter_name]['value'] = $param->parameter_value;
		}
		$data['options'] = $options;

		$this->open_page('admin_setting', $data);
	}

	public function set_commerce(){
		$data = array(
			'am' => 'setting',
			'asm_1' => 'commerce',
			'title_page' => 'e-Commerce Setting'
			);

		$this->load->model('Commerce_m', 'comm');
		$data['selling_point'] = $this->comm->get_selling_points();

		$this->load->model('Bank_m', 'bank');
		$data['banks'] = $this->bank->get_bank_data();

		$this->load->model('Content_m', 'content');
		$get_options = $this->content->get_all_options();
		foreach($get_options->result() as $param){
			$options[$param->parameter_name]['desc'] = $param->description;
			$options[$param->parameter_name]['value'] = $param->parameter_value;
		}
		$data['options'] = $options;

		$this->open_page('admin_setting_commerce', $data);
	}

	public function view_order(){
		$data = array(
			'am' => 'order',
			'asm_1' => 'view_all',
			'title_page' => 'Customer Orders'
			);

		$this->load->model('Order_m', 'order');

		$data['orders'] = $this->order->view_order_summary();

		$this->open_page('admin_order_view_all', $data);
	}

	public function view_order_detail($order_id){
		$data = array(
			'am' => 'order',
			'asm_1' => 'view_all',
			'title_page' => 'Customer Orders'
			);

		$this->load->model('Order_m', 'order');
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

		//print_r($data['detail']);
		$this->open_page('admin_order_view_detail', $data);
	}

	public function view_payment(){
		$data = array(
			'am' => 'order',
			'asm_1' => 'payment',
			'title_page' => 'Customer Payment Confirmation'
			);

		$this->load->model('Order_m', 'order');

		$data['payments'] = $this->order->view_customer_payment();

		$this->open_page('admin_payment_view_all', $data);
	}

	public function page_new(){
		$this->load->model('Content_m', 'content');
		$data = array(
			'am' => 'page',
			'asm_1' => 'new',
			'title_page' => 'Add new page',
			'title' => 'add'
			);
		$this->open_page('admin_page_creation', $data);
	}

	public function page_edit(){
		$this->load->model('Content_m', 'content');
		$data = array(
			'am' => 'page',
			'asm_1' => 'new',
			'title_page' => 'Edit page',
			'title' => 'edit'
			);
		// get post data by post id and return to client
		$post_data = $this->content->get_post_data('page','a.id', $this->input->get('id', TRUE));
		
		$data['page_data'] = $post_data->row();
		
		$this->open_page('admin_page_creation', $data);
	}

	function show_notifications(){
		$data = array(
			'am' => 'order',
			'asm_1' => 'view_all',
			'title_page' => 'Notifications'
			);

		$id=$this->input->get('id', TRUE);

		$this->load->library('notification');

		if($id=="")
			$get_data = $this->notification->get_data();
		else
			$get_data = $this->notification->get_data('id', $id);
		// print_r($this->db->last_query());
		foreach($get_data as $notif){
			$this->load->model('Common');
			$data_read = array('has_been_read' => "true");
			if($notif->has_been_read=="false")
				$this->Common->update_data_on_table('notifications', 'id', $notif->id, $data_read);
		}

		if($id=="")
			$get_data = $this->notification->get_data();
		else
			$get_data = $this->notification->get_data('id', $id);
		
		$data['show_notifications'] = $get_data;

		$this->open_page('admin_notifications', $data);
	}

	function media_view_all(){
		$data = array(
			'am' => 'media',
			'asm_1' => 'view_all',
			'title_page' => 'Media'
			);

		$this->load->model('Content_m', 'content');

		$data['media'] = $this->content->get_media();

		$this->open_page('admin_media_view_all', $data);
	}

	/* end pages */

	public function add_post(){
		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');
		$data = $this->general_post_data();
		$last_id = $this->db_trans->insert_data('posts', $data);

		if (! empty($_FILES['image_file']['name']))
			$this->upload_set_primary_image($last_id);

		redirect('cms/post_edit?id='.$last_id);
	}

	public function update_post(){
		$id = $this->input->get('id', TRUE);
		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');
		$data = $this->general_post_data();
		$update = $this->db_trans->update_data_on_table('posts', 'id', $id, $data);

		if (! empty($_FILES['image_file']['name']))
			$this->upload_set_primary_image($id);

		redirect('cms/post_edit?id='.$id);
	}

	public function delete_post(){
		$type = $this->input->get('ty');
		$id = $this->input->get('id', TRUE);
		$this->load->library('Db_trans');
		$this->db_trans->delete_from_table_by_id('posts', 'id', $id);

		redirect('cms/view_post?ty='.$type);
	}

	public function add_page(){
		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');
		$data = $this->general_post_data();
		$last_id = $this->db_trans->insert_data('posts', $data);

		redirect('cms/page_edit?id='.$last_id);
	}

	function general_post_data(){		
		$data = array(
			'title' => ucwords($this->input->post('title', TRUE)),
			'type' => $this->input->post('type', TRUE),
			'content' => $this->input->post('content', TRUE),
			'category' => $this->input->post('category', TRUE),
			'tags' => $this->input->post('tags', TRUE),
			'status' => $this->input->post('action', TRUE),
			'author' => $this->session->userdata('userid'),
			'url' => $this->input->post('url', TRUE)
			);
		// $data['category'] = '';
		// if(is_array($_POST['category'])){
		// 	foreach($_POST['category'] as $cat)
		// 		$data['category'] += $cat.',';
		// 	rtrim($data['category'], ',');
		// }
		// else
		// 	$data['category'] = $this->input->post('category', TRUE);

		return $data;
	}

	public function product_add(){
		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');
		
		$data = $this->general_post_data();
		
		$last_id = $this->db_trans->insert_data('posts', $data);
		// insert detail product
		$product_info = array(
			'post_id' => $last_id,
			'price' => $this->input->post('price', TRUE),
			'discount' => $this->input->post('discount', TRUE),
			'equal_to_point' => $this->input->post('point', TRUE),
			'currency' => 'Rp'
			);
		$this->db_trans->insert_data('products', $product_info);
		// upload image if user upload image
		if (! empty($_FILES['image_file']['name']))
			$this->upload_set_primary_image($last_id);

        redirect('cms/product_new');
	}

	public function product_update(){
		$prod_id = $this->input->post('product_id', TRUE);
		$post_id = $this->input->post('post_id', TRUE);

		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');

		$data = $this->general_post_data();

		$upd = $this->db_trans->update_data_on_table('posts', 'id', $post_id, $data);
		// insert detail product
		$product_info = array(
			'price' => $this->input->post('price', TRUE),
			'discount' => $this->input->post('discount', TRUE),
			'equal_to_point' => $this->input->post('point', TRUE),
			'currency' => 'Rp'
			);
		$this->db_trans->update_data_on_table('products', 'id', $prod_id, $product_info);
		//print_r($this->db->last_query());
		// upload image if user upload image
		if (! empty($_FILES['image_file']['name']))
			$this->upload_set_primary_image($post_id);

        redirect('cms/product_edit?po_id='.$post_id.'&pr_id='.$prod_id);
	}

	function upload_set_primary_image($post_id){
		$this->load->library('upload');
		$config = array(
			'upload_path' => './assets/uploads/',
			'allowed_types' => 'jpg|png|jpeg',
			'overwrite' => false,
			'remove_spaces' => true,
			'max_size' => '4000'
		);
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('image_file')){
			//$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('err_no', "204");
			$this->session->set_flashdata('err_msg', $this->upload->display_errors());
		} 
		else{
			$upload_data = $this->upload->data();
			//insert document data in database
	
			$data = array(
				'file_name' => $upload_data['file_name'],
				'file_type' => $upload_data['file_type'],
				'file_extension' => $upload_data['file_ext'],
				'img_width' => $upload_data['image_width'],
				'img_height' => $upload_data['image_height'],
			);
			$insert_file = $this->db_trans->insert_data('media_files', $data); // return the last inserted id
			// mapping post and media
			$map = array('primary_image' => $insert_file);
			$map_post_media = $this->db_trans->update_data_on_table('posts', 'id', $post_id, $map);
        }
	}

	function get_product_detail($post_data){
		foreach($post_data as $row){
			$prod_data = $this->content->get_product_detail_by_post_id($row->id);
			$product[$row->id] = $prod_data;
		}

		return $product;
	}

	public function get_category_by_id(){
		$this->load->model('Content_m', 'content');
		// get category data
		$category = $this->content->get_category_data('id', $this->uri->segment(3));
		$data = $category->row();
		$response = array(
			'category' => $data->category,
			'slug' => $data->slug,
			'parent_id' => $data->parent_id
			);
		
		echo json_encode($response);
	}

	public function category_add(){
		$type = $this->input->post('type', TRUE);

		$this->load->library('Db_trans');

		$data = array(
			'category' => $this->input->post('category', TRUE),
			'slug' => $this->input->post('slug', TRUE),
			'parent_id' => $this->input->post('parent', TRUE),
			'category_part' => $type
			);
		$last_id = $this->db_trans->insert_data('post_categories', $data);

		redirect('cms/category_view?ty='.$type);
	}

	public function category_update(){
		$type = $this->input->post('type', TRUE);
		$id = $this->input->post('id', TRUE);

		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');

		$data = array(
			'category' => $this->input->post('category', TRUE),
			'slug' => $this->input->post('slug', TRUE),
			'parent_id' => $this->input->post('parent', TRUE),
			'category_part' => $type
			);
		$last_id = $this->db_trans->update_data_on_table('post_categories', 'id', $id, $data);

		redirect('cms/category_view?ty='.$type);
	}

	public function category_delete(){
		$type = $this->input->get('ty', TRUE);
		$id = $this->input->get('id', TRUE);

		$this->load->model('Content_m', 'content');
		$this->load->library('Db_trans');

		$last_id = $this->db_trans->delete_from_table_by_id('post_categories', 'id', $id);

		redirect('cms/category_view?ty='.$type);
	}

	public function opt_general_update(){
		$this->load->library('Db_trans');

		$this->db_trans->update_data_on_table('options', 'parameter_name', 'web_title', array('parameter_value' => $this->input->post('web-title')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'web_slogan', array('parameter_value' => $this->input->post('slogan')));
		if (! empty($_FILES['logo-primary']['name'])){
			$this->load->library('upload');
			$config = array(
				'upload_path' => './assets/uploads/',
				'allowed_types' => 'jpg|png',
				'overwrite' => false,
				'remove_spaces' => true,
				'max_size' => '4000'
			);
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('logo-primary')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err_no', "204");
				$this->session->set_flashdata('err_msg', $this->upload->display_errors());
			} 
			else{
				$upload_data = $this->upload->data();
				//insert document data in database
				$data = array(
					'parameter_value' => $upload_data['file_name']
				);
				$this->db_trans->update_data_on_table('options', 'parameter_name', 'logo_primary', $data);
	        }
		}

		redirect('cms/set_options');
	}

	public function opt_contact_update(){
		$this->load->library('Db_trans');

		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_name', array('parameter_value' => $this->input->post('company-name')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_address', array('parameter_value' => $this->input->post('address')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_address_2', array('parameter_value' => $this->input->post('address_2')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_city', array('parameter_value' => $this->input->post('city')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_province', array('parameter_value' => $this->input->post('province')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_email', array('parameter_value' => $this->input->post('email')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_phone', array('parameter_value' => $this->input->post('phone')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_mobile', array('parameter_value' => $this->input->post('mobile')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_pin_bb', array('parameter_value' => $this->input->post('pin-bb')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_fb_name', array('parameter_value' => $this->input->post('fb-name')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_fb_link', array('parameter_value' => $this->input->post('fb-link')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_map_name', array('parameter_value' => $this->input->post('map-name')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_map_lat', array('parameter_value' => $this->input->post('map-lat')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'company_map_long', array('parameter_value' => $this->input->post('map-long')));

		redirect('cms/set_options?tab=contact');
	}

	public function add_more_images(){
		$post_id = $this->input->post('post_id');
		$prod_id = $this->input->post('prod_id');
		
		$this->load->library('Db_trans');

		$config = array(
			'upload_path' => './assets/uploads/',
			'allowed_types' => 'jpg|png|jpeg',
			'overwrite' => false,
			'remove_spaces' => true,
			'max_size' => '4000'
		);
		
		foreach ($_FILES['more_images']['name'] as $key => $image)  //fieldname is the form field name
		{
			$_FILES['more_images[]']['name']= $_FILES['more_images']['name'][$key];
	        $_FILES['more_images[]']['type']= $_FILES['more_images']['type'][$key];
	        $_FILES['more_images[]']['tmp_name']= $_FILES['more_images']['tmp_name'][$key];
	        $_FILES['more_images[]']['error']= $_FILES['more_images']['error'][$key];
	        $_FILES['more_images[]']['size']= $_FILES['more_images']['size'][$key];

	        $this->load->library('upload');
		    $this->upload->initialize($config);

		    if ($this->upload->do_upload('more_images[]')) {
	            $upload_data = $this->upload->data();
				//insert document data in database
				$data = array(
					'file_name' => $upload_data['file_name'],
					'file_type' => $upload_data['file_type'],
					'file_extension' => $upload_data['file_ext'],
					'img_width' => $upload_data['image_width'],
					'img_height' => $upload_data['image_height'],
				);
				$insert_file = $this->db_trans->insert_data('media_files', $data); // return the last inserted id
				// mapping post and media
				$map = array(
					'post_id' => $post_id,
					'media_id' => $insert_file
					);
				$map_post_media = $this->db_trans->insert_data('post_media', $map);
	        } else {
	            $this->session->set_flashdata('err_no', "204");
				$this->session->set_flashdata('err_msg', $this->upload->display_errors());
	        }
		}
		if($prod_id<>"")
			redirect('cms/product_edit?po_id='.$post_id.'&pr_id='.$prod_id);
		else
			redirect('cms/post_edit?id='.$post_id);
	}

	public function post_media_delete(){
		$media_id = $this->input->get('media', TRUE);
		$post_id = $this->input->get('po_id', TRUE);
		$prod_id = $this->input->get('pr_id', TRUE);

		$this->load->model('content_m', 'content');
		//get the filename and delete from storage
		$get = $this->content->get_post_image($media_id);
		$filename = $get->file_name;
		unlink('./assets/uploads/'.$filename);

		$this->load->library('Db_trans');
		$this->db_trans->delete_from_table_by_id('media_files', 'id', $media_id);

		if($prod_id<>"")
			redirect('cms/product_edit?po_id='.$post_id.'&pr_id='.$prod_id);
		else
			redirect('cms/post_edit?id='.$post_id);
	}

	public function get_category_under_root($root_id){
		$this->load->model('Content_m', 'content');

		$get = $this->content->get_category('parent_id', $root_id);
		foreach($get->result() as $row){
			$response[] = array(
				'id' => $row->id,
				'name' => $row->category
				);
		}
		echo json_encode($response);
	}

	public function point_get_data_by_id($id){
		$this->load->model('Commerce_m', 'comm');
		$point = $this->comm->get_selling_point_by_id($id);
		$response = array(
			'id' => $point->id,
			'title' => $point->title,
			'point' => $point->point,
			'price' => $point->price
			);

		echo json_encode($response);
	}

	public function sell_point_update(){
		$data = array(
			'title' => $this->input->post('title'),
			'point' => $this->input->post('point'),
			'price' => $this->input->post('price')
			);
		$id = $this->input->post('id');

		$this->load->library('Db_trans');
		$update = $this->db_trans->update_data_on_table('selling_points', 'id', $id, $data);

		redirect('cms/set_commerce');
	}

	public function change_bank_active(){
		$this->load->library('Db_trans');
		$id = $this->uri->segment(3);
		$status = $this->uri->segment(4);

		$data = array('active' => $status);
		$update = $this->db_trans->update_data_on_table('bank_accounts', 'bank_id', $id, $data);

		redirect('cms/set_commerce?tab=bank');
	}

	function bank_add(){
		$data = array(
			'bank_name' => $this->input->post('name', TRUE),
			'bank_account_number' => $this->input->post('number', TRUE),
			'bank_holder_name' => $this->input->post('account-name', TRUE),
			'bank_branch' => $this->input->post('branch', TRUE),
			'bank_city' => $this->input->post('city', TRUE),
			'active' => 'false'
			);
		$this->load->library('Db_trans');
		$last_id = $this->db_trans->insert_data('bank_accounts', $data);

		redirect('cms/set_commerce?tab=bank');
	}

	function bank_update(){
		$id = $this->input->post('id', TRUE);
		$data = array(
			'bank_name' => $this->input->post('name', TRUE),
			'bank_account_number' => $this->input->post('number', TRUE),
			'bank_holder_name' => $this->input->post('account-name', TRUE),
			'bank_branch' => $this->input->post('branch', TRUE),
			'bank_city' => $this->input->post('city', TRUE)
			);
		$this->load->library('Db_trans');
		$update = $this->db_trans->update_data_on_table('bank_accounts', 'bank_id', $id, $data);

		redirect('cms/set_commerce?tab=bank');
	}

	function bank_get_data_by_id(){
		$id = $this->uri->segment(3);
		$this->load->model('Bank_m', 'bank');
		$bank = $this->bank->get_bank_by_id($id);

		$response = array(
			'id' => $bank->bank_id,
			'name' => $bank->bank_name,
			'account_name' => $bank->bank_holder_name,
			'number' => $bank->bank_account_number,
			'branch' => $bank->bank_branch,
			'city' => $bank->bank_city
			);

		echo json_encode($response);
	}

	public function opt_shipcost_update(){
		$this->load->library('Db_trans');

		$this->db_trans->update_data_on_table('options', 'parameter_name', 'min_total_free_ship_cost', array('parameter_value' => $this->input->post('free')));
		$this->db_trans->update_data_on_table('options', 'parameter_name', 'ship_cost', array('parameter_value' => $this->input->post('ship-cost')));

		redirect('cms/set_commerce?tab=ship-cost');
	}

	function count_notification(){
		$this->load->library('notification');
		$response['notifications'] = $this->notification->get_data();
		$response['notif_unread'] = $this->notification->count_unread();

		echo json_encode($response);
	}

	function media_add(){
		$this->load->library('upload');
		$this->load->library('Db_trans');
		$config = array(
			'upload_path' => './assets/uploads/',
			'allowed_types' => 'jpg|png|jpeg|mp3|mp4|wmv',
			'overwrite' => false,
			'remove_spaces' => true,
			'max_size' => '50000'
		);
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('image_file')){
			//$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('err_no', "204");
			$this->session->set_flashdata('err_msg', $this->upload->display_errors());
		} 
		else{
			$upload_data = $this->upload->data();
			//insert document data in database
	
			$data = array(
				'file_name' => $upload_data['file_name'],
				'file_type' => $upload_data['file_type'],
				'file_extension' => $upload_data['file_ext'],
				'img_width' => $upload_data['image_width'],
				'img_height' => $upload_data['image_height'],
			);
			$insert_file = $this->db_trans->insert_data('media_files', $data); // return the last inserted id
        }

		redirect('cms/media_view_all');
	}

	function media_delete(){
		$this->load->library('Db_trans');
		$this->load->model('Content_m', 'content');

		$media_id = $this->uri->segment(3);
		$any_in_post = false;
		// check if the media is in any post or post_media
		if($this->content->check_media_in_post($media_id))
			$any_in_post = true;
		if($this->content->check_media_in_post_media($media_id))
			$any_in_post = true;

		if($any_in_post){
			$this->session->set_flashdata('err_no', "204");
			$this->session->set_flashdata('err_msg', "Media you wish to delete is embedded in a post, please change image in your post then delete it.");
		}
		else{
			//get the filename and delete from storage
			$get = $this->content->get_post_image($media_id);
			$filename = $get->file_name;
			// delete from database
			$this->db_trans->delete_from_table_by_id('media_files', 'id', $media_id);
			// delete from storage
			unlink('./assets/uploads/'.$filename);
		}
		redirect('cms/media_view_all');
	}
}
