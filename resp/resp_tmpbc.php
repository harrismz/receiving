<?php
	/*
	****	create by Mohamad Yunus
	****	on 09 June 2017
	****	remark:  
	*/
	include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=customs;";
	$db->Connect($dsn,'sa','JvcSql@123');
	
	//	get paramater
	$typeform 			= $_REQUEST['typeform'];
	switch ($typeform)
	{
		//***
		//response edit
		case 'edit':
			//	declare
			$desc 		= @$_REQUEST["desc"];
			$id 		= @$_REQUEST["id"];
			$jns_dok 	= @$_REQUEST["jns_dok"].'BC';
			$dp_no 		= @$_REQUEST["dp_no"];
			$files 		= @$_REQUEST["files"] .' - '. getenv("REMOTE_ADDR");
			
			//	execute query
			try
			{
				if($desc == 'jnsdok'){
					$rs 	= $db->Execute("update upload_mrd_tempbc set	jns_dok	= '{$jns_dok}',
																			files	= '{$files}',
																			update_date = convert(varchar(20), getdate(), 120)
																			where	id = '{$id}'");
				}
				else{
					$rs 	= $db->Execute("update upload_mrd_tempbc set	dp_no	= '{$dp_no}',
																			files	= '{$files}',
																			update_date = convert(varchar(20), getdate(), 120)
																			where	id = '{$id}'");
				}
				
				$rs->Close();
			
				$var_msg = 1;
			}
			catch (exception $e)
			{
				$var_msg = $db->ErrorNo();
			}
			
			//	message
			switch ($var_msg)
			{
				case $db->ErrorNo():
					$err		= $db->ErrorMsg();
					$error 		= str_replace( "'", "`", $err);
					$error_msg 	= str_replace( "[Microsoft][ODBC SQL Server Driver][SQL Server]", "", $error);
					
					echo "{
						'success': false,
						'msg': '$error_msg'
					}";
					break;
				
				case 1:
					echo "{
						'success': true,
						'msg': 'Data has been input.'
					}";
					break;
			}
		
		break;
	}
	
	//	connection close
    $db->Close();
/*
    include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=customs;";
	$db->Connect($dsn,'sa','JvcSql@123');
	ini_set('memory_limit','500M');
	
	
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
*/
?>