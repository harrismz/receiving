<?php
	include('../ADODB/connection.php');
	
	echo '<a href="index.php">Kembali menu</a><br /><br />';
		
		
	// tampilkan data
	echo '<form method="post" action="partlist.php">';
	echo '<table border=0 cellpadding=0 cellspacing=0 width=800>';
	echo '<tr>';
		echo '<td width=150 valign=top>Select Supplier</td>';
		echo '<td> <select name="suppcode">';
			//mengisi combo box Supplier
			$rs_cb_suppcode = $db->Execute("select * from supplier order by suppname");
			while (!$rs_cb_suppcode->EOF)
			{
				echo '<option value="' . $rs_cb_suppcode->fields[0] . '">' . $rs_cb_suppcode->fields[1] . ' - ' . $rs_cb_suppcode->fields[0] . '</option>';
				$suppname = $rs_cb_suppcode->fields[1];
				
				$rs_cb_suppcode->MoveNext();
			}
		echo '</select></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td colspan=2>';
			echo '<input type="hidden" value="' . $suppname . '" id="suppname" name="suppname">';
			echo '<input type="submit" value="Get Part List" id="subpart" name="subpart">';
		echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</form>';

	$rs_cb_suppcode->Close(); $db->Close();
?>



