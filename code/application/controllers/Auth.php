<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	public $user = null;
	
	function __construct(){
		parent::__construct();
		parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
		$this->load->model('users_model');
		$this->load->library('facebook');
		$this->load->library('linkedin');
		$this->load->library('twitteroauth');
	}

	public function index(){
		if($this->session->userdata('isLogged') != TRUE){
			$this->session->sess_destroy();
		    $this->load->view('auth/index');
		    $this->load->view('template/footer');
		}else{
			if($this->session->userdata('role') == 1){
				redirect('admin/products');
			}else{
				redirect('frontend/home');
			}
			
		}
		
	}

	public function fb_login(){
		$this->user = $this->facebook->getUser();

		if($this->user){

			try{
				$user_profile = $this->facebook->api('/me');
				
				if(isset($user_profile['email'])){
					$user_email = $user_profile['email'];
				}else{
					$user_email = $user_profile['id'];
				}
				$data = array(
					'id' => $user_profile['id'],
					'first_name' => $user_profile['first_name'],
					'last_name' => $user_profile['last_name'],
					'email' => $user_email,
					'fb_login' => TRUE,
					'isLogged' => TRUE,
					'role' => 0
			    );
			    $this->session->set_userdata('link', $user_profile['id']);
			  //  $this->session->set_userdata('id', $user_profile['id']);
			    $this->session->set_userdata($data);
			    $fb_users = $this->users_model->get_record_by_filed(array('email' => $user_email ));
			    if(count($fb_users) == 0){
			    	$last_id = $this->users_model->insert_data($data);
			    }else{
			    	$last_id = $this->users_model->get_record(array('email' => $user_email ));
			    	$this->users_model->update_record($last_id->id,$data);

			    }
			    

				redirect('frontend/home');
			}catch(FacebookApiException $e){
				$this->user = null;
			}
			

		}else{

			$login = $this->facebook->getLoginUrl(
			  array(
	            'display'   => 'popup',
	            'next'      => base_url('auth/fb_login'),
	        	'cancel_url'=> base_url('auth/index'),
        ));
			redirect($login);
		}

		
	}

	public function twitter_login(){
		$a = $this->session->userdata('token');	
		if($a){

		$connection = new TwitterOAuth('NXN5bPRLh6npCLauKil2FMoq5', '4aWzIN9yuV80f16odPxkFKeWftwkvGeVjbBt9sTPYyfCaUb4sf', $this->session->userdata('token') ,$this->session->userdata('token_secret'));

		    if(!empty($_REQUEST['oauth_verifier'])){
		    	$oauth_verifier = $_REQUEST['oauth_verifier'];
		    }else{
		    	redirect('auth/log_out');
		    }
		    $access_token = $connection->getAccessToken($oauth_verifier);
		    $data = array(
		    	'id' => $access_token['user_id'],
		    	'first_name' => $access_token['screen_name'],
		    	'last_name' => $access_token['screen_name'],
		    	'isLogged' => TRUE,
				'role' => 0,
	    	);
		    $this->session->set_userdata($data);
		     $twiter_users = $this->users_model->get_record_by_filed(array('id' => $access_token['user_id'] ));
			    if(count($twiter_users) == 0){
			    	$last_id = $this->users_model->insert_data($data);
			    }else{
			    	$last_id = $this->users_model->get_record(array('id' => $access_token['user_id']));
			    	$this->users_model->update_record($last_id->id,$data);

			    }

		    redirect('frontend/home');

		}else{
			$connection = new TwitterOAuth('NXN5bPRLh6npCLauKil2FMoq5', '4aWzIN9yuV80f16odPxkFKeWftwkvGeVjbBt9sTPYyfCaUb4sf');
			$request_token = $connection->getRequestToken('http://shop.loc/auth/twitter_login');
 			$data = array(
					'token' => $request_token['oauth_token'],
					'token_secret' => $request_token['oauth_token_secret'],
		    );
			$this->session->set_userdata($data);
			   
			if($connection->http_code == '200'){
				$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
				header('Location: ' . $twitter_url); 
			}else{
				die("error connecting to twitter! try again later!");
			}
		}
	}
	public function linkedin_login(){
		$config['base_url']             =   base_url('auth/get_linkedin_url');
		$config['callback_url']         =   base_url('auth/linkedin_login');
		$config['linkedin_access']      =   '78iwuorjnrw04c';
		$config['linkedin_secret']      =   'J05AYZ236vVmIc3e';
		$linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );

		if (isset($_REQUEST['oauth_verifier'])){
			$_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];
			$linkedin->request_token    =   unserialize($_SESSION['requestToken']);
			$linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
			$linkedin->getAccessToken($_REQUEST['oauth_verifier']);

			$_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
			$xml_response = $linkedin->getProfile("~:(id,first-name,last-name,headline,picture-url)");
			die($linkedin->getAccessToken($_REQUEST['oauth_verifier']));
			$user_data = explode(' ', $xml_response);
			$data = array(
				'id' => $user_data[5],
				'first_name' => $user_data[7],
				'last_name' => $user_data[9],
				'email' => $user_data[5],
				'isLogged' => TRUE,
				'role' => 0
				);

			$this->session->set_userdata($data);
			$linkedin_users = $this->users_model->get_record_by_filed(array('email' => $user_data[5] ));
			if(count($linkedin_users) == 0){
				$last_id = $this->users_model->insert_data($data);
			}else{
				$last_id = $this->users_model->get_record(array('email' => $user_data[5] ));
				$this->users_model->update_record($last_id->id,$data);

			}

			redirect('frontend/home');
		}else{

			redirect('auth/index');
		}
	}
	public function get_twitter_url(){
		$connection = new TwitterOAuth('NXN5bPRLh6npCLauKil2FMoq5', '4aWzIN9yuV80f16odPxkFKeWftwkvGeVjbBt9sTPYyfCaUb4sf');
			$request_token = $connection->getRequestToken('http://shop.loc/auth/twitter_login');   
			if($connection->http_code == '200'){
				$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
				echo $twitter_url;
				//header('Location: ' . $twitter_url); 
			}else{
				die("error connecting to twitter! try again later!");
			}
	}

	public function get_linkedin_url(){
		  $config['base_url']             =   base_url('auth/get_linkedin_url');
		  $config['callback_url']         =   base_url('auth/linkedin_login');
		  $config['linkedin_access']      =   '78iwuorjnrw04c';
		  $config['linkedin_secret']      =   'J05AYZ236vVmIc3e';
		  $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['callback_url'] );
		  $linkedin->getRequestToken();
    	  $_SESSION['requestToken'] = serialize($linkedin->request_token);
  		  
  		  echo $linkedin->generateAuthorizeUrl();
	
	}
	public function register(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'email|trim|required|xss_clean|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'matches[password]|trim|required|xss_clean');
		
		if ($this->form_validation->run()){
			if($this->input->post('submit')){
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')),
					'isLogged' => TRUE,
					'role' => 0
			    );
			    $last_id = $this->users_model->insert_data($data);
			    $this->session->set_userdata($data);
			    $this->session->set_userdata('id', $last_id);
			   

				redirect('frontend/home');
			}
		}else{
			$this->load->view('auth/register');	
		}
		
	}

	public function sign_in(){
		if($this->input->post('submit')){
			$data = $this->users_model->get_record(array('email'=>$this->input->post('email')));

			if($data->password === md5($this->input->post('password'))){
				$this->session->set_userdata('id', $data->id);
                $this->session->set_userdata('first_name', $data->first_name);
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
	
	public function log_out(){
		$logout = $this->facebook->getLogoutUrl(array('next' => base_url().'auth/fb_log_out/'));	
		if($this->session->userdata('fb_login') == TRUE){
			$this->session->sess_destroy();
			redirect($logout);
		}
		else{
			$this->session->sess_destroy();
		    session_destroy();
			redirect('auth/index');
		}	
	}

	public function fb_log_out(){
		session_destroy();
		redirect('auth/index');
	}

}


