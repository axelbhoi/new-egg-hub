
<div class="header-wrapper">
	<div class="container">
		<img src="<?php echo base_url(); ?>img/logo.png" width="150px;"/>
		<!-- Button to trigger modal -->
		<?php 
			if($this->session->userdata('is_logged_in') == 1) {
				?>
				<a id = "logout" href="<?php echo base_url(); ?>main/logout" role="button" class="pull-right btn btn-primary" style="margin-top: 20px;">Logout</a>
				<?php
			} else {
				?>
				<a href="#login_modal" role="button" class="pull-right btn btn-info" data-toggle="modal" style="margin-top: 20px;">Login</a>
				<?php
			}
		?>
	</div>
</div>