<?php
	include('../../ADODB/adodb5/adodb.inc.php');
	
	$db = ADONewConnection('odbc_mssql');
	$dsn = "Driver={SQL Server};Server=SVRDBB;Database=testedi;";
	$db->Connect($dsn,'sa','password');
	// $db->Connect('Driver={SQL Server};Server=136.198.117.5;Database=edi;','sa','password');
	


?>