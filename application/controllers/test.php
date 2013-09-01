<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class test extends CI_Controller {

		public function index()
		{
			$this->load->model('post_model');

			$results = $this->post_model->get_notifications($this->session->userdata('username'));

			foreach($results as $result)
			{
				$alls[] = $this->post_model->all_notifications($result->e_post_id);
			}
			
			/*foreach($result as $id)
			{
				$all = $this->post_model->all_notifications($id);
			
				$final[] = $all;

				unset($all); 
			}


			*/
			foreach($alls as $all)
			{
				foreach($all as $row)
				{
					$total[] = $row; 
				}
			}			
			echo "<pre>";
				print_r($total);
			echo "</pre>";
			
		}
	}