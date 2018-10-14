<?php
	include('../../ADODB/adodb5/adodb.inc.php');
	
	$db = ADONewConnection('odbc_mssql');
	$dsn = "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	// $db->Connect('Driver={SQL Server};Server=136.198.117.5;Database=edi;','sa','password');



?>