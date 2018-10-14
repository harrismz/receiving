<?php
	/*
	****	create by Mohamad Yunus
	****	on 20 Oct 2016
	*/
	
	include('../con_mysql.php');
	
	
	$rs 	= $db->Execute("select userid, supp, inv, part, po, sum(qty), date_format(rcvdate, '%Y-%m-%d %T'), custom, id from rectrx where sndflg = 'N' group by supp, po limit 30");
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