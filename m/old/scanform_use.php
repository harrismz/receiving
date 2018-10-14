<html>
<head>
	<title>MC ISSUE TO PRODUCTION SCAN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='../../bootstrap/css/bootstrap.min.css'>
	<link rel='stylesheet' href='asset/mobile.css'>
	<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
	<script src='../../bootstrap/js/bootstrap.js'></script>
	<script src='asset/mobile.js'></script>
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
			<label class="control-label"  for="issueseq_lbl" id="issueseq_lbl"> ISSUE SEQ : <font id="issueseq_label" size="6"></font></label> <!--print issue disini-->
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
					<input class="form-control" type="text" name="nik" id="nik" class="kelas1" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4"  for="issueseq">ISSUE SEQ</label>
				<div class="col-sm-8">
					<input class="form-control kelas1" type="text" name="issueseq" id="issueseq" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4"  for="idso">SO NUMBER</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="idso" id="idso" class="kelas1" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_barcode1">
				<label class="control-label col-sm-4" id="label_idbarcode1" for="idbarcode1">BARCODE SCAN </label>
				<div class="col-sm-8">
					<input class="form-control kelas1" type="text" name="idbarcode1" id="idbarcode1" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_barcode2">
				<label class="control-label col-sm-4" id="label_idbarcode2" for="idbarcode2">PART NO</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="idbarcode2" id="idbarcode2" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_po2">
				<label class="control-label col-sm-4" id="label_po2" for="po2">PO</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="po2" id="po2" onkeypress="etr(event)"/>
				</div>
			</div>
			<div class="form-group" id="show_qty2">
				<label class="control-label col-sm-4" id="label_qty2" for="qty2">QTY</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="qty2" id="qty2" onkeypress="etr(event)"/>
				</div>
			</div>
			<!--<button class="btn btn-primary col-sm-4" type="button" name="submit" value="SUBMIT" class="dua"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;SUBMIT</button>-->
			<button class="btn btn-success col-sm-4 css_button" type="button" name="setmanual" id="setmanual" value="MANUAL" onClick="tomanual()">MANUAL</button>
			<button class="btn btn-success col-sm-4 css_button" type="button" name="setscanner" id="setscanner" value="SCANNER" onClick="toscanner()">SCANNER</button>
			<button class="btn btn-primary col-sm-4 css_button2" type="button" name="start_so" value="START SO" id="start_so" onClick="startso()"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;&nbsp;START SO</button>
			<button class="btn btn-primary col-sm-4 css_button2" type="reset" name="reset" value="reset" id="reset" onClick="startnik()"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;&nbsp;START NIK</button>
		</form>
		<input	type="text" name="parthdn1" id="parthdn1" />
		<input	type="text"	name="parthdn2"	id="parthdn2" />
		<input	type="text"	name="partpo2"	id="partpo2" />
		<input	type="text"	name="partqty2"	id="partqty2" />
	</div>
	<div class="container col-sm-12" style="border: 3px solid lightblue">
		<button class="btn btn-info col-sm-6 css_button2" type="button" name="btn_scanpart" id="btn_scanpart" value="MANUAL" class="dua" onClick="newPart()"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;NEW LIST</button>
		<button class="btn btn-info col-sm-6 css_button2" type="button" name="btn_scanpart" id="btn_scanpart" value="MANUAL" class="dua" onClick="refreshPart()"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;REFRESH LIST</button>
	</div>
	<div class="container show-partlist">
		
	</div>
	<br>
	<div id="scanpart" class="container col-sm-12"  onload="scanpart()" style="border: 3px solid lightblue"></div>
	<br>
</body>
</html>
