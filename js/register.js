$(document).ready(function(){	
	
	$('button#register_submit').live('click', function(){
	
		var checked = $('input#terms').is(':checked');
		
		$(this).button('loading');
		
		if(checked) {
			
			var form_data = {
				email: 		$('input#reg_email').val(),
				password: 	$('input#reg_password').val(),
				cpassword:  $('input#cpassword').val(),
				fname: 		$('input#fname').val(),
				lname: 		$('input#lname').val()
			};
			
			$.ajax({
				url: $('form#register_form').attr('action'),
				type: 'POST',
				data: form_data,
				success: function(data) {
					if(data != 1) {
						$('div#register_error').removeAttr('class');
						$('div#register_error').attr('class','alert alert-error');						
						$('div#register_error').html(data);
						$('div#register_error').fadeIn();
					} else {
						//redirect
						window.location.replace('main/');
					}
				},
				complete: function() {
					$('button#register_submit').button('reset');
				}
			});
			
		} else {
			$('div#register_error').removeAttr('class');
			$('div#register_error').attr('class','alert alert-error');
			$('div#register_error').text('Please agree to our terms and conditions').fadeIn();
		}
		$('button#register_submit').button('reset');
		return false;
	});

	$('button#login_submit').click(function(){
	
		$(this).button('loading');
		
		$('div#modal_alert').html('');
		$('div#modal_alert').hide();
		
		var form_data = {
			email: $('input#email').val(),
			password: $('input#password').val(),
			isAjax: 1
		};
		
		$.ajax({
			url: $('form#login_form').attr('action'),
			type: 'POST',
			data: form_data,
			success: function(data) {
				if(data != 1) {
					$('div#modal_alert').html(data);
					$('div#modal_alert').fadeIn();
				} else {
					//redirect
					window.location.replace('main/');
				}
			},
			complete: function() {
				$('button#login_submit').button('reset');
			}
		});
		return false;
	});
	
	$('#closer').click(function(){
		$('#modal_alert').css('display','none');
		$('#modal_alert').html('');
	});
});