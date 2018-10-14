<?php


/*

koneksi tdk diperlukan di halaman ini

include "koneksi.php";

*/


?>
<html>
<head>
<title>MC ISSUE TO PRODUCTION SCAN</title>
<script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/jquery-ui.js"></script>
<script>
	$(document).ready(
	/*	window.onload = function scanissue(){
			$('#scanissue').html(
				'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
			);
			$.post('scanissue_tab_noframe.php', {so: $('[name=so]').val(), parthdn: $('[name=parthdn]').val()},
				function(result){
					$('#scanissue').html(result).show();
				}
			);
			return false;
		}*/
	)
	function mulai()
	{
		var mypart = document.getElementById('partid');
		var mytext = document.getElementById('idbarcode');
		var myso_number = document.getElementById('idso');
		
		mypart.value = mytext.value;   
		mytext.value = "";
		mytext.focus();
		
	}

	$(function(){
		$("#tabs").tabs();
	});
	
	function bc_submit(){
		$('#scanissue').html('<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>');
		$.post('scanissue_tab_noframe.php', {so: $('[name=so]').val(), parthdn: $('[name=parthdn]').val()},
			function(result){
				$('#scanissue').html(result).show();
			}
		);
		return false;
	}
</script>

</head>
<!--<body onload="document.forms[0].so.focus();">-->
<body>

<?php
/*
IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {
*/
?>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<!-- <a href="index.php">menu</a><br /> -->

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Barcode Scan</a></li>
		<li><a href="#tabs-2">Manual</a></li>
	</ul>
	<div id="tabs-1">
		<form method="post" onsubmit="mulai()">
			<table>
				<tr><td>SO NUMBER</td><td>:</td><td><input type="text" name="so" id="idso" class="kelas1" /></td></tr>
				<tr><td>BARCODE SCAN</td><td>:</td><td><input type="text" name="barcode" id="idbarcode" class="kelas1" /></td></tr>
				<tr><td colspan="3" align="right">
						<input type="submit" name="submit" value="Submit" class="dua" onclick="bc_submit()"/>
						<input type="hidden" name="parthdn" id="partid" />
					</td>
				</tr>
			</table>
		</form>  
	</div>
	<div id="tabs-2">
		<!--<form method="post" action="scanissue.php" target="scanissue" onsubmit="mulai()">
		<form method="post" onsubmit="mulai()">
			<table>
				<tr><td>SO NUMBER</td><td>:</td><td><input type="text" name="so" id="idso" class="kelas1" /></td></tr>
				<tr><td>BARCODE</td><td>:</td><td><input type="text" name="barcode" id="idbarcode" class="kelas1" /><input type="hidden" name="parthdn" id="partid" /></td></tr>
				<tr><td>PART</td><td>:</td><td><input type="text" name="part" id="part" class="kelas1" /></td></tr>
				<tr><td>PO</td><td>:</td><td><input type="text" name="po" id="po" class="kelas1" /></td></tr>
				<tr><td>QTY</td><td>:</td><td><input type="text" name="qty" id="qty" class="kelas1" /></td></tr>
				<tr><td colspan="3" align="right">
						<input type="submit" name="submit" value="Submit" class="dua" onclick="m_submit()"/>
					</td>
				</tr>
			</table>
		</form>  -->
	</div>
</div>
<div id="scanissue" onload="scanissue()"></div>
<br>
<br>
</body>
</html>

<?php
/*   }
*/
?>
