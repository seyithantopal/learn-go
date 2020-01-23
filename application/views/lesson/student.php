<style>
	.menu-list li{
		list-style-type:none;
		display:inline;
		margin-right:5px;
	}

	.person-info ul{
		list-style-type:none;
	}

	.menu-list li button {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		width:120px;
	}
	
	.name {
		font:21px Calibri Light;
		color:darkblue;
		font-weight:bold;
	}

	.person-info, .menu-list {
		width:300px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		margin:0;
		padding:0;
	}

	.title {
		font:15px Calibri Light;
		font-weight:bold;
		color:gray;
		font-style:italic;
		margin-top:5px;
	}
	.all-area {
		border:1px solid gray;
		-webkit-border-radius:5px;
		margin-top:15px;
		margin-right:10px;
		padding-top:20px;
		width:300px;
		display:inline-block;
	}
</style>
<div class="container">
	<div class="dev-row">
		<div class="col-xs-12">
			<p class="home-slogan">Öğretmenlere soru sormanın en kolay ve eğlenceli yolu</p>
		</div>
		<div class="lesson-select" style="width:100%;text-align:center;">
			<form action="" onsubmit="return false" method="" name="lf" id="lesson-select-form">
				<select name="lesson" class="lesson" style="width:300px;height:35px;-webkit-border-radius:5px;-moz-border-radius:5px;-o-border-radus:5px;border-radius:5px;padding-left:5px;">
					<option>Matematik</option>
					<option>Geometri</option>
					<option>Fizik</option>
					<option>Kimya</option>
					<option>Biyoloji</option>
				</select>
				<button type="submit" class="btn btn-primary lesson-select-btn" name="lesson-select-btn">Ders Seç</button>
			</form>	
		</div>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			
		</div>
	</div>
	<div class="teachers">

	</div>
	
</div>