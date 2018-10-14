<?php
    include "koneksi.php";
	
	echo '<a href="part_without_supplier_code.php">Kembali</a><br /><br />';

	if(isset($_GET['supp']))
	{
		$vsupp = $_GET['supp'];
		$vpartno = $_GET['partno'];
		$vpartname = str_replace(" ", '&nbsp;', $_GET['partname']);
		
		// form ........
		echo '<form method="post" action="suppcode_edit_post.php">';
		echo '<table border=0 cellpadding=0 width=700>';
		echo '<tr>';
		echo '<td width=150 valign=top>SUPPCODE</td>';
			echo '<td> <select name="suppcode">';
				//mengisi combo box Supplier
				$rs_cb_suppcode = $db->Execute("select * from supplier order by suppname");
				while (!$rs_cb_suppcode->EOF)
				{
					echo '<option value="' . $rs_cb_suppcode->fields[0] . '">' . $rs_cb_suppcode->fields[1] . ' - ' . $rs_cb_suppcode->fields[0] . '</option>';
					$rs_cb_suppcode->MoveNext();
				}
			echo '</select></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td valign=top>PART NUMBER</td>';
		echo '<td> <input type=text name=partno id=partno value=' . $vpartno . ' disabled=true  /> </td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td valign=top>PART NAME</td>';
		echo '<td> <input type=text name=partname id=partname value=' . $vpartname  . ' disabled=tru /> </td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan=2> <input type=submit name=submit value=UPDATE /> </td>';
		echo '</tr>';
		echo '<input type=hidden name=partno id=partno value=' . $vpartno . ' />';
		echo '<input type=hidden name=partname id=partname value=' . $vpartname  . ' />';
		echo '</table>';
		echo '</form>';

	} //end if(isset($_GET['supp']))
	
	
	$rs_cb_suppcode->Close(); $db->Close();
?>




