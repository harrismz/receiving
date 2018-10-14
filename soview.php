<?php
include "koneksi.php";
echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Data hasil upload : <br />';
// tampilkan data
echo '<table border="1">';
echo '<th>SO.NUMBER</th>';
echo '<th>PART.NO</th>';
echo '<th>PART.NAME</th>';
echo '<th>BOM QTY</th>';
echo '<th>QTY REQUIRED</th>';
echo '<th>LOT</th>';
echo '<th>LINE</th>';
echo '<th>MODEL</th>';			
$sqltampil = "select * from sa90";
$nt = $db->Execute($sqltampil);
while(!$nt->EOF)	
 {		
   echo '<tr>';	
   echo '<td>' . $nt->fields[0] . '</td><td>' . $nt->fields[1] . '</td><td>' . $nt->fields[2] . '</td><td align="right">' . $nt->fields[3] . '</td><td align="right">' . $nt->fields[4] . '</td><td>';
   echo $nt->fields[5] . '</td><td>' . $nt->fields[6] . '</td><td>' . $nt->fields[7] . '</td>' ;
   echo '</tr>';
   $nt->MoveNext();
 } // end of while
$nt->Close();
   
echo '</table>';echo '</body>';echo '</html>';
?>

