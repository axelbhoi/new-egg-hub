$(document).ready(function(){
	var socket = io.connect('http://localhost:3000');
	//var socket = io.connect('http://54.213.182.79:3000');	

	var loggers = {session:user_session, html:"<div class = 'row-fluid user_row' style = 'margin-bottom:2%' id = '"+user_session+"'  >"+
					"<div class = 'span2'>"+
						"<img src = '"+base_url+"img/profile_32/"+thirty+"'>"+
					"</div>"+
					"<div class = 'span10' style = 'margin-top:2%'>"+
						"<span style = 'font-weight:bold'>"+username+"</span>"+
					"</div>"+
				  "</div>"};			
	socket.emit('server ready',loggers);	
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
	
	$('.notif_row').live('click',function(){
		var c_id = $(this).attr('comment-id');
		$(this).attr('comment-id',$(this).attr('comment-id')).hide();
		
		$('html, body').animate({ scrollTop: $('.comment-wrapper').attr('comment-id',c_id).position().top}, 500);		
				$.ajax({
					url: base_url + "post/deactivate_notification",
					type: 'POST',
					data: { c_id:c_id },
					async: false,
					cache: false,
					success: function(data) {	
						if(data == "success")
						{	
							var notif_total = $('#notif_number').text();
							var total_minus = parseInt(notif_total,10) - 1;
							$('#notif_number').text(total_minus);
						}
						else
						{
							alert("Oops");
						}
					}
				});	
	});

	$('#notif_number').text(notify);
	$('#users_number').text(usernumber);

	$('.delete-posts').each(function(){
		$(this).hover(function() {
	      $(this).tooltip('show');
		});
			if(user_session == $(this).attr('post-userdata'))
			{
				$(this).css('display','list');
			}
			else
			{
				$(this).css('display','none');	
			}		
	});

	$('.delete-comments').each(function(){
		$(this).hover(function() {
	      $(this).tooltip('show');
		});
			if(user_session == $(this).attr('comment-by'))
			{
				$(this).css('display','list');
			}
			else
			{
				$(this).css('display','none');	
			}				
	});	
										
	var randomnumber=Math.floor(Math.random()*999999999);
	var rfno = sessionID +'_'+randomnumber;
	var container = $('.posts-container'); 
	
	$('button#post_submit').live("click", function(){
		var randomnumber=Math.floor(Math.random()*999999999);
		var rfno = sessionID +'_'+randomnumber;		
		$(this).button('loading');

		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var year = d.getFullYear();
		var hour = d.getHours();
		var minute = d.getMinutes();
		var second = d.getSeconds();	

		if(second < 10)
		{
			new_second = "0"+second;
		}
		else
		{
			new_second = second;
		}

		if(minute < 10)
		{
			new_minute = "0"+minute;
		}
		else
		{
			new_minute = minute;
		}		

		if(hour < 10)
		{
			new_hour = "0"+hour;
		}
		else
		{
			new_hour = hour;
		}	

		if(day < 10)
		{
			new_day = "0"+day;
		}
		else
		{
			new_day = day;month
		}		

		if(month < 10)
		{
			new_month = "0"+month;
		}
		else
		{
			new_month = month;
		}	

		setTimeout(function(){
			var post_by = $('input#post_by').val();
			var post_content = $('textarea#post_content').val();
			
			if(post_content != '') {
				var form_data = {
					post_by: post_by,
					rfno: rfno,
					post_content: post_content,
					isAjax: 1
				};
				
				$.ajax({
					url: $('form#post_form').attr('action'),
					type: 'POST',
					data: form_data,
					async: false,
					cache: false,
					success: function(data) {	
							var post_html = "<div class='post-wrapper' id= '"+rfno+"' >"+
									"<div class= 'media'>"+
										"<a class='pull-left' href='#'>"+	
											"<img class='media-object' width='64px' data-src='holder.js/64x64' src = '"+base_url+"img/profile_64/"+sixty+"'>"+
										"</a>"+
										"<div class='media-body'>"+
											"<h5 class='media-heading'>"+
												""+username+""+
												"<span class='pull-right'><a href= '"+base_url+"post/delete_post' class='delete-posts' rel='tooltip' style='opacity: 0.3;' post-id='"+rfno+"' post-userdata = '"+post_by+"'  data-original-title = 'Delete' data-placement = 'top'><i class='icon-remove'></i></a></span>"+
											"</h5>"+
											"<span style = 'text-wrap:normal;word-wrap:break-word'>"+post_content+"</span>"+
											"<ul class= 'media-options'>"+
												"<li><small><a href='#' class='posts-comment' post-id = '"+rfno+"' rel='tooltip' title='Comment'><i class='icon-comment'></i> Comment</a></small></li>"+
												"<li>&nbsp;&#8226;&nbsp;</li>"+
												"<li><small><a class='like-indicator' href='javascript:void(0)' rel='popover' post-id='"+rfno+"'></a></small></li>"+
												"<li><small class='muted'>"+year+"-"+new_month+"-"+new_day+"&nbsp;"+new_hour+":"+new_minute+":"+new_second+"</small></li>"+
											"</ul>"+

											"<div class='comments-container' post-id='"+rfno+"' style='margin-top: 10px;''></div>"+
											"<div class='media'>"+
												"<a class='pull-left' href='#''>"+
													"<img class='media-object' width='32px' data-src='holder.js/32x32' src = '"+base_url+"img/profile_32/"+thirty+"'>"+
												"</a>"+
												"<div class='media-body'>"+
													"<form action ='"+base_url+"post/submit_comment' method = 'post' accept-charset = 'utf-8' post-id='"+rfno+"'>"+
														"<input type='hidden' name='post_id' value ='"+rfno+"'/>"+
														"<textarea rows='1' class='input-block-level comment-textarea' placeholder='Comment...' style='resize: none;' name='comment' post-id='"+rfno+"'></textarea>"+
														"<button type='submit' class='btn btn-small pull-right comment-button' post-id='"+rfno+"' disabled >Comment</button>"+
													"</form>"+
												"</div>"+	
											"</div>"+	
										"</div>"+	
									"</div>"+	
									"<hr>"+
								"</div>";		
							socket.emit('send post',post_html);				

					}, 
					complete: function() {
						$('button#post_submit').button('reset');
						$('textarea#post_content').val('');
						$('span#rem-char').text('300');
					}
				});
			} else {
				alert('Post is empty');
			}
			$('button#post_submit').button('reset');
		}, 500);
		
		return false;
	});
	
	socket.on('new post', function(data){	
		container.prepend(data);
		$('.delete-posts').each(function(){
				if(user_session == $(this).attr('post-userdata'))
				{
					$(this).css('display','list');
				}
				else
				{
					$(this).css('display','none');	
				}		
		});		
	});


	$('textarea#post_content').keyup(function(){
		var content = $(this).val();
		var max_char = 300;
		
		var remaining = max_char - content.length;
		
		$('span#rem-char').text(remaining);
		
		if(content == '') {
			$('button#post_submit').attr('disabled','disabled');
		} else {
			$('button#post_submit').removeAttr('disabled');
		};
	});
	

	//delete
	$('a.delete-posts').live("click", function(){
		var id = $(this).attr('post-id');
		var session = $(this).attr('post-userdata');
		var url = $(this).attr('href');
		var myarr = id.split("_"); 
		var form_data = {
			id: id,
			is_ajax: 1
		};

		var del_data = { id:id, sessionID:sessionID };
		
		if(user_email == myarr[0])
		{
			var ans = confirm("Do you want to delete this post?");	
			if(ans) 
			{
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					async: false,
					cache: false,
					success: function(data) 	{
							$('div.post-wrapper').each(function(){
								if($(this).attr('id') == id)
								{
									$(this).remove();
								}

							});						
						socket.emit('delete post',del_data);				
					}
				});

			} 

			else 
			{
				return false;
			}
			
			return false;
		}
		else
		{
			alert('You cant delete others post');
			return false;
		}
	
		return false;
	});
	
	socket.on('deleted post', function(data){
		$('div.post-wrapper').each(function(){
			if($(this).attr('id') == data.id)
			{
				$(this).remove();
			}

		});		
			
	});

	/* --------- for comments ---------- */
	$('button.comment-button').live('click', function(){
		var randomnumber=Math.floor(Math.random()*999999999);
		var rfno = sessionID +'_'+'comment'+'_'+randomnumber;				
		var post_id = $(this).attr('post-id');
		var comment_content = $('textarea[post-id="'+post_id+'"]').val();
		var eadd = sessionID;
		var p_by = user_session;
		var form_data = {
			post_id: post_id,
			comment: comment_content,
			rfno: rfno,
			is_ajax: 1
		};
		
		$.ajax({
			url: $('form[post-id="'+post_id+'"]').attr('action'),
			type: 'POST',
			data: form_data,
			dataType: "json",
			success: function(data) {
				var html_data = { for_user:data.e_notification_for ,picture:data.e_login_picture_thirty_two, fullname:data.e_fullname, rfno:rfno, p_by:p_by, eadd:eadd, post_id: post_id, html: "<div class='media comment-wrapper' comment-id='"+rfno+"'>"+
										"<a class='pull-left' href='#'>"+
											"<img class='media-object' width='32px' data-src='holder.js/64x64' src = '"+base_url+"img/profile_32/"+thirty+"'>"+
										"</a>"+
										"<div class='media-body'>"+
											"<h5 class='media-heading'>"+
												""+username+""+
											"<span class='pull-right'><a href= '"+base_url+"post/delete_comment' class='delete-comments' rel='tooltip' style='opacity: 0.3;' comment-id='"+rfno+"' comment-by = '"+user_session+"'  data-original-title = 'Delete' data-placement = 'top'><i class='icon-remove'></i></a></span>"+												
											"</h5>"+
											"<span style = 'text-wrap:normal;word-wrap:break-word'>"+comment_content+"</span>"+	
										"</div>"+
									"</div>" };	
				socket.emit('send comment',html_data);

			},
			complete: function() {
				$('textarea[post-id="'+post_id+'"]').val('');
			}
		});
		$('button.comment-button').attr('disabled','disabled');
		return false;
	});
	
	$('textarea.comment-textarea').live('keyup', function(){
		var comment_content = $(this).val();
		
		if(comment_content != '') {
			$(this).next().removeAttr('disabled');
		} else {
			$(this).next().attr('disabled','disabled');
		}
	});

	socket.on('new comment', function(data){
		$('div.comments-container[post-id="'+data.post_id+'"]').append(data.html);			
		$('.delete-comments').each(function(){
				if(user_session == $(this).attr('comment-by'))
				{
					$(this).css('display','list');
				}
				else
				{
					$(this).css('display','none');	
				}		
		});				
		
		if(user_email == data.for_user)
		{	
			if(data.p_by != user_session)
			{
				var notifs_total = $('#notif_number').text();
				var totals_minus = parseInt(notifs_total,10) + 1;
				$('#notif_number').text(totals_minus);

				var notification_html = "<div class = 'row-fluid notif_row' comment-id = '"+data.rfno+"'>"+
											"<div class = 'span2' style = 'margin-top:2%; padding-left:2%'>"+
												"<img src = '"+base_url+"img/profile_32/"+data.picture+"'>"+
											"</div>"+
											"<div class = 'span10'>"+
												"<span style = 'font-weight:bold'>"+data.fullname+"</span>"+
												"<span>commented on your post</span>"+
											"</div>"+
										"</div>";
				$('#inner-notifications').prepend(notification_html);	
			
			}
		}
	});
	
	//delete comment
	$('a.delete-comments').live("click", function(){
		var id = $(this).attr('comment-id');
		var url = $(this).attr('href');
		var session = $(this).attr('comment-by');

		var form_data = {
			id: id,
			session:session,
			is_ajax: 1
		};
		if(user_session == session)
		{
			var ans = confirm("Do you want to delete this comment?");
			if(ans) {
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					success: function(data) {
						socket.emit('delete comment',form_data);				
						$('div.comment-wrapper[comment-id="'+id+'"]').remove();
					},
					complete: function() {
						
					}
				});
			} 
			else {
				return false;
			}
		}
		else
		{
			alert('You cant delete others post');
			return false;			
		}	
		return false;
	});

	socket.on('deleted comment', function(data){
		$('div.comment-wrapper[comment-id="'+data.id+'"]').remove();
	
		if ($('.notif_row').attr('comment-id',data.id).length > 0) {
		  	$('.notif_row').attr('comment-id',data.id).remove();
			var minus_total = parseInt(notify,10) -1;
			$('#notif_number').text(minus_total);		  	
		}		
		
	});
	
	/* --------- for like, comment, and post options ---------- */
	
	//like
	$('a.posts-like').live("click", function(){
		
		var post_id = $(this).attr('post-id');
		var url = $(this).attr('href');
		
		var form_data = {
			post_id: post_id
		};
		
		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			success: function(data) {
				if($.isNumeric(data)) {
					
					if(data == 0) {
						$('a.like-indicator[post-id="'+post_id+'"]').before('You like this ');
						$('a.like-indicator[post-id="'+post_id+'"]').after('<li>&#8226;</li>');
					} else if(data == 1) {
						$('a.like-indicator[post-id="'+post_id+'"]').before('You and ');
					} else {
						$('a.like-indicator[post-id="'+post_id+'"]').before('You and ');
						$('a.like-indicator[post-id="'+post_id+'"]').html(data);
						$('a.like-indicator[post-id="'+post_id+'"]').after(' other people ');
					} 
					$('a.posts-like[post-id="'+post_id+'"]').hide();
					$('li.like-separator[post-id="'+post_id+'"]').hide();
					
					//alert(data);
				} else {
					alert('Problem occured, please refresh the page and try again.');
					//alert(data);
				}
			},
			complete: function() {
			}
		});
		
		return false;
	});
	
	//unlike
	$('a.posts-unlike').live("click", function(){
		alert('Under construction');
		return false;
	});
	
	//comment
	$('a.posts-comment').live("click", function(e){
		e.preventDefault();
		var id = $(this).attr('post-id');
		$('.comment-textarea[post-id = "'+id+'"]').focus();
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


	
