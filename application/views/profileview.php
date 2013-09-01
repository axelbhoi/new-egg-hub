<?php 	
	if(count($details)!=null)
	{
		foreach($details as $detail)
		{
			$describe = $detail->e_describe_yourself;
			$quote = $detail->e_fave_quote;
			$month = $detail->e_month;
			$day = $detail->e_day;
			$year = $detail->e_year;
			$gender = $detail->e_gender;
			$contact = $detail->e_contact_number;
			$email = $detail->e_mail;
			$status = $detail->e_status;
			$college = $detail->e_college;
			$highschool = $detail->e_highschool;
		}	
	}
	else
	{
			$describe = "";
			$quote = "";
			$month = "";
			$day = "";
			$year = "";
			$gender = "";
			$contact = "";
			$email = "";
			$status = "";
			$college = "";
			$highschool = "";
	}
?>
<div class="main-content-wrapper">
	<div class="container main-content">
		<div class="row-fluid">
			<?php $this->load->view('templates/sidebar'); ?>
			<div class = "span8" style = "margin-top:2%">
				<div class = "span6 basic-wrapper well">
				
					<div class = "row-fluid">
						<span style = "font-weight:bold;font-size:16px">Basic Info</span>
						<a href="#" class="btn btn-mini pull-right" id="basic_info" rel="popover" data-original-title=""  ><i class="icon-pencil"></i><span style="font-weight:bold">Edit</span></a>
					</div>
					
					<hr/>
					
					<div class = "row-fluid" >
						<div class = "span5">
							<span id = "bday" class = "pull-left leftside">Birthday</span>
						</div>	
						<div class = "span7 pull-left">
							<span id = "bday_month" class = "rightside"><?php echo $month;?></span>
							<span id = "bday_day" class = "rightside"><?php echo $day;?></span>
							<span>,</span>
							<span id = "bday_year" class = "rightside"><?php echo $year;?></span>
						</div>
					</div>
					
					<div class = "row-fluid" style = "margin-top:2%">
						<div class = "span5">
							<span id = "gender" class = "pull-left leftside">Gender</span>
						</div>
						<div class = "span7">
							<span id = "gender_value" class = "pull-left rightside"><?php echo $gender;?></span>
						</div>
					</div>		

					<div class = "row-fluid" style = "margin-top:2%">
						<div class = "span5">
							<span id = "number" class = "pull-left leftside">Contact Number</span>
						</div>
						<div class = "span7">
							<span id = "number_value" class = "pull-left rightside"><?php echo $contact;?></span>
						</div>
					</div>		

					<div class = "row-fluid" style = "margin-top:2%">
						<div class = "span5">
							<span id = "email" class = "pull-left leftside">Email Address</span>
						</div>
						<div class = "span7">
							<span id = "email_value" class = "pull-left rightside"><?php echo $email;?></span>
						</div>
					</div>			

					<div class = "row-fluid" style = "margin-top:2%">
						<div class = "span5">
							<span id = "status" class = "pull-left leftside">Relationship Status</span>
						</div>
						<div class = "span7">
							<span id = "status_value" class = "pull-left rightside"><?php echo $status;?></span>
						</div>
					</div>					

					<div class = "row-fluid" style = "margin-top:2%">
						<div class = "span5">
							<span id = "college" class = "pull-left leftside">College</span>
						</div>
						<div class = "span7">
							<span id = "college_status" class = "pull-left rightside"><?php echo $college;?></span>
						</div>
					</div>	
					
					<div class = "row-fluid" style = "margin-top:2%">
						<div class = "span5">
							<span id = "high" class = "pull-left leftside">Highschool</span>
						</div>
						<div class = "span7">
							<span id = "high_status" class = "pull-left rightside"><?php echo $highschool;?></span>
						</div>
					</div>						
					
				</div>
				
				<div class = "span6">
					<div class = "row-fluid">
						<div class = "span12 basic-wrapper well">
							<span style = "font-weight:bold;font-size:16px">Describe Yourself</span>
							<a href="#" class="btn btn-mini pull-right" id="describe_yourself" rel="popover" data-original-title="" ><i class="icon-pencil"></i><span style="font-weight:bold">Edit</span></a>						
							
							<hr/>
							<div class = "row-fluid">
								<span id = "desc_self"><?php echo $describe;?></span>
							</div>
						</div>
					</div>	
					<div class = "row-fluid">
						<div class = "span12 basic-wrapper well">
							<span style = "font-weight:bold;font-size:16px">Favourite Quote</span>
							<a href="#" class="btn btn-mini pull-right" id="fave_quote" rel="popover" data-original-title="" ><i class="icon-pencil"></i><span style="font-weight:bold">Edit</span></a>						
							
							<hr/>
							<div class = "row-fluid">
								<span id = "fave_quote_self"><?php echo $quote;?></span>
							</div>
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