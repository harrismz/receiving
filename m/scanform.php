<html>
<head>
	<title>MC ISSUE TO PRODUCTION SCAN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='../../bootstrap/css/bootstrap.min.css'>
	<link rel='stylesheet' href='asset/mobile_1.css'>
	<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
	<script src='../../bootstrap/js/bootstrap.js'></script>
	<script src='asset/mobile_1.js'></script>
	<script>
		$(document).ready(function()
		{
		 	var gantiWeb = '<button class="btn btn-warning" type="button" onclick="errWeb()">Klik disini jika WEB ini ERROR</button>';
			document.getElementById("errorWeb").innerHTML = gantiWeb;
		});

		function errWeb(){
			//var pathArray = window.location.pathname.split( '/' );
			var pathArray = window.location.href.split( '/' );
			var totArray = pathArray.length;
			var i;
			var segment = "";
			var segment_1 = pathArray[0];
			var segment_2 = pathArray[1];
			var segment_3 = pathArray[2];

			for (i=3; i < totArray; i++){
				segment += "/"+pathArray[i];
			}
			window.location.replace('http://136.198.117.75'+segment);
		}
	</script>
</head>
<body>
	<h4 id="h4_form">MC ISSUE TO PRODUCTION SCAN</h4>
	<h5 id="errorWeb" align="center"></h5>
	
	<hr>
	<div class="container col-sm-12">
		<!--<form class="col-sm-5" method="post" id="form1" style="border: 1px solid green">-->
		<form method="post" id="form1">
			<div class="form-group">
				<label class="control-label col-sm-4"  for="nik">NIK</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="nik" id="nik" class="kelas1" onkeypress="etr(event)"/>
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
		<input	type="hidden" name="parthdn1" id="parthdn1" />
		<input	type="hidden"	name="parthdn2"	id="parthdn2" />
		<input	type="hidden"	name="partpo2"	id="partpo2" />
		<input	type="hidden"	name="partqty2"	id="partqty2" />
	</div>
	<div id="scanissue" class="container col-sm-12"  onload="scanissue()"></div>
	</div>
</body>
</html>
