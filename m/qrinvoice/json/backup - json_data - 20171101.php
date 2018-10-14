<?php
	/*
	****	modify by Mohamad Yunus
	****	on 26 May 2017
	****	remark:  perubahan query menjadi SQL Server (line 11) 
	*/
	
	include('../con_mysql.php');
	
	
	$rs 	= $db->Execute("select userid, supp, inv, part, po, qty, convert(varchar(20), rcvdate, 120), custom, id from rectrx where sndflg = 'N' order by id desc");
	$return = array();

	for ($i = 0; !$rs->EOF; $i++) {
		
		$return[$i]['userid'] 	= trim($rs->fields['0']);
		$return[$i]['supp'] 	= trim($rs->fields['1']);
		$return[$i]['inv'] 		= trim($rs->fields['2']);
		$return[$i]['part'] 	= trim($rs->fields['3']);
		$return[$i]['po'] 		= trim($rs->fields['4']);
		$return[$i]['qty'] 		= trim($rs->fields['5']);
		$return[$i]['rcvdate'] 	= trim($rs->fields['6']);
		$return[$i]['custom'] 	= trim($rs->fields['7']);
		$return[$i]['id'] 		= trim($rs->fields['8']);
		
		$rs->MoveNext();
	}
	
	/*
	$o = array(
		"success"=>true,
		"rows"=>$return);
	*/
	echo json_encode($return);
		
	
	// Closing Database Connection
	$rs->Close();
	$db->Close();
?>