<?php

include "koneksi.php";

echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Data hasil upload : <br />';


if ($_REQUEST["loadheader"] == "ok") 
   
  { 
		
    if (is_uploaded_file($_FILES["userfile"]["tmp_name"]))
      {
			
		
        // hapus record table sa90temp
		 $sql = "delete from sa90temp";     
         $rsdel = $db->Execute($sql);
			
        set_time_limit(7200);  // Set limit time fpr maximum execute
		
        $namatemp = $_FILES['userfile']['tmp_name'];
		$feed = fopen($namatemp, 'r');
		$rsdel->Close();
			
     //   $kopifile = "d:\\xampp\\tmp\\so.csv";
            
      //  copy($namatemp,  $kopifile);      26 Agustus 2015
		//	echo 'set quoted';
			
		 // ------------------------------------------
		 
        while ($i = fgetcsv($feed, 10000, ",")) 
		{
			$ins = array();
			$ins ["a"] 		= trim( $i['0']);
			$ins ["b"] 		= trim( $i['1']);
			$ins ["c"] 		= trim( $i['2']);
			$ins ["d"] 		= trim( $i['3']);
			$ins ["e"] 		= trim( $i['4']);
			$ins ["f"] 		= trim( $i['5']);
			$ins ["g"] 		= trim( $i['6']);
			$ins ["h"] 		= trim( $i['7']);
			$ins ["i"] 		= trim( $i['8']);
			$ins ["j"] 		= trim( $i['9']);
			$ins ["k"] 		= trim( $i['10']);
			$ins ["l"] 		= trim( $i['11']);
			$ins ["m"] 		= trim( $i['12']);
			$ins ["n"] 		= trim( $i['13']);
			$ins ["o"] 		= trim( $i['14']);
			$ins ["p"] 		= trim( $i['15']);
			$ins ["q"] 		= trim( $i['16']);
			$ins ["r"] 		= trim( $i['17']);
			$ins ["s"] 		= trim( $i['18']);
			$ins ["t"] 		= trim( $i['19']);
			$ins ["u"] 		= trim( $i['20']);
			$ins ["v"] 		= trim( $i['21']);
			$ins ["w"] 		= trim( $i['22']);
			$ins ["x"] 		= trim( $i['23']);
			$ins ["y"] 		= trim( $i['24']);
			$ins ["z"] 		= trim( $i['25']);
			
			$ins ["aa"] 	= trim( $i['26']);
			$ins ["ab"] 	= trim( $i['27']);
			$ins ["ac"] 	= trim( $i['28']);
			$ins ["ad"] 	= trim( $i['29']);
			$ins ["ae"] 	= trim( $i['30']);
			$ins ["af"] 	= trim( $i['31']);
			$ins ["ag"] 	= trim( $i['32']);
			$ins ["ah"] 	= trim( $i['33']);
			$ins ["ai"] 	= trim( $i['34']);
			$ins ["aj"] 	= trim( $i['35']);
			$ins ["ak"] 	= trim( $i['36']);
			$ins ["al"] 	= trim( $i['37']);
			$ins ["am"] 	= trim( $i['38']);
			$ins ["an"] 	= trim( $i['39']);
			$ins ["ao"] 	= trim( $i['40']);
			$ins ["ap"] 	= trim( $i['41']);
			$ins ["aq"] 	= trim( $i['42']);
			$ins ["ar"] 	= trim( $i['43']);
			$ins ["as"] 	= trim( $i['44']);
			$ins ["at"] 	= trim( $i['45']);
			$ins ["au"] 	= trim( $i['46']);
			$ins ["av"] 	= trim( $i['47']);
			$ins ["aw"] 	= trim( $i['48']);
			$ins ["ax"] 	= trim( $i['49']);
			$ins ["ay"] 	= trim( $i['50']);
			$ins ["az"] 	= trim( $i['51']);
			
			$ins ["ba"] 	= trim( $i['52']);
			$ins ["bb"] 	= trim( $i['53']);
			$ins ["bc"] 	= trim( $i['54']);
			$ins ["bd"] 	= trim( $i['55']);
			$ins ["be"] 	= trim( $i['56']);
			$ins ["bf"] 	= trim( $i['57']);
			$ins ["bg"] 	= trim( $i['58']);
			$ins ["bh"] 	= trim( $i['59']);
			$ins ["bi"] 	= trim( $i['60']);
			$ins ["bj"] 	= trim( $i['61']);
			$ins ["bk"] 	= trim( $i['60']);
			
			$rsinsert = $db->Execute("select top 1 * from sa90temp");
			$insertSQL = $db->GetInsertSQL($rsinsert, $ins );
			$db->Execute($insertSQL);
			
			$rsinsert->Close();
		}
		 
	 //------------------------------ batas -------------------------------------

	// hapus data di sa90
        $sqldelsa = "delete from sa90";
        $rsdelsa = $db->Execute($sqldelsa);
		$rsdelsa->Close();
			
    // insert data ke sa90 dari sa90temp
    	$sqlins = "insert into sa90 select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac,convert(char,ab) from sa90temp";	       
		$hasilins= $db->Execute($sqlins);
		$hasilins->Close();
		
 	// bersihkan double quote

	// echo 'Bersihkan double quote<br />';			
        $sqlupd = "update sa90 set so = REPLACE(so,CHAR(34),''), partno = REPLACE(partno,CHAR(34),'')";
        $sqlupd .= " , partname = REPLACE(partname,CHAR(34),''), lot = REPLACE(lot,CHAR(34),'')";
        $sqlupd .= " , line = REPLACE(line,CHAR(34),''), model = REPLACE(model,CHAR(34),''), suppcode = REPLACE(suppcode,CHAR(34),'')";
	    $rsupd = $db->Execute($sqlupd);
	
	//  insert or update data to SA90M  table  (   used by transacation  and history )
			
		$sqlbaca= "select * from sa90";
	
		$baris  = 0;
		$brsbaca= $db->Execute($sqlbaca);
 			
        while(!$brsbaca->EOF)
          {
	     
			$cekso      = $brsbaca->fields[0];
			$cekpart    = $brsbaca->fields[1];
			$cekpartname= $brsbaca->fields[2];
				
			$cekbom     = $brsbaca->fields[3];
			$cekqty     = $brsbaca->fields[4];
			$ceklot     = $brsbaca->fields[5];
			
			$cekline    = $brsbaca->fields[6];
				
			$cekmodel   = $brsbaca->fields[7];
			$ceksuppcode= $brsbaca->fields[8];
             // cek data di table SA90M --> jika belum ada --> do insert , jika sudah ada --> do update
			$cekmodel2   = trim($cekmodel);
			
			// cek so di sa90m
			$sqlada_so = "select top 1 so, model, max(replikasi) as replikasi from sa90m
									where so = '$cekso'
									group by so,model
									order by replikasi asc"; //by zaki 20170421
            $rshasil_so = $db->Execute("select top 1 so, model, max(replikasi) as replikasi from sa90m
									where so = '$cekso'
									group by so,model
									order by replikasi asc"); //by zaki 20170421
			$cekdata_so = $rshasil_so->RecordCount(); //by zaki 20170421
			$cek_so = trim($rshasil_so->fields[0]); //by zaki 20170421
			$cekmodel_so = trim($rshasil_so->fields[1]); //by zaki 20170421
			
		 	$sqlada = "select * from sa90m where so = '$cekso' and partno = '$cekpart'";
			$rshasil = $db->Execute("select * from sa90m where so = '$cekso' and partno = '$cekpart'");
			$cekdata = $rshasil->RecordCount();	  
			
			if($cekdata_so == 0 or empty($cekdata_so)){
				if($cekdata == 0){
						$baris++;
									  
							echo '** ';
							echo $baris;
							echo ' ** ';
								echo 'so : ';
						echo $cekso ;
						echo ' ** partno : ';
						echo $cekpart;
						echo ' is nothing.. inserting ...<br />';
							$sqlins = " insert into sa90m select so,partno,partname,bom,qty,lot,line,model from sa90 where so = '$cekso' and partno = '$cekpart'";
							$rsins= $db->Execute($sqlins);
				}             
				else{
						$baris++;  		  
						echo '** ';
							echo $baris;
							echo ' ** ';
						echo 'so : ';
						echo $cekso;
						echo 'partno : ';
						echo $cekpart;
						echo ' data already exist, updating ...<br />';
						$sqlup = "update sa90m set partname = '$cekpartname', bom = $cekbom, qty = $cekqty, lot = '$ceklot', ";
						$sqlup .= "line = '$cekline', model = '$cekmodel' where so = '$cekso' and partno = '$cekpart'";
						  $hslup= $db->Execute($sqlup);
				}
			}
			else{
				if($cekmodel_so == $cekmodel2){
					if($cekdata == 0){
							$baris++;
										  
								echo '** ';
								echo $baris;
								echo ' ** ';
									echo 'so : ';
							echo $cekso ;
							echo ' ** partno : ';
							echo $cekpart;
							echo ' is nothing.. inserting ...<br />';
								$sqlins = " insert into sa90m select so,partno,partname,bom,qty,lot,line,model from sa90 where so = '$cekso' and partno = '$cekpart'";
								$rsins= $db->Execute($sqlins);
					}             
					else{
							$baris++;  		  
							echo '** ';
								echo $baris;
								echo ' ** ';
							echo 'so : ';
							echo $cekso;
							echo 'partno : ';
							echo $cekpart;
							echo ' data already exist, updating ...<br />';
							$sqlup = "update sa90m set partname = '$cekpartname', bom = $cekbom, qty = $cekqty, lot = '$ceklot', ";
							$sqlup .= "line = '$cekline', model = '$cekmodel' where so = '$cekso' and partno = '$cekpart'";
							  $hslup= $db->Execute($sqlup);
					}
				}
				elseif($cekmodel_so != $cekmodel2){
					$sqlins_dup = "insert into sa90m select so,partno,partname,bom,qty,lot,line,model,CONVERT(varchar(20),getdate(),120) from sa90 where so = '$cekso' and partno = '$cekpart'";
					$rsins_dup= $db->Execute($sqlins_dup);
					
					$sqldel_so 	= "delete from sa90m where so = '$cekso' and model = '$cekmodel_so'"; //by zaki 20170421
					$rsdel_so	= $db->Execute($sqldel_so); //by zaki 20170421
					
					// echo 'data dgn so : ' . $cekso . ' dan partno : ' . $cekpart . ' hasil = ' . $cekdata . ', ';
					
					if($cekdata == 0){
							$baris++;
										
								echo '** ';
								echo $baris;
								echo ' ** ';
									echo 'so : ';
							echo $cekso ;
							echo ' ** partno : ';
							echo $cekpart;
							echo ' is nothing.. inserting ...<br />';
								$sqlins = " insert into sa90m select so,partno,partname,bom,qty,lot,line,model from sa90 where so = '$cekso' and partno = '$cekpart'";
								$rsins= $db->Execute($sqlins);
					}             
					else{
							$baris++;  		  
							echo '** ';
								echo $baris;
								echo ' ** ';
							echo 'so : ';
							echo $cekso;
							echo 'partno : ';
							echo $cekpart;
							echo ' data already exist, updating ...<br />';
							$sqlup = "update sa90m set partname = '$cekpartname', bom = $cekbom, qty = $cekqty, lot = '$ceklot', ";
							$sqlup .= "line = '$cekline', model = '$cekmodel' where so = '$cekso' and partno = '$cekpart'";
							$hslup= $db->Execute($sqlup);
					} 
				}
			}
			
			$brsbaca->MoveNext();
	   }
	   $brsbaca->close();
			
		


echo 'Proses upload so data selesai dengan jumlah record : ';
echo $baris;
echo '<br />';

//  Proses untuk produksi 
//	
			
//  hapus data di sa90prodtemp


echo 'Proses upload data so produksi ....<br />';

$del_sa90prodtemp = "delete from sa90prodtemp";
$rsdpt	= $db->Execute($del_sa90prodtemp);
$rsdpt->close();

// insert data ke sa90prodtemp dari sa90temp
			
$ins_sa90prodtemp = "insert into sa90prodtemp select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac,aa from sa90temp";
//$rsipt = $db->Execute($ins_sa90prodtemp);
//$rsipt->close();
// bersihkan double quote
			$upd_sa90prodtemp = "update sa90prodtemp set so = REPLACE(so,CHAR(34),''), partno = REPLACE(partno,CHAR(34),'')";
			$upd_sa90prodtemp .= " , partname = REPLACE(partname,CHAR(34),''), lot = REPLACE(lot,CHAR(34),'')";
$upd_sa90prodtemp .= " , line = REPLACE(line,CHAR(34),''), model = REPLACE(model,CHAR(34),''), aa = REPLACE(aa,CHAR(34),'')";
			
//$rsupt = $db->Execute($upd_sa90prodtemp);
//$rsupt->close();
//  insert or update data to sa90prodtemp  table  (   used by transacation  and history )
$barisprod = 0;
$sel_sa90prodtemp	= "select * from sa90prodtemp";
$row = $db->Execute($sel_sa90prodtemp);			

while(!$row->EOF)
    {
	$so = str_replace("'", "", $row->fields[0]);
	$part = str_replace("'", "", $row->fields[1]);
	$partname = str_replace("'", "", $row->fields[2]);
				
        $bom = str_replace("'", "", $row->fields[3]);
	$qty = str_replace("'", "", $row->fields[4]);
	$lot = str_replace("'", "", $row->fields[5]);
	
	$line = str_replace("'", "", $row->fields[6]);
				
        $model = str_replace("'", "", $row->fields[7]);
	$aa = str_replace("'", "", $row->fields[8]);
	// cek data di table SA90M --> jika belum ada --> do insert , jika sudah ada --> do update
	$sel_sa90prod 	= "select * from sa90prod where so = '$so' and partno = '$part'";
	$rs_sa90prod	= $db->Execute($sel_sa90prod);
	$cek = $rs_sa90prod->RecordCount();	

	if($cek == 0)          
	  {
		$barisprod++;
					  
	        echo '** ';
	        echo $baris;
	        echo ' ** ';
                echo 'so : ';
		echo $so ;
		echo ' ** partno : ';
		echo $part;
		echo ' is nothing.. inserting ...<br />';
				$ins_sa90prod = "insert into sa90prod select * from sa90prodtemp where so = '$so' and partno = '$part'";
					
            	$rs_ins_sa90prod = $db->Execute($ins_sa90prod);
          }
				
        else
          { 
		$barisprod++;  		  
		echo '** ';
	        echo $barisprod;
	        echo ' ** ';
		echo 'so : ';
		echo $so;
		echo 'partno : ';
		echo $part;
		echo ' data already exist, updating ...<br />';

			$upd_sa90prod = "update sa90prod set partname = '$partname', bom = $bom, qty = $qty, lot = '$lot', ";
            $upd_sa90prod .= "line = '$line', model = '$model', aa = '$aa' where so = '$so' and partno = '$part'";
            $rs_upd_sa90prod = $db->Execute($upd_sa90prod);

    	}
	$row->MoveNext();	
    }
	$row->close();
		// -- end -- //	
echo 'Proses upload so data untuk produksi selesai dengan jumlah record : ';
echo $barisprod;
echo '<br />';


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
$nt= $db->Execute($sqltampil);
while(!$nt->EOF)
   {     
     echo '<tr>';
     echo '<td>' . $nt->fields[0] . '</td><td>' . $nt->fields[1] . '</td><td>' . $nt->fields[2] . '</td><td align="right">' . $nt->fields[3] . '</td><td align="right">' . $nt->fields[4] . '</td><td>';
     echo $nt->fields[5] . '</td><td>' . $nt->fields[6] . '</td><td>' . $nt->fields[7] . '</td>' ;
     echo '</tr>';
	 $nt->MoveNext();
   } // end of while
   
   $nt->close();

echo '</table>';
			
			
		}

   

else
{
  // if not ok
}


} 




echo '</body>';echo '</html>';

// tutup koneksi 12 des 2011
//mssql_close($con);

?>



