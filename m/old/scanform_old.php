<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MC ISSUE TO PRODUCTION SCAN</title>
<link rel='stylesheet' href='../../bootstrap/css/bootstrap.min.css'>
<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
<script src='../../bootstrap/js/bootstrap.js'></script>
<script type="text/javascript">
function mulai()
{
	var mypart = document.getElementById('partid');
	var mytext = document.getElementById('idbarcode');
	var myso_number = document.getElementById('idso');
	
	mypart.value = mytext.value;   
	mytext.value = "";
	mytext.focus();
}

function start()
{
	var myso_number = document.getElementById('idso');
	myso_number.focus();
}
</script>

</head>
<body onload="document.forms[0].so.focus();">

<?php

IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {

?>
    <div id="form" class="col-sm-8 col-sm-offset-2">
        <form method="post" action="scanissue.php" target="scanissue" onsubmit="mulai()">
            <div class="form-group">
				<label class="control-label col-sm-3"  for="astno">SO NUMBER</label>
				<div class="col-sm-12">
					<input class="form-control" type="text" name="so" id="idso" class="kelas1" />
				</div>
			</div>
            <div class="form-group">
				<label class="control-label col-sm-3"  for="astno">BARCODE SCAN</label>
				<div class="col-sm-12">
					<input class="form-control" type="text" name="barcode" id="idbarcode" class="kelas1" />
				</div>
			</div>
            <div class="form-group">
				<div class="col-sm-12">
					<button class="btn btn-primary col-sm-12" type="submit" name="submit" value="Submit" class="dua"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;SUBMIT</button>
					<button class="btn btn-primary col-sm-12" type="reset" name="reset" value="reset" id="reset" onClick="start()"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;&nbsp;START</button>
					<input type="hidden" name="parthdn" id="partid" />
				</div>
			</div>
        </form> 
    </div>
</body>
</html>

<?php
   }

?>
