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
		width:125px;
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
		border:1px solid #4286f4;
		-webkit-border-radius:5px;
		margin-top:5px;
		margin-right:10px;
		padding-top:20px;
		width:300px;
		display:inline-block;
	}
</style>
<div class="container">
	<div class="dev-row">
		<div class="all-area">
			<div class="row">
				<div class="col-ms-12 person-info">
					<ul>
						<li class="name"><i class="fa fa-times-circle" style="color:red;" alt="Busy" title="Busy"></i> John Doe John Doe John Doe John Doe John Doe John Doe John Doe John Doe John</li>
						<li class="title">Teacher</li>
					</ul>
				</div>		
			</div>
			<div class="row">
				<div class="col-ms-12 menu-list">
					<ul>
						<li><button class="btn btn-primary">Follow Follow Follow Follow Follow Follow Follow Follow </button></li>
						<li><button class="btn btn-info">Message</button></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="all-area">
			<div class="row">
				<div class="col-ms-12 person-info">
					<ul>
						<li class="name"><i class="fa fa-check-circle" style="color:green;" alt="Available" title="Available"></i> John Doe John Doe John Doe John Doe John Doe John Doe</li>
						<li class="title">Teacher</li>
					</ul>
				</div>		
			</div>
			<div class="row">
				<div class="col-ms-12 menu-list">
					<ul>
						<li><button class="btn btn-primary">Follow</button></li>
						<li><button class="btn btn-info">Message</button></li>
					</ul>
				</div>
			</div>
		</div>


		
	</div>
</div>