<?php
	/*
	****	create by Mohamad Yunus
	****	on 3 Jun 2017
	****	revise: -
	*/
	
	include('../../ADODB/adodb5/adodb.inc.php');
	
	//	open connection
	$db 	= ADONewConnection('odbc_mssql');
	$dsn 	= "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=customs;";
	$db->Connect($dsn,'sa','JvcSql@123');
	
	//	get paramater
	$stdate		= trim(@$_REQUEST["valstdate"]);
	$endate		= trim(@$_REQUEST["valendate"]);
	$supp		= trim(@$_REQUEST["valsupp"]);
	$partno		= trim(@$_REQUEST["valpartno"]);
	$pono		= trim(@$_REQUEST["valpono"]);
    $page		= @$_REQUEST["page"];
	$limit		= @$_REQUEST["limit"];
	$start		= (($page*$limit)-$limit)+1;
	
	//	execute query
    $sql 	= "declare @totalcount as int; exec displayTEMPBC $start, $limit, '{$stdate}', '{$endate}', '{$supp}', '{$partno}', '{$pono}', @totalcount=@totalcount out";
    $rs 	= $db->Execute($sql);
    $totalcount = $rs->fields['16'];
	
	//	array data
	$return 	= array();
    for ($i=0; !$rs->EOF; $i++){
        $return[$i]['jns_dok']	= $rs->fields['0'];
        $return[$i]['dp_no']	= $rs->fields['1'];
        $return[$i]['dp_tgl']	= $rs->fields['2'];
        $return[$i]['bpb_no']	= $rs->fields['3'];
        $return[$i]['bpb_tgl']	= $rs->fields['4'];
        $return[$i]['pemasok']	= $rs->fields['5'];
        $return[$i]['partno']	= $rs->fields['6'];
        $return[$i]['partname']	= $rs->fields['7'];
        $return[$i]['sat']		= $rs->fields['8'];
        $return[$i]['jumlah']	= floatval($rs->fields['9']);
        $return[$i]['nilai']	= floatval($rs->fields['10']);
        $return[$i]['periode']	= $rs->fields['11'];
        $return[$i]['files']	= $rs->fields['12'];
        $return[$i]['currency']	= $rs->fields['13'];
        $return[$i]['ponumber']	= $rs->fields['14'];
        $return[$i]['id']		= $rs->fields['15'];
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