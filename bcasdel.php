<?

// DELETE B-CAS BASED ON SERIAL

	include "koneksi.php";

	// Connect to server and select databse.
		
//	if ($_SERVER['REQUEST_METHOD'] != 'POST')
        if(isset($_GET['serial'])) 
	
	{
		$vserial	= $_GET['serial'];

		// update data
		$sql = "delete from bcas where serial = '" . $vserial . "'";
		$rs = $db->Execute($sql);
		if(!$rs)
		{
			echo "error  " ;
                  echo   ' <script type="text/javascript">;';
                  echo  ' window.aler("error delete");';
                  echo ' </script>';
		}
                else
                {
                 echo "delete berhasil";
                 echo ' <script type="text/javascript">';
                 echo '    window.aler("record deleted");';
                 echo '  </script> ';
                }
	} //end of isset GET
	
//	echo '<script language="javascript">location.href="part_without_supplier_code.php";</script>'; 
?>