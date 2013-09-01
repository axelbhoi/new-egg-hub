<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_model extends CI_Model{

	function getAllPosts()
	{
		$this->db->order_by('e_post_cremod', 'DESC');
		$query = $this->db->get('e_posts_tbl');
		return ($query) ? $query : false;
	}
	
	function insertNewPost($post_data)
	{
		$query = $this->db->insert('e_posts_tbl',$post_data);
		return ($query) ? true : false;
	}
	
	function getRecentPost($email)
	{
		$this->db->where('e_post_by', $email);
		$this->db->order_by('e_post_cremod', 'DESC');
		$query = $this->db->get('e_posts_tbl',1);
		return ($query) ? $query : false;
	}
	
	//delete
	function deletePost($id)
	{
		$this->db->where('e_post_id', $id);
		$query = $this->db->delete('e_posts_tbl');
		$this->db->where('e_post_id', $id);
		$query = $this->db->delete('e_comments_tbl');
		return ($query) ? true : false;
	}
	
	//like
	function getPostLikes($post_id)
	{
		$this->db->where('e_post_id', $post_id);
		$this->db->select('e_post_like');
		$query = $this->db->get('e_posts_tbl');
		return ($query) ? $query->row('e_post_like') : false;
	}
	
	function updatePostLike($like_data, $post_id) {
		$this->db->where('e_post_id', $post_id);
		$query = $this->db->update('e_posts_tbl', $like_data);
		return ($query) ? true : false;
	}
	
	/* ----------- for comments ----------- */
	function getAllComments()
	{
		$this->db->order_by('e_comment_cremod', 'ASC');
		$query = $this->db->get('e_comments_tbl');
		return ($query) ? $query : false;
	}
	
	function insertNewComment($comment_data)
	{
		$query = $this->db->insert('e_comments_tbl', $comment_data);
		return ($query) ? true : false;
	}
	
	function getRecentComment($post_id)
	{
		$this->db->where('e_post_id', $post_id);
		$this->db->order_by('e_comment_cremod', 'DESC');
		$query = $this->db->get('e_comments_tbl',1);
		return ($query) ? $query : false;
	}
	
	//delete
	function deleteComment($comment_id)
	{
		$this->db->where('e_comment_id', $comment_id);
		$query = $this->db->delete('e_comments_tbl');
		return ($query) ? true : false;
	}

	//insert notification
	function insert_notifications($data)
	{
		return $this->db->insert('e_notification_tbl',$data);
	}

	//get notifications
	function get_notifications($user_id)
	{
		$this->db->where('e_post_by',$user_id);

		$query = $this->db->get('e_posts_tbl');

		return $query->result();
	}

	function all_notifications($post_ID)
	{

		$query = "SELECT a.*, b.e_login_fname, b.e_login_lname, b.e_login_id, b.e_login_picture_thirty_two, b.e_login_email
		FROM  `e_notification_tbl` a
		JOIN  `e_login_tbl` b 
		ON a.e_comment_by = b.e_login_id
		WHERE a.e_post_id = '$post_ID'
		AND a.e_notification_isActive = 1
		ORDER BY a.e_notification_id DESC";
			
		$result = $this->db->query($query);
			
		return $result->result();			
	}

	function user_details($user_id)
	{
		$this->db->where('e_login_id',$user_id);

		$query = $this->db->get('e_login_tbl');

		return $query->result();
	}

	public function update_notification($comment_id,$data)
	{
		$this->db->where('e_comment_id',$comment_id);

		return $this->db->update('e_notification_tbl',$data);
	}

	public function delete_notification($comment_id)
	{
		$this->db->where('e_comment_id',$comment_id);

		return $this->db->delete('e_notification_tbl');		
	}
}