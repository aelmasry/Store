<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('areas_model');
		$this->load->model('cart_model');
	}

	public function index(){
		$data = array(
			'records' => $this->areas_model->get_records()
		);
		$this->load->frontend_view('areas',$data);
	}

	public function area($id){	
		$this->load->model('products_model');
		$data = array(
			'records' => $this->products_model->get_products_by_category(array('area'=>$id))
		);
		$this->load->frontend_view('area',$data);
	}

	public function get_areas_lat_lng(){
		$area_data = $this->areas_model->get_record_by_filed(array('id' => $this->input->post('id') ));
		echo json_encode($area_data);
	}

}

