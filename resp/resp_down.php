<?php
	/*
	****	create by Mohamad Yunus
	****	on 13 June 2016
	*/

    include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	//ini_set('memory_limit','500M');
	
	
	//	get paramater
	$suppcode 	= trim(@$_REQUEST["valsuppcode"]);
	$suppname 	= trim(@$_REQUEST["valsuppname"]);
	$partnumber = trim(@$_REQUEST["valpartnumber"]);
	$lokasi 	= trim(@$_REQUEST["vallokasi"]);
	
	//	execute query
    $sql = "exec downStdPack '{$suppcode}', '{$suppname}', '{$partnumber}', '{$lokasi}'";
    $rs = $db->Execute($sql);
	
	//	save file
	$fname = 'STDPack_PartNo.csv';
	
	//	input data in file
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=$fname");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	$fp = fopen("php://output", "w");
	$headers = 'Suppcode, Suppname, Partnumber, Partname, STDPack, Kategori, Lokasi' . "\n";
	fwrite($fp,$headers);
	
	while(!$rs->EOF)
	{
	   fputcsv($fp, array(	$rs->fields['0'], $rs->fields['1'], $rs->fields['2'], 
							$rs->fields['3'], $rs->fields['4'], $rs->fields['5'], 
							$rs->fields['6']));
	   
	   $rs->MoveNext();
	} 
	
	//	connection close
	fclose($fp);
	$rs->Close();
    $db->Close();
?>