<html>
<title>Standard Packing Data Maintenance - Supplier Select</title>
<body>
<?php
// echo 'testdb.php<br />';
include "koneksi.php";

//$rs = $db->Execute("select * from supplier");
// $sukses = $rs->RecordCount();
// echo $sukses;
 
 
echo '<form action="stdlocalpart.php" method="post" id="frmpart" name="frmpart">';
echo 'Select Supplier : ';
echo '<select name="supp">';

$rs = $db->Execute("select * from supplier order by suppname");
while (!$rs->EOF) 
  {
    
    echo '<option value="' . $rs->fields[0] . '">' . $rs->fields[1] . '-' . $rs->fields[0] . '</option>';
    $suppname = $rs->fields[1];
	 $rs->MoveNext();
 
  }
echo '</select>';
echo '<br />';
echo '<input type="hidden" value="' . $suppname . '" id="suppname" name="suppname">';
echo '<input type="submit" value="Get Part List" id="subpart" name="subpart">';

echo '</form>';

$rs->Close();


?>
</body>
</html>

