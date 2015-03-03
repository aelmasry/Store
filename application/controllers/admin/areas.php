<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Areas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('areas_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation'); 
		if(!$this->session->userdata('isLogged') && $this->session->userdata('role') != 1){
			redirect('auth/index');
		}
	}
	
	public function index(){
		$perPage = 5;
		$count = count($this->areas_model->get_records());
		$config['base_url'] = base_url().'admin/areas/index/';
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
			'records' =>   $this->areas_model->get_records_by_page($config['per_page'],$offset),
		);

		$this->load->admin_view('areas',$data);		
	}

	public function add_edit($id = ''){

		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');

		if ($this->form_validation->run()){
			if($this->input->post('submit')){
				$data =  array(
					'name' => $this->input->post('name'),
					'lat' => $this->session->userdata('lat'),
					'lng' => $this->session->userdata('lng'),
					'zoom' => $this->session->userdata('zoom')
					
			
				);
				if($id != ''){
				   $this->areas_model->update_record($this->input->post('product_id'),$data);
				}else{
					$this->areas_model->insert_data($data);
				}
				$data = array(
						'records' =>  $this->areas_model->get_records()
				);
		        redirect('admin/areas/index');
			}
		}else{

			if($this->input->post('ajax_true')){
					$this->session->set_userdata('lat',$this->input->post('lat'));
					$this->session->set_userdata('lng',$this->input->post('lng'));
					$this->session->set_userdata('zoom',$this->input->post('zoom'));
				}else{
					if($id != ''){
						$data = array(
							'records' => $this->areas_model->get_record(array('id'=>$id))
							);
						$this->load->admin_view('editarea',$data);
					}else{
						$this->load->admin_view('addarea');
					}
				}
			
			
		}
		
		
	}

	public function delete($id){
		$this->areas_model->delete($id);
		redirect('admin/areas/index');
	}

	public function add_lat_lng(){
		
	}


}

