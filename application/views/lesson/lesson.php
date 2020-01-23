<section class="main-section">
	<div class="container">
		<div class="dev-row">
			<div class="col-xs-12">
				<table border="0">
					<tr>
						<td valign="bottom"><ul style="width:75px;" class="colors">
							<li data-val="black"><div style="background-color:black;width:30px;height:30px;-webkit-border-radius:4px;">&nbsp;</div></li>
							<li data-val="green"><div style="background-color:green;width:30px;height:30px;-webkit-border-radius:4px;">&nbsp;</div></li>
							<li data-val="blue"><div style="background-color:blue;width:30px;height:30px;-webkit-border-radius:4px;margin-top:5px;">&nbsp;</div></li>
							<li data-val="red"><div style="background-color:red;width:30px;height:30px;-webkit-border-radius:4px;margin-top:5px;">&nbsp;</div></li>
						</ul></td>
						<td valign="bottom">
							<button class="btn btn-primary openChatCanvas">Sohbeti Aç</button>
							<button class="btn btn-primary savePage">Sayfayı Kaydet</button>
							<button class="btn btn-primary cleanPage">Sayfayı Temizle</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="canvas-div">
		<div class="container">		
			<div class="dev-row">
				<div class="col-sm-12">
					<div id="canvasDiv" style="float:left;overflow:auto;">
						<canvas id="sig-canvas" width="620" height="160" class="1">
							Get a better browser, bro.
						</canvas>
						<canvas id="sig-canvas2" width="620" height="160" class="2">
							Get a better browser, bro.
						</canvas>
						<canvas id="sig-canvas3" width="620" height="160" class="3">
							Get a better browser, bro.
						</canvas>
						<canvas id="sig-canvas4" width="620" height="160" class="4">
							Get a better browser, bro.
						</canvas>
						<canvas id="sig-canvas5" width="620" height="160" class="5">
							Get a better browser, bro.
						</canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="dev-row">
				<div class="col-sm-12">
					<ul class="canvas-pagination">
						<li data-val="1"><div class="num-box">1</div></li>
						<li data-val="2"><div class="num-box">2</div></li>
						<li data-val="3"><div class="num-box">3</div></li>
						<li data-val="4"><div class="num-box">4</div></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- -->
	<div class="container">
		<div class="dev-row m">
			<div class="col-xs-12">
				<div class="all-area">
					<ul class="message">

					</ul>
				</div>
			</div>
			<div class="col-xs-12">
				<textarea placeholder="Mesajınızı giriniz" class="form-control" id="messageBox"></textarea>
			</div>
		</div>
	</div>

	<style>
		.all-area {
			border:1px solid #000;
			-webkit-border-radius:4px;
			margin-top:10px;
		}
		.menus ul {
			margin:0;
			padding:0;
			margin-left:20px;
		}
		.menus ul li {
			list-style-type:none;
			display:inline-table;
			padding:2px;
		}
		.colors li {
			list-style-type:none;
			display:inline-table;
			cursor:pointer;
		}
		.colors{
			margin:0;
			padding:0;
			margin-top:5px;
		}

		.date {
			clear:both;
			float:right;
			margin-right:10px;
			font:13px Calibri;
		}
		.messages {
			margin-top:5px;
			font:18px Calibri Light;
			margin-bottom:10px;
		}

		.name {
			color:steelblue;
			font:18px Calibri;
		}

		#messageBox {
			margin-top:10px;
			height:150px;
			resize:none;
		}

		.message {
			overflow-y: auto;
			text-overflow: ellipsis;
			//white-space: nowrap;
			margin:0;
			height:500px;
			padding:0;
			margin-left:10px;
			padding-top:5px;
		}
		hr {
			-webkit-border-bottom-colors: none;
			-webkit-border-image: none;
			-webkit-border-left-colors: none;
			-webkit-border-right-colors: none;
			-webkit-border-top-colors: none;
			//border-color: #EEEEEE -moz-use-text-color #FFFFFF;
			color: #adadad;
			border-style: solid none;
			border-width: 1px 0;
			margin: 5px 0;
			margin-right:10px;
		}

		body {
			padding-top: 20px;
			padding-bottom: 20px;
			-webkit-user-select:none;
		}
		#sig-canvas {
			border: 1px solid #000;
			border-radius: 5px;
			cursor: pointer;
			margin-top:10px;
		}
		#sig-canvas2 {
			border: 1px solid #000;
			border-radius: 5px;
			cursor: pointer;
			margin-top:10px;
		}
		#sig-canvas3 {
			border: 1px solid #000;
			border-radius: 5px;
			cursor: pointer;
			margin-top:10px;
		}
		#sig-canvas4 {
			border: 1px solid #000;
			border-radius: 5px;
			cursor: pointer;
			margin-top:10px;
		}
		#sig-canvas5 {
			border: 1px solid #000;
			border-radius: 5px;
			cursor: pointer;
			margin-top:10px;
		}
		#sig-dataUrl {
			width: 100%;
		}	
		.canvas-pagination .num-box {
			border:1px solid #000;
			padding:10px;
			-webkit-border-radius:4px;
		}

		.canvas-pagination li {
			display:inline-table;
			list-style-type:none;
			margin-right:5px;
			cursor:pointer;
		}

		.selected-num-box {
			background-color:#68a349;
			color:wheat;
			border:1px solid #000;
			padding:10px;
			-webkit-border-radius:4px;
		}
		.canvas-pagination{
			margin:0;
			padding:0;
			margin-top:5px;
		}

	</style>
</div>
</section>