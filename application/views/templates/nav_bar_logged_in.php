
		<div class="navbar affix-top container" id = "nav" data-spy="affix" data-offset-top="300">
		      <div class="navbar-inner container">
		          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
							<ul class="nav">
								<li><a class="brand hidden-desktop" href="#" >EGG-HUB</a></li>
							</ul>		          
							<ul class = "nav pull-right hidden-desktop">
								<li id = "settings" class = "dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<b class="caret"></b></a>
									<ul class="dropdown-menu  pull-right">
										<li><a href="<?php echo base_url();?>profile_picture/index/<?php echo $this->session->userdata('username');?>">Change Profile Picture</a></li>
									</ul>					
								</li>				
							</ul>			          
							          
					  <div class="nav-collapse collapse">
							<ul class="nav">
								<li><a href="<?php echo base_url(); ?>site/">Home</a></li>
								<li><a href="<?php echo base_url(); ?>profile/">Profile</a></li>
								<li><a href="<?php echo base_url(); ?>shoutbox/">Shoutbox</a></li>
							</ul>

							<ul class = "nav pull-right visible-desktop">
								<li id = "settings" class = "dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<b class="caret"></b></a>
									<ul class="dropdown-menu  pull-right">
										<li><a href="<?php echo base_url();?>profile_picture/index/<?php echo $this->session->userdata('username');?>">Change Profile Picture</a></li>
									</ul>														
								</li>	
							</ul>							
					  </div>
		       
		      </div>
		</div>	
		
