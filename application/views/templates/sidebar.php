<div class="dashboard-sidebar span3">
<!--Sidebar content-->
	<div class="profile-picture-holder">
		<img src="<?php echo base_url(); ?>img/profile_full/<?php echo $this->session->userdata('full_pic')?>" class="img-polaroid img-circle"/>				
	</div>
	
	<div class="profile-info-holder">
		<span class="label label-info"><?php echo $user->row('e_login_fname').' '.$user->row('e_login_lname'); ?></span>
	</div>
	<div class="accordion" id="accordion1" style = "margin-top:10%">
  		<div class="accordion-group">
	   		 <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
			        Online Users
			        <span class="badge badge-important pull-right" id = "users_number"></span>
			      </a>
	   		 </div>
		    <div id="collapseOne" class="accordion-body collapse">
			   	<div class="accordion-inner" id = "inner-users">
			   		<?php $usernumber = 0; foreach($loggeds as $logged):?>
			   			<?php if($this->session->userdata('username') != $logged->e_login_id): $usernumber++;?>
			   				<?php if($logged->e_login_picture_thirty_two == null)
			   					{
			   						$pic = "default-profile-pic.png";
			   					}
			   					else
			   					{
			   						$pic = $logged->e_login_picture_thirty_two;
			   					}
			   				?>					   	

					   		<div class = "row-fluid user_row" style = "margin-bottom:2%" id = "<?php echo $logged->e_login_id;?>">
								<div class = "span2">
									<img src = "<?php echo base_url();?>img/profile_32/<?php echo $pic;?>" />
								</div>
								<div class = "span10" style = "margin-top:2%">
								   	<span style = "font-weight:bold"><?php echo $logged->e_login_fname.' '.$logged->e_login_lname;?></span>	       			
								</div>
					   		</div>
					   	<?php endif;?>		
				   	<?php endforeach;?>	
			   	</div>
		    </div>
	  </div>
	</div>
</div>

<script type = "text/javascript">
	var usernumber = "<?php echo $usernumber?>";
</script>