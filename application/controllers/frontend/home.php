<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('products_model');
	}

	public function index(){
		$perPage = 3;
		$count = count($this->products_model->get_records());
		$config['base_url'] = base_url().'frontend/home/index/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perPage; 
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = "<ul class='pagination  pagination-centered'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$url_segment = $this->uri->segment(4);
		$this->pagination->initialize($config);
		if ($this->uri->segment(4) > 0) {
			$offset = $url_segment * $perPage - $perPage;
		}else{
			$offset = $this->uri->segment(4);
		}
		
		$data = array(
			'records' => $this->products_model->get_records_by_page($config['per_page'],$offset)
		);
		
		$this->load->frontend_view('index',$data);
		
	}

}

