<html>
<title>Barcode Print Part Select</title>
<body>
<?php

include "koneksi.php";


if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	// bukan dari posting
}
else
{
    $supp = $_POST['supp'];
	
	echo '<form action="brcview.php" method="post" id="frmview" name="frmview">';
		echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" style="font-size=13pt">';
			echo '<tr>';
				echo '<td width="200px" style="font-weight:bold;">SUPPLIER CODE</td>';
				echo '<td>: '. $supp .' </td>';
			echo '</tr>';
			
			// cari supplier name
			$sqlname = "select suppname from supplier where suppcode = '$supp'";
			$hasil= $db->Execute($sqlname);

			while(!$hasil->EOF)
			{
				$suppname = $hasil->fields[0];
				
				echo '<tr>';
					echo '<td style="font-weight:bold;">SUPPLIER NAME</td>';
					echo '<td>: '. $suppname .' </td>';
				echo '</tr>';
				
				$hasil->MoveNext();
			}
			$hasil->close();
			
			echo '<tr>';
				echo '<td style="font-weight:bold;">SELECT PART NUMBER</td>';
				echo '<td>: ';
						echo '<select name="part">'.
							$sql = "select * from stdpack where suppcode = '$supp' order by partnumber asc";
							$nt = $db->Execute($sql);
							while(!$nt->EOF)
							  {
								echo '<option value="' . $nt->fields[1] . '">' . $nt->fields[1] . '</option>';
								$nt->MoveNext();
							  }
						echo '</select>';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td style="font-weight:bold;">PO</td>';
				echo '<td>: <input type="text" name="po" id="po" maxlength="7"> </td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td style="font-weight:bold;">QTY</td>';
				echo '<td>: <input type="text" name="qty" id="qty"> </td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td style="font-weight:bold;">INVOICE NO</td>';
				echo '<td>: <input type="text" name="invno" id="invno" maxlength="15"> </td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td> <input type="hidden" value="' . $suppname . '" id="suppname" name="suppname"> </td>';
				echo '<td>'.
					 '<input type="submit" value="View" id="subview" name="subview"> </td>';
			echo '</tr>';
		echo '</table>';
	echo '</form>';
 
} // end of if post... 

$nt->close();

?>
</body>
</html>

