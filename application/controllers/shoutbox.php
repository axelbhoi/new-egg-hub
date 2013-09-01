<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shoutbox extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('chat_model');
		if($this->session->userdata('is_logged_in') != 1) {
			redirect('site');
		}
	}
	
	public function index()
	{
		//sets the title for the page
		$data['title'] = 'Let\'s shout!';
		
		//loads the scripts
		$data['scripts'] = array('jquery.min','bootstrap.min','shoutbox');
		 
		//loads the styles
		$data['styles'] = array('bootstrap.min','bootstrap-responsive.min','main');
		
		//gets all the neccessary information from the database
		$data['user'] = $this->user_model->getUserData($this->session->userdata('email'));
		$data['users'] = $this->user_model->getAllUserData();
		$data['loggeds'] = $this->user_model->get_active_users();
		//loads user email
		$data['mail'] = $this->session->userdata('email');
		
		$data['chats'] = $this->chat_model->getchat();

		//loads the views
		$this->load->view('templates/head',$data);
		$this->load->view('templates/header');
		$this->load->view('templates/nav_bar_logged_in');
		$this->load->view('shoutbox_view',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/login_modal');
	}
	
	public function get_users()
	{
		echo "hello";
	}

	public function add_chat_messages()
	{
		$today = date("Y-m-d");
		
		$data = array(
			'user_email'			=> $this->input->post('sessionID'),
			'user_name'				=> $this->input->post('username'),
			'chat_message_content'	=> strip_tags($this->input->post('message')),
			'created_date'			=> $today,
			'cremod'				=> $this->input->post('output')
		);
		
		echo $this->chat_model->insert($data);
	}
}