<?php
	/*
	****	create by Mohamad Yunus
	****	on 16 Jan 2017
	****	revise:	-
	*/

    include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	ini_set('memory_limit','500M');
	
	
	//	get paramater
	$stdate		= trim(@$_REQUEST["valstdate"]);
	$endate		= trim(@$_REQUEST["valendate"]);
	$so			= trim(@$_REQUEST["valso"]);
	$partno		= trim(@$_REQUEST["valpartno"]);
	$lotno		= trim(@$_REQUEST["vallotno"]);
	
	//	execute query
    $sql = "exec downBcas '{$stdate}', '{$endate}', '{$so}', '{$partno}', '{$lotno}'";
    $rs = $db->Execute($sql);
	
	//	save file
	$fname = 'BCAS.csv';
	
	//	input data in file
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=$fname");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$fp = fopen("php://output", "w");
	$headers = 'SO Number, Part No, Part Name, BOM, Req QTY, Scan QTY, Lot, Line, Model, Issue Date, Serial' . "\n";
	fwrite($fp,$headers);
	
	while(!$rs->EOF)
	{
	   fputcsv($fp, array(	$rs->fields['0'], $rs->fields['1'], $rs->fields['2'], 
							$rs->fields['3'], $rs->fields['4'], $rs->fields['5'], 
							$rs->fields['6'], $rs->fields['7'], $rs->fields['8'], 
							$rs->fields['9'], $rs->fields['10']));
	   
	   $rs->MoveNext();
	} 
	
	//	connection close
	fclose($fp);
	$rs->Close();
    $db->Close();
?>