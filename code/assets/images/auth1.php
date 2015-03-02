<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $user = null;
	function __construct()
	{
		parent::__construct();
		parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
		$this->load->model('users_model');
		$this->load->library('facebook');
		$this->user = $this->facebook->getUser();
	}

	public function index()
	{
		$this->load->view('auth/index');

	}
	public function fb_login()
	{
		if($this->user){
			try{
				$user_profile = $this->facebook->api('/me');
				$data = array(
					'first_name' => $user_profile['first_name'],
					'last_name' => $user_profile['last_name'],
					'email' => $user_profile['email'],
					'isLogged' => TRUE,
					'role' => 0
			    );
			    $this->load->library('session');
			    $this->session->set_userdata($data);
			    $fb_users = $this->users_model->get_record_by_filed(array('email' => $user_profile['email'] ));
			    if(count($fb_users) == 0){
			    	$last_id = $this->users_model->insert_data($data);
			    }else{
			    	$last_id = $this->users_model->get_record(array('email' => $user_profile['email'] ));
			    	$this->users_model->update_record($last_id->id,$data);

			    }
			    

				redirect('frontend/home');
			}catch(FacebookApiException $e){
				$this->user = null;
			}
			

		}else{
			$login = $this->facebook->getLoginUrl();
			redirect($login);
		}

		
	}
	public function register()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'email|trim|required|xss_clean|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'matches[password]|trim|required|xss_clean');
		

		if ($this->form_validation->run())
		{
			if($this->input->post('submit'))
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'isLogged' => TRUE,
					'role' => 0
			    );
			    
			    $this->load->library('session');
			    $this->session->set_userdata($data);
			    $last_id = $this->users_model->insert_data($data);

				redirect('frontend/home');
			}
		}
		$this->load->view('auth/register');
	}

	public function sign_in()
	{
		if($this->input->post('submit')){
			$data = $this->users_model->get_record(array('email'=>$this->input->post('email')));

			if($data->password === md5($this->input->post('password'))){
				$this->load->library('session');
				$this->session->set_userdata('id', $data->id);
                $this->session->set_userdata('username', $data->first_name);
                $this->session->set_userdata('email', $data->email);
                $this->session->set_userdata('role', $data->role);
                $this->session->set_userdata('isLogged', TRUE);
                if($data->role == 1){
                	redirect('admin/products');
                }else{
                	redirect('frontend/home');
                }
				
			}
			else{
				redirect('auth/index');
			}
		}
		
	}
	public function log_out()
	{
		$this->session->sess_destroy();
		$logout = $this->facebook->getLogoutUrl(array('next' => base_url().'auth/fb_log_out/'));

		redirect($logout);
	}

	public function fb_log_out()
	{
		session_destroy();
		redirect('auth/index');

	}
}


