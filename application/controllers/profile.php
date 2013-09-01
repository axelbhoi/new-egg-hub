<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct()
   {
		parent::__construct();
		$this->load->model('profile_model');
		$this->load->model('user_model');
		
		if($this->session->userdata('is_logged_in') != 1) {
			redirect('site');
		}
   }
	
	public function index()
	{
		//sets title
		$data['title'] = 'Profile';
		
		//loads the scripts
		$data['scripts'] = array('jquery.min','bootstrap.min','profile');
		 
		//loads the styles
		$data['styles'] = array('bootstrap.min','bootstrap-responsive.min','main');
		
		$data['picture'] = $this->profile_model->getPicture($this->session->userdata('email'));
		
		$data['mail'] = $this->session->userdata('email');
		
		$data['user'] = $this->user_model->getUserData($this->session->userdata('email'));
		
		$data['details'] = $this->profile_model->get_all_values($this->session->userdata('email'));
		
		$this->load->view('templates/head',$data);
		$this->load->view('templates/header');
		$this->load->view('templates/nav_bar_logged_in');
		$this->load->view('profileview',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/login_modal');
	}

	public function changes()
	{
		if($this->input->post('change') == "describe")
		{
			$describe = strip_tags($this->input->post('describe_value'));
			
			$data = array(
				'e_describe_yourself'	=> $describe
			);
			echo $this->profile_model->update_profile($data);
		}
		
		if($this->input->post('change') == "quote")
		{
			$quote_value = strip_tags($this->input->post('quote_value'));
			
			$data = array(
				'e_fave_quote'	=> $quote_value
			);
			echo $this->profile_model->update_profile($data);
		}	
		
		if($this->input->post('change') == "basic")
		{
			$data = array(
				'e_month'			=> strip_tags($this->input->post('month_selected')),
				'e_day'				=> strip_tags($this->input->post('day_selected')),
				'e_year'			=> strip_tags($this->input->post('year_selected')),	
				'e_gender'			=> strip_tags($this->input->post('gender_selected')),
				'e_contact_number'	=> strip_tags($this->input->post('contact_number')),
				'e_status'			=> strip_tags($this->input->post('relationship_selected')),
				'e_college'			=> strip_tags($this->input->post('college_input')),
				'e_highschool'		=> strip_tags($this->input->post('highschool_input')),
				'e_mail'			=> strip_tags($this->input->post('email_add'))
			);
			echo $this->profile_model->update_profile($data);
		}

	}
}	