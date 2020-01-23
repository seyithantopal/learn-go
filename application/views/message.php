<script>
	$(document).ready(function(){
		$('.click').click(function(){
			//$('.message').scrollTop($('.message')[0].scrollHeight);
			alert($('.message li').length);
		});
	});
</script>
<style>
	.all-area {
		border:1px solid #000;
		-webkit-border-radius:4px;
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
		margin-top:20px;
		height:200px;
	}
	
	.message {
		overflow-y: auto;
		text-overflow: ellipsis;
		//white-space: nowrap;
		margin:0;
		height:450px;
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
</style>
<div class="container">
	<div class="dev-row">
		<div class="col-xs-12">
			<div class="all-area">
				<ul class="message">
					<li><b class="name">Öğrenci</b><div class="date">23.12.2016 20:00</div>
						<div class="messages">Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message Message </div>
					</li>			
				</ul>
			</div>
		</div>
	</div>
	<div class="dev-row">
		<div class="col-xs-12">
			<input type="button" class="click" value="Click">
		</div>
	</div>
</div>