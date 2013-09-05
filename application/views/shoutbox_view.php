
<div class="main-content-wrapper">
	<div class="container main-content">
		<div class="row-fluid">
			<?php $this->load->view('templates/sidebar'); ?>
			<h3 style="text-align: center;">Shout out loud!</h3>
			<div class="span8">
				<div class="shoutbox-wrapper well">
					<div class = "row-fluid" >
						<div class="input-append" style = "text-align:center">
							<input type="text" id = "chat_message" class = "span10" placeholder="Share something!">
							<button id = "submit_message" class="btn" type="button">Shout!</button>
						</div>
					</div>	
					<div class="shoutbox-screen">
						<div id = "chatbox">
						<?php foreach($chats as $chat):?>
							<?php if($chat->user_email == $this->session->userdata('email')):?>
							<div class = "row-fluid" style = "margin-top:2%">
								<div class = "span8">
									<div class = "span1">
										<img class="media-object hidden-phone" width="32px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/profile_32/<?php echo $this->session->userdata('thirty_two_pic');?>">
									</div>
									<div class = "span11">		
										<span style = "color:#3396B8;font-weight:bold"><?php echo $chat->user_name;?>:</span>
										<span style = "color:#1975FF" class = "messages_from_chat">&nbsp<?php echo $chat->chat_message_content;?></span>
									</div>
								</div>
								
								<div class = "span4">
									<span style = "color:#5D5D56" class = "pull-right visible-desktop"><?php echo $chat->cremod;?></span>
								</div>
							</div>
							<?php else:?>
							<?php if($chat->e_login_picture_thirty_two == null) 
								{
									$pic = "default-profile-pic.png";
								}	
								else
								{
									$pic = $chat->e_login_picture_thirty_two;
								}
							?>
								<div class = "row-fluid" style = "margin-top:2%">
									<div class = "span8">
										<div class = "span1">
											<img class="media-object hidden-phone" width="32px" data-src="holder.js/64x64" src="<?php echo base_url(); ?>img/profile_32/<?php echo $pic;?>">
										</div>		
										<div class = "span11">								
												<span style = "color:#E81919;font-weight:bold"><?php echo $chat->user_name;?>:</span>
												<span style = "color:#C24C4C" class = "messages_from_chat">&nbsp;<?php echo $chat->chat_message_content;?></span>
										</div>
									
									</div>
									<div class = "span4">
										<span style = "color:#5D5D56" class = "pull-right visible-desktop"><?php echo $chat->cremod;?></span>
									</div>
								</div>

							<?php endif;?>
						<?php endforeach;?>						
						</div>
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
	var thirty = "<?php echo $this->session->userdata('thirty_two_pic')?>";
</script>