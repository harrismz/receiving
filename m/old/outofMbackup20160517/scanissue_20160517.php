<?php
//include "koneksi_edit.php";
include "koneksi.php";

// mendapatkan waktu sistem...
//Setting Jam Indonesia //
	date_default_timezone_set('Asia/Jakarta');
	$Ymd = gmdate("Ymd");
	$wkt = date('H:i:s');
// ================= //

$waktu =  getdate();
$jam = $waktu['hours'];
$menit = $waktu['minutes'];
$detik = $waktu['seconds'];
$tanggal = $waktu['year']  . "-" . $waktu['mon'] . "-" . $waktu['mday'];
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
 
$tglins = $tanggal . ' ' . $wkt;

echo "tanggal : " . $tglins . '<br />';

?>
<html>
<head>
<title>SCAN ISSUE</title>
</head>

<?php
/*if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   echo "Silahkan Pilih SO NUMBER untuk memulai";
   echo "<br />";
 }
else  // jika hasil dari postingan .......
 {
*/
  //$tipe = $_POST['scantype'];
  
  /*
  **----------------------- modify by zaki---------------------------
  */
  
  /*
  $txtso = $_POST['so1'];
  $txtbarcode = strtoupper($_POST['parthdn']);
  $varpart = trim(substr($txtbarcode,0,15));
  $varpo = substr($txtbarcode,16,7);
  $varqty  = substr($txtbarcode,24,5);
  */

$txtnikPost1 = isset($_POST['nik']) ? $_POST['nik'] : "";
$txtsoPost1  = isset($_POST['idso']) ? $_POST['idso'] : "";
$varpartPost1= isset($_POST['parthdn1']) ? $_POST['parthdn1'] : "";
$varpartPost2= isset($_POST['parthdn2']) ? $_POST['parthdn2'] : "";
$varpoPost  = isset($_POST['partpo2']) ? $_POST['partpo2'] : "";
$varqtyPost = isset($_POST['partqty2']) ? $_POST['partqty2'] : "";

if($varpartPost1 != "" and $varpartPost2 == ""){
	$varpartPost= strtoupper($varpartPost1);
	
	$txtnik	    = strtoupper(trim($txtnikPost1));
	$txtso	    = strtoupper(trim($txtsoPost1));
	$varpart    = trim(substr($varpartPost,0,15));
	$varpo      = substr($varpartPost,16,7);
	$varqty     = substr($varpartPost,24,5);
}
else{
	$varpartPost= strtoupper($varpartPost2);
	
	$txtnik	    = strtoupper(trim($txtnikPost1));
	$txtso	    = strtoupper(trim($txtsoPost1));
	$varpart    = strtoupper(trim($varpartPost));
	$varpo      = strtoupper(trim($varpoPost));
	$varqty     = strtoupper(trim($varqtyPost));
}

if($txtsoPost1 == "" && $varpartPost1 == "" && $varpartPost2 == "" && $varpoPost == "" && $varqtyPost == "")
{
	echo "Silahkan Pilih SO NUMBER untuk memulai";
	echo "<br />";
}
else{

/* urgent tttt ttt !!!   
	if(strlen($varpo)!=7){
	
	}
*/

  /*
  **-------------------------- end modify by zaki---------------------
  */	
  echo 'SO : ' . $txtso . '&nbsp;&nbsp***';
  // echo '<br />barcode : ' . $txtbarcode;
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PART NUMBER : ' . $varpart . '&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PO : ' . $varpo . '&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY : ' . $varqty . '<br />';
  // cek data di detailcsv...
  // ---    form pindah ke sini.......
 
  $sql_check = $db->Execute("select * from sa90m where so = '$txtso'");
  $row_check = $sql_check->RecordCount();
  if(!$row_check)
	{
	 echo "<font size=6 color=red>SO Number Belum Terdaftar</font><br />";
	 return false;
	}

echo '<hr>';
 /*modify by zaki*/
 // if($txtbarcode != "")
	if($varpart != "")
 /*end modify by zaki*/
   {
     $cekpart = 0;
	 $wrongpart = 0;	
	 // ambil data dari GROUP PARTNO SESUAI SO    
     $sqlview = "select	a.so, a.partno, a.partname, a.qty, 
						(select sum(scanqty) from partiss where so = a.so and partno = a.partno) as scanqty,
						a.bom, a.lot, a.line, a.model 
				from	sa90m a
				where	a.so = '{$txtso}'";
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
		 echo " Part OK...Inserting Data <br />";
		 $sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik')";
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
  echo '<th><h2>PART.NO</h2></th>';
  echo '<th><h2>PART NAME</h2></th>';
  echo '<th><h2>REQ QTY</h2></th>';
  echo '<th><h2>SCAN QTY</h2></th>';
  echo '<th><h2>BOM</h2></th>';
  echo '<th><h2>LOT</h2></th>';
  echo '<th><h2>LINE</h2></th>';
  echo '<th><h2>MODEL</h2></th>';
  echo '</tr>';    

  $sqlview = "	select	a.so, a.partno, a.partname, a.qty, 
						(select sum(scanqty) from partiss where so = a.so and partno = a.partno) as scanqty,
						a.bom, a.lot, a.line, a.model 
				from	sa90m a
				where	a.so = '{$txtso}'
				order by (select max(issdate) from partiss where so = a.so and partno = a.partno) desc";
  $row = $db->Execute($sqlview);
  while (!$row->EOF)
  {
	echo  '<tr>';
	echo  '<td>' . $row->fields[1] . '</td><td>' . $row->fields[2] . '</td><td align="right">' . $row->fields[3] . '</td><td align="right">' . $row->fields[4] . '</td>' ;
	echo  '<td align="right">' . $row->fields[5] . '</td><td>' . $row->fields[6] . '</td><td>' . $row->fields[7] . '</td><td>' . $row->fields[8] . '</td>';
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
	
	
	/*
		SELECT [so]
			  , [partno]
			  ,[partname]
			  ,[po]
			  ,[bom]
			  ,[reqqty]
			  , (select sum([scanqty]) from [edi].[dbo].[partiss] where [SO] = [partiss_sum].[so] AND [partno] = [partiss_sum].[partno]) as totscanqty
			  ,[scanqty]
			  ,[lot]
			  ,[line]
			  ,[model]
			  ,[issdate]
			  ,[sndflag]
			  ,[nik]
		  FROM [edi].[dbo].[partiss] as [partiss_sum] WHERE SO = '05495179' AND PARTNO = 'J2B-0028-00'
	*/
?>
