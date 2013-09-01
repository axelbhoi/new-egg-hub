<div class="post-wrapper" id="<?php echo $recent_post->row('e_post_id');?>">
	<div class="media">
		<a class="pull-left" href="#">
			<img class="media-object" width="64px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/default-profile-pic.png">
		</a>
		<div class="media-body">
			<h5 class="media-heading">
				<?php echo $user->row('e_login_fname').' '.$user->row('e_login_lname'); ?>
				<!-- Delete/Remove-->
				<span class="pull-right"><a href="<?php echo base_url(); ?>post/delete_post" class="delete-posts" rel="tooltip" title="Delete" style="opacity: 0.3; display: none;" post-id="<?php echo $recent_post->row('e_post_id');?>"><i class="icon-remove"></i></a></span>
			</h5>
			<?php echo $recent_post->row('e_post_content');?>
			
			<!-- like, comment, likes button container -->
			<ul class="media-options">
				<li><small><a href="<?php echo base_url(); ?>post/like" rel="tooltip" title="Like" class="posts-like" post-id="<?php echo $recent_post->row('e_post_id'); ?>"><i class="icon-thumbs-up"></i> Like</a></small></li> <li class="like-separator" post-id="<?php echo $recent_post->row('e_post_id');?>">&#8226;</li>
				<li><small><a href="#" rel="tooltip" title="Comment"><i class="icon-comment"></i> Comment</a></small></li>
				<li>&#8226;</li>
				<li><small><a class="like-indicator" href="javascript:void(0)" rel="popover" post-id="<?php echo $recent_post->row('e_post_id'); ?>"></a></small></li>
				<!-- <li>&#8226;</li> -->
				<li><small class="muted">2 seconds ago</small></li>
			</ul>
			
			<div class="comments-container" post-id="<?php echo $recent_post->row('e_post_id'); ?>" style="margin-top: 10px;">
			</div>
			
			<!-- Comment composer -->
			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object" width="32px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/default-profile-pic.png">
				</a>
				<div class="media-body">
					<?php echo form_open('post/submit_comment', array('post-id' => $recent_post->row('e_post_id'))); ?>
						<input type="hidden" name="post_id" value="<?php echo $recent_post->row('e_post_id'); ?>"/>
						<textarea rows="1" class="input-block-level comment-textarea" placeholder="Comment..." style="resize: none;" name="comment" post-id="<?php echo $recent_post->row('e_post_id');?>"></textarea>
						<button type="submit" class="btn btn-small pull-right comment-button" post-id="<?php echo $recent_post->row('e_post_id');?>" disabled>Comment</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	<hr>
</div>
