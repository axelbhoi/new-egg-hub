<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class user_model extends CI_Model {

		function login($email,$password)
		{
			$this->db->where('e_login_email',$email);
			$this->db->where('e_login_password',md5($password));
			
			$query = $this->db->get('e_login_tbl');
			
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function getUserData($email) {
			$this->db->where('e_login_email', $email);
			$query = $this->db->get('e_login_tbl');
			return $query;
		}
		
		function getAllUserData() {
			$query = $this->db->get('e_login_tbl');
			return ($query) ? $query : false;
		}
		
		function insertNewUser($new_user_data) {
			return $query = $this->db->insert('e_login_tbl', $new_user_data);
		}
		
		function getUserIdFromEmail($email) {
			$this->db->where('e_login_email', $email);
			$this->db->select('e_login_id');
			$query = $this->db->get('e_login_tbl');
			return $id = $query->row('e_login_id');
		}
		
		function getUserFullNameFromEmail($email) {
			$this->db->select('e_login_fname');
			$this->db->select('e_login_lname');
			$this->db->where('e_login_email', $email);
			$query = $this->db->get('e_login_tbl');
			return $full_name = $query->row('e_login_fname').' '.$query->row('e_login_lname');
		}
		
		//update logged in
		function updateLoginStatus($mail,$data)
		{	
			$this->db->where('e_login_email',$mail);
			$this->db->update('e_login_tbl',$data);
			return;
		}
		
		//checks if user is still logged in
		function check_user_credentials($user_email)
		{
			$this->db->where('e_login_email',$user_email);
			$query = $this->db->get('e_login_tbl'); 	
				
			foreach($query->result() as $row)
			{
				return $row->e_login_isActive;
			}
		}
		
		function from_email($email)
		{
			$this->db->where('e_login_email',$email);
			$query = $this->db->get('e_login_tbl');
			
			return $query->result();
		}

		function get_id($id)
		{
			$this->db->where('e_login_id',$id);

			$query = $this->db->get('e_login_tbl');

			return $query->result();
		}

		function update($id,$data)
		{
			$this->db->where('e_login_id',$id);

			return $this->db->update('e_login_tbl',$data);
		}

		function get_active_users()
		{
			$this->db->where('e_login_isActive',1);

			$query = $this->db->get('e_login_tbl');

			return $query->result();
		}
	}