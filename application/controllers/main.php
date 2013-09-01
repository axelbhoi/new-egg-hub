<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class main extends CI_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
			$this->load->model('post_model');
			
			
			if($this->session->userdata('is_logged_in') != 1) {
				redirect('site');
			}
		}
	
		public function index()
		{
			//gets the user data using email
			$data['user'] = $this->user_model->getUserData($this->session->userdata('email'));
			$data['users'] = $this->user_model->getAllUserData();

			$data['loggeds'] = $this->user_model->get_active_users();

			$data['posts'] = $this->post_model->getAllPosts();
			$data['comments'] = $this->post_model->getAllComments();
			$data['email'] = $this->user_model->getUserIdFromEmail($this->session->userdata('email'));
			
			$data['notifications'] = $this->notifications();
			//echo "<pre>";print_r($data['notifications']); echo "</pre>"; die();

			//sets the title for the page
			$data['title'] = 'Hi! '.$data['user']->row('e_login_fname');
			
			//loads the scripts
			$data['scripts'] = array('jquery.min','bootstrap.min','posts');
			
			//loads the styles
			$data['styles'] = array('bootstrap.min','bootstrap-responsive.min','main');
			
			//loads the views
			$this->load->view('templates/head',$data);
			$this->load->view('templates/header');
			$this->load->view('templates/nav_bar_logged_in');
			$this->load->view('members/home');
			$this->load->view('templates/footer');
		}

		public function notifications()
		{
			$this->load->model('post_model');
			$results = $this->post_model->get_notifications($this->session->userdata('username'));

			foreach($results as $result)
			{
				$alls[] = $this->post_model->all_notifications($result->e_post_id);
			}
			

			foreach($alls as $all)
			{
				foreach($all as $row)
				{
					$total[] = $row; 
				}
			}		
			return $total;
		}

		public function profile_picture($state = null,$message = null)
		{
			//gets the user data using email
			$data['user'] = $this->user_model->getUserData($this->session->userdata('email'));
			
			//sets the title for the page
			$data['title'] = 'Hi! '.$data['user']->row('e_login_fname');
			
			//loads the scripts
			$data['scripts'] = array('jquery.min','bootstrap.min','bootstrap-fileupload.min',);
			
			//loads the styles
			$data['styles'] = array('bootstrap.min','bootstrap-responsive.min','main','bootstrap-fileupload.min',);
			
			$data['id'] = end($this->uri->segments);

			$data['details'] = $this->user_model->get_id(end($this->uri->segments));

			$data['validation'] = $state;
			
			$data['messages'] = $message;

			//loads the views
			$this->load->view('templates/head',$data);
			$this->load->view('templates/header');
			$this->load->view('templates/nav_bar_logged_in');
			$this->load->view('members/profile_pic');
			$this->load->view('templates/footer');
		}


		public function logout()
		{		
			$user_email = $this->session->userdata('email');
		
			$data = array('e_login_isActive'=>0);
				
			$this->user_model->updateLoginStatus($user_email,$data);
				
			//destroys all sessions and redirect to login page
			$this->session->sess_destroy();
			redirect(base_url());
		
		}
	}