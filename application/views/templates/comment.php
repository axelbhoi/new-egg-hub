<!-- Comments -->
<div class="media comment-wrapper" comment-id="<?php echo $comment_id; ?>">
	<a class="pull-left" href="#">
		<img class="media-object" width="32px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/default-profile-pic.png">
	</a>
	<div class="media-body">
		<h5 class="media-heading">
			<?php echo $comment_by_fullname?>
			<span class="pull-right"><a href="<?php echo base_url(); ?>post/delete_comment" class="delete-comments" rel="tooltip" title="Delete" style="opacity: 0.3; display: none;" comment-id="<?php echo $comment_id; ?>"><i class="icon-remove"></i></a></span>
		</h5>
		<?php echo $e_comment_content; ?>
	</div>
</div>