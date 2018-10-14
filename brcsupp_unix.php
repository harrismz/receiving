<html>
<title>Barcode Print Supplier Select</title>
<body>
<?php
include "koneksi.php";

echo '<a href="index.php">menu</a><br />';
echo '<form action="brcpart_unix.php" method="post" id="frmpart" name="frmpart">';
echo 'Select Supplier : ';
echo '<select name="supp">';

$sql = "select * from supplier order by suppname";
$nt = $db->Execute($sql);

while(!$nt->EOF)
  {
    echo '<option value="' . $nt->fields[0] . '">' . $nt->fields[1] . '-' . $nt->fields[0] . '</option>';
 //    echo $nt[0] . ' - ' . $nt[1] . '<br />';
    $nt->MoveNext();
  }
echo '</select>';
echo '<br />';
echo '<input type="submit" value="Get Part List" id="subpart" name="subpart">';

echo '</form>';

// tutup koneksi


$nt->close();
?>
</body>
</html>

