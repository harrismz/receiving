<?php
include "koneksi.php";

// mendapatkan waktu sistem...

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
	$Ymd = gmdate("Ymd");
	$wkt = date('H:i:s');
// ================= //


$tglins = $tanggal . ' ' . $wkt;
echo "tanggal : " . $tglins . '<br />';

?>
<html>
<head>
<title>SCAN ISSUE</title>
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   echo "Silahkan Pilih SO NUMBER untuk memulai";
   echo "<br />";
 }
else  // jika hasil dari postingan .......
 {
  //$tipe = $_POST['scantype'];
  $txtso = $_POST['so'];
  $txtbcas = strtoupper($_POST['partbcas']);
  $txtbarcode = strtoupper($_POST['parthdn']);
  $varserial = trim(substr($txtbarcode,0,30));
  $varpart = trim($txtbcas);                     //trim(substr($txtbarcode,0,15));
  $varpo = 'test';   //substr($txtbarcode,16,7);
  $varqty  = 1 ;                  //substr($txtbarcode,24,5);
		
  echo 'SO : ' . $txtso . '&nbsp;&nbsp***';
  // echo '<br />barcode : ' . $txtbarcode;
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PART NUMBER : ' . $varpart . '&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PO : ' . $varpo . '&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY : ' . $varqty . '<br />';
  // cek data di detailcsv...
  // ---    form pindah ke sini.......
 
  $sql_check = $db->Execute("select * from sa90m where so = '$txtso' ");
  $row_check = $sql_check->RecordCount();
  if(!$row_check)
	{
	 echo "<font size=6 color=red>SO Number Belum Terdaftar</font><br />";
	 return false;
	}
?>
<hr>
<?
  if($txtbarcode != "")
   {
     $cekpart = 0;
	 $wrongpart = 0;	
	 // ambil data dari GROUP PARTNO SESUAI SO    
     $sqlview = "select sa90m.so,sa90m.partno,sa90m.partname,sa90m.qty,visspart.scanqty,sa90m.bom,sa90m.lot,sa90m.line,sa90m.model from sa90m left join visspart on  sa90m.so = visspart.issso and sa90m.partno = visspart.isspartno  where sa90m.so = '$txtso' ";
     $row = $db->Execute($sqlview);
     while (!$row->EOF)
	  {
	   $partcek1 = $row->fields[1];
       if(trim($partcek1) == trim($varpart))
	    {
         $wrongpart = 1;
		 $nilainama = $row->fields[2];
		 $nilaireq = $row->fields[3];
		 $nilaiscan = $row->fields[4];
		 $nilaibom = $row->fields[5];
		 $nilailot = $row->fields[6];
		 $nilailine = $row->fields[7];
		 $nilaimodel = $row->fields[8];
		 $cektotalqty = $nilaiscan + $varqty;
		 if($cektotalqty > $nilaireq)
		  {
			$cekpart = 0;
		  }
		 else
		  {
			$cekpart = 1;
		  }

		} // end if(trim....
       $row->MoveNext();

      } //while
	  
	  //echo "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins')";
	 
			//echo 'nilai scan : ' . $cektotalqty;
	 echo 'status : ';
 	 if ($wrongpart == 1) 
      {
       if ($cekpart == 0)
        {
		 echo "<font size=6 color=red> QUANTITY OVER </font><br />";
		 $suara = 'Over2good.wav';
		 echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
        }
       if ($cekpart == 1)
        {
		 $suara = 'ok1.wav';
		 echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
		 echo " Part OK... Inserting Data <br />";
		 $sqlins = "insert into bcas(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate,serial) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$varserial')";
		 $hslins = $db->execute($sqlins);
		}	                        
 	  }  // end if ($wrongpart == 1 )                             

	 if ($wrongpart == 0)  // wrong part
	  {
	   echo "<font size=6 color=red> WRONG Part !!! </font><br />";
	   $suara = 'WrongParts2good.wav';
	   echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
	  }

// -------------------------------------------------
			// tampilkan data
   } //end of	if($txtbarcode != "")

else          
 {
  echo '<h1>' . $txtso . '</h1>';
  echo '<table border="1">';
  echo '<tr>';
  echo '<th><h2>PART NUMBER</h2></th>';
  echo '<th><h2>PART NAME</h2></th>';
  echo '<th><h2>REQ QTY</h2></th>';
  echo '<th><h2>SCAN QTY</h2></th>';
  echo '<th><h2>BOM</h2></th>';
  echo '<th><h2>LOT</h2></th>';
  echo '<th><h2>LINE</h2></th>';
  echo '<th><h2>MODEL</h2></th>';
  echo '</tr>';    

  $sqlview = "select sa90m.so,sa90m.partno,sa90m.partname,sa90m.qty,vbcas.scanqty,sa90m.bom,sa90m.lot,sa90m.line,sa90m.model from sa90m left join vbcas on sa90m.so = vbcas.issso and sa90m.partno = vbcas.isspartno where sa90m.so = '$txtso' and sa90m.partno = '$txtbcas'  ";
  $row = $db->Execute($sqlview);
  while (!$row->EOF)
  {
	echo  '<tr>';
	echo  '<td>' . $row->fields[1] . '</td><td>' . $row->fields[2] . '</td><td align="right">' . $row->fields[3] . '</td><td align="right">' . $row->fields[4] . '</td>' ;
	echo  '<td align="right">' . $row->fields[5] . '</td><td>' . $row->fields[6] . '</td><td>' . $row->fields[7] . '</td><td>' . $row->fields[8] . '</td><td>' . $row->fields[9] . '</td>';
	echo  '</tr>';
	$partcek1 = $row->fields[1];
    $row->MoveNext();
  }
    echo '</table>';
    $row->close();      
 }  // end of else -------> if($txtbarcode != "") 


?>


<br>
<br>
<br>
</body>
</html>

<?php
	} //else postingan
?>
