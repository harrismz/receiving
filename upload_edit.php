<?
phpinclude "koneksi.php";$con = mssql_connect($_MSSQL[Host], $_MSSQL[User], $_MSSQL[Pass]) or die("Cant connect to database");
mssql_select_db($_MSSQL[DBNa], $con);echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Data hasil upload : <br />';if ($_REQUEST["loadheader"] == "ok")    
  { 		
    if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) 		
     {			
       // hapus record table sa90temp			
       $sqldeltemp = "delete from sa90temp";			
       $hasildeltemp = mssql_query($sqldeltemp,$con);
       set_time_limit(3600);  // Set limit time fpr maximum execute

       // insert data to sa90temp					
       $namatemp = $_FILES['userfile']['tmp_name'];			
       $kopifile = "d:\\xampp\\tmp\\so.csv";            
       copy($namatemp,  $kopifile);			
$sql = "SET QUOTED_IDENTIFIER OFF BULK INSERT EDI.dbo.sa90temp from 'd:\\xampp\\tmp\\so.csv' with ( FIELDTERMINATOR = ',')";			
$result = mssql_query($sql);						
// hapus data di sa90			
$sqldelsa = "delete from sa90";			
$hasildelsa=mssql_query($sqldelsa,$con);			

// insert data ke sa90 dari sa90temp			
$sqlins = "insert into sa90 select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac from sa90temp";			$hasilins=mssql_query($sqlins,$con);						
// bersihkan double quote			
$sqlupd = "update sa90 set so = REPLACE(so,CHAR(34),''), partno = REPLACE(partno,CHAR(34),'')";			
$sqlupd .= " , partname = REPLACE(partname,CHAR(34),''), lot = REPLACE(lot,CHAR(34),'')";			
$sqlupd .= " , line = REPLACE(line,CHAR(34),''), model = REPLACE(model,CHAR(34),'')";			
$hasilupd=mssql_query($sqlupd,$con);   						
//  insert or update data to SA90M  table  (   used by transacation  and history )			
$sqlbaca = "select * from sa90";			
$hasilbaca=mssql_query($sqlbaca,$con);			
while($brsbaca=mssql_fetch_array($hasilbaca))			    {				   
$cekso = $brsbaca[0];				   
$cekpart = $brsbaca[1];				   
$cekpartname = $brsbaca[2];				   
$cekbom = $brsbaca[3];				   
$cekqty = $brsbaca[4];				   
$ceklot = $brsbaca[5];				   
$cekline = $brsbaca[6];				   
$cekmodel = $brsbaca[7];				   
// cek data di table SA90M --> jika belum ada --> do insert , jika sudah ada --> do update				   
$sqlada = "select * from sa90m where so = '$cekso' and partno = '$cekpart'";				   
$hasilada=mssql_query($sqlada,$con);				   
$cekdata=mssql_num_rows($hasilada);				   
//echo 'cek data dgn so : ' . $cekso . ' dan partno : ' . $cekpart . ' hasil = ' . $cekdata . ', ';				   				   if($cekdata == 0)				     
     {					  
       //echo ', data nothing.. data insert...<br />';					  
       $sqlins = "insert into sa90m select * from sa90 where so = '$cekso' and partno = '$cekpart'";					         $hslins=mssql_query($sqlins,$con);					 
     }				   
else				     
{					  
//echo ', data already exist, data update...<br />';					  
$sqlup = "update sa90m set partname = '$cekpartname', bom = $cekbom, qty = $cekqty, lot = '$ceklot', ";					  
$sqlup .= "line = '$cekline' , model = '$cekmodel' where so = '$cekso' and partno = '$cekpart'";					  
$hslup=mssql_query($sqlup,$con);					 
 }				   				
 }					
//  Proses untuk produksi //				
// hapus data di sa90prodtemp			
$del_sa90prodtemp 		= "delete from sa90prodtemp";			
$rs_del_sa90prodtemp	= mssql_query($del_sa90prodtemp, $con);			
// insert data ke sa90prodtemp dari sa90temp			
$ins_sa90prodtemp 		= "insert into sa90prodtemp select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac,aa from sa90temp";			
$rs_ins_sa90prodtemp	= mssql_query($ins_sa90prodtemp, $con);						
// bersihkan double quote			
$upd_sa90prodtemp = "update sa90prodtemp set so = REPLACE(so,CHAR(34),''), partno = REPLACE(partno,CHAR(34),'')";			
$upd_sa90prodtemp .= " , partname = REPLACE(partname,CHAR(34),''), lot = REPLACE(lot,CHAR(34),'')";			
$upd_sa90prodtemp .= " , line = REPLACE(line,CHAR(34),''), model = REPLACE(model,CHAR(34),''), aa = REPLACE(aa,CHAR(34),'')";			$rs_upd_sa90prodtemp	 = mssql_query($upd_sa90prodtemp, $con);						
//  insert or update data to sa90prodtemp  table  (   used by transacation  and history )			

$sel_sa90prodtemp	= "select * from sa90prodtemp";			
$rs_sa90prodtemp	= mssql_query($sel_sa90prodtemp, $con);						
while($row = mssql_fetch_array($rs_sa90prodtemp))			
  {				
$so 		= str_replace("'", "", $row[0]);				
$part 		= str_replace("'", "", $row[1]);				
$partname	= str_replace("'", "", $row[2]);				
$bom 		= str_replace("'", "", $row[3]);				
$qty 		= str_replace("'", "", $row[4]);				
$lot 		= str_replace("'", "", $row[5]);				
$line 		= str_replace("'", "", $row[6]);				
$model 		= str_replace("'", "", $row[7]);				
$aa 		= str_replace("'", "", $row[8]);				
// cek data di table SA90M --> jika belum ada --> do insert , jika sudah ada --> do update				
$sel_sa90prod 	= "select * from sa90prod where so = '$so' and partno = '$part'";				
$rs_sa90prod	= mssql_query($sel_sa90prod,$con);				
$cek = mssql_num_rows($rs_sa90prod);			   				
if($cek == 0)				
  {					
    $ins_sa90prod = "insert into sa90prod select * from sa90prodtemp where so = '$so' and partno = '$part'";					    $rs_ins_sa90prod = mssql_query($ins_sa90prod, $con);				
  }				
else				
{					
    $upd_sa90prod    = "update sa90prod set partname = '$partname', bom = $bom, qty = $qty, lot = '$lot', ";					
    $upd_sa90prod   .= "line = '$line', model = '$model', aa = '$aa' where so = '$so' and partno = '$part'";					    $rs_upd_sa90prod = mssql_query($upd_sa90prod, $con);				
}			}		// -- end -- //																// tampilkan data            
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
$hasil=mssql_query($sqltampil,$con);			
while($nt=mssql_fetch_array($hasil))				
{					
 echo '<tr>';					
echo '<td>' . $nt[0] . '</td><td>' . $nt[1] . '</td><td>' . $nt[2] . '</td><td align="right">' . $nt[3] . '</td><td align="right">' . $nt[4] . '</td><td>';					echo $nt[5] . '</td><td>' . $nt[6] . '</td><td>' . $nt[7] . '</td>' ;					
echo '</tr>'; 				
} // end of while			
echo '</table>';											}   else 		
{           // if not ok		
}} echo '</body>';
echo '</html>';// tutup koneksi 12 des 2011
mssql_close($con);

?>