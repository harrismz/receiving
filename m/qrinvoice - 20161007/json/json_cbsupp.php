<?php
	/*
	****	create by Mohamad Yunus
	****	on 28 Sept 2016
	*/
	
	include('../con_svrdbn.php');
	
	
	$rs 	= $db->Execute("select suppcode, suppname from supplier order by suppname");
	$return = array();

	for ($i = 0; !$rs->EOF; $i++) {
		
		$return[$i]['suppcode'] 		= trim($rs->fields['0']);
		$return[$i]['suppname'] 		= trim($rs->fields['1']);
		
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