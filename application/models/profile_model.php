<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class profile_model extends CI_Model{
	
		public function getPicture($mail)
		{
			$this->db->select('e_login_picture');
			$this->db->where('e_login_email',$mail);
			$query = $this->db->get('e_login_tbl');
			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					 if($row->e_login_picture != NULL)
					 {
						return $row->e_login_picture;
					 }
					 else
					 {
						return "none";
					 }
				}
			}
			
		}
		
		public function check_user_availability($user)
		{
			$this->db->where('e_profile_email',$user);
			$query = $this->db->get('e_profile_tbl');
			
			if($query->num_rows() > 0)
			{
				return "success";
			}
			else
			{
				return "fail";
			}
		}
		
		public function insert_new_user($user)
		{
			$query = $this->db->insert('e_profile_tbl',$user);
			return $query;
		}
		
		public function get_all_values($user)
		{
			$this->db->where('e_profile_email',$user);
			$query = $this->db->get('e_profile_tbl');
			
			return $query->result();
		}
		
		public function update_profile($data)
		{
			$this->db->where('e_profile_email',$this->session->userdata('email'));
			return $this->db->update('e_profile_tbl',$data);
		}
	}