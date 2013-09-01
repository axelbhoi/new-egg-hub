<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class profile_picture extends CI_Controller{

		public function index($state = null,$message = null)
		{
			$this->load->model('user_model');

			$data['validation'] = $state;
			
			$data['messages'] = $message;

			$data['id'] = end($this->uri->segments);

			//gets the user data using email
			$data['user'] = $this->user_model->getUserData($this->session->userdata('email'));
			
			//sets the title for the page
			$head['title'] = 'Hi! '.$data['user']->row('e_login_fname');
			
			//loads the scripts
			$head['scripts'] = array('jquery.min','bootstrap.min','bootstrap-fileupload.min');
			
			//loads the styles
			$head['styles'] = array('bootstrap.min','bootstrap-responsive.min','main','bootstrap-fileupload.min');
			
			$data['id'] = end($this->uri->segments);

			$data['details'] = $this->user_model->get_id(end($this->uri->segments));

			//loads the views
			$this->load->view('templates/head',$head);
			$this->load->view('templates/header');
			$this->load->view('templates/nav_bar_logged_in');
			$this->load->view('members/profile_pic',$data);
			$this->load->view('templates/footer');			
		}

		function do_upload()
		{
			$this->load->library('image_lib');
			$this->load->model('user_model');

			$config['upload_path'] = './img/profile_full/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '200';
			$config['max_width']  = '600';
			$config['max_height']  = '600';

			$configThumb = array();
			$configThumb['image_library']		= 'gd2';
			$configThumb['new_image']			= 'img/profile_64/';
			$configThumb['create_thumb']		= TRUE;
			$configThumb['maintain_ratio']		= FALSE;

			$configThumb['width'] = 64;
			$configThumb['height'] = 64;	
		

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload())
			{
				$this->index($state = "error",$message =  $this->upload->display_errors());
			}
			else
			{
				$image = $this->upload->data();

				$configThumb['source_image'] = $image['full_path'];

				$this->image_lib->initialize($configThumb);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$profile = $image['file_name'];
				$posts = $image['raw_name'].'_thumb'.$image['file_ext'];

				$configThumb['new_image'] = 'img/profile_32/';
				$configThumb['width'] = 32;
				$configThumb['height'] = 32;
				$this->image_lib->initialize($configThumb);
				$this->image_lib->resize();
				
				$comments = $image['raw_name'].'_thumb'.$image['file_ext'];

				$data = array(
					'e_login_picture'				=> $profile,
					'e_login_picture_thirty_two'	=> $posts,
					'e_login_picture_sixty_four'	=> $comments
				);

				$result = $this->user_model->update(end($this->uri->segments),$data);

				if($result)
				{
					$session_data = array(
						'full_pic'		=> $profile,
						'sixty_four_pic'=> $posts,
						'thirty_two_pic'=> $comments
					);	
					$this->session->set_userdata($session_data);									
					$this->index($state = "success",$message = null);
				}
				else
				{
					//you can calter here the message that will be showed 
					show_error('Database Error'.'<a style = "margin-left:20px" href = "'.base_url().'main'.'">Go back to Main</a>'); 													
				}

			}
		}		
	}	