
<div id = "not_login" class="modal hide fade">
  <div class="modal-header" id = "login_modal_header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Oopps!!!</h3>
  </div>
  <div class="modal-body">
    <p id="oops_message" style ="font-size:16px;font-weight:bold"></p>
  </div>
  <div class="modal-footer">
    <a  href="#" class="btn btn-primary" id = "close_not_login">Close</a>
  </div>
</div>

<div id = "delete_post_confirmation" class="modal hide fade">
  <div class="modal-header" id = "login_modal_header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Delete Post</h3>
  </div>
  <div class="modal-body">
    <p id="oops_message_post" style ="font-size:16px;font-weight:bold"></p>
  </div>
  <div class="modal-footer">
  	<a  href="#" class="btn btn-primary" id = "submit_delete_post_confirmation">Ok</a>
    <a  href="#" class="btn" id = "close_delete_post_confirmation">Close</a>
  </div>
</div>



<div class="main-content-wrapper">
	<div class="container main-content">
		<div class="row-fluid">
	
			<?php $this->load->view('templates/sidebar_posts'); ?>
			
			<div class="span9">
			<!--Dashboard content-->
				<div class="dashboard-posts-wrapper">
				
					<!--Dashboard composer-->
					<div class="dashboard-composer">
						<h3>Post something...</h3>
						<?php echo form_open('post/submit_post',array('id' => 'post_form')); ?>
							<textarea rows="3" maxlength="300" class="input-block-level" placeholder="What's up <?php echo $user->row('e_login_fname'); ?>?..." name="post_content" id="post_content"></textarea>
							<input type="hidden" name="post_by" value="<?php echo $user->row('e_login_id');?>" id="post_by"/>
							<button class="btn btn-info pull-right" type="submit" id="post_submit" data-loading-text="Posting...">Post</button>
							<span class="help-inline"><span id="rem-char">300</span> characters remaining</span>
						<?php echo form_close(); ?>
					</div>
					
					<hr>
					
					<div class="posts-container">
					
						<?php
							if($posts->num_rows() > 0) 
							{
								foreach($posts->result() as $post) 
								{
									?>
									<div class="post-wrapper" id="<?php echo $post->e_post_id;?>">
										<?php foreach($users->result() as $user_data):?>
											<?php if($user_data->e_login_id == $post->e_post_by) :?>
											<?php if($user_data->e_login_picture_sixty_four == null)
												{
													$s_pic = "default-profile-pic.png";
												}
												else
												{
													$s_pic = $user_data->e_login_picture_sixty_four;
												}
											?>
										<div class="media">
											<a class="pull-left" href="#">
												<img class="media-object" width="64px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/profile_64/<?php echo $s_pic;?>">
											</a>
											<div class="media-body">
												<h5 class="media-heading">
													<?php echo $user_data->e_login_fname.' '.$user_data->e_login_lname;?>
											<?php endif;?>			
										<?php endforeach;?>
													<!-- Delete/Remove-->
													<span class="pull-right"><a href="<?php echo base_url(); ?>post/delete_post" class="delete-posts" rel="tooltip"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Post" style="opacity: 0.3;" post-id="<?php echo $post->e_post_id; ?>" post-userdata = "<?php echo $post->e_post_by;?>"><i class="icon-remove"></i></a></span>
												</h5>
												<span style = "text-wrap:normal;word-wrap:break-word"><?php echo $post->e_post_content; ?></span>
												
												<!-- like, comment, likes button container -->
												<ul class="media-options">
													<li><small><a href="#" class="posts-comment" rel="tooltip" title="Comment" post-id="<?php echo $post->e_post_id;?>"><i class="icon-comment"></i> Comment</a></small></li>
													<li>&#8226;</li>
													<li><small class="muted"><?php echo $post->e_post_cremod;?></small></li>
												</ul>
												
												<div class="comments-container" post-id="<?php echo $post->e_post_id;?>" style="margin-top: 10px;">
												<?php 
													//load comments
													foreach($comments->result() as $comment) {
														if($comment->e_post_id == $post->e_post_id) {
														?>

														<?php foreach($users->result() as $user_data):?>
															<?php if($user_data->e_login_id == $comment->e_comment_by):?>
															<?php if($user_data->e_login_picture_thirty_two == null)
																{
																	$t_pic = "default-profile-pic.png";
																}
																else
																{
																	$t_pic = $user_data->e_login_picture_thirty_two;
																}
															?>
																<!-- comments -->
																<div class="media comment-wrapper" comment-id="<?php echo $comment->e_comment_id; ?>">
																	<a class="pull-left" href="#">
																		<img class="media-object" width="32px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/profile_32/<?php echo $t_pic;?>">
																	</a>
																	<div class="media-body">
																		<h5 class="media-heading">
																		<?php echo $user_data->e_login_fname.' '.$user_data->e_login_lname;?>
																<?php endif;?>			
															<?php endforeach;?>		
																<span class="pull-right"><a href="<?php echo base_url(); ?>post/delete_comment" class="delete-comments" rel="tooltip" title="Delete" style="opacity: 0.3;" comment-id="<?php echo $comment->e_comment_id; ?>" comment-by = "<?php echo $comment->e_comment_by;?>"><i class="icon-remove"></i></a></span>
																</h5>
																<span style = "text-wrap:normal;word-wrap:break-word"><?php echo $comment->e_comment_content; ?></span>
															</div>
														</div>
														<?php
														}
													}
												?>
												</div>
												
												<!-- Comment composer -->
												<div class="media">
													<a class="pull-left" href="#">
														<img class="media-object" width="32px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/profile_32/<?php echo $this->session->userdata('thirty_two_pic');?>">
													</a>
													<div class="media-body">
														<?php echo form_open('post/submit_comment', array('post-id' => $post->e_post_id)); ?>
															<input type="hidden" name="post_id" value="<?php echo $post->e_post_id;?>"/>
															<textarea rows="1" class="input-block-level comment-textarea" placeholder="Comment..." style="resize: none;" name="comment" post-id="<?php echo $post->e_post_id;?>"></textarea>
															<button type="submit" class="btn btn-small pull-right comment-button" post-id="<?php echo $post->e_post_id;?>" disabled>Comment</button>
														<?php echo form_close(); ?>
													</div>
												</div>
											</div>
										</div>
										<hr>
									</div>
								<?php
								}
							}
						?>

					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
<script type = "text/javascript">
	var sessionID = "<?php echo $this->session->userdata('email')?>";
	var username = "<?php echo $this->session->userdata('fullname')?>";
	var user_email = "<?php echo $this->session->userdata('email');?>";
	var user_session = "<?php echo $this->session->userdata('username')?>";
	var base_url = "<?php echo base_url();?>";
	var path = "<?php echo $this->session->userdata('full_pic')?>";
	var sixty = "<?php echo $this->session->userdata('sixty_four_pic')?>";
	var thirty = "<?php echo $this->session->userdata('thirty_two_pic')?>";

</script>