<?php
	//include "koneksi_edit.php";
	include "koneksi.php";
	
	$partcode = isset($_POST['partcode']) ? $_POST['partcode'] : ""; 
	$issueke  = isset($_POST['issueke']) ? $_POST['issueke'] : ""; 
	
	try{
		if ($issueke == ""){
			//$sql = "SELECT MIN(issue_ke) FROM partlist WHERE (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') AND (issue_ke = (SELECT MIN(issue_ke) AS min_issue FROM partlist AS issue_partlist WHERE (status_scan IS NULL))) and (scan_issue <> 0)";
			$sql = "SELECT ISNULL(MIN(issue_ke),(select max(issue_ke) from partlist where kode = '$partcode' )) as issueke FROM partlist WHERE (status_scan IS NULL) AND (kode = '$partcode') AND (scan_issue <> 0)";
			$rspart = $db->Execute($sql);
			$checksts = $rspart->Recordcount();
			
			$sql2 = "SELECT MAX(issue_ke) as issueke FROM partlist WHERE (kode = '$partcode') AND (scan_issue <> 0)";
			$rspartmax1 = $db->Execute($sql2);
			
			echo $rspart->fields['0']."/".$rspartmax1->fields['0'];
		}
		else{
			//$sql = "SELECT MIN(issue_ke) FROM partlist WHERE (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') AND (issue_ke = (SELECT MIN(issue_ke) AS min_issue FROM partlist AS issue_partlist WHERE (status_scan IS NULL))) and (scan_issue <> 0)";
			$sql2 = "SELECT MAX(issue_ke) as issueke FROM partlist WHERE (kode = '$partcode') AND (scan_issue <> 0)";
			$rspartmax2 = $db->Execute($sql2);
			
			echo $issueke."/".$rspartmax2->fields['0'];
		}
	}
	catch (Exception $ex){
		echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
	}
?>