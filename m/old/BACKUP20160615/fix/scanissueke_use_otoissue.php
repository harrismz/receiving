<?php
	include "koneksi_edit.php";
	
	$dept_part= isset($_POST['dept_part']) ? $_POST['dept_part'] : ""; 
	$date_part= isset($_POST['date_part']) ? $_POST['date_part'] : ""; 
	$line     = isset($_POST['line']) ? $_POST['line'] : ""; 
	$model    = isset($_POST['model']) ? $_POST['model'] : ""; 
	$prodno   = isset($_POST['prodno']) ? $_POST['prodno'] : ""; 
	$lot      = isset($_POST['lot']) ? $_POST['lot'] : ""; 
	$qty      = isset($_POST['qty']) ? $_POST['qty'] : ""; 
	try{
		//$sql = "SELECT MIN(issue_ke) FROM partlist WHERE (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') AND (issue_ke = (SELECT MIN(issue_ke) AS min_issue FROM partlist AS issue_partlist WHERE (status_scan IS NULL))) and (scan_issue <> 0)";
		$sql = "SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') and (scan_issue <> 0)";
		$rspart = $db->Execute($sql);
		echo $rspart->fields['0'];
	}
	catch (Exception $ex){
		echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
	}
?>