<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('products_model');
	}

	public function index(){
		$data = array(
			'records' => $this->products_model->get_records()
		);
		$this->load->frontend_view('/products',$data);
	}

	public function details($id){
		$data = array(
			'records' => $this->products_model->get_record(array('id'=>$id))
		);
		$this->load->frontend_view('/product',$data);
	}

}

