<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class site extends CI_Controller{
	
		function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('user_model');
			$this->load->model('profile_model');
			if($this->session->userdata('is_logged_in') == 1) {
				redirect('main');
			}
		}	
		
		function index()
		{
			//sets the title for the page
			$data['title'] = 'Welcome to Site with no name!';
			
			//loads the scripts
			$data['scripts'] = array('jquery.min','bootstrap.min','register');
			
			//loads the styles
			$data['styles'] = array('bootstrap.min','bootstrap-responsive.min','main');
			
			//loads the views
			$this->load->view('templates/head',$data);
			$this->load->view('templates/header');
			//$this->load->view('templates/nav_bar');
			$this->load->view('home');
			$this->load->view('templates/footer');
			$this->load->view('templates/login_modal');
		}
		
		function validate_register()
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$cpassword = $this->input->post('cpassword');
			
			if($email == '' || $password == '' || $fname == '' || $lname == '' || $cpassword == '')
			{
				echo 'All fields are required';
			}
			else 
			{
				//set rules for validation
				$this->form_validation->set_rules('email','Email','xss_clean|trim|valid_email|max_length[128]|is_unique[e_login_tbl.e_login_email]');
				$this->form_validation->set_rules('password','Password','xss_clean|max_length[32]|min_length[6]|trim');
				$this->form_validation->set_rules('cpassword','Confirm password','xss_clean|matches[password]|trim');
				
				if($this->form_validation->run()) {
					//register the user
					
					$new_user_data = array(
						'e_login_email' 	=> $email,
						'e_login_password'	=> md5($password),
						'e_login_fname'		=> $fname,
						'e_login_isActive' => 1,
						'e_login_lname'		=> $lname
					);
					
					$inserted = $this->user_model->insertNewUser($new_user_data);
					
					if($inserted)
					{
						//automatically log in the user
						$users_info = $this->user_model->from_email($email);
						
						$new = array('e_profile_email'=>$email);
						
						$this->profile_model->insert_new_user($new);
						
						$pic = "default-profile-pic.png";
						$s_pic = "default-profile-pic.png";
						$t_pic = "default-profile-pic.png";
						
						$session_data = array(
							'email' 		=> $email,
							'is_logged_in'  => 1,
							'username'		=> $users_info[0]->e_login_id,
							'fullname'		=> $users_info[0]->e_login_fname.' '.$users_info[0]->e_login_lname,
							'full_pic'		=> $pic,
							'sixty_four_pic'=> $s_pic,
							'thirty_two_pic'=> $t_pic
						);


						//set session
						$this->session->set_userdata($session_data);
					
						echo 1;
					}
					else
					{
						echo 'Problem occured, please try again later';
					}
				} 
				else
				{
					echo validation_errors();
				}
			}
		}
		
		function validate_login()
		{
			$this->form_validation->set_rules('email','Email','required|xss_clean|trim');
			$this->form_validation->set_rules('password','Password','required|xss_clean|trim');	

			if($this->form_validation->run()) 
			{	
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				
				$login = $this->user_model->login($email,$password);
				
				if($login) 
				{
					$data = array('e_login_isActive'=>1);
					
					$users_info = $this->user_model->from_email($email);
					
					$this->user_model->updateLoginStatus($email,$data);
				
					if($users_info[0]->e_login_picture != null)
					{
						$pic = $users_info[0]->e_login_picture;
						$s_pic = $users_info[0]->e_login_picture_sixty_four;
						$t_pic = $users_info[0]->e_login_picture_thirty_two;
					}
					else
					{
						$pic = "default-profile-pic.png";
						$s_pic = "default-profile-pic.png";
						$t_pic = "default-profile-pic.png";
					}

					$session_data = array(
						'email' 		=> $email,
						'is_logged_in'  => 1,
						'username'		=> $users_info[0]->e_login_id,
						'fullname'		=> $users_info[0]->e_login_fname.' '.$users_info[0]->e_login_lname,
						'full_pic'		=> $pic,
						'sixty_four_pic'=> $s_pic,
						'thirty_two_pic'=> $t_pic
					);	
					//set session
					$this->session->set_userdata($session_data);
					
					echo 1;
				} 
				else 
				{
					echo 'Invalid username or password';
				}
				
			} 
			else 
			{
				echo validation_errors(' ','<br>');
			}				
		}
		
		public function forbidden()
		{
			//show access forbidden page
			$this->session->sess_destroy();
			$this->index();
		}		
	}