
<style>
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

<!-- Content -->
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