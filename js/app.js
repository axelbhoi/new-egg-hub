
var express = require('express'),
	app = express(),
	server = require('http').createServer(app),
	io = require('socket.io').listen(server);
	
server.listen(3000);


io.sockets.on('connection',function(socket){
	
	socket.on('server ready', function(data){
		io.sockets.emit('server go',data);	
		//sockets.broadcast.emit('server go',data); //sends message besides me
	});

	socket.on('user logout', function(data){
		io.sockets.emit('server out',data);	
		//socket.broadcast.emit('new message',data); sends message besides me
	});	

	socket.on('send message', function(data){
		io.sockets.emit('new message',data);	
		console.log('user id is'+socket.id);
		//socket.broadcast.emit('new message',data); sends message besides me
	});

	socket.on('send post', function(data){
		io.sockets.emit('new post',data);	
		//socket.broadcast.emit('new message',data); sends message besides me
	});

	socket.on('send comment', function(data){
		io.sockets.emit('new comment',data);	
		//socket.broadcast.emit('new message',data); sends message besides me
	});	

	socket.on('delete post', function(data){
		io.sockets.emit('deleted post',data);	
		console.log('deletes a post', 'deletes a post');
		//socket.broadcast.emit('new message',data); sends message besides me
	});		
	
	socket.on('delete comment', function(data){
		io.sockets.emit('deleted comment',data);	
		console.log('deletes a comment', 'deletes a comment');
		//socket.broadcast.emit('new message',data); sends message besides me
	});		

    socket.on('close', function () {
      console.log('socket closed');
      socketlist.splice(socketlist.indexOf(socket), 1);
    });

});	

