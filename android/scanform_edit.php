<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MC ISSUE TO PRODUCTION SCAN</title>
<link rel='stylesheet' href='../../bootstrap/css/bootstrap.min.css'>
<link rel='stylesheet' href='../mobile_style.css'>
<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
<script src='../../bootstrap/js/bootstrap.js'></script>
<script type="text/javascript">
$(document).ready(
	function(){
		$("#issueseq").keyup(
			function(){
				var issue = document.getElementById("issueseq").value;
				//alert(issue);
				document.getElementById("issueseq_label").innerHTML = issue;
			}
		);
	}
);

function mulai()
{
	var mypart     = document.getElementById('partid');
	var mytext     = document.getElementById('idbarcode');
	var mynik	   = document.getElementById('nik');
	var myso_number= document.getElementById('idso');
	var myissueseq = document.getElementById('issueseq');
	
	mypart.value   = mytext.value;  
	mytext.value   = "";
	
	if(mynik.value == ""){
		mynik.focus();
	}else if(myso_number.value == ""){
		myso_number.focus();
	}else if(myissueseq.value == ""){
		myissueseq.focus();
	}else{
		mytext.focus();
	}
}

function start()
{
	var mynik = document.getElementById('nik');
	mynik.focus();
}
</script>

</head>
<body onload="document.forms[0].nik.focus();">

<?php

IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {

?>
    <div id="form" class="col-sm-6">
        <form method="post" action="scanissue_edit.php" target="scanissue" onsubmit="mulai()">
            <div class="form-group">
				<label class="control-label col-sm-3"  for="astno">NIK</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="nik" id="nik" class="kelas1" />
				</div>
			</div>
            <div class="form-group">
				<label class="control-label col-sm-3"  for="astno">SO NUMBER</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="so" id="idso" class="kelas1" />
				</div>
			</div>
            <div class="form-group">
				<label class="control-label col-sm-3"  for="issueseq">ISSUE SEQ</label>
				<div class="col-sm-9">
					<input class="form-control kelas1" type="text" name="issueseq" id="issueseq"/>
				</div>
			</div>
            <div class="form-group">
				<label class="control-label col-sm-3"  for="astno">BARCODE SCAN</label>
				<div class="col-sm-9">
					<input class="form-control kelas1" type="text" name="barcode" id="idbarcode"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<button class="btn-android btn btn-primary col-sm-12" type="submit" name="submit" value="Submit" class="dua"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;SUBMIT</button>
					<button class="btn-android btn btn-primary col-sm-12" type="reset" name="reset" value="reset" id="reset" onClick="start()"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;&nbsp;START</button>
					<input type="hidden" name="parthdn" id="partid" />
				</div>
			</div>
        </form> 
    </div>
	<div class="col-sm-6">
        <form method="post" action="scanissue_edit.php" target="scanissue" onsubmit="mulai()">
            <div class="form-group">
				<label class="control-label col-sm-6"  for="astno" > MAX ISSUE : <font size="25">25</font></label> <!--print max issue disini-->
			</div>
            <div class="form-group">
				<label class="control-label col-sm-6"  for="astno" > ISSUE SEQ : <font id="issueseq_label" size="25"></font></label> <!--print max issue disini-->
			</div>
		</form> 
    </div>
</body>
</html>

<?php
   }

?>
