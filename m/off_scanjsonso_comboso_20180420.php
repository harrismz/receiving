<?php 
	//include "koneksi_edit.php";
	include "koneksi.php";

	//==GET SYSTEM TIME===========
	date_default_timezone_set('Asia/Jakarta');
	$Ymd = gmdate("Ymd");
	$wkt = date('H:i:s');
	//============================
	$dept_part= isset($_POST['dept_part']) ? $_POST['dept_part'] : ""; 
	$issueke  = isset($_POST['issueke']) ? $_POST['issueke'] : ""; 
	$date_part= isset($_POST['date_part']) ? $_POST['date_part'] : ""; 
	$line     = isset($_POST['line']) ? $_POST['line'] : ""; 
	$model    = isset($_POST['model']) ? $_POST['model'] : ""; 
	$prodno   = isset($_POST['prodno']) ? $_POST['prodno'] : ""; 
	$lot      = isset($_POST['lot']) ? $_POST['lot'] : ""; 
	$qty      = isset($_POST['qty']) ? $_POST['qty'] : ""; 
	
	try{
		if ($issueke == ""){
			$sql = "SELECT DISTINCT(so_number) FROM partlist
				WHERE (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty')
				AND (issue_ke = (SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') and (scan_issue <> 0))) ORDER BY so_number asc";
				$rspart = $db->Execute($sql);
				$return = array();
		}
		else{
			$sql = "SELECT DISTINCT(so_number) FROM partlist
				WHERE (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty')
				AND (issue_ke = '$issueke') ORDER BY so_number asc";
				$rspart = $db->Execute($sql);
				$return = array();
		}
	}
	catch (Exception $ex){
		echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
	}
	
	for ($i=0; !$rspart->EOF; $i++){
		$return[$i]['so_number']=trim($rspart->fields['0']);
		$rspart->MoveNext();
	}
	
	$data = array("data" => $return);
	echo json_encode($data);
	$db->Close();
	$db=null;
?>
