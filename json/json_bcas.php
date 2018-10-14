<?php
	/*
	****	create by Mohamad Yunus
	****	on 6 Jan 2017
	****	revise: -
	*/
	
	include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	
	//	get paramater
	$stdate		= trim(@$_REQUEST["valstdate"]);
	$endate		= trim(@$_REQUEST["valendate"]);
	$so			= trim(@$_REQUEST["valso"]);
	$partno		= trim(@$_REQUEST["valpartno"]);
	$lotno		= trim(@$_REQUEST["vallotno"]);
    $page		= @$_REQUEST["page"];
	$limit		= @$_REQUEST["limit"];
	$start		= (($page*$limit)-$limit)+1;
	
	//	execute query
    $sql 	= "declare @totalcount as int; exec dispBcas $start, $limit, '{$stdate}', '{$endate}', '{$so}', '{$partno}', '{$lotno}', @totalcount=@totalcount out";
    $rs 	= $db->Execute($sql);
    $totalcount = $rs->fields['11'];
	
	//	array data
	$return 	= array();
    for ($i=0; !$rs->EOF; $i++){
        $return[$i]['so']		= $rs->fields['0'];
        $return[$i]['partno']	= $rs->fields['1'];
        $return[$i]['partname'] = $rs->fields['2'];
        $return[$i]['bom']   	= intval($rs->fields['3']);
        $return[$i]['reqqty']   = intval($rs->fields['4']);
        $return[$i]['scanqty']  = intval($rs->fields['5']);
        $return[$i]['lot']   	= $rs->fields['6'];
        $return[$i]['line']   	= $rs->fields['7'];
        $return[$i]['model']   	= $rs->fields['8'];
        $return[$i]['issdate']  = $rs->fields['9'];
        $return[$i]['serial']   = $rs->fields['10'];
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