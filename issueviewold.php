<?php
include "koneksi.php";
echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Issue OLD Record Detail : <br />';

$nomorso = '';

IF ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $pilihan = "SO";
 }
else
 {
   $nomorso = $_POST['txtso'];
   $pilihan = $_POST['pilih'];
 }

echo '<form method="post" action="issueviewold.php">';
echo 'FILTER DATA BY : &nbsp;&nbsp;';
echo '<select name="pilih" id="idpilih">';
echo '<option value="SO">SO NUMBER</option>';
echo '<option value="PART">PART NUMBER</option>';
echo '<option value="PO">PO NUMBER</option>';
echo '</select>';
echo '&nbsp;&nbsp;';
echo '<input type="text" name="txtso" id="txtso" />';
echo '&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<input type="submit" name="submit" value="Submit" />';
echo '</form>';
// tampilkan data
// tampilkan data berdasarkan filter so number
echo '<table border="1">';
echo '<th>SO.NUMBER</th>';
echo '<th>PART.NO</th>';
echo '<th>PART.NAME</th>';
echo '<th>PO</th>';
echo '<th>BOM</th>';
echo '<th>REQ.QTY</th>';
echo '<th>SCAN QTY</th>';
echo '<th>LOT</th>';
echo '<th>LINE</th>';
echo '<th>MODEL</th>';
echo '<th>ISSUE DATE & TIME</th>';

if($pilihan == 'SO')
   {
	$sqltampil = "select * from partissold where so = '$nomorso' order by issdate";		
   }

if($pilihan == 'PART')
   {
	$sqltampil = "select * from partissold where partno = '$nomorso' order by issdate";		
   }
   
if($pilihan == 'PO')
   {
	$sqltampil = "select * from partissold where po = '$nomorso' order by issdate";		
   }
   
$nt = $db->Execute($sqltampil);
while(!$nt->EOF)
 {
  echo '<tr>';
  echo '<td>' . $nt->fields[0] . '</td><td>' . $nt->fields[1] . '</td><td>' . $nt->fields[2] . '</td><td align="right">' . $nt->fields[3] . '</td><td align="right">' . $nt->fields[4] . '</td>';
  echo '<td align="right">' . $nt->fields[5] . '</td><td align="right">' . $nt->fields[6] . '</td><td>' . $nt->fields[7] . '</td>' ;
  echo '<td>' . $nt->fields[8] . '</td><td>' . $nt->fields[9] . '</td><td>' . $nt->fields[10] . '</td>' ;
  echo '</tr>';
  $nt->MoveNext();
 } // end of while
echo '</table>';

$nt->close();

echo '</body>';
echo '</html>';

?>
