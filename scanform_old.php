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
	var mypart = document.getElementById('partid');
	var mytext = document.getElementById('idbarcode');
	var myso_number = document.getElementById('idso');
	
	mypart.value = mytext.value;   
	mytext.value = "";
	mytext.focus();
}
</script>

</head>
<body onload="document.forms[0].so.focus();">

<?php

IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {

?>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<!-- <a href="index.php">menu</a><br /> -->
     <form method="post" action="scanissue_old.php" target="scanissue" onsubmit="mulai()">
     SO NUMBER : <input type="text" name="so" id="idso" class="kelas1" /> <br>
     BARCODE SCAN :
     <input type="text" name="barcode" id="idbarcode" class="kelas1" />
     <input type="submit" name="submit" value="Submit" class="dua" />
     <input type="hidden" name="parthdn" id="partid" />
   </form>    


<br>
<br>
</body>
</html>

<?php
   }

?>
