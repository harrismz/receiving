<?php
	include('../../ADODB/adodb5/adodb.inc.php');
	
	$db = ADONewConnection('odbc_mssql');
	$dsn = "Driver={SQL Server};Server=SVRDBS;Database=edi;";
	$db->Connect($dsn,'sa','password');
	
	$rs = $db->Execute("select ponumber from ordbal 
						where 	suppcode 	= '".trim($_REQUEST['suppcode'])."' and 
								partnumber 	= '".trim($_REQUEST['partno'])."' and 
								ponumber 	like '%".trim($_REQUEST['pono'])."%' order by ponumber asc");
	$return = array();

	for ($i = 0; !$rs->EOF; $i++) {
		
		$return[$i]['pono'] 		= trim($rs->fields['0']);
		
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