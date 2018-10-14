<?php
	include('adodb/adodb.inc.php');
	include('adodb/adodb-exceptions.inc.php');
	include('adodb/adodb-errorpear.inc.php');
	
	/*
	$db = ADONewConnection('mysql');
	//$db->Connect('136.198.117.48','root','JvcSql@123','db_tes');
	$db->Connect('136.198.117.33','fingerplus','','db_tes');
	*/
	$db = ADONewConnection('odbc_mssql');
	$dsn = "Driver={SQL Server};Server=136.198.117.48\JEINSQL2012;Database=qrinvoice;";
	$db->Connect($dsn,'sa','JvcSql@123');
?>
