<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

   public function __construct()
   {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('post_model');
		
		if($this->session->userdata('is_logged_in') != 1) {
			redirect('site');
		}
   }
   
   public function submit_post()
   {
		$post_by = $this->input->post('post_by');
		$post_content = strip_tags(htmlentities($this->input->post('post_content')));
		
		$data['post'] = array(
			'e_post_by' 		=> $post_by,
			'e_post_content' 	=> $post_content,
			'e_post_id'			=> $this->input->post('rfno')
		);
		
		$posted = $this->post_model->insertNewPost($data['post']);
		
		if($posted) {
			$data['user'] = $this->user_model->getUserData($this->session->userdata('email'));
			$data['recent_post'] = $this->post_model->getRecentPost($data['user']->row('e_login_id'));
			$this->load->view('templates/post', $data);
		} else {
			echo 0;
		}
   }
   
   //delete
   public function delete_post()
   {
		$id = $this->input->post('id');
		
		//delete post from the database
		$isDeleted = $this->post_model->deletePost($id);
		
		if($isDeleted) {
			echo $isDeleted;
		} else {
			echo 'Problem occured while deleting post.';
		}
   }

   public function submit_comment()
   {		
		$post_id = $this->input->post('post_id');
		$comment_by = $this->user_model->getUserIdFromEmail($this->session->userdata('email'));
		$comment_content = $this->input->post('comment');
		
		$comment_data = array(
			'e_post_id' 		=>$post_id,
			'e_comment_by'		=>$comment_by,
			'e_comment_content' =>$comment_content,
			'e_comment_id'		=> strip_tags($this->input->post('rfno'))
		);
		
		$commented = $this->post_model->insertNewComment($comment_data);
		
		if($commented) {
			$for = explode('_',$post_id);

			$data = array(
				'e_post_id'					=> $post_id,
				'e_comment_id'				=> strip_tags($this->input->post('rfno')),
				'e_comment_by'				=> $comment_by,
				'e_notification_for'		=> $for[0],
				'e_notification_isActive'	=> 1
			);
			$this->post_model->insert_notifications($data);

			$user = $this->post_model->user_details($comment_by);

			if($user[0]->e_login_picture_thirty_two == null)
			{
				$pic = "default-profile-pic.png";
			}
			else
			{
				$pic = $user[0]->e_login_picture_thirty_two;
			}

			$result = array(
				'e_post_id'					=> $post_id,
				'e_comment_id'				=> strip_tags($this->input->post('rfno')),
				'e_comment_by'				=> $comment_by,
				'e_notification_for'		=> $for[0],
				'e_login_picture_thirty_two'=> $pic,
				'e_fullname'				=> $user[0]->e_login_fname.' '.$user[0]->e_login_lname
			);	
			echo json_encode($result);

		} else {
			echo 0;
		}
   }
   
   //delete comment
   public function delete_comment()
   {
		$comment_id = $this->input->post('id');
		
		//delete post from the database
		$isDeleted = $this->post_model->deleteComment($comment_id);
		
		$this->post_model->delete_notification($comment_id);

		if($isDeleted) {
			echo $comment_id;
		} else {
			echo 'Problem occured while deleting comment.';
		}
   }
	
	//like
	public function like()
	{
		$post_id = $this->input->post('post_id');
		
		$past_likes = $this->post_model->getPostLikes($post_id);
		
		if($past_likes == '') {
			
			$indicator_for_ajax = 0;
			
			$like_data = array(
				'e_post_like' => $this->user_model->getUserIdFromEmail($this->session->userdata('email'))
			);
			
		} else {
			$past_likes = explode(',',$past_likes);
			
			if(count($past_likes) == 1) {
				//1 like You like this
				$indicator_for_ajax = 1;
			} else if(count($past_likes) == 2){
				//2 like expected: You and other_user like this
				$indicator_for_ajax = count($past_likes);
			} else {
				//You and n other people like this
				$indicator_for_ajax = count($past_likes);
			}
			
			array_push($past_likes, $this->user_model->getUserIdFromEmail($this->session->userdata('email')));
			$likes = implode(',',$past_likes);
			
			$like_data = array(
				'e_post_like' => $likes
			);
			
		}
		
		$isLiked = $this->post_model->updatePostLike($like_data, $post_id);
		
		
		if($isLiked) {
			//echo 'success';
			echo $indicator_for_ajax;
		} else {
			//echo 'failed';
			echo 0;
		}
	}

	public function deactivate_notification()
	{
		$data = array(
			'e_notification_isActive' => 0
		);

		$result = $this->post_model->update_notification($this->input->post('c_id'),$data);
		
		if($result)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}
}