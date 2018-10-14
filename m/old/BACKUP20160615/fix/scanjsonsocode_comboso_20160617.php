<?php 
	include "koneksi_edit.php";

	//==GET SYSTEM TIME===========
	date_default_timezone_set('Asia/Jakarta');
	$Ymd = gmdate("Ymd");
	$wkt = date('H:i:s');
	//============================
	$partcode= isset($_POST['partcode']) ? $_POST['partcode'] : ""; 
	$issueke  = isset($_POST['issueke']) ? $_POST['issueke'] : ""; 
	
	try{
		if ($issueke == ""){
			$sql = "SELECT DISTINCT(so_number) FROM partlist
				WHERE (kode = '$partcode')
				AND (issue_ke = (SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (kode = '$partcode') AND (scan_issue <> 0))) ORDER BY so_number asc";
				$rspart = $db->Execute($sql);
				$return = array();
		}
		else{
			$sql = "SELECT DISTINCT(so_number) FROM partlist
				WHERE (kode = '$partcode')
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
