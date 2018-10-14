<?php
include "koneksi.php";

echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Data hasil upload : <br />';

if ($_REQUEST["loadheader"] == "ok") 
{
	if (is_uploaded_file($_FILES["userfile"]["tmp_name"]))
	{
	//	Langkah ke 1
		// hapus record table sa90temp
		$sql = "delete from sa90temp_so1";     
		$rsdel = $db->Execute($sql);
		$rsdel->Close();
		
		// Set limit time fpr maximum execute
		set_time_limit(7200);
		
		
		$namatemp = $_FILES['userfile']['tmp_name'];
		$feed = fopen($namatemp, 'r');
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
			
			$rsinsert = $db->Execute("select top 1 * from sa90temp_so1");
			$insertSQL = $db->GetInsertSQL($rsinsert, $ins );
			$db->Execute($insertSQL);
			
			$rsinsert->Close();
		}
		//	end of while sa90temp
		
	//	Langkah ke 2	
		// hapus data di sa90
		$sqldelsa = "delete from sa90_so1";
		$rsdelsa = $db->Execute($sqldelsa);
		$rsdelsa->Close();

		// insert data ke sa90 dari sa90temp
		$sqlins = "insert into sa90_so1 select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac,convert(char,ab) from sa90temp_so1";	       
		$hasilins= $db->Execute($sqlins);
		$hasilins->Close();
		
		// echo 'Bersihkan double quote<br />';			
        $sqlupd = "update sa90_so1 set so = REPLACE(so,CHAR(34),''), partno = REPLACE(partno,CHAR(34),'')";
        $sqlupd .= " , partname = REPLACE(partname,CHAR(34),''), lot = REPLACE(lot,CHAR(34),'')";
        $sqlupd .= " , line = REPLACE(line,CHAR(34),''), model = REPLACE(model,CHAR(34),''), suppcode = REPLACE(suppcode,CHAR(34),'')";
	    $rsupd = $db->Execute($sqlupd);
		$rsupd->Close();
	
	//	Langkah ke 3
		$sqlbaca= "select * from sa90_so1";
		$baris  = 0;
		$brsbaca= $db->Execute($sqlbaca);
		while(!$brsbaca->EOF)
		{
			$sono      		= $brsbaca->fields[0];
			$partno	   		= $brsbaca->fields[1];
			$partname		= $brsbaca->fields[2];
			$bom     		= $brsbaca->fields[3];
			$qty     		= $brsbaca->fields[4];
			$lot     		= $brsbaca->fields[5];
			$line    		= $brsbaca->fields[6];
			$newmodel   	= trim($brsbaca->fields[7]);
			
			//	cek so sa90m
			$rs = $db->Execute("select count(*) from sa90m_so1 where so = '{$sono}'");
			$cekso = $rs->fields[0];
			$rs->close();
			
			if($cekso == 0){
				//echo $sono . 'tidak ada <br>';
				$sqlins	= " insert into sa90m_so1 select so,partno,partname,bom,qty,lot,line,model from sa90_so1 where so = '$sono'";
				$rsins	= $db->Execute($sqlins);
				$rsins->Close();
				//echo $sono . 'inserted <br>';
			}
			else{
				$rsmodel 	= $db->Execute("select distinct model from sa90m_so1 where so = '{$sono}'");
				$oldmodel	= trim($rsmodel->fields[0]);
				$rsmodel->close();
				
				if ($oldmodel == $newmodel){
					//echo $sono . 'model sama ('.$oldmodel .')-('.$newmodel .')<br>';
					$sqlhasil	= "select count(*) from sa90m_so1 where so = '{$sono}' and partno = '{$partno}'";
					$rshasil	= $db->Execute($sqlhasil);
					$cekpart	= $rshasil->fields[0];
					$rshasil->Close();
					
					if($cekpart == 0){
						//echo '------------ ('.$cekpart .') part tidak ada<br>';
						$sqlins	= " insert into sa90m_so1 select so,partno,partname,bom,qty,lot,line,model 
									from sa90_so1 where so = '{$sono}' and partno = '{$partno}' and model = '{$newmodel}'";
						$rsins	= $db->Execute($sqlins);
						$rsins->Close();
						///echo '------------ inserted <br>';
					}
					else{
						//echo '------------ ('.$cekpart .') part ada<br>';
						$sqlup 	= "update sa90m_so1 set partname = '{$partname}', bom = {$bom}, 
									qty = {$qty}, lot = '{$lot}', line = '{$line}', model = '{$newmodel}' 
									where so = '{$sono}' and partno = '{$partno}' and model = '{$newmodel}'";
						$rsup	= $db->Execute($sqlup);
						$rsup->Close();
						//echo '------------ updated <br>';
					}
				}
				else{
					echo $sono . 'model beda ('.$oldmodel .')-('.$newmodel .')<br>';
					
				}
			}
			
			$brsbaca->MoveNext();
		}
	}
	//	end of tmpname
}
//	end of loadheader

echo '</body>';
echo '</html>';

$db->Close();
?>



