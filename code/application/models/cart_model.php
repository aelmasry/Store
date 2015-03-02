<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends My_Model {

	protected $name = 'Cart';
	protected $id = 'id';

    function __construct(){
        parent::__construct();
    }

    public function delete_records_from_cart($email){
		$this->db->delete($this->name, array('user' => $email));  
    }

}