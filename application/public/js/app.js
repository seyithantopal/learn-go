var app = require('express')(),
server = require('http').createServer(app);
mysql = require('mysql'),
io = require('socket.io')(server),
connection = mysql.createConnection({
	host:'localhost',
	user:'root',
	password:'',
	database:'learn_go'
});
connection.connect(function(err){
	if(err){
		console.log('Veritabanına bağlanırken hata' + err.stack);
		return;
	}
});

server.listen(3000);
// Share session with io sockets

io.sockets.on('connection',function(socket){
	console.log('Connected to server');	
	socket.on('send-id',function(data){
		var query = connection.query('SELECT * FROM users WHERE id='+ data.get_id +''); // Teacher's Data
		var query2 = connection.query('SELECT * FROM users WHERE id='+ data.send_id +''); // Student's Data
		query.on('result',function(row){
			var socketId = row['socketID'];
			query2.on('result',function(row2){
				var nameSurname = row2['name-surname'];
				var id = row2['id'];
				io.to(socketId).emit('bildirim',{
					nameSurname:nameSurname,
					teacherId:id
				});
			});
			//console.log(socketId);
		});
	});
	socket.on('studentRouteEmit',function(data){
		var query = connection.query('SELECT * FROM users WHERE id='+ data.studentID +''); // Student's Data
		query.on('result',function(row){
			var studentSocketId = row['socketID'];
			io.to(studentSocketId).emit('studentRoute',data.teacherID);
		});
		var query2 = connection.query('UPDATE users SET isAvailable=0 WHERE id='+ data.teacherID +'');		
	});
	socket.on('sendURL',function(data){
		//console.log(data.studentId);
		var query = connection.query('SELECT * FROM users WHERE id='+ data.studentId +'');
		query.on('result',function(row){
			var studentSocketId = row['socketID'];
			io.to(studentSocketId).emit('cameURL',data.msg);
			//console.log(studentSocketId);
		});
		var query2 = connection.query('SELECT * FROM users WHERE id='+ data.teacherId +'');
		query2.on('result',function(row2){
			var teacherSocketId = row2['socketID'];
			io.to(teacherSocketId).emit('cameURL',data.msg);
			//console.log(teacherSocketId);
		});
	});
	socket.on('showSocketID',function(){
		socket.emit('showSocketID_',socket.id);
	});
	socket.on('datesAccept',function(id){
		var query = connection.query("UPDATE dates SET viewed=1,status=1 WHERE id=?",id);
	});
	socket.on('datesDenial',function(id){
		var query = connection.query("UPDATE dates SET viewed=1,status=0 WHERE id=?",id);
	});
	
	socket.on('deneme',function(data){
		var query2 = connection.query('UPDATE users SET socketID=?,isAvailable = 1 WHERE id='+ data +'',socket.id);		
		//console.log(data);
	});
	socket.on('updateStudentSocketID',function(data){
		var query2 = connection.query('UPDATE users SET socketID=? WHERE id='+ data +'',socket.id);		
		//console.log("öğrenci socket id "+data+" ile değiştirildi");
	});
	socket.on('updateTeacherSocketID',function(data){
		var query2 = connection.query('UPDATE users SET socketID=? WHERE id='+ data +'',socket.id);		
		//console.log(data);
	});


	/* ---------------------------------------------------------------------------------------------------------- */
	/* ---------------------------------------------------------------------------------------------------------- */
	
	

	socket.on('inviteReq', function(data){
		var query = connection.query("SELECT * FROM users WHERE id = '"+ data.teacher_id +"'");
		var query2 = connection.query("SELECT * FROM users WHERE id = '"+ data.student_id +"'");
		query.on('result', function(row){
			query2.on('result', function(row2){
				var name_surname = row2['name_surname'];
				io.to(row['socketID']).emit('inviteRes', {
					name_surname: name_surname,
					student_id: row2['id'],
					teacher_id: row['id']
				});
			});
		});
	});

	socket.on('getTeachersReq', function(data) {
		var query = connection.query("SELECT * FROM users WHERE statement='Öğretmen' AND branch='" + data + "' AND status = 1");
		query.on('result', function(row){
			socket.emit('getTeachersRes', {
				id: row['id'],
				name: row['name_surname'],
				branch: row['branch'],
				isAvailable: row['isAvailable']
			});
		});
	});


	socket.on('updateSocketID', function(data){
		var query = connection.query('UPDATE users SET socketID=? WHERE id='+ data +'',socket.id);
	});

	socket.on('goLessonReq', function(data){
		var query = connection.query("SELECT * FROM users WHERE id = '" + data.s_id + "'");
		query.on('result', function(row){
			io.to(row['socketID']).emit('goLessonRes', data.t_id);
		});
	});

	socket.on('messageReq', function(data){
		var query = connection.query("SELECT * FROM users WHERE id = '" + data.studentID + "'");
		var query2 = connection.query("SELECT * FROM users WHERE id = '" + data.teacherID + "'");
		if(data.who == 1) {
			query.on('result', function(row){
				io.to(row['socketID']).emit('messageRes', {
					message: data.message,
					statement: 'Öğretmen'
				});
			});
			query2.on('result', function(row2){
				io.to(row2['socketID']).emit('messageRes', {
					message: data.message,
					statement: 'Öğretmen'
				});
			});
		} else {
			query2.on('result', function(row2){
				io.to(row2['socketID']).emit('messageRes', {
					message: data.message,
					statement: 'Öğrenci'
				});
			});
			query.on('result', function(row){
				io.to(row['socketID']).emit('messageRes', {
					message: data.message,
					statement: 'Öğrenci'
				});
			});
		}
	});


	socket.on('loginReq', function(data){
		//io.sockets.emit('loginRes');
		io.sockets.emit('loginRes');
		var query = connection.query("SELECT * FROM users WHERE statement='Öğretmen' AND branch='" + data + "' AND status = 1");
		query.on('result', function(row){
			io.sockets.emit('getTeachersRes', {
				id: row['id'],
				name: row['name_surname'],
				branch: row['branch'],
				isAvailable: row['isAvailable']
			});
		});
	});

	socket.on('canvasReq', function(data){
		console.log('Canvas initialized');
		var query = connection.query('SELECT * FROM users WHERE id='+ data.studentID +'');
		query.on('result',function(row){
			io.to(row['socketID']).emit('canvasRes', {
				canvasData: data.canvasData,
				canvasName: data.canvasName
			});
			//console.log(studentSocketId);
		});
		var query2 = connection.query('SELECT * FROM users WHERE id='+ data.teacherID +'');
		query2.on('result',function(row2){
			io.to(row2['socketID']).emit('canvasRes', {
				canvasData: data.canvasData,
				canvasName: data.canvasName
			});
		});
	});

	socket.on('canvasAddImageReq', function(data){
		console.log('Canvas images initialized');
		var query = connection.query('SELECT * FROM users WHERE id='+ data.studentID +'');
		query.on('result',function(row){
			io.to(row['socketID']).emit('canvasAddImageRes', {
				canvasData: data.canvasData,
				canvasName: data.canvasName
			});
			//console.log(studentSocketId);
		});
		var query2 = connection.query('SELECT * FROM users WHERE id='+ data.teacherID +'');
		query2.on('result',function(row2){
			io.to(row2['socketID']).emit('canvasAddImageRes', {
				canvasData: data.canvasData,
				canvasName: data.canvasName
			});
		});
	});

	socket.on('logoutReq', function(data){
		console.log('Done Logout');
		io.sockets.emit('loginRes');
		var query2 = connection.query('UPDATE users SET status = 0, isAvailable = 1 WHERE id='+ data.id +'');
		var query = connection.query("SELECT * FROM users WHERE statement='Öğretmen' AND branch='" + data.branch + "' AND status = 1");
		query.on('result', function(row){
			io.sockets.emit('getTeachersRes', {
				id: row['id'],
				name: row['name_surname'],
				branch: row['branch'],
				isAvailable: row['isAvailable']
			});
		});
	});


	/* ---------------------------------------------------------------------------------------------------------- */
	/* ---------------------------------------------------------------------------------------------------------- */



	socket.on('sendMessage',function(data){
		if(data.whoID == 1){
			var query = connection.query('SELECT * FROM users WHERE id='+ data.studentID +'');
			query.on('result',function(row){
				var socketID = row['socketID'];
				io.to(socketID).emit('sendMsg',{
					statement:'Öğretmen',
					msg:data.msg
				});
				socket.emit('sendMsg',{
					statement:'Öğretmen',
					msg:data.msg
				});
			});
		}
		else{
			var query = connection.query('SELECT * FROM users WHERE id='+ data.teacherID +'');
			query.on('result',function(row){
				var socketID = row['socketID'];
				io.to(socketID).emit('sendMsg',{
					statement:'Öğrenci',
					msg:data.msg
				});
				socket.emit('sendMsg',{
					statement:'Öğrenci',
					msg:data.msg
				});
			});
		}
	});
	socket.on('aa',function(data){
		socket.on('disconnect',function(){
			console.log(data);
			var query = connection.query("SELECT * FROM users WHERE id = ?",data);
			query.on('result',function(row){
				var socketID = row['socketID'];
				io.to(socketID).emit('disconnectSocketID');
				var query2 = connection.query('UPDATE users SET isAvailable = 1 WHERE id='+ data +'');
			});
		});
	});
	
});