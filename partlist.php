<html>
<title>Part List</title>
<body>
<?php
	include('../ADODB/connection.php');
	

	if(isset($_GET['suppcode']))
	{
		$supp = $_GET['suppcode'];
	}

	if ($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		// bukan dari posting
	}
	else
	{
		$supp = $_POST['suppcode'];
	}
	
	echo '<a href="part_category.php">Kembali</a><br /><br />';
	
	// nampilin Supplier name : 
	$rs_suppname = $db->Execute("select * from supplier where suppcode = $supp");
	while (!$rs_suppname->EOF)
	{
		$suppname = $rs_suppname->fields[1];
		$rs_suppname->MoveNext();
	}
	
	// hitung data:
	$rs = $db->Execute("select * from stdpack where suppcode = $supp");
	$numrows = $rs->PO_RecordCount('select * from stdpack where suppcode = $supp');
	
	// Table
	echo '<table border=0 cellpadding=0 cellspacing=0 width=600>';
	echo '<tr>';
		echo '<td width=150 valign=top>Supplier Name</td>';
		echo '<td><b> ' . $suppname . ' - ' . $supp . ' </b></td>';
	echo '</tr>';
	
	echo '<tr>';
		echo '<td colspan=2>';		
			echo '<table border=1 cellpadding=0 cellspacing=0 width=800>';
			echo '<tr>';
			echo '<td colspan=4 align=center>';
				//Tampil jumlah data
				if ($numrows!=0){
					echo 'Ditemukan data ( <b>'.$numrows.'</b> ) record<br />';
				}
				else{
					echo 'Ditemukan data ( <b>'.$numrows.'</b> ) record<br />';
				}
			echo '</td>';
			echo '</tr>';
			echo '<th>Part.No</th>';
			echo '<th>Part Name</th>';
			echo '<th>Kategori</th>';
			echo '<th>ACTION</th>';
			//Query tampil data:
			$rs_tampil = $db->Execute("select * from stdpack where suppcode = $supp");
			while (!$rs_tampil->EOF)
			{
				//Merubah kata 'SML' menjadi 'SMALL PARTS'
				switch ($rs_tampil->fields[4])
				{
					case 'SML':
						$rs_tampil->fields[4]="SMALL PARTS";
						break;
					case 'MDL':
						$rs_tampil->fields[4]="MIDDLE PARTS";
						break;
					case "BIG":
						$rs_tampil->fields[4]="BIG PARTS";
						break;
				} // end switch ($rs_tampil->fields[4])
				
				echo '<tr>';
				echo '<td>' . $rs_tampil->fields[1] . '</td><td>' . $rs_tampil->fields[2] . '</td><td align="center">' . $rs_tampil->fields[4] . '</td>';
				echo '<td align=center><a href="partlist_edit.php?supp=' . trim($supp) . '&partno=' . $rs_tampil->fields[1] . '&partname=' . $rs_tampil->fields[2] . '&suppname=' . $suppname . '">EDIT</a></td>' ;  
				echo '</tr>';
				
				
				$rs_tampil->MoveNext();
			} //end while (!$rs_tampil->EOF)
			echo '</table>';
		echo '</td>';
	echo '</tr>';
	echo '</table>';
	// end table
	
	$rs_suppname->Close();
	$rs->Close();
	$rs_tampil->Close();
	$db->Close();
?>
</body>
</html>

