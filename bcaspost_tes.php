<?php
include "koneksi.php";

$waktu =  getdate();
$jam = $waktu[hours];
$menit = $waktu[minutes];
$detik = $waktu[seconds];
$hari_ini = date(m.d.y);
$abad = '20';
$hari_thn = substr($hari_ini,4,2);
$tahun = $abad . $hari_thn;
$hari_bln = substr($hari_ini,0,2);
$hari_tgl = substr($hari_ini,2,2);
$tanggal = $abad . $hari_thn . "-" . $hari_bln . "-" . $hari_tgl;
$cjam = strlen($jam);
$cmenit = strlen($menit);
$cdetik = strlen($detik);
if($cjam == 1 )
 {
  $jam = "0" . $jam;
 }
if($cmenit == 1)
 {
  $menit = "0" . $menit;
 }
if($cdetik == 1)
 {
  $detik = "0" . $detik;
 }

//Setting Jam Indonesia //
	date_default_timezone_set('Asia/Jakarta');
	$Ymd = gmdate("Y-m-d");
	$wkt = date('H:i:s');
// ================= //


$tglins = $Ymd . ' ' . $wkt;
// echo "tanggal : " . $tglins . '<br />';



if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
   echo 'not post';  

}  // end if server post
else
{
  echo "tanggal : " . $tglins . '<br />';
  $txtso = $_POST['so'];
  $txtbcas = strtoupper($_POST['partbcas']);
  $txtbarcode = strtoupper($_POST['barcode']);
  $varserial = trim(substr($txtbarcode,0,30));
  $varpart = trim($txtbcas);                     //trim(substr($txtbarcode,0,15));
  $varpo = '';   //substr($txtbarcode,16,7);
  $varqty  = 1 ;                  //substr($txtbarcode,24,5);
  $showserial1 = substr($varserial,1,4);
  $showserial2 = substr($varserial,5,4);
  $showserial3 = substr($varserial,9,4);
  $showserial4 = substr($varserial,13,4);
  $showserial5 = substr($varserial,17,4);
  $showserial = $showserial1 . '-' . $showserial2 . '-' . $showserial3 . '-' . $showserial4 . '-' . $showserial5 ;
  echo 'SO : ' . $txtso . '&nbsp;&nbsp***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PART NUMBER : ' . $varpart . '&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERIAL : ' . $showserial . '&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY : ' . $varqty . '<br />';
  
  $sql_check = $db->Execute("select * from sa90m where so = '$txtso' ");
  $row_check = $sql_check->RecordCount();
  if(!$row_check)
	{
	 echo "<font size=6 color=red>SO Number Belum Terdaftar</font><br />";
	 return false;
	}  // if row_cek

	echo "ad: ".$txtbarcode;
	echo "<br>";
	echo "part: ". $varpart;

}  // else if post





?>