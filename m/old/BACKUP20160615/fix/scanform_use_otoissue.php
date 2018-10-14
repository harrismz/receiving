<html>
<head>
	<title>MC ISSUE TO PRODUCTION SCAN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='../../bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="asset/jquery-ui.css"> 
	<link rel='stylesheet' href='asset/mobile_otoissue.css'>
	
	<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
	<script src="asset/jquery-ui.js"></script> 
	<script src='../../bootstrap/js/bootstrap.js'></script>
	<script src='asset/mobile_otoissue.js'></script>
</head>
<body>
	<h4 id="h4_form">MC ISSUE TO PRODUCTION SCAN</h4>
	<hr>
	<div class="container col-sm-5">
	<div class="container col-sm-12">
		<!--<div class="form-group col-sm-6"  style="border: 1px solid green" >
			<label class="control-label col-sm-6"  for="astno" > MAX ISSUE : <font size="12">25</font></label> <!--print max issue disini-->
		<!--</div>-->
		<div class="form-group col-sm-6">
			<label class="control-label"  for="issueseq_lbl" id="issueseq_lbl"> ISSUE SEQ : <font id="issueseq_label" size="6" onload="scan_issueke()"></font></label> <!--print issue disini-->
		</div>
		<div class="form-group col-sm-6">
			<label class="control-label"  for="so_lbl" id="so_lbl"> SO : <font id="so_label" size="6"></font></label> <!--print so disini-->
		</div>
	</div>
	<div id="scanissue" class="container col-sm-12"  onload="scanissue()"></div>
	</div>
	
	<div class="container col-sm-7">
		<!--<form class="col-sm-5" method="post" id="form1" style="border: 1px solid green">-->
		<form method="post" id="form1">
			<div class="form-group">
				<label class="control-label col-sm-4"  for="nik">NIK</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="nik" id="nik" onBlur="this.value=this.value.toUpperCase()" class="kelas1" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4"  for="idso">SO NUMBER</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="idso" id="idso" onBlur="this.value=this.value.toUpperCase()" class="kelas1" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_barcode1">
				<label class="control-label col-sm-4" id="label_idbarcode1" for="idbarcode1">BARCODE SCAN </label>
				<div class="col-sm-8">
					<input class="form-control kelas1" type="text" name="idbarcode1" id="idbarcode1" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_barcode2">
				<label class="control-label col-sm-4" id="label_idbarcode2" for="idbarcode2">PART NO</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="idbarcode2" id="idbarcode2" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_po2">
				<label class="control-label col-sm-4" id="label_po2" for="po2">PO</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="po2" id="po2" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_qty2">
				<label class="control-label col-sm-4" id="label_qty2" for="qty2">QTY</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="qty2" id="qty2" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr(event)"/>
				</div>
			</div>
			<!--<button class="btn btn-primary col-sm-4" type="button" name="submit" value="SUBMIT" class="dua"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;SUBMIT</button>-->
			<button class="btn btn-success col-sm-4 css_button" type="button" name="setmanual" id="setmanual" value="MANUAL" onClick="tomanual()">MANUAL</button>
			<button class="btn btn-success col-sm-4 css_button" type="button" name="setscanner" id="setscanner" value="SCANNER" onClick="toscanner()">SCANNER</button>
			<button class="btn btn-primary col-sm-4 css_button2" type="button" name="start_so" value="START SO" id="start_so" onClick="startso()"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;&nbsp;START SO</button>
			<button class="btn btn-primary col-sm-4 css_button2" type="reset" name="reset" value="reset" id="reset" onClick="startnik()"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;&nbsp;START NIK</button>
		</form>
		<input	type="hidden" name="parthdn1" id="parthdn1" />
		<input	type="hidden"	name="parthdn2"	id="parthdn2" />
		<input	type="hidden"	name="partpo2"	id="partpo2" />
		<input	type="hidden"	name="partqty2"	id="partqty2" />
	</div>
	<div class="container col-sm-12">
		<button class="btn btn-info col-sm-6 css_button2" type="button" name="btn_newpart" id="btn_newpart" onClick="newPart()"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;NEW LIST</button>
		<button class="btn btn-info col-sm-6 css_button2" type="button" name="btn_refrespart" id="btn_refreshpart" onClick="refreshPart()"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;REFRESH LIST</button>
	</div>
	<div class="container" id="show_partlist">
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
					<label class="control-label col-sm-3" id="label_line" for="issueke">ISSUE SEQ</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="issueke" id="issueke" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_date" for="date_part">DATE</label>
					<div class="col-sm-9">
						<input class="form-control" type="date" name="date_part" id="date_part" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_line" for="line">LINE</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="line" id="line" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
			</div>
			<div class="col-sm-6" id="right_list">
				<div class="form-group">
					<label class="control-label col-sm-3" id="label_model" for="model">MODEL</label>
					<div class="col-sm-9">
						<input class="form-control" type="text" name="model" id="model" onBlur="this.value=this.value.toUpperCase()" onkeypress="etr2(event)" />
					</div>
				</div>
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
			</div>
		</form>
	</div>
	<input	type="hidden"	name="hide_dept"	id="hide_dept" />
	<input	type="hidden"	name="hide_issueke"	id="hide_issueke" />
	<input	type="hidden"	name="hide_date"	id="hide_date" />
	<input	type="hidden" 	name="hide_line" 	id="hide_line" />
	<input	type="hidden"	name="hide_model"	id="hide_model" />
	<input	type="hidden"	name="hide_prodno"	id="hide_prodno" />
	<input	type="hidden"	name="hide_lot"		id="hide_lot" />
	<input	type="hidden"	name="hide_qty"		id="hide_qty" />
	&nbsp;
	<!--<div id="scanpart" class="table-responsive col-sm-12"  onload="scanpart()"></div>-->
	<div id="scanpart" class="table-responsive col-sm-12"></div>
</body>
</html>
