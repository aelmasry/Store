<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends My_Model {

	protected $name = 'products';
	protected $id = 'id';

    function __construct()
    {
        parent::__construct();
    }
    
    public function get_products_by_category($arr = array())
    {
        $this->db->where($arr);
        return $this->db->get($this->name)->result();  
        
    }
}