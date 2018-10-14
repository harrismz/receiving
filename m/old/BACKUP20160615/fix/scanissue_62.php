<?php
include "koneksi_edit.php";
//include "koneksi.php";

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

echo "<p align='center'>Tanggal : " . $tglins . '</p>';

?>
<html>
<head>
<title>SCAN ISSUE</title>
<style>
#SoNum{
	font-size:20px;
	font-weight:bold;
	text-align:center;
}
#soNotReg {
	font-size:20px;
	font-weight:bold;
	color:red;
	text-align:center;
 }
 /*p, #show_so{
	 _line-height: 50%;
 }
 */
 /*
 #table_showpart, #td_right_showpart, #td_showpart, #th_showpart{
	 border-collapse: collapse;
	 border: 2px solid gray;
 }
 #td_right_showpart{
	 text-align: right;
 }
 #td_right_showpart, #td_showpart{
	 padding: 3px;
 }
 #th_showpart{
	 text-align: center;
	 padding: 8px;
	 font-size: 25px;
 }
 */
 /*table bootstrap*/
 #table_showpart thead{
    background-color:#009999;
    display: block;
    color:#fff;
}
#table_showpart tbody{
    display: block;
    overflow-y: scroll; 
    max-height: 280px;
    position: static;
    font-size:14px;
}
#table_showpart th{
    vertical-align: top;
    padding:2px 2px;
    text-align: center;
}
#table_showpart td{
    vertical-align: top;
    padding:2px 2px;
    text-align: center;
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -webkit-pre-wrap; /*Chrome & Safari */ 
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: pre-wrap;       /* css-3 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
    word-break: break-all;
    white-space: normal;
}
#table_showpart th:nth-child(1), #table_showpart td:nth-child(1)  { /*part no*/
    min-width:150px;
}
#table_showpart td:nth-child(1){ /**part no*/
    text-align:left;
}
#table_showpart th:nth-child(2), #table_showpart td:nth-child(2) { /*part name*/
    min-width:150px;
}
#table_showpart td:nth-child(2){ /**part name*/
    text-align:left;
}
#table_showpart th:nth-child(3), #table_showpart td:nth-child(3) { /*req qty*/
    min-width:80px;
}
#table_showpart td:nth-child(3){ /*req qty*/
    text-align:right;
}
#table_showpart th:nth-child(4), #table_showpart td:nth-child(4) { /*scan qty*/
    min-width:80px;
}
#table_showpart td:nth-child(4){ /*scan qty*/
    text-align:right;
}
#table_showpart th:nth-child(5), #table_showpart td:nth-child(5) { /*bom*/
    min-width:70px;
}
#table_showpart td:nth-child(6){ /*bom*/
    text-align:right;
}
#table_showpart th:nth-child(6), #table_showpart td:nth-child(6){ /*lot*/
    min-width:70px;
}
#table_showpart td:nth-child(6){ /*lot*/
    text-align:center;
}
#table_showpart th:nth-child(7), #table_showpart td:nth-child(7){ /*line*/
    min-width:70px;
}
#table_showpart td:nth-child(7){ /*line*/
    text-align:center;
}
#table_showpart th:nth-child(8){ /*model*/
   min-width:100px;
}
#table_showpart td:nth-child(8){ /*model*/
    min-width:100px;
    text-align: left;
}
#table_showpart th + th, #table_showpart td + td {
    border-left:1px solid #ddd;
}

 /*end table bootstrap*/
</style>
</head>

<?php
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
	//echo "<p id='SoNum'>Silahkan Pilih SO NUMBER untuk memulai</p>";
	echo "<p id='SoNum'>SCAN NIK ANDA untuk memulai</p>";
}
else{

/* urgent tttt ttt !!!   
	if(strlen($varpo)!=7){
	
	}
*/

  /*
  **-------------------------- end modify by zaki---------------------
  */	
  /*echo '<p align="center">SO : <b>' . $txtso . '</b>&nbsp;&nbsp***';
  // echo '<br />barcode : ' . $txtbarcode;
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PART NUMBER : <b>' . $varpart . '</b>&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PO : <b>' . $varpo . '</b>&nbsp;&nbsp;***';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY : <b>' . $varqty . '</b></p>';
  // cek data di detailcsv...
  // ---    form pindah ke sini.......
 */
  $sql_check = $db->Execute("select * from sa90m where so = '$txtso'");
  $row_check = $sql_check->RecordCount();
  if(!$row_check)
	{
	 echo "<h1 id='soNotReg'>SO Number Belum Terdaftar</h1>";
	 return false;
	}

//echo '<hr>';
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
	 if ($wrongpart == 1) 
      {
       if ($cekpart == 0)
        {
			echo "<h1 id='soNotReg'>QUANTITY OVER</h1>";
			// $suara = 'Over2good.wav';
			echo "<audio controls autoplay hidden=\"hidden\"><source src =\"LEBIH.mp3\" type=\"audio/mp3\"></audio>";
        }
       if ($cekpart == 1)
        {
		/* $suara = 'ok1.wav';
		 echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
		 echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data</h2>";
		 */
		 
		 echo "<audio controls autoplay hidden=\"hidden\"><source src =\"BERHASIL.mp3\" type=\"audio/mp3\"></audio>";
		?>
        <font size=6 id="randColor" style="font-weight:bold;">Part OK...Inserting Data</font><br/>
		<?php
		 $sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik')";
		 $hslins = $db->execute($sqlins);
		}	                        
 	  }  // end if ($wrongpart == 1 )                             

	 if ($wrongpart == 0)  // wrong part
	  {
	   echo "<h1 id='soNotReg'>WRONG Part !!!</h1>";
	    echo "<audio controls autoplay hidden=\"hidden\"><source src =\"SALAH.mp3\" type=\"audio/mp3\"></audio>";
	  }

// -------------------------------------------------
			// tampilkan data
   } //end of	if($txtbarcode != "")

else          
{
?>
  <h1 align="center" id="show_so"><?=$txtso?></h1>
	  <table id="table_showpart">
	  <thead>
		  <th id="th_showpart">PART.NO</th>
		  <th id="th_showpart">PART NAME</th>
		  <th id="th_showpart">REQ QTY</th>
		  <th id="th_showpart">SCAN QTY</th>
		  <th id="th_showpart">BOM</th>
		  <th id="th_showpart">LOT</th>
		  <th id="th_showpart">LINE</th>
		  <th id="th_showpart">MODEL</th>
	  </thead>   
<?php
  $sqlview = "	select	a.so, a.partno, a.partname, a.qty, 
						(select sum(scanqty) from partiss where so = a.so and partno = a.partno) as scanqty,
						a.bom, a.lot, a.line, a.model 
				from	sa90m a
				where	a.so = '{$txtso}'
				order by (select max(issdate) from partiss where so = a.so and partno = a.partno) desc";
  echo'<tbody>';
  $row = $db->Execute($sqlview);
  while (!$row->EOF)
  {
?>
	
	<tr>
		<td id="td_showpart"><?=$row->fields[1]?></td>
		<td id="td_showpart"><?=$row->fields[2]?></td>
		<td id="td_right_showpart"><?=$row->fields[3]?></td>
		<td id="td_right_showpart"><?=$row->fields[4]?></td>
		<td id="td_right_showpart"><?=number_format($row->fields[5], 2, '.', '')?></td>
		<td id="td_showpart"><?=$row->fields[6]?></td>
		<td id="td_showpart"><?=$row->fields[7]?></td>
		<td id="td_showpart"><?=$row->fields[8]?></td>
	</tr>
<?php
	$partcek1 = $row->fields[1];
    $row->MoveNext();
  }
?>
	</tbody>
    </table>
<?php
    $row->close();      
	
 }  // end of else -------> if($txtbarcode != "") 


?>
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
