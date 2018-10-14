<?php
	/*
	****	create by Mohamad Yunus
	****	on 28 Sept 2016
	****	remark:  merubah nama koneksi (on line 8 - by Mohamad Yunus - 20171101)
	*/
	
	include('../con_qrinvoice.php');
	
	
	$rs 	= $db->Execute("exec dispDataSummary");
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
		$return[$i]['category'] = trim($rs->fields['8']);
		
		$rs->MoveNext();
	}
	
	echo json_encode($return);		
	
	// Closing Database Connection
	$rs->Close();
	$db->Close();
?>