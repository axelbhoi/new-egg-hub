$(document).ready(function(){
	var socket = io.connect('http://localhost:3000');
	//var socket = io.connect('http://54.213.182.79:3000');	

	$('#users_number').text(usernumber);
	socket.on('server go', function(data){ 
		if(data.session != user_session)
		{
			if($('div.user_row[id = '+data.session+']').length == 0)
			{
				var user_total = $('#users_number').text();
				var total_user = parseInt(user_total,10) + 1;
				$('#users_number').text(total_user);

				$('#inner-users').append(data.html);
			}
		} 
	});

	var describe = $('#desc_self').text();
	var quote = $('#fave_quote_self').text();
	var month = $('#bday_month').text();
	var day = $('#bday_day').text();
	var year = $('#bday_year').text();
	var gender = $('#gender_value').text();
	var contact = $('#number_value').text();
	var email = $('#email_value').text();
	var status = $('#status_value').text();
	var college = $('#college_status').text();
	var highschool = $('#high_status').text();

	
	$('#describe_yourself').on('click',function(e){
		e.preventDefault();
		$('#fave_quote').popover('hide');	
		$('#basic_info').popover('hide');
	});
	
	$('#basic_info').on('click',function(e){
		e.preventDefault();
		$('select[id="month"]').find('option[value= '+ month +']').attr("selected","selected");	
		$('select[id="day"]').find('option[value= '+ day +']').attr("selected","selected");	
		$('select[id="year"]').find('option[value= '+ year +']').attr("selected","selected");	
		$('select[id="gender_id"]').find('option[value= '+ gender +']').attr("selected","selected");	
		$('select[id="relationship_id"]').find('option[value= '+ status +']').attr("selected","selected");			
		$('#fave_quote').popover('hide');	
		$('#describe_yourself').popover('hide');
	});	
	
	$('#fave_quote').on('click',function(e){
		e.preventDefault();
		$('#describe_yourself').popover('hide');
		$('#basic_info').popover('hide');
	});	

		$('#basic_info').popover({	
			html: true,
			trigger: 'click',
			content: function() {
			return $('#info_div').html();
			},
			template: '<div class="popover" id = "describe_info_div" style = "width:320px;height:auto;"><div class="arrow"></div>'+
						'<div class="popover-inner myclass"><h3 class="popover-title"></h3>'+
						'<div class="popover-content" style = "text-align:center">'+
						'<select id="month" style="width:95px;font-size:11px" >'+
						'<option value="January">January</option>'+
						'<option value="February" selected = "selected">February</option>'+
						'<option value="March">March</option>'+
						'<option value="April">April</option>'+
						'<option value="May">May</option>'+
						'<option value="June">June</option>'+
						'<option value="July">July</option>'+
						'<option value="August">August</option>'+
						'<option value="September">September</option>'+
						'<option value="October">October</option>'+
						'<option value="November">November</option>'+
						'<option value="December">December</option>'+
						'</select>'+
						'<select name="day" id="day" style="width:55px;font-size:11px">'+
						'<option value="1">1</option>'+
						'<option value="2">2</option>'+
						'<option value="3">3</option>'+
						'<option value="4">4</option>'+
						'<option value="5">5</option>'+
						'<option value="6">6</option>'+
						'<option value="7">7</option>'+
						'<option value="8">8</option>'+
						'<option value="9">9</option>'+
						'<option value="10">10</option>'+
						'<option value="11">11</option>'+
						'<option value="12" >12</option>'+
						'<option value="13">13</option>'+
						'<option value="14">14</option>'+
						'<option value="15">15</option>'+
						'<option value="16">16</option>'+
						'<option value="17">17</option>'+
						'<option value="18">18</option>'+
						'<option value="19">19</option>'+
						'<option value="20">20</option>'+
						'<option value="21">21</option>'+
						'<option value="22">22</option>'+
						'<option value="23">23</option>'+
						'<option value="24">24</option>'+
						'<option value="25">25</option>'+
						'<option value="26">26</option>'+
						'<option value="27">27</option>'+
						'<option value="28">28</option>'+
						'<option value="29">29</option>'+
						'<option value="30">30</option>'+
						'<option value="31">31</option>'+
						'</select>'+
						'<select name="year" id="year" style="width:65px;font-size:11px">'+
						'<option value="1943">1943</option>'+
						'<option value="1944">1944</option>'+
						'<option value="1945">1945</option>'+
						'<option value="1946">1946</option>'+
						'<option value="1947">1947</option>'+
						'<option value="1948">1948</option>'+
						'<option value="1949">1949</option>'+
						'<option value="1950">1950</option>'+
						'<option value="1951">1951</option>'+
						'<option value="1952">1952</option>'+
						'<option value="1953">1953</option>'+
						'<option value="1954">1954</option>'+
						'<option value="1955">1955</option>'+
						'<option value="1956">1956</option>'+
						'<option value="1957">1957</option>'+
						'<option value="1958">1958</option>'+
						'<option value="1959">1959</option>'+
						'<option value="1960">1960</option>'+
						'<option value="1961">1961</option>'+
						'<option value="1962">1962</option>'+
						'<option value="1963">1963</option>'+
						'<option value="1964">1964</option>'+
						'<option value="1965">1965</option>'+
						'<option value="1966">1966</option>'+
						'<option value="1967">1967</option>'+
						'<option value="1968">1968</option>'+
						'<option value="1969">1969</option>'+
						'<option value="1970">1970</option>'+
						'<option value="1971">1971</option>'+
						'<option value="1972">1972</option>'+
						'<option value="1973">1973</option>'+
						'<option value="1974">1974</option>'+
						'<option value="1975">1975</option>'+
						'<option value="1976">1976</option>'+
						'<option value="1977">1977</option>'+
						'<option value="1978">1978</option>'+
						'<option value="1979">1979</option>'+
						'<option value="1980">1980</option>'+
						'<option value="1981">1981</option>'+
						'<option value="1982">1982</option>'+
						'<option value="1983">1983</option>'+
						'<option value="1984">1984</option>'+
						'<option value="1985">1985</option>'+
						'<option value="1986">1986</option>'+
						'<option value="1987">1987</option>'+
						'<option value="1988">1988</option>'+
						'<option value="1989">1989</option>'+
						'<option value="1990">1990</option>'+
						'<option value="1991">1991</option>'+
						'<option value="1992">1992</option>'+
						'<option value="1993">1993</option>'+
						'<option value="1994">1994</option>'+
						'<option value="1995">1995</option>'+
						'<option value="1996">1996</option>'+
						'<option value="1997">1997</option>'+
						'<option value="1998">1998</option>'+
						'<option value="1999">1999</option>'+
						'<option value="2000">2000</option>'+
						'<option value="2001">2001</option>'+
						'<option value="2002">2002</option>'+
						'<option value="2003">2003</option>'+
						'<option value="2004">2004</option>'+
						'<option value="2005">2005</option>'+
						'<option value="2006">2006</option>'+
						'<option value="2007">2007</option>'+
						'<option value="2008">2008</option>'+
						'<option value="2009">2009</option>'+
						'<option value="2010">2010</option>'+
						'<option value="2011">2011</option>'+
						'<option value="2012">2012</option>'+
						'</select>'+						
						'<br>'+
						'<select id = "gender_id">'+
						'<option value = "Male" >Male</option>'+
						'<option value = "Female">Female</option>'+
						'<option value = "Others">Others</option>'+
						'</select>'+
						'<input type = "text" id = "contact_number" name = "contact_number" placeholder = "Contact Number" value = "'+contact+'"/>'+
						'<input type = "email" id = "email_address" name = "email_address" placeholder = "Email Address" value = "'+email+'">'+
						'<select id = "relationship_id">'+
						'<option value = "Single">Single</option>'+
						'<option value = "Married">Married</option>'+
						'<option value = "In a Relationship">In a Relationship</option>'+
						'<option value = "Complicated">Complicated</option>'+
						'</select>'+		
						'<input type = "text" id = "college_id" name = "college_id" placeholder = "College" value = "'+college+'" />'+	
						'<input type = "text" id = "highschool_id" name = "highschool_id" placeholder = "Highschool" value = "'+highschool+'" /><br>'+
						'<a href = "#" id = "save_basic" class = "btn btn-primary pull-right" style = "margin-bottom:2%">Save</a>'+
						'</div></div></div>',
			title: "<strong>Change Basic Info</strong>",
			placement: 'right'
			}).on('click',function(){
				var month = $('#bday_month').text();
				var day = $('#bday_day').text();
				var year = $('#bday_year').text();
				var gender = $('#gender_value').text();
				var status = $('#status_value').text();
			
				$('select[id="month"]').find('option[value= '+ month +']').attr("selected","selected");	
				$('select[id="day"]').find('option[value= '+ day +']').attr("selected","selected");	
				$('select[id="year"]').find('option[value= '+ year +']').attr("selected","selected");	
				$('select[id="gender_id"]').find('option[value= '+ gender +']').attr("selected","selected");	
				$('select[id="relationship_id"]').find('option[value= '+ status +']').attr("selected","selected");	
		
		});
	
		
		$('#describe_yourself').popover({	
			html: true,
			trigger: 'click',
			content: function() {
			return $('#info_div').html();
			},
			template: '<div class="popover" id = "describe_info_div" style = "width:350px;height:150px;"><div class="arrow"></div>'+
						'<div class="popover-inner myclass"><h3 class="popover-title"></h3>'+
						'<div class="popover-content">'+
						'<textarea id = "describe_field" style = "width:95%;height:50px;resize:none">'+describe+'</textarea>'+
						'<br><a href = "#" id = "save_describe" class = "btn btn-primary pull-right">Save</a>'+
						'</div></div></div>',
			title: "<strong>Change Description</strong>",
			placement: 'top'
						
		});

		$('#fave_quote').popover({	
			html: true,
			trigger: 'click',
			content: function() {
			return $('#info_div').html();
			},
			template: '<div class="popover" id = "fave_quote_div" style = "width:350px;height:150px;"><div class="arrow"></div>'+
						'<div class="popover-inner myclass"><h3 class="popover-title"></h3>'+
						'<div class="popover-content">'+
						'<textarea id = "quote_div" style = "width:95%;height:50px;resize:none">'+quote+'</textarea>'+
						'<br><a href = "#" id = "save_quote" class = "btn btn-primary pull-right">Save</a>'+
						'</div></div></div>',
			title: "<strong>Change Quote</strong>",
			placement: 'top'
						
		});		
		
	$('#save_describe').live('click',function(){
		var describe_value = $('#describe_field').val();
		var change = "describe";
			$.ajax({
					type: "POST",
					url: base_url + "profile/changes",
					data: { change:change,
							describe_value : describe_value },
					asyc: false,
					cache: false,
					success:
						function(data)
						{	
							if(data == 1)
							{
								$('#describe_yourself').popover('hide');
								$('#desc_self').text(describe_value);
							}
							else
							{
								alert("error occured");
							}
						},
					error:
						function(data)
						{
							alert("error occured");
						}	
			});		
		return false;
	});
	
	$('#save_basic').live('click',function(){
		var month_selected =  $("#month option:selected").text();
		var day_selected =  $("#day option:selected").text();
		var year_selected =  $("#year option:selected").text();		
		var gender_selected = $("#gender_id option:selected").text();	
		var contact_number = $('#contact_number').val();
		var email_add = $('#email_address').val();
		var relationship_selected = $("#relationship_id option:selected").text();
		var college_input = $('#college_id').val();	
		var highschool_input = $('#highschool_id').val();
		var change = "basic";
		
			$.ajax({
					type: "POST",
					url: base_url + "profile/changes",
					data: { change:change,
							month_selected : month_selected,
							day_selected : day_selected,
							year_selected : year_selected,
							gender_selected : gender_selected,
							contact_number : contact_number,
							email_add : email_add,
							relationship_selected : relationship_selected,
							college_input : college_input,
							highschool_input : highschool_input},
					asyc: false,
					cache: false,
					success:
						function(data)
						{	
							if(data == 1)
							{
								$('#bday_month').text(month_selected);
								$('#bday_day').text(day_selected);
								$('#bday_year').text(year_selected);
								$('#gender_value').text(gender_selected);
								$('#number_value').text(contact_number);
								$('#email_value').text(email_add);
								$('#status_value').text(relationship_selected);
								$('#college_status').text(college_input);
								$('#high_status').text(highschool_input);

								$('#basic_info').popover('hide');
							}
							else
							{
								alert("error occured");
							}
						},
					error:
						function(data)
						{
							alert("error occured");
						}	
			});				
		
		
		return false;
	});
	
	
	$('#save_quote').live('click',function(){
		var quote_value = $('#quote_div').val();
		var change = "quote";
			$.ajax({
					type: "POST",
					url: base_url + "profile/changes",
					data: { change:change,
							quote_value : quote_value },
					asyc: false,
					cache: false,
					success:
						function(data)
						{	
							if(data == 1)
							{
								$('#fave_quote').popover('hide');
								$('#fave_quote_self').text(quote_value);
							}
							else
							{
								alert("error occured");
							}
						},
					error:
						function(data)
						{
							alert("error occured");
						}	
			});		
		return false;
	});	

	$('#logout').live('click',function(){
		var logout = {session:user_session};
		socket.emit('user logout',logout);
	});

		socket.on('server out', function(data){ 
			if(data.session != user_session)
			{
				if($('div.user_row[id = '+data.session+']').length > 0)
				{
					var user_total = $('#users_number').text();
					var total_user = parseInt(user_total,10) - 1;
					$('#users_number').text(total_user);

					$('div.user_row[id = '+data.session+']').remove();
				}
				
				
			} 
		});	
});