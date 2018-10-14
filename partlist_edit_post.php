<?
	include('../ADODB/connection.php');
	
	if ($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		// echo 'PROSES BUKAN DARI POSTING';
	}
	else
	{
		$vsupp 		= $_POST['suppcode'];
		$vpartno 	= $_POST['partno'];
		$vpartname 	= $_POST['partname'];
		$vkategori 	= $_POST['kategori'];
		

		// update data
		$sql = "select * from stdpack where suppcode = '" . $vsupp . "' and partnumber = '" . $vpartno . "'";
		$rs = $db->Execute($sql);
		
		$record = array();
		$record["kategori"] = $vkategori;

		$updateSQL = $db->GetUpdateSQL($rs, $record);
		$db->Execute($updateSQL);
	} //end of else request method post...
	
	echo '<script language="javascript">location.href="partlist.php?suppcode=' . trim($vsupp) . '";</script>'; 
	
	$rs->Close(); $db->Close();
?>