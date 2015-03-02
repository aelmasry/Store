<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Paypal extends CI_Controller {
private $currency = 'USD'; // currency for the transaction
private $ec_action = 'Sale'; // for PAYMENTREQUEST_0_PAYMENTACTION, it's either Sale, Order or Authorization

	function __construct(){
		parent::__construct();
		$this->load->model('cart_model');
		$this->load->model('products_model');
		$this->load->model('users_model');
		$this->load->model('order_model');
		$paypal_details = array(
			'API_username' => 'poxos.poxosyan01-facilitator_api1.gmail.com', 
			'API_signature' => 'AV.7SEEZAzyOya0jjk5BNOLm8N10AI1HlaXHYvIyYI0CSVlWHxfUdyF0', 
			'API_password' => 'WX2ZJYJTT4TN3GNC',
		);
		$this->load->library('paypal_ec', $paypal_details);
	}

	public function index(){

		mb_internal_encoding("UTF-8");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		if ($this->form_validation->run()){
			$user_data = $this->users_model->get_record(array('email'=>$this->session->userdata('email')));
			$cart = $this->cart_model->get_record_by_filed(array('user'=>$user_data->id));
			$data = array();
			$datetime = date('Y-m-d H:i:s');
			if($this->input->post('delivery_type') == 2){
				$type = 'By Post';
			}else{
				if($this->input->post('delivery_type') == 4){
					$type = 'By Plane';
				}else{
					$type = 'By Sea';
				}
			}
			foreach ($cart as  $value){
				$order_data = array(
				 	'user' => $value->user,
				 	'product' =>  $value->product,
				 	'count' =>  $value ->count,
				 	'address' =>  $this->input->post('address'),
				 	'type' => $type,
				 	'datetime' => $datetime
	            );
				$this->order_model->insert_data($order_data);
			}

			for ($i=0; $i <count($cart) ; $i++){ 
				$data[$i] = $this->products_model->get_record_array(array('id'=>$cart[$i]->product));
				$data[$i]['cart_id'] = $cart[$i] ->id;
				$data[$i]['count'] = $cart[$i] ->count;

			}
			$to_buy = array(
				'desc' => 'Purchase from Online Shop', 
				'currency' => $this->currency, 
				'type' => $this->ec_action, 
				'return_URL' => site_url('paypal/back'), 
				'cancel_URL' => site_url('paypal'), 
				'shipping_amount' =>  $this->input->post('delivery_type'), 
				'get_shipping' => true
			);

			foreach($data as $product){
				$temp_product = array(
					'name' => $product['name'], 
					'desc' => mb_substr($product['description'],0,20) . " ...", 
					'number' => 123123,
					'quantity' => $product['count'], 
					'amount' => $product['price']
				);

				$to_buy['products'][] = $temp_product;
			}

			$set_ec_return = $this->paypal_ec->set_ec($to_buy);
			if (isset($set_ec_return['ec_status']) && ($set_ec_return['ec_status'] === true)){
				$this->paypal_ec->redirect_to_paypal($set_ec_return['TOKEN']);
			}else{
				$this->_error($set_ec_return);
			}
	 	}else{
			$user_data = $this->users_model->get_record(array('email'=>$this->session->userdata('email')));
			$cart = $this->cart_model->get_record_by_filed(array('user'=>$user_data->id));
			$data = array();

			for ($i=0; $i < count($cart) ; $i++){ 
				$data[$i] = $this->products_model->get_record_array(array('id'=>$cart[$i]->product));
				$data[$i]['cart_id'] = $cart[$i] ->id;
				$data[$i]['count'] = $cart[$i] ->count;

		}
		$to_buy = array();
		$total = 0;
		foreach($data as $product){
			$temp_product = array(
				'name' => $product['name'], 
				'desc' => mb_substr($product['description'],0,20) . " ...", 
				'number' => 123123,
				'quantity' => $product["count"], 
				'amount' => $product['price']*$product['count']
			);
			$total += $product['price']*$product['count'];
			$to_buy['products'][] = $temp_product;
		}
		$total += $this->input->post('delivery_type');
		$to_buy['total'] = $total;
		if($this->session->userdata('isLogged')){
			$to_buy['isLogged'] = TRUE;
		}else{
			$to_buy['isLogged'] = FALSE;
		}
		$this->load->frontend_view('/next',$to_buy);
	  }
	}

	public function back(){

		$this->cart_model->delete_records_from_cart($this->session->userdata('id') );
		if($this->session->userdata('isLogged')){
			$data['isLogged'] = TRUE;
		}else{
			$data['isLogged'] = FALSE;
		}
		$this->load->frontend_view('/order_success',$data);
	}

	public function next(){
		$user_data = $this->users_model->get_record(array('email'=>$this->session->userdata('email')));
		$cart = $this->cart_model->get_record_by_filed(array('user'=>$user_data->id));
		$data = array();

		for ($i=0; $i <count($cart) ; $i++) { 
			$data[$i] = $this->products_model->get_record_array(array('id'=>$cart[$i]->product));
			$data[$i]['cart_id'] = $cart[$i] ->id;
			$data[$i]['count'] = $cart[$i] ->count;
		}

		$to_buy = array();
		$total = 0;
		foreach($data as $product){
			$temp_product = array(
				'name' => $product['name'], 
				'desc' => mb_substr($product['description'],0,20) . " ...", 
				'number' => 123123,
				'quantity' => $product['count'], 
				'amount' => $product['price']*$product['count']
			);

			$total += $product['price']*$product['count'];
			$to_buy['products'][] = $temp_product;
		}
		$total += 2;
		$to_buy['total'] = $total;
		if($this->session->userdata('isLogged')){
			$to_buy['isLogged'] = TRUE;
		}else{
			$to_buy['isLogged'] = FALSE;
		}
		$this->load->frontend_view('/next',$to_buy);
	}

	public function count_change(){
		echo $_POST['name'];
		$data['count'] = $_POST['count'];
		$this->cart_model->update_record($_POST['name'],$data);
	}

}

