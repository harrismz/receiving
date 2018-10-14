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
	
	//	get paramater
	$suppcode	= trim(@$_REQUEST["valsuppcode"]);
	$suppname	= trim(@$_REQUEST["valsuppname"]);
	$partnumber	= trim(@$_REQUEST["valpartnumber"]);
	$lokasi		= trim(@$_REQUEST["vallokasi"]);
    $page		= @$_REQUEST["page"];
	$limit		= @$_REQUEST["limit"];
	$start		= (($page*$limit)-$limit)+1;
	
	//	execute query
    $sql 	= "declare @totalcount as int; exec dispStdPack $start, $limit, '{$suppcode}', '{$suppname}', '{$partnumber}', '{$lokasi}', @totalcount=@totalcount out";
    $rs 	= $db->Execute($sql);
    $totalcount = $rs->fields['8'];
	
	//	array data
	$return 	= array();
    for ($i=0; !$rs->EOF; $i++){
        $return[$i]['suppcode']		= $rs->fields['0'];
        $return[$i]['suppname']		= $rs->fields['1'];
        $return[$i]['partnumber']   = $rs->fields['2'];
        $return[$i]['partname']   	= $rs->fields['3'];
        $return[$i]['stdpack']   	= $rs->fields['4'];
        $return[$i]['kategori']   	= $rs->fields['5'];
        $return[$i]['lokasi']   	= $rs->fields['6'];
        $return[$i]['replikasi']   	= $rs->fields['7'];
        $rs->MoveNext();
    }
    
    $o = array(
        "success"=>true,
        "totalCount"=>$totalcount,
        "rows"=>$return);
        
    echo json_encode($o);
    
	//	connection close
    $rs->Close();
	$db->Close();
?>