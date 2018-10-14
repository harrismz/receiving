<?php
	echo '<a href="part_category.php">Kembali</a><br /><br />';
	
	if(isset($_GET['supp']))
	{
		$suppname = $_GET['suppname'];
		$vsupp = $_GET['supp'];
		$vpartno = $_GET['partno'];
		$vpartname = str_replace(" ", '&nbsp;', $_GET['partname']);
		
		
		// form ........
		echo '<form method="post" action="partlist_edit_post.php">';
		echo '<table border=0 cellpadding=0 width=700>';
		echo '<tr>';
		echo '<td width=150 valign=top>Supplier Name</td>';
		echo '<td><b> ' . $suppname . ' - ' . $vsupp . ' </b></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td valign=top>PART NUMBER</td>';
		echo '<td> <input type=text name=partno id=partno value=' . $vpartno . ' disabled=true  /> </td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td valign=top>PART NAME</td>';
		echo '<td> <input type=text name=partname id=partname value=' . $vpartname  . ' disabled=true /> </td>';
		echo '</tr>';
		echo '<tr>';
		echo '<tr>';
		echo '<td valign=top>Kategori</td>';
		echo '<td>';
			echo '<select name="kategori">';
				echo '<option value=SML>SMALL PARTS</option>';
				echo '<option value=MDL>MIDDLE PARTS</option>';
				echo '<option value=BIG>BIG PARTS</option>';
			echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan=2> <input type=submit name=submit value=UPDATE /> </td>';
		echo '</tr>';
		echo '<input type=hidden name=suppcode id=suppcode value=' . $vsupp . ' />';
		echo '<input type=hidden name=partno id=partno value=' . $vpartno . ' />';
		echo '<input type=hidden name=partname id=partname value=' . $vpartname  . ' />';
		echo '</table>';
		echo '</form>';
		// end form

	} //end if(isset($_GET['supp']))
?>




