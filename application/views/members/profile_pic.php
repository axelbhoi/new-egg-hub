<div class="main-content-wrapper">
	<div class="container main-content">
		<div class="row-fluid" style = "margin-top:5%">
				  <?php if($validation == "error"):?>
					  <div class="alert alert-error span8 offset2">
						  <span style = "font-weight:bold;"><center><?php echo $messages;?></center></span>
						</div>
							
				  <?php elseif($validation == "success"):?>
					<div class="alert alert-success span8 offset2">
					  <span style = "font-weight:bold"><center>You have successfully uploaded the image</center></span>
					</div>
				  <?php else:?>
					<div class="alert alert-info span8 offset2">
						<strong>Note:&nbsp</strong>Maximum allowable file size is 250kb. Image file extension must be .png or jpg, Max Height is 600px, Max Width is 600px
					</div>	
				  <?php endif;?>			
			<div class = "span4 offset4">

					<?php echo form_open_multipart('profile_picture/do_upload/'.$id); ?>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						  <div id = "image_container" class="fileupload-preview thumbnail" style="width: 300px; height: 300px; line-height:300px">
							<?php if($details[0]->e_login_picture == null):?>
								<img src = "<?php echo base_url();?>img/default-profile-pic.png" />
						  	<?php else:?>
						  		<img src = "<?php echo base_url();?>img/profile_full/<?php echo $details[0]->e_login_picture;?>" />
						  	<?php endif;?>
						  </div>
						  <div >
								<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
								<input type="file" name = "userfile" size = "20" id = "file_btn"/></span>
								<a id = "remove_btn" href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
								<button id = "submit_btn" style = "margin-left:90px" class = "btn">Upload Image</button>
						  </div>
						</div>
					<?php echo form_close();?>	
			</div>
	</div>
</div>			