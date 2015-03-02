<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('categories_model');
		$this->load->model('cart_model');
	}

	public function index(){
		$data = array(
			'records' => $this->categories_model->get_records()
		);
		$this->load->frontend_view('/categories',$data);
	}

	public function category($id){	
		$this->load->model('products_model');
		$data = array(
			'records' => $this->products_model->get_products_by_category(array('cat'=>$id))
		);
		$this->load->frontend_view('/category',$data);
	}

}

