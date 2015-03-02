<?php
class My_Model extends CI_Model {

	protected $name;
	protected $id;

    function __construct(){
        parent::__construct();
    }

    public function get_records(){
    	$query =  $this->db->get($this->name);
    	return $query->result(); 
    }

    public function get_records_by_page($num,$offset){
        $query =  $this->db->get($this->name,$num,$offset);
        return $query->result(); 
    }

    public function get_record($arr = array()){
        $this->db->where($arr);
        return $this->db->get($this->name)->row();
    }
    
   public function get_record_array($arr = array()){
        $this->db->where($arr);
        return $this->db->get($this->name)->row_array();
    }
    public function get_record_by_filed($arr = array()){
        $this->db->where($arr);
        return $this->db->get($this->name)->result();
    }

    public function delete($id){
        $this->db->delete($this->name, array($this->id => $id));
    }

    public function insert_data($arr=array()){
       $this->db->insert($this->name, $arr);
       return $this->db->insert_id();
    }

    public function get_last_id(){
        return $this->db->insert_id();
    }
    
    public function update_record($id,$data=array()){
        $this->db->where('id', $id);
        $this->db->update($this->name, $data); 
    }


}