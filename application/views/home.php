<div class="main-content-wrapper">	
	<div class="container main-content">
		<div class="row-fluid">
			<div class="span12" style="background: url('./img/slider/slider2.jpg');">
				<div class="register-form-wrapper span4" style="background: rgba(48,184,228,1);">
				<h2>Join us!</h2>
					<?php echo form_open('site/validate_register', array('id' => 'register_form','style' => 'margin-bottom: 5px')); ?>
					
						<div class="alert alert-info" id="register_error" style="text-align:center;width:80%">
							<p>All fields are required</p>
						</div>
						
						<!-- Email -->
						<div class="control-group" style="margin:0;">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<input type="text" id="reg_email" name="email" placeholder ='axelfelipe1224@gmail.com' style = "width:90%" />
							</div>
						</div>
						
						<!-- Password -->
						<div class="control-group" style="margin:0;">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<input type="password" id="reg_password" name="password" style = "width:90%" placeholder = "minimum of 6 characters" />
							</div>
						</div>						
						
						<!-- Confirm password -->
						<div class="control-group" style="margin:0;">
							<label class="control-label" for="cpassword">Confirm Password</label>
							<div class="controls">
								<input type="password" id="cpassword" name="cpassword" style = "width:90%" placeholder = "minimum of 6 characters" />
							</div>
						</div>
						
						<!-- First name -->
						<div class="control-group" style="margin:0;">
							<label class="control-label" for="cpassword">First Name</label>
							<div class="controls">
								<input type="text" id="fname" name="fname" style = "width:90%" placeholder = "Axel" />
							</div>
						</div>
						
						<!-- Last name -->
						<div class="control-group" style="margin:0;">
							<label class="control-label" for="cpassword">Last Name</label>
							<div class="controls">
								<input type="text" id="lname" name="lname" style = "width:90%" placeholder = "Felipe" />
							</div>
						</div>
						
						<!-- Terms and Conditions and Submit-->
						<div class="control-group" style="margin:0;">
							<div class="controls">
								<label class="checkbox">
									<input type="checkbox" id="terms"> I agree too Egghub's <a href="">Terms and Conditions</a>
									<br>
								</label>
								<br>
								<button type="submit" class="btn" id="register_submit" data-loading-text="Please wait...">Register</button>
							</div>
						</div>
						
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>
	</div>
</div>
		<div style = "clear:both"></div>	
		
	<div id="push"></div>
