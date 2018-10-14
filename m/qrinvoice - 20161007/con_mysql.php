<?php
	include('adodb/adodb.inc.php');
	include('adodb/adodb-exceptions.inc.php');
	include('adodb/adodb-errorpear.inc.php');
	
	$db = ADONewConnection('mysql');
	$db->Connect('136.198.117.48','root','JvcSql@123','db_tes');
?>
