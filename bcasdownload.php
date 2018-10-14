<?php
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="sample.csv"');
$fp = fopen('php://output', 'w');
include "koneksi.php";




IF ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
  // 
 }
else
 {
   $nomorso = $_POST['txtso'];
 }


$tahun = substr($nomorso,0,4);
$bulan = substr($nomorso,5,2);

$sqltampil = "select * from bcas where (year(issdate) = $tahun) and (month(issdate) = $bulan) order by partno,lot,issdate";		

  
$nt = $db->Execute($sqltampil);

echo 'DATE,MODEL,LOT,PARTNO,PARTNAME,LOTQTY,LINE,SERIAL,SO';
echo "\n";

while(!$nt->EOF)
 {
  $nomor++;
  $varserial = trim($nt->fields[12]);
  $showserial1 = substr($varserial,1,4);
  $showserial2 = substr($varserial,5,4);
  $showserial3 = substr($varserial,9,4);
  $showserial4 = substr($varserial,13,4);
  $showserial5 = substr($varserial,17,4);
  $showserial = $showserial1 . '-' . $showserial2 . '-' . $showserial3 . '-' . $showserial4 . '-' . $showserial5 ;

  echo $nt->fields[10] . ',' . $nt->fields[9] . ',' . $nt->fields[7] . ',' ;
  echo $nt->fields[1] . ',' . $nt->fields[2] . ',' ;
  echo $nt->fields[5] . ',' . $nt->fields[8] . ',' . $showserial  . ',' . $nt->fields[0] ;
  echo "\n";
 
// $tulis = $nt->GetRows();
//print_r($nomorso);
//echo ',';
//echo $showserial;



  $nt->MoveNext();
 } // end of while


$nt->close();


?>