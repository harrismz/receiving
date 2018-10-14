<?php
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
<script>
    $(document).ready(function() {
        //$("#randColor").css("color", "hsla(" + Math.floor(Math.random() * (360)) + ", 97%, 41%, 1)");
        var color = '#'; 
        var letters = ['00b300','000000','996633'];
        color += letters[Math.floor(Math.random() * letters.length)];
        $("#randColor").css("color", "" +color+ "");
        
    });
  </script>
<style>
    #sotbl thead{
    background-color:#0073e6;
    display: block;
    color:#fff;
    }
    #sotbl tbody{
        display: block;
        overflow-y: scroll; 
        max-height: 130px;
        position: static;
        font-size:14px;
    }
    #sotbl th{
        vertical-align: top;
        padding:2px 2px;
        text-align: center;
    }
    #sotbl td{
        vertical-align: top;
        padding:2px 2px;
        text-align: left;
        white-space: -moz-pre-wrap !important;  
        white-space: -webkit-pre-wrap; 
        white-space: -pre-wrap;      
        white-space: pre-wrap;       
        word-wrap: break-word;       
        word-break: break-all;
        white-space: normal;
    }

    #sotbl th:nth-child(1), #sotbl td:nth-child(1)  { /*partno*/
        min-width:110px;
    }
    #sotbl th:nth-child(2), #sotbl td:nth-child(2)  { /*partname*/
        min-width:150px;
    }
    #sotbl th:nth-child(3), #sotbl td:nth-child(3) { /*reqqty*/
        min-width:60px;
    }
    #sotbl th:nth-child(4), #sotbl td:nth-child(4) { /*scanqty*/
        min-width:60px;
    }
    #sotbl th:nth-child(5), #sotbl td:nth-child(5) { /*bom*/
        min-width:150px;
    }
    #sotbl th:nth-child(6), #sotbl td:nth-child(6) { /*lot*/
        min-width:60px;
    }
    #sotbl th:nth-child(7), #sotbl td:nth-child(7) { /*line*/
        min-width:80px;
    }
    #sotbl th:nth-child(8), #sotbl td:nth-child(8) { /*model*/
        min-width:100px;
    }
    @media only screen and (max-width: 767px) {
        #sotbl th:nth-child(8), #sotbl td:nth-child(8) { /*model*/
            min-width:100px;
        }
    }
    #sotbl th + th, #sotbl td + td {
        border-left:1px solid #ddd;
    }
</style>
</head>
<body>
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
  $txtbarcode = strtoupper($_POST['parthdn']);
  $varpart = trim(substr($txtbarcode,0,15));
  $varpo = substr($txtbarcode,16,7);
  $varqty  = substr($txtbarcode,24,5);
		
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

  if($txtbarcode != "")
   {
     $cekpart = 0;
	 $wrongpart = 0;	
	 // ambil data dari GROUP PARTNO SESUAI SO    
     $sqlview = "select sa90m.so,sa90m.partno,sa90m.partname,sa90m.qty,visspart.scanqty,cast(ROUND(sa90m.bom,2) as numeric(20,2),sa90m.lot,sa90m.line,sa90m.model from sa90m left join visspart on  sa90m.so = visspart.issso and sa90m.partno = visspart.isspartno  where sa90m.so = '$txtso'";
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
        ?>
        <font size=6 id="randColor" style="font-weight:bold;">Part OK...Inserting Data</font><br/>
    <?php
		 $sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins')";
		 $hslins = $db->execute($sqlins);
		}	                        
 	  }  // end if ($wrongpart == 1 )                             

	 if ($wrongpart == 0)  // wrong part
	  {
	   echo "<font size=6 color=red> WRONG Part !!! </font><br />";
	   $suara = 'WrongParts2good.ogg';
	  // echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
	  ?>
	  <script>
			var audio = document.getElementsByTagName("audio")[0];
			audio.play();
	  </script>
    
      <?php
	   echo "<audio autoplay><source src =\"WrongParts2good.wav\" type=\"audio/wav\"></audio>";
	  }

// -------------------------------------------------
			// tampilkan data
   } //end of	if($txtbarcode != "")

else          
 { 
  
?>
    <div class="col-sm-6 col-sm-offset-3"><h1 class="home" align="center"><?php echo $txtso ?></h1></div>
    <div class="table table-responsive col-sm-6 col-sm-offset-3">
        <table  id="sotbl" align="center">
            <thead>
                <th>PART.NO</th>
                <th>PART NAME</th>
                <th>REQ QTY</th>
                <th>SCAN QTY</th>
                <th>BOM</th>
                <th>LOT</th>
                <th>LINE</th>
                <th>MODEL</th>
            </thead>
            <tbody>
                <?php
                    $sqlview = "select sa90m.so,sa90m.partno,sa90m.partname,sa90m.qty,visspart.scanqty,sa90m.bom,sa90m.lot,sa90m.line,sa90m.model from sa90m left join visspart on sa90m.so = visspart.issso and sa90m.partno = visspart.isspartno where sa90m.so = '$txtso' order by visspart.issdate desc";
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
                ?>
            </tbody>
         </table>
    </div>
<?php
	$row->close();      
   // end of else -------> if($txtbarcode != "") 
} 
?> 
<br>
<br>
<br>
</body>
</html>

<?php
	
} //else postingan
?>
