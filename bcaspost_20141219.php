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
  $txtbarcode = strtoupper($_POST['parthdn']);
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

// batas copy paste
if($txtbarcode != "")
   {
     $cekpart = 0;
	 $wrongpart = 0;	
         $sudah = 0;
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
		 
		 $sqlins = "insert into bcas(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate,serial) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$varserial')";
		 $hslins = $db->execute($sqlins);
               //   if ($hslins) == true)
               //    {
                    // $suara = 'ok1.wav';
		    // echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
		    // echo " Part OK... Inserting Data <br />";
                    $sudah = 0;
              //     }
           
                  if ($hslins == false)
                   {
                     $sudah = 1 ;
//                     echo 'error inserting : <br>';
//                     echo "<font size=6 color=red> SERIAL : $showserial ALREADY SCAN !!!</font><br />";
//                     $suara = 'Over2good.wav';
//	             echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";  
                   }
	    } // end if ($cekpart == 1 )

	                        
 	  }  // end if ($wrongpart == 1 )                             

	 if ($wrongpart == 0)  // wrong part
	  {
	   echo "<font size=6 color=red> WRONG Part !!! </font><br />";
	   $suara = 'WrongParts2good.wav';
	   echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
	  }

         if ($wrongpart == 1 && $sudah == 0)
           {
              $suara = 'ok1.wav';
	      echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
	      echo " Part OK... Inserting Data<br />";             
           }
         if ($wrongpart == 1 && $sudah == 1)
           {
                     echo 'error inserting <br>' ;
                     echo "<font size=6 color=red> SERIAL : $showserial ALREADY SCAN !!!</font><br />";
                     $suara = 'Over2good.wav';
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




// batas copy paste


}  // else if post





?>