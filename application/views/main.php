<!DOCTYPE html>
<html xml:lang="tr" lang="tr">
<head>
	<title>Deneme</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!--<script src="<?php echo APP_URL;?>public/jquery.min.js"></script>-->
	<!--<script type="text/javascript" src="<?php echo APP_URL;?>public/modernizr.js"></script>-->
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/bootstrap/css/bootstrap-theme.min.css">
	<script src="<?php echo APP_URL;?>public/bootstrap/js/ajax.js"></script>
	<!--<script src="js/javascript.js"></script>-->
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/bootstrap/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>public/bootstrap/css/font-awesome.css">
	<script src="<?php echo APP_URL;?>public/bootstrap/js/ajax.js"></script>
	<script src="<?php echo APP_URL;?>public/js/min/jquery-v1.10.2.min.js" type="text/javascript"></script>
	<!--<script src="<?php echo APP_URL;?>public/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>-->
	<script src="<?php echo APP_URL;?>public/js/min/hammer-v2.0.3.min.js" type="text/javascript"></script>
	<script src="http://localhost:3000/socket.io/socket.io.js"></script>
	
	<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	
	<!--Include flickerplate-->
	<link href="<?php echo APP_URL;?>public/css/flickerplate.css"  type="text/css" rel="stylesheet">
	<script src="<?php echo APP_URL;?>public/js/min/flickerplate.min.js" type="text/javascript"></script>
	<link href="<?php echo APP_URL;?>public/css/demo.css"  type="text/css" rel="stylesheet">
	
	
	
	<!--Execute flickerplate-->
	<script>
		$(function(){

			$('.flicker-example').flickerplate(
			{
				auto_flick 				: true,
				auto_flick_delay 		: 3,
				arraws					: false,
				flick_animation 		: 'transition-slide'
			});
			
			// Variables Start

			var socket = io.connect("http://localhost:3000");
			var definationID;
			var changing = 1;
			var veri = '';
			var studentID = -1, teacherID = -1, who = -1;
			var isAvailable = '';
			var color = '';
			var title = '';
			var canvas, ctx;
			var canvas_num = 1;
			var drawing = false;
			var mousePos = { x:0, y:0 };
			var lastPos = mousePos;
			var canvas_name;
			var pen_color = 'black';
			
			// Variables End

			// Process Start

			$("#alert-success").hide();
			$("#alert-danger").hide();

			
			$(".savePage").click(function(){
				//$(".messageBox table tbody").animate({ scrollTop: $('.messageBox table tbody').prop("scrollHeight")}, 1000);
				//$('.messageBox table tbody').scrollTop($('.messageBox table tbody')[0].scrollHeight);
				//base_image.setAttribute('crossOrigin', 'anonymous');
				ctx.clearRect(0, 0, 600, 200);
				socket.emit('canvasAddImageReq', {
					canvasData: '<?php echo APP_URL;?>public/images/bg01.jpg',
					teacherID: teacherID,
					studentID: studentID,
					canvasName: canvas_name
				});
				//alert(teacherID);
			});

			$(".cleanPage").click(function(){
				ctx.fillStyle = "#ffffff";
				ctx.fillRect(0,0,canvas.width, canvas.height);
				init();
			});

			// socket.on start

			socket.on('canvasAddImageRes', function(data){
				var img = new Image;
				img.onload = function() {
  					ctx.drawImage(img, 0, 0, 600, 400); // Or at whatever offset you like
  				};
  				img.src = data.canvasData;
  			});
			
			socket.on('getTeachersRes', function(data){
				if(data.isAvailable == 1) {
					isAvailable = 'fa fa-check-circle';
					color = 'green';
					title = 'Müsait';
				} else if(data.isAvailable == 0) {
					isAvailable = 'fa fa-times-circle';
					color = 'red';
					title = 'Derste';
				}
				veri = "<div class='all-area'><div class='row'><div class='col-xs-12 person-info'><ul>";
				veri += "<li class='name'><i class='"+ isAvailable +"' style='margin-right:5px;color:"+ color +";' alt='"+ title +"' title='"+ title +"'></i>"+ data.name +"</li><li class='title'>"+ data.branch +" Öğretmeni</li></ul></div></div>";
				veri += "<div class='row'><div class='col-xs-12 menu-list'><ul>";
				veri += "<li><button class='btn btn-primary' title='Ders isteği gönder' onclick='$.invite(" + data.id + ")'>Ders isteği gönder</button></li><li><button class='btn btn-info'>Message</button></li></ul></div></div></div>";
				$('.teachers').append(veri);
			});

			socket.on('loginRes', function(data){
				$(".all-area").remove();
			});

			socket.on('canvasRes',function(data){

				var myCanvas = document.getElementById(data.canvasName);
				var ctx = myCanvas.getContext('2d');
				var img = new Image;
				img.onload = function(){
  					ctx.drawImage(img,0,0); // Or at whatever offset you like
  				};
  				img.src = data.canvasData;
  			});
			
			
			/*socket.on('getTeachersRes', function(data){
				var veri = "<table border='1' class='user-ranking'><tr>";
				veri += "<td style='padding-left:5px;padding-right:5px;'><div class='ranking-name'>"+ data.name +"</div><hr class='ranking-name-hr'><a onclick='$.invite(" + data.id + ")' class='link'>Ders İsteği Gönder</a><br /><a href='#' class='link'>Randevu Al</a></td>";
				veri += "</tr></table>";
				$('.row-fluid').append(veri);
			});*/

socket.on('inviteRes', function(data){
	var text = " adlı kişi size ders talebi gönderiyor.Kabul ediyor musunuz?";
	$(".modal-body").html('<b>' + data.name_surname + '</b>' + text);
	$(".modal-footer").html("<input type='button' class='btn btn-success datesAccept' value='Kabul Et' onclick='$.inviteAccept("+ data.teacher_id +", "+ data.student_id +")'><input type='button' class='btn btn-danger' value='Reddet' data-dismiss='modal'>");
	$("#lessonRequest").modal();
});

socket.on('goLessonRes', function(data){
	$.ajax({
		type: 'POST',
		url: 'http://localhost:8080/learn_go/home/setSession',
		data: {'id': data},
	});				
	window.location = '<?php echo ROOT_URL;?>lesson';
});

function encode(r){
	var smile = -1, angry = -1;
	smile = r.search(/:\)/g);
	angry = r.search(/:\(/g);
		if(r.search(/[\x26\x0A\<>'"]/g) != -1) return r.replace(/[\x26\x0A\<>'"]/g, function(r){return"&#"+r.charCodeAt(0)+";"});
		else {
			if(smile != -1 && angry != -1) {
				return r.replace(/:\)/g, "<i class='fa fa-smile-o'></i>").replace(/:\(/g, "<i class='fa fa-frown-o'></i>");
			} else if(smile != -1) {
				return r.replace(/:\)/g, "<i class='fa fa-smile-o'></i>");
			} else if(angry != -1) {
				return r.replace(/:\(/g, "<i class='fa fa-frown-o'></i>");
			}
			else return r;
		}
	}


	socket.on('messageRes', function(data){
		var d = new Date()  // 30 Jan 2011
		var dd = d.getDate();
		var mm = d.getMonth() + 1;
		var yy = d.getFullYear();
		var date = dd + '/' + mm + '/'  + yy;
		if($('.message li').length != 0) {
			var values = "<hr />";
			values += "<li><b class='name'>"+ data.statement +"</b><div class='date'>"+ date +"</div><div class='messages'>"+ encode(data.message) +"</div></li>";
		} else {
			var values = "<li><b class='name'>"+ data.statement +"</b><div class='date'>"+ date +"</div><div class='messages'>"+ encode(data.message) +"</div></li>";
		}
		$(".message").append(values);
		$('.message').scrollTop($('.message')[0].scrollHeight);
	});



			// socket.on end


			
			definationID = <?php if(!isset($_SESSION['userdata'])) echo 0; else echo $_SESSION['userdata']['id']; ?>;
			if(definationID != 0) {
				who = <?php if(isset($_SESSION['userdata'])) {if($_SESSION['userdata']['statement'] == 1) echo 1; else echo 0;} else echo -1;?>;
				socket.emit('updateSocketID', definationID);
			}
			if(who == 1) {
				teacherID = <?php if(isset($_SESSION['userdata'])) echo $_SESSION['userdata']['id']; else echo -1;?>;
				studentID = <?php if(isset($_SESSION['guestdata'])) echo $_SESSION['guestdata']['id']; else echo -1;?>;
			}
			else if(who == 0) {
				studentID = <?php if(isset($_SESSION['userdata'])) echo $_SESSION['userdata']['id']; else echo -1;?>;
				teacherID = <?php if(isset($_SESSION['guestdata'])) echo $_SESSION['guestdata']['id']; else echo -1;?>;
			}

			$('.lesson-select-btn').click(function(){
				if(changing == 1) {
					$(".all-area").remove();
					socket.emit('getTeachersReq', $('.lesson').val().trim());
					changing = 0;
				}
			});

			
			$.inviteAccept = function(t_id, s_id) {
				socket.emit('goLessonReq', {
					s_id: s_id,
					t_id: t_id
				});
				$.ajax({
					type: 'POST',
					url: 'http://localhost:8080/learn_go/home/setSession',
					data: {'id': s_id},
				});
				window.location = '<?php echo ROOT_URL;?>lesson';
			}
			$.invite = function(id) {
				if(definationID != 0) {
					socket.emit('inviteReq', {
						teacher_id: id,
						student_id: definationID
					});
				}
			}



			$.logout = function() {
				if(who == 1) {
					var branch = <?php if(isset($_SESSION['userdata']) && $_SESSION['userdata']['statement'] == 1) echo "'".$_SESSION['userdata']['branch'] . "'"; else echo "''"; ?>;
					socket.emit('logoutReq', {
						id: teacherID,
						branch: branch
					});
				}
				window.location = '<?php echo ROOT_URL;?>auth/logout';
			}

			$(".lesson").change(function(){
				changing = 1;
			});
			$(".tip").change(function(){
				var tip = $(".tip").val();
				if(tip == "Öğrenci"){
					$(".brans").hide();
					$(".brans").val('');
				}
				else{
					$(".brans").val($(".brans option:first").val());
					$(".brans").show();
				}
			});

			$("#messageBox").keydown(function(e){
				if(e.keyCode == 13){
					e.preventDefault();
					var msg = $(this).val().trim();
					if(msg != '') {
						//alert(aa);
						socket.emit('messageReq', {
							who: who,
							teacherID: teacherID,
							studentID: studentID,
							message: msg
						});
						socket.emit('session-sample');
						$(this).val('');			
					}
				}
			});

			

			$("#login").click(function(){
				if($(".form-control:eq(5)").val()=="" || $(".form-control:eq(6)").val()==""){
					alert("Lütfen boş bırakmayınız");
					return false;
				} else {
					var values = $("#login_form").serialize();
					$.ajax({
						type:"POST",
						url:"http://localhost:8080/learn_go/auth/login/",
						data:values,
						success:function(suc){
							$("#alert-danger").show();
							if(suc.substring(0,1) == "B"){
								$("#alert-success").removeClass();
								$("#alert-success").addClass("alert alert-danger");
								$("#alert-success").html(suc);
								$("#alert-success").show();
							}else{
								var result = $.parseJSON(suc);
								if(result['statement'] == 'Öğretmen') {
									socket.emit('loginReq', $('.brans').val().trim());
								}
								window.location = '<?php echo ROOT_URL . 'home';?>';
								
							}
							setTimeout(function(){
								$("#alert-success").hide();
							},4000);
						}
					});
				}
			});

			$(".m").hide();

			$(".openChatCanvas").click(function(){
				var value = $(".openChatCanvas").text();
				if(value == "Sohbeti Aç"){
					$(".canvas-div").hide();
					$(".m").show();
					$(".message").focus();
					$(".openChatCanvas").text('Tahtayı Aç');
				}else if(value == "Tahtayı Aç"){
					$(".canvas-div").show();
					$(".m").hide();
					$(".openChatCanvas").text('Sohbeti Aç');
				}
			});
			
			$("#signin").click(function(){
				var values = $("#signin_form").serialize();
				if($(".form-control:eq(0)").val()=="" || $(".form-control:eq(1)").val()=="" || $(".form-control:eq(2)").val()=="") alert("Lütfen boş bırakmayınız");
				else{
					$.ajax({
						type:"POST",
						url:"http://localhost:8080/learn_go/auth/signup/",
						data:values,
						success:function(suc){
							$("#alert-danger").show();
							if(suc.substring(0,1) == "B"){
								$("#alert-danger").html(suc);
								$("#alert-danger").removeClass();
								$("#alert-danger").addClass("alert alert-danger");
							}else{
								$("#alert-danger").html(suc);
								$("#alert-danger").removeClass();
								$("#alert-danger").addClass("alert alert-success");
							}
							setTimeout(function(){
								$("#alert-danger").hide();
							},6000);
						}
					});					
				}
			});

			//alert($('.main-header .container').width());


			window.requestAnimFrame = (function (callback) {
				return window.requestAnimationFrame || 
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				window.oRequestAnimationFrame ||
				window.msRequestAnimaitonFrame ||
				function (callback) {
					window.setTimeout(callback, 1000/60);
				};
			})();

	// Set up the canvas
	function init() {
		//alert('initializing: ' + canvas_name);
		if(canvas_num == 1) {
			canvas = document.getElementById('sig-canvas');
			canvas_name = 'sig-canvas';
		}
		else {
			canvas = document.getElementById('sig-canvas' + canvas_num);
			canvas_name = 'sig-canvas' + canvas_num;
		}
		ctx = canvas.getContext("2d");
		resizeCanvas();		
		window.addEventListener('resize', resizeCanvas, false);
		window.addEventListener('orientationchange', resizeCanvas, false);
		canvas.addEventListener("mousedown", function (e) {
			drawing = true;			
			lastPos = getMousePos(canvas, e);
		}, false);
		canvas.addEventListener("mouseup", function (e) {
			drawing = false;
			var canvasData = canvas.toDataURL();
			socket.emit('canvasReq', {
				canvasData: canvasData,
				teacherID: teacherID,
				studentID: studentID,
				canvasName: canvas_name
			});
		}, false);
		canvas.addEventListener("mousemove", function (e) {
			mousePos = getMousePos(canvas, e);
		}, false);

	// Set up touch events for mobile, etc
	canvas.addEventListener("touchstart", function (e) {
		mousePos = getTouchPos(canvas, e);
		var touch = e.touches[0];
		var mouseEvent = new MouseEvent("mousedown", {
			clientX: touch.clientX,
			clientY: touch.clientY
		});

		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchend", function (e) {
		var mouseEvent = new MouseEvent("mouseup", {});

		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchmove", function (e) {
		var touch = e.touches[0];
		var mouseEvent = new MouseEvent("mousemove", {
			clientX: touch.clientX,
			clientY: touch.clientY
		});
		canvas.dispatchEvent(mouseEvent);
		//console.log('aa');
	}, false);

	// Prevent scrolling when touching the canvas
	document.body.addEventListener("touchstart", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
	document.body.addEventListener("touchend", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
	document.body.addEventListener("touchmove", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
}
init();


	//resizeCanvas();
	

	// Set up the UI
	/*var sigText = document.getElementById("sig-dataUrl");
	var sigImage = document.getElementById("sig-image");
	var clearBtn = document.getElementById("sig-clearBtn");
	var submitBtn = document.getElementById("sig-submitBtn");*/
	

	/*clearBtn.addEventListener("click", function (e) {
		clearCanvas();
		sigText.innerHTML = "Data URL for your signature will go here!";
		sigImage.setAttribute("src", "");
	}, false);
	submitBtn.addEventListener("click", function (e) {
		var dataUrl = canvas.toDataURL();
		sigText.innerHTML = dataUrl;
		sigImage.setAttribute("src", dataUrl);
	}, false);*/

	// Set up mouse events for drawing
	

	// Get the position of the mouse relative to the canvas
	function getMousePos(canvasDom, mouseEvent) {
		var rect = canvasDom.getBoundingClientRect();
		return {
			x: mouseEvent.clientX - rect.left,
			y: mouseEvent.clientY - rect.top
		};		
	}

	//$('#canvasDiv').css('width', $('.main-header .container').width() - 30);
	function resizeCanvas() {
		var dataUrl = canvas.toDataURL();
		canvas.width = $('.main-header .container').width() - 30;
		canvas.height = window.innerHeight;
		var image=new Image();
		image.onload = function() 
		{
			ctx.drawImage(image, 0, 0);
		};
		image.src = dataUrl;
	}

	// Get the position of a touch relative to the canvas
	function getTouchPos(canvasDom, touchEvent) {
		var rect = canvasDom.getBoundingClientRect();
		return {
			x: touchEvent.touches[0].clientX - rect.left,
			y: touchEvent.touches[0].clientY - rect.top
		};
	}

	// Draw to the canvas
	function renderCanvas() {
		if (drawing) {
			ctx.lineWidth = 2;
			ctx.lineCap = "round";
			ctx.strokeStyle = pen_color;
			ctx.moveTo(lastPos.x, lastPos.y);
			ctx.lineTo(mousePos.x, mousePos.y);
			lastPos = mousePos;
			ctx.stroke();
			
		}
	}

	for(var i = 2;i<= 5;i++) {
		$('.' + i).hide();
	}

	$('.colors li').click(function(){
		pen_color = $(this).data('val');
	});
	$('.canvas-pagination div:eq(0)').addClass('selected-num-box');
	var selected = 0;
	$('.canvas-pagination li').click(function(){
		$('.' + canvas_num).hide();
		canvas_num = $(this).data('val');
		$('.' + canvas_num).show();
		init();
		$('.canvas-pagination div:eq('+ selected +')').removeClass();
		$('.canvas-pagination div:eq('+ selected +')').addClass('num-box');

		selected = $(this).data('val') - 1;

		$('.canvas-pagination div:eq('+ selected +')').removeClass();
		$('.canvas-pagination div:eq('+ selected +')').addClass('selected-num-box');
		//init($('.' + canvas_num).attr('id'));


	});

	function clearCanvas() {
		canvas.width = canvas.width;
	}

	// Allow for animation
	(function drawLoop () {
		requestAnimFrame(drawLoop);
		renderCanvas();
	})();

});
</script>
<style>
	
</style>
</head>
<body onload="">
	<div class="wrapper">
		<div class="dev-row">
			<header class="main-header">
				<nav class="main-nav">
					<div class="container">
						<ul class="pull-right">
							<li><a href="<?php echo ROOT_URL;?>home">Anasayfa</a></li>
							<li><a href="<?php echo ROOT_URL;?>about-us">Hakkımızda</a></li>
							<?php if(isset($_SESSION['userdata'])) :?>
								<li><a href="#"><?php echo $_SESSION['userdata']['name_surname']; ?></a></li>
								<li><a href="#" onclick="$.logout();return false;">Çıkış</a></li>
							<?php else :?>
								<li><a href="#" data-toggle="modal" data-target="#myModal">Kayıt Ol</a></li>
								<li><a href="#" data-toggle="modal" data-target="#giris">Giriş Yap</a></li></span>
							<?php endif ;?>
						</ul>
						<!--<div class="aaaa pull-left">
							<div class="col-xs-6">
								<div class="" style="font:28px Calibri Light;color:white;margin-top:15px;">LearnGo</div>
							</div>
						</div>-->
					</div>
				</nav>
			</header>
		</div>
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<form action="<?php echo ROOT_URL;?>auth/add" method="" id="signin_form" onsubmit="return false">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Kayıt Ol</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12">
									<p><input type="text" name="name_surname" placeholder="Ad Soyad" class="form-control" autofocus autocomplete="off"></input></p>
									<p><input type="text" name="username" placeholder="Kullanıcı Adı" class="form-control" autocomplete="off"></input></p>
									<p><input type="password" name="password" placeholder="Şifre" class="form-control"></input></p>
									<p>
										<div class="row">
											<div class="col-xs-6">
												<select name="statement" class="form-control tip">
													<option>Öğretmen</option>
													<option>Öğrenci</option>
												</select>
											</div>
											<div class="col-xs-6">
												<select name="branch" class="form-control brans">
													<option>Matematik</option>
													<option>Geometri</option>
													<option>Fizik</option>
													<option>Kimya</option>
												</select>
											</div>
										</div>
									</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="signin" id="signin">Kayıt Ol</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
							<div class="alert alert-danger" role="alert" id="alert-danger"></div>
						</div>
					</div>

				</div>
			</div>
		</form>
		<!-- Giris Modal -->
		<form action="<?php echo ROOT_URL;?>auth/login" onsubmit="return false"  id="login_form" method="post">
			<div id="giris" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Giriş Yap</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12">
									<p><input type="text" name="username" placeholder="Kullanıcı Adı" class="form-control" autofocus autocomplete="off"></input></p>
									<p><input type="password" name="password" placeholder="Şifre" class="form-control"></input></p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="login" id="login">Giriş Yap</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
							<div class="alert alert-success" role="alert" id="alert-success" style="text-align:left;margin-top:10px;"></div>
						</div>
					</div>

				</div>
			</div>
		</form>

		<div id="lessonRequest" class="modal fade" role="dialog" data-backdrop="static">
			<div class="modal-dialog">
				<form action="" method="" id="signin_form" onsubmit="return false">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Ders İsteği</h4>
						</div>
						<div class="modal-body">
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</form>
			</div>
		</div>



		<?php 
		require $viewPath;
		?>
		<footer class="main-footer">
			<div class="container">
				<div class="col-xs-8">
					<ul>
						<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
					</ul>
				</div>
				<div class="col-xs-4">
					Bize Ulaşın
					<form action="" method="POST" onsubmit="alert('Email information sent');return false;">
						<input type="text" class="form-control contact-us"></input>
					</form>
				</div>
				<div class="col-xs-12">
					<span class="site-adware"><em>Copyright &copy; 2015 </em></span>
				</div>		
			</div>
		</footer>
	</div>
	<script>
		(function() {})();
	</script>
</body>
</html>