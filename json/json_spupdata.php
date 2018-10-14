<?php
	/*
	****	create by Mohamad Yunus
	****	on 8 June 2016
	*/

    include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	
	//	execute query
	$replikasi 	= @$_REQUEST['valreplikasi'];
	$stdpack 	= @$_REQUEST['valstdpack'];
	$kategori 	= @$_REQUEST['valkategori'];
	$lokasi 	= @$_REQUEST['vallokasi'];
	$ip			= getenv("REMOTE_ADDR");
	$updatedate	= 'convert(varchar(20),getdate(),120)';
	
	$rs 	= $db->Execute("update stdpack 	set	stdpack = '{$stdpack}',
												kategori = '{$kategori}',
												lokasi = '{$lokasi}',
												input_user = '{$ip}',
												input_date = $updatedate
							where replikasi = '{$replikasi}'");
	$rs->Close();
    
	//	connection close
    $db->Close();
?>