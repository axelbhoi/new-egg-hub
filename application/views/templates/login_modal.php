<!-- Modal -->
<div id="login_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="login_modalLabel" aria-hidden="true">
	<div class="modal-header" id = "login_modal_header">
		<button type="button" id = "closer" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="login_modalLabel">Login</h3>
	</div>
	<div class="modal-body">
		<?php echo form_open('site/validate_login',array('id' => 'login_form', 'class' => 'form-horizontal'));?>
			<div class="alert alert-block alert-error fade in" id = "modal_alert" style="display: none;text-align:center">
				<p style="text-align:center;"></p>
			</div>
			<div class="control-group">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
					<input type="text" id="email" placeholder="Email" name="email">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" id="password" placeholder="Password" name="password">
				</div>
			</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" data-loading-text="Logging in..." id="login_submit">Login</button>
		<?php echo form_close(); ?>
	</div>
</div>