<html>
<head>
<title>MC ISSUE TO PRODUCTION SCAN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'>
<link rel="stylesheet" href="../bootstrap/jquery/jquery-ui/jquery-ui.css"> 
<script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
<script src="../bootstrap/jquery/jquery-ui/jquery-ui.js"></script> 
<script src='../bootstrap/js/bootstrap.js'></script>
	
<script>
	$(document).ready(function(){
		if ( $('.dt')[0].type != 'date' ) $('.dt').datepicker({ dateFormat: 'yy-mm-dd' });
	});	
</script>


<style>
	*{
		margin: 0;
		padding: 0;
	}
	ul{
		list-style-type:none;
		overflow: hidden;
		background-color: #333;
	}
	li{
		float: left;
	}
	li a{
		display: block;
		color: #fff;
		text-align: center;
		padding: 10px 12px;
		text-decoration: none;
		font-weight: bold;
	}
	li font{
		display: block;
		color: #fff;
		text-align: center;
		padding: 6px 5px 0px 30px;
		text-decoration: none;
		font-weight: bold;
		font-size: 20px;
	}
	li a{
		background-color: #0f9292;
	}
	li a:hover{
		background-color: #fff;
		color: #333;
	}
	.btn-success{
		border-radius: 0 !important;
		font-weight: bold !important;
		background-color: #0f9292 !important;
		border:0 !important;
	}
	.btn-success:hover{
		border-radius: 0 !important;
		font-weight: bold !important;
		background-color: #fff !important;
		color: #0f9292 !important;
		border:0 !important;
	}
	/*
	#submit, #start_so, #reset{
		background-color: #4caf50;
		border: none;
		color: #fff;
		padding: 6px 52px;
		text-align:center;
		text-decoration: none;
		display: inline-block;
		font-size: 15px;
	}
	
	#submit:hover, #start_so:hover, #reset:hover, #submit:active, #start_so:active, #reset:active{
		background-color:#fff;
		color: #125BA8;
		box-shadow: 0px 0px 15px rgba(128, 128, 128,1);
	}*/
</style>
</head>
<body>
	<ul>
		<li>
			<a href="http://136.198.117.48/receiving/index.php">< BACK TO MENU</a>
		</li>
		<li><font>PRINT PARTLIST SCHEDULE</font></li>
	</ul>
	<br>
	<form method="post" action="print_partcode_sch.php">
		<div class="container col-sm-6 col-sm-offset-3" style="background-color: #dccaa6;">
		<br>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3">DATE ISSUE</label>
				<div class="col-sm-9">
					<input class="form-control dt" type="date" name="issue_date" id="issue_date" onBlur="this.value=this.value.toUpperCase()" ></input>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3" id="label_dept" for="issue_dept">DEPARTMENT</label>
				<div class="col-sm-9">
					<select class="form-control" name="issue_dept" id="issue_dept" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)">
						<option value = "">-- SELECT DEPARTMENT --</option>
						<option value = "FA">FA</option>
						<option value = "PCB">PCB</option>
						<option value = "SMALLFA">SMALL PART FA</option>
					</select>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3">LINE</label>
				<div class="col-sm-9">
					<input class="form-control " type="text" name="issue_line" id="issue_line" onBlur="this.value=this.value.toUpperCase()" ></input>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3">MODEL</label>
				<div class="col-sm-9">
					<input class="form-control " type="text" name="issue_model" id="issue_model" onBlur="this.value=this.value.toUpperCase()" ></input>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3">PROD NO</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="issue_prodno" id="issue_prodno" onBlur="this.value=this.value.toUpperCase()" ></input>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3">LOT</label>
				<div class="col-sm-9">
					<input class="form-control " type="text" name="issue_lot" id="issue_lot" onBlur="this.value=this.value.toUpperCase()" ></input>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<label class="control-label col-sm-3">QTY</label>
				<div class="col-sm-9">
					<input class="form-control " type="text" name="issue_qty" id="issue_qty" onBlur="this.value=this.value.toUpperCase()" ></input>
				</div>
			</div>
			<div class="form-group col-sm-12">
				<button class="btn btn-success col-sm-6 css_button" type="reset" name="reset" id="reset" value="RESET">RESET</button>
				<button class="btn btn-success col-sm-6 css_button" type="submit" name="submit" id="submit" value="SUBMIT">SUBMIT</button>
			</div>
		</div>
	</form>    
</body>
</html>