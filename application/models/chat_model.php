<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class chat_model extends CI_Model{
		
		function getchat()
		{
			$today = date("Y-m-d");

			$this->db->select('*');
			$this->db->from('e_chat_table');
			$this->db->where('e_chat_table.created_date',$today);
			$this->db->join('e_login_tbl', 'e_chat_table.user_email = e_login_tbl.e_login_email');
			$this->db->order_by('cremod','desc');
			$query = $this->db->get();			

			return $query->result();
		}
		
		function insert($data)
		{
			return $this->db->insert('e_chat_table',$data);
		}
	}