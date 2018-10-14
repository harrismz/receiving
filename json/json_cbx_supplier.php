<?php
	include('../../ADODB/adodb5/adodb.inc.php');
	
	$db = ADONewConnection('odbc_mssql');
	$dsn = "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	
	
	$rs = $db->Execute("select suppcode, suppname from supplier order by suppname");
	$return = array();

	for ($i = 0; !$rs->EOF; $i++) {
		
		$return[$i]['suppcode'] 		= trim($rs->fields['0']);
		$return[$i]['suppname'] 		= trim($rs->fields['1']);
		
		$rs->MoveNext();
	}
	
	$o = array(
		"success"=>true,
		"rows"=>$return);
	
	echo json_encode($o);
		
	
	// Closing Database Connection
	$rs->Close();
	$db->Close();
?>