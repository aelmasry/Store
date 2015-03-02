<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('categories_model');
		$this->load->model('areas_model');
		$this->load->model('cart_model');
		if(!$this->session->userdata('isLogged') && $this->session->userdata('role') != 1){
			redirect('auth/index');
		}
	
	}
	
	public function index(){
		$perPage = 5;
		$count = count($this->products_model->get_records());
		$config['base_url'] = base_url().'admin/products/index/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perPage; 
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = "<ul class='pagination  pagination-centered' >";
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
			'records' => $this->products_model->get_records_by_page($config['per_page'],$offset),
			'categories' => $this->categories_model->get_records(),
			'areas' => $this->areas_model->get_records(),
			);
		$this->load->admin_view('products',$data);
		
	}

	public function add_edit($id = ''){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
		$this->form_validation->set_rules('price', 'Price', 'numeric|trim|required|xss_clean');
		
		if ($this->form_validation->run()){
			if($this->input->post('submit')){
				$config['upload_path'] = 'assets/images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$userfile_data['upload_data'] = '';
				if (!$this->upload->do_upload('userfile')){
					$userfile_data = array('msg' => $this->upload->display_errors());

				} else { 
					$userfile_data['msg'] = "Upload success!";
					$userfile_data['upload_data'] = $this->upload->data();

				}
	
				if(isset($userfile_data['upload_data'])){
						$img = $userfile_data['upload_data']['file_name'];
				}else{
					if($id != ''){
						$data_img = $this->products_model->get_record(array('id'=>$id));
						$img = $data_img->image;

					}else{
						$img = 'default.jpg';
					}
				}
				
				
				$data =  array(
					'name' => $this->input->post('name'),
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'cat' => $this->input->post('category'),
					'area' => $this->input->post('area'),
					'price' => $this->input->post('price'),
					'image' => $img
				);
				if($id != ''){
					$this->products_model->update_record($id,$data);
				}else{
					$last_id = $this->products_model->insert_data($data);
				}
				
				redirect('admin/products');
			}
		}else{
			if($id != ''){
				$data = array(
						'records' => $this->products_model->get_record(array('id'=>$id)),
						'categories' => $this->categories_model->get_records(),
						'areas' => $this->areas_model->get_records()
				);

				$this->load->admin_view('editproduct',$data);
			}else{
				$data = array(
						'records' => $this->categories_model->get_records(),
						'areas' => $this->areas_model->get_records()

				);
		
				$this->load->admin_view('addproduct',$data);
			}
			
		}
		
	}

	public function delete($id){
		$this->products_model->delete($id);
		$data = array(
			'records' =>  $this->products_model->get_records(),
			'categories' => $this->categories_model->get_records(),
			'areas' => $this->areas_model->get_records()
		);

		redirect('admin/products');
	}

}

