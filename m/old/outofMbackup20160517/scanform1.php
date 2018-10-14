<?php


/*

koneksi tdk diperlukan di halaman ini

include "koneksi.php";

*/


?>
<html>
<head>
<title>MC ISSUE TO PRODUCTION SCAN</title>
<script type="text/javascript">
function mulai()
{
	var nik = document.getElementById('nik');
	var parthdn = document.getElementById('parthdn');
	var idbarcode = document.getElementById('idbarcode');
	var idso = document.getElementById('idso');
	
	parthdn.value = idbarcode.value;   
	idbarcode.value = "";
	if (nik.value = ""){
		nik.focus();
	}
	else if (idso.value = ""){
		idso.focus();
	}
	else if (idbarcode.value = ""){
		idbarcode.focus();
	}
}
</script>

</head>
<body onload="document.forms[0].nik.focus();">

<?php

IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {

?>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<!-- <a href="index.php">menu</a><br /> -->
     <form method="post" action="scanissue1.php" target="scanissue" onsubmit="mulai()">
     NIK : <input type="text" name="nik" id="nik" class="kelas1" /> <br>
     SO NUMBER : <input type="text" name="idso" id="idso" class="kelas1" /> <br>
     BARCODE SCAN :
     <input type="text" name="idbarcode" id="idbarcode" class="kelas1" />
     <input type="submit" name="submit" value="Submit" class="dua" />
     <input type="hidden" name="parthdn" id="parthdn" />
   </form>    
</body>
</html>

<?php
   }

?>
