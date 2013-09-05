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

	$('input#chat_message').keypress(function(e){
	   if(e.which == 13) 
		{
			$('button#submit_message').click();
			return false;
		}	
	});
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();
	var hour = d.getHours();
	var minute = d.getMinutes();
	var second = d.getSeconds();

	var output = d.getFullYear() + '-' +
		((''+month).length<2 ? '0' : '') + month + '-' +
		((''+day).length<2 ? '0' : '') + day + ' ' +
		((''+hour).length<2 ? '0' :'') + hour + ':' +
		((''+minute).length<2 ? '0' :'') + minute + ':' +
		((''+second).length<2 ? '0' :'') + second;
				var $chat = $('#chatbox');
														
				$('button#submit_message').on('click',function(e){		
					e.preventDefault();
					var message = $('#chat_message').val();
					var meta = { session:sessionID ,name:username, message:message, dates:output, thirty:thirty}
					$('#chat_message').val('');
					
					$.ajax({
							type: "POST",
							url: base_url + "shoutbox/add_chat_messages",
							data: { username:username, sessionID:sessionID, message:message, output:output},
							asyc: false,
							cache: false,
							success:
								function(data)
								{
									socket.emit('send message',meta);
									console.log("user sent message:" + sessionID);	
								},
							error:
								function(data)
								{
									alert("error occured");
								}
					});					
					
				});
				
				socket.on('new message', function(data){
					if(data.session == sessionID)
					{
						$chat.prepend('<div class = "row-fluid" style = "margin-top:2%">'+
							'<div class = "span8">'+
								'<div class = "span1">'+
									'<img class = "media-object hidden-phone" width="32px" data-src = "holder.js/64x64" src = "'+base_url+'img/profile_32/'+data.thirty+'" />'+
								'</div>'+
								'<div class = "span11">'+
									'<span style = "color:#3396B8;font-weight:bold">'+data.name+':</span>'+
									'<span style = "color:#1975FF" class = "messages_from_chat">&nbsp'+data.message+'</span>'+
								'</div>'+
							'</div>'+
							'<div class = "span4">'+
							'<span style = "color:#5D5D56" class = "pull-right visible-desktop">'+output+'</span>'+
							'</div>'+						
						'</div>');
					}
					
					else
					{

						$chat.prepend('<div class = "row-fluid" style = "margin-top:2%">'+
									'<div class = "span8">'+
										'<div class = "span1">'+
											'<img class = "media-object hidden-phone" width="32px" data-src = "holder.js/64x64" src = "'+base_url+'img/profile_32/'+data.thirty+'" />'+
										'</div>'+
										'<div class = "span11">'+
											'<span style = "color:#E81919;font-weight:bold">'+data.name+':</span>'+
											'<span style = "color:#C24C4C" class = "messages_from_chat">&nbsp;'+data.message+'</span>'+
										'</div>'+
									'</div>'+
									'<div class = "span4">'+
									'<span style = "color:#5D5D56" class = "pull-right visible-desktop">'+output+'</span>'+
									'</div>'+					
						'</div>');						
					}
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