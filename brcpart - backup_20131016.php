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
   
echo 'supplier code : ' . $supp . '<br />';

// cari supplier name
$sqlname = "select suppname from supplier where suppcode = '$supp'";
$hasil= $db->Execute($sqlname);

while(!$hasil->EOF)
   {
      $suppname = $hasil->fields[0];
	  $hasil->MoveNext();
   }
   
$hasil->close();   
echo 'suppname : ' . $suppname;

echo '<form action="brcview.php" method="post" id="frmview" name="frmview">';
echo 'Select Part Number : ';
echo '<select name="part">';

$sql = "select * from stdpack where suppcode = '$supp'";
$nt = $db->Execute($sql);
while(!$nt->EOF)
  {
    echo '<option value="' . $nt->fields[1] . '">' . $nt->fields[1] . '</option>';
 //    echo $nt[0] . ' - ' . $nt[1] . '<br />';
    $nt->MoveNext();
  }
echo '</select>';
echo '<br />PO : ';
echo '<input type="text" name="po" id="po" maxlength="7">';
echo '<br />QTY : ';
echo '<input type="text" name="qty" id="qty">';
echo '<br />';
echo '<input type="hidden" value="' . $suppname . '" id="suppname" name="suppname">';
echo '<input type="submit" value="View" id="subview" name="subview">';

echo '</form>';
 
} // end of if post... 

$nt->close();

?>
</body>
</html>

