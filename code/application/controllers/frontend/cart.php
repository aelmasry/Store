<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('users_model');
		$this->load->model('cart_model');
	}

	public function index(){
		$user_data = $this->users_model->get_record(array('email'=>$this->session->userdata('email')));
		$cart = $this->cart_model->get_record_by_filed(array('user'=>$user_data->id));

		$data['records'] = array();
		for ($i=0; $i < count($cart); $i++){ 
			
			$data['records'][$i] = $this->products_model->get_record(array('id'=>$cart[$i]->product));
			$data['records'][$i]->cart_id = $cart[$i] ->id;
			$data['records'][$i]->count = $cart[$i] ->count;
			
		}

		$this->load->frontend_view('/cart',$data);
		
	}

	public function add_product(){
		$user_data = $this->users_model->get_record(array('id'=>$this->session->userdata('id')));
		$cart = $this->cart_model->get_record_by_filed(array('user'=>$user_data->id,'product'=> $_POST['product_id']));
		$data['records'] = array();
		if(!empty($cart)){
			$count = $cart[0]->count + 1;
			$data = array(
				'product' =>  $this->input->post('product_id'),
				'user' => $user_data->id,
				'count' => $count
			);
			$this->cart_model->update_record($cart[0]->id,$data);
		}else{
			$data = array(
				'product' => $this->input->post('product_id'),
				'user' => $user_data->id,
				'count' => 1
			);
			$this->cart_model->insert_data($data);
		}
		

	}

	public function delete($id){
		$this->cart_model->delete($id);
		redirect('frontend/cart/index');
	}

	public function get_cart_count(){
		$user_data = $this->users_model->get_record(array('id'=>$this->session->userdata('id')));
		$cart_count = 0;
		if(isset($user_data->id)){
		$cart = $this->cart_model->get_record_by_filed(array('user'=>$user_data->id));
		foreach ($cart as  $value) {
			$cart_count += $value->count;
		}
		}
		
		echo $cart_count;
	}


}

