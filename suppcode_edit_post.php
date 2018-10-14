<?
	include "koneksi.php";

	// Connect to server and select databse.
		
	if ($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		// echo 'PROSES BUKAN DARI POSTING';
	}
	else
	{
		$vsupp 		= $_POST['suppcode'];
		$vpartno 	= $_POST['partno'];
		$vpartname 	= $_POST['partname'];

		// update data
		$sql = "update stdpack set suppcode = '" . $vsupp . "' where partnumber = '" . $vpartno . "'";
		$rs = $db->Execute($sql);
		if(!$rs)
		{
			echo "error  " ;
		}
	} //end of else request method post...
	
	echo '<script language="javascript">location.href="part_without_supplier_code.php";</script>'; 
?>