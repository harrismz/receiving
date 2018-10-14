<html>
<head>
	<title>MC ISSUE TO PRODUCTION SCAN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='../../bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="asset/jquery-ui.css"> 
	<link rel='stylesheet' href='asset/mobile_prod_comboso.css'>
	
	<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
	<script src="asset/jquery-ui.js"></script> 
	<script src='../../bootstrap/js/bootstrap.js'></script>
	<script src='asset/mobile_prod_comboso.js'></script>
	
</head>
<body>
	<ul>
		<li>
			<a href="http://136.198.117.48/receiving/index.php">< BACK TO MENU</a>
		</li>
		<li><font>MC ISSUE TO PRODUCTION SCAN</font></li>
	</ul>
	<br>
	<div class="panel panel-default col-sm-10 col-sm-offset-1">
		&nbsp;
		<form method="post" id="form2">
			<div class="col-sm-6" id="left_list">
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_dept" for="dept_part">DEPARTMENT</label>
					<div class="col-sm-9">
						<select class="form-control" name="dept_part" id="dept_part" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)">
							<option value = "FA">FA</option>
							<option value = "PCB">PCB</option>
							<option value = "SMALLFA">SMALL PART FA</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_date" for="date_part">DATE</label>
					<div class="col-sm-9">
						<input class="form-control dt" type="date" name="date_part" id="date_part" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_line" for="line">LINE</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="line" id="line" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_model" for="model">MODEL</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="model" id="model" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
			</div>
			<div class="col-sm-6" id="right_list">
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_prodno" for="prodno">PROD NO</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="prodno" id="prodno" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_lot" for="lot">LOT</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="lot" id="lot" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_qty" for="qty">QTY</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="qty" id="qty" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_line" for="issueke">ISSUE SEQ</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="issueke" id="issueke" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
			</div>
		</form>
		&nbsp;
	</div>
	<div class="container col-sm-10 col-sm-offset-1">
		<button class="btn btn-info col-sm-6 css_button2" type="button" name="btn_newpart" id="btn_newpart" onClick="newPart()"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;NEW MODEL</button>
		<button class="btn btn-info col-sm-6 css_button2" type="button" name="btn_refrespart" id="btn_refreshpart" onClick="refreshPart()"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;CHECK MODEL</button>
	&nbsp;
	</div>
	<input	type="hidden"	name="hide_dept"	id="hide_dept" />
	<input	type="hidden"	name="hide_date"	id="hide_date" />
	<input	type="hidden"	name="hide_line" 	id="hide_line" />
	<input	type="hidden"	name="hide_model"	id="hide_model" />
	<input	type="hidden"	name="hide_prodno"	id="hide_prodno" />
	<input	type="hidden"	name="hide_lot"		id="hide_lot" />
	<input	type="hidden"	name="hide_qty"		id="hide_qty" />
	<input	type="hidden"	name="hide_issueke"	id="hide_issueke" />
	<!--
	<button	type="button"	onclick="isidata()" >run</button>
	<script>
	function isidata(){
		document.getElementById('dept_part').value = 'FA';
		document.getElementById('date_part').value = '2016-06-21';
		document.getElementById('line').value = '13';
		document.getElementById('model').value = 'KMM-102MN';
		document.getElementById('prodno').value = '030A';
		document.getElementById('lot').value = '11356';
		document.getElementById('qty').value = '750';
		document.getElementById('issueke').value = '';
	}
	</script>
	-->
	<!--<div class="panel panel-default col-sm-12">-->
		<div class="container col-sm-10 col-sm-offset-1">
			<label class="control-label col-sm-4"  for="line_lbl" id="line_lbl"> LINE : <font id="line_label" size="6"></font></label> <!--print issue disini-->
			<label class="control-label col-sm-4"  for="issueseq_lbl" id="issueseq_lbl"> ISSUE SEQ : <font id="issueseq_label" size="6"></font></label> <!--print issue disini-->
			<label class="control-label col-sm-4"  for="model_lbl" id="model_lbl"> MODEL : <font id="model_label" size="6"></font></label> <!--print issue disini-->
		</div>	
		<div id="scanpart" class="table-responsive col-sm-12" align="center"></div>
	<!--</div>-->
</body>
</html>
