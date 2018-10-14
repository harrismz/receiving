<?php
include "koneksi_edit.php";
//include "koneksi.php";

// mendapatkan waktu sistem...
//Setting Jam Indonesia //
date_default_timezone_set('Asia/Jakarta');
$Ymd = gmdate("Ymd");
$wkt = date('H:i:s');
// ================= //

$waktu  =  getdate();
$jam    = $waktu['hours'];
$menit  = $waktu['minutes'];
$detik  = $waktu['seconds'];
$tanggal= $waktu['year']  . "-" . $waktu['mon'] . "-" . $waktu['mday'];
$cjam   = strlen($jam);
$cmenit = strlen($menit);
$cdetik = strlen($detik);
if($cjam == 1 ){ $jam = "0" . $jam; }
if($cmenit == 1){ $menit = "0" . $menit; }
if($cdetik == 1){ $detik = "0" . $detik; }
$tglins = $tanggal . ' ' . $wkt;

//echo "<p align='center'>Tanggal : " . $tglins . '</p>';
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
		</style>
	</head>

	<?php
		$txtnikPost1 = isset($_POST['nik']) ? $_POST['nik'] : "";
		$txtsoPost1  = isset($_POST['idso']) ? $_POST['idso'] : "";
		$varpartPost1= isset($_POST['parthdn1']) ? $_POST['parthdn1'] : "";
		$varpartPost2= isset($_POST['parthdn2']) ? $_POST['parthdn2'] : "";
		$varpoPost   = isset($_POST['partpo2']) ? $_POST['partpo2'] : "";
		$varqtyPost  = isset($_POST['partqty2']) ? $_POST['partqty2'] : "";

		if($varpartPost1 != "" and $varpartPost2 == ""){
			$varpartPost= strtoupper($varpartPost1);

		echo'|'.	$txtnik	    = strtoupper(trim($txtnikPost1));
		echo'|'.	$txtso	    = strtoupper(trim($txtsoPost1));
		echo'|'.	$varpart    = trim(substr($varpartPost,0,15));
		echo'|'.	$varpo      = substr($varpartPost,16,7);
		echo'|'.	$varqty     = substr($varpartPost,24,5);
		}
		else{
			$varpartPost= strtoupper($varpartPost2);

		echo'<br><br>|'.	$txtnik	    = strtoupper(trim($txtnikPost1));
		echo'|'.	$txtso	    = strtoupper(trim($txtsoPost1));
		echo'|'.	$varpart    = strtoupper(trim($varpartPost));
		echo'|'.	$varpo      = strtoupper(trim($varpoPost));
		echo'|'.	$varqty     = strtoupper(trim($varqtyPost));
		}

		/*==================== PARTLIST DATA====================================*/
	echo'<br><br>|'.	$dept_part= isset($_POST['dept_part']) ? $_POST['dept_part'] : "";
	echo'<br>|'.	$issueke	= isset($_POST['issueke']) ? $_POST['issueke'] : "";
	echo'<br>|'.	$date_part= isset($_POST['date_part']) ? $_POST['date_part'] : "";
	echo'<br>|'.	$line     = isset($_POST['line']) ? $_POST['line'] : "";
	echo'<br>|'.	$model    = isset($_POST['model']) ? $_POST['model'] : "";
	echo'<br>|'.	$prodno   = isset($_POST['prodno']) ? $_POST['prodno'] : "";
	echo'<br>|'.	$lot      = isset($_POST['lot']) ? $_POST['lot'] : "";
	echo'<br>|'.	$qty      = isset($_POST['qty']) ? $_POST['qty'] : "";
		/*==================== END-PARTLIST-DATA ====================================*/



		if($txtsoPost1 == "" && $varpartPost1 == "" && $varpartPost2 == "" && $varpoPost == "" && $varqtyPost == ""){
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
			if(!$row_check){
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
				
				while (!$row->EOF){
					$partcek1 = $row->fields[1];
					if(trim($partcek1) == trim($varpart)){
						$wrongpart  = 1;
						$nilainama  = $row->fields[2];
						$nilaireq   = $row->fields[3];
						$nilaiscan  = $row->fields[4];
						$nilaibom   = $row->fields[5];
						$nilailot   = $row->fields[6];
						$nilailine  = $row->fields[7];
						$nilaimodel = $row->fields[8];
						$cektotalqty= $nilaiscan + $varqty;
						if($cektotalqty > $nilaireq){ $cekpart = 0; }
						else { $cekpart = 1; }
					} // end if(trim....
					$row->MoveNext();
				} //while

				//echo "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins')";
				//echo 'nilai scan : ' . $cektotalqty;
				if ($wrongpart == 1){
					if ($cekpart == 0){
						echo "<h1 id='soNotReg'>QUANTITY OVER</h1>";
						$suara = 'Over2good.wav';
						echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
					}
					if ($cekpart == 1){
						
						/*	echo $sqlchkissue = "SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') and (scan_issue <> 0)";
							$chkissue = $db->Execute($sqlchkissue);
							echo'*issue*'. $issueke = $chkissue->fields['0'];
						*/	
					echo'<br><br>'.	$sqlpartlist = "SELECT id_partlist, partdept, line, model, prod_no, lot, qty,
									date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue,
									scan_issue, tot_scan,status_scan, upload_nik, upload_date, scan_nik, scan_date
									FROM partlist
									WHERE
										(status_scan IS NULL)
									AND (partdept = '$dept_part')
									AND (date_issue = '$date_part') 
									AND (line = '$line')
									AND (model = '$model')
									AND (prod_no = '$prodno')
									AND (lot = '$lot')
									AND (qty = '$qty')
									and (scan_issue <> 0)
									and so_number = '$txtso'
									and partno = '$varpart'
									AND issue_ke = '$issueke'";
						$rspartlist = $db->execute($sqlpartlist);
					echo'<br><br>'.	$chkpartlist = $rspartlist->RecordCount();
					echo'<br>'.	$scan_issue = $rspartlist->fields['16'];
					echo'<br>'.	$tot_scan = $rspartlist->fields['17'];
						
						$qtyscan = $varqty;
						$tot_qtyscan = intval($tot_scan) + intval($qtyscan);
						
						if ($chkpartlist != 0 && ($tot_qtyscan > $scan_issue) ){
							echo "<h1 id='soNotReg'>QTY SCAN OVER THAN STD ISSUE !!!</h1>";
							$suara = 'WrongParts2good.wav';
							echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
						}
						else if ($chkpartlist != 0 && ($tot_qtyscan < $scan_issue)){
					echo'<br><br>'.		$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik')";
							$hslins = $db->execute($sqlins);
							
					echo'<br><br>'.		$sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
							$hslsel = $db->execute($sqlsel);
							$chk_inspartiss = $hslsel->RecordCount();
							
							if ($chk_inspartiss != 0){
					echo'<br><br>upd--'.			$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', scan_nik = '$txtnik', scan_date = '$tglins'
														WHERE
																(status_scan IS NULL)
															AND (partdept = '$dept_part')
															AND (date_issue = '$date_part') 
															AND (line = '$line')
															AND (model = '$model')
															AND (prod_no = '$prodno')
															AND (lot = '$lot')
															AND (qty = '$qty')
															and (scan_issue <> 0)
															and so_number = '$txtso'
															and partno = '$varpart'
															AND issue_ke = '$issueke'";
								$upd_partlist = $db->execute($sqlupd_partlist);
							}
							
							$suara = 'ok1.wav';
							echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
							echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data (Update)</h2>";
						}
						else if($chkpartlist != 0 && ($tot_qtyscan = $scan_issue)){
							$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik')";
							$hslins = $db->execute($sqlins);
							
							$sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
							$hslsel = $db->execute($sqlsel);
							$chk_inspartiss2 = $hslsel->RecordCount();
							
							if ($chk_inspartiss2 != 0){
							echo'<br><br>pass--'.	$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', status_scan = '1', scan_nik = '$txtnik', scan_date = '$tglins'
														WHERE
																(status_scan IS NULL)
															AND (partdept = '$dept_part')
															AND (date_issue = '$date_part') 
															AND (line = '$line')
															AND (model = '$model')
															AND (prod_no = '$prodno')
															AND (lot = '$lot')
															AND (qty = '$qty')
															and (scan_issue <> 0)
															and so_number = '$txtso'
															and partno = '$varpart'
															AND issue_ke = '$issueke'";
								$upd_partlist = $db->execute($sqlupd_partlist);
							}
							
							$suara = 'ok1.wav';
							echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
							echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data (ISSUE PASS)</h2>";
						}
						else if ($chkpartlist == 0){
							echo "<h1 id='soNotReg'>Check Partlist Table !!!</h1>";
							$suara = 'WrongParts2good.wav';
							echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
						}
						
						//echo "select scan_issue from parlist where so_number = '$txtso' and partname = '$nilainama' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel'";
						/* 
						$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik')";
						$hslins = $db->execute($sqlins);
						echo $sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
						$hslsel = $db->execute($sqlsel);
						echo'<br>'. $hslsel->fields['0'];
						echo'|'. $hslsel->fields['1'];
						echo'|'. $hslsel->fields['2'];
						echo'|'. $hslsel->fields['3'];
						echo'|'. $hslsel->fields['4'];
						echo'|'. $hslsel->fields['5'];
						echo'|qty'. $hslsel->fields['6'];
						echo'|'. $hslsel->fields['7'];
						echo'|'. $hslsel->fields['8'];
						echo'|'. $hslsel->fields['9'];
						echo'|'. $hslsel->fields['10'];
						echo'|'. $hslsel->fields['11'];
						echo '|-'.$hslsel->RecordCount();
						if($hslsel->RecordCount() != 0){
						$sqlpartlist = "update partlist set tot_scan = '$varqty', status_scan = '1', scan_nik = '$txtnik', scan_date = '$tglins' where "
						}*/
					}	                        
				}  // end if ($wrongpart == 1 )                             

				if ($wrongpart == 0)  // wrong part
				{
					echo "<h1 id='soNotReg'>WRONG Part !!!</h1>";
					$suara = 'WrongParts2good.wav';
					echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
				}

				// -------------------------------------------------
				// tampilkan data
			} //end of	if($txtbarcode != "")

			else{
				/*  echo '<h1 align="center" id="show_so">' . $txtso . '</h1>';
				echo '<table id="table_showpart" align="center">';
				echo '<tr>';
				echo '<th id="th_showpart">PART.NO</th>';
				echo '<th id="th_showpart">PART NAME</th>';
				echo '<th id="th_showpart">REQ QTY</th>';
				echo '<th id="th_showpart">SCAN QTY</th>';
				echo '<th id="th_showpart">BOM</th>';
				echo '<th id="th_showpart">LOT</th>';
				echo '<th id="th_showpart">LINE</th>';
				echo '<th id="th_showpart">MODEL</th>';
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
				echo  '<td id="td_showpart">' . $row->fields[1] . '</td>';
				echo  '<td id="td_showpart">' . $row->fields[2] . '</td>';
				echo  '<td id="td_right_showpart">' . $row->fields[3] . '</td>';
				echo  '<td id="td_right_showpart">' . $row->fields[4] . '</td>';
				echo  '<td id="td_right_showpart">' . $row->fields[5] . '</td>';
				echo  '<td id="td_showpart">' . $row->fields[6] . '</td>';
				echo  '<td id="td_showpart">' . $row->fields[7] . '</td>';
				echo  '<td id="td_showpart">' . $row->fields[8] . '</td>';
				echo  '</tr>';
				$partcek1 = $row->fields[1];
				$row->MoveNext();
				}
				echo '</table>';
				$row->close();      
				*/
			}  // end of else -------> if($txtbarcode != "") 
		}
	?>
	<br>
	</body>
</html>

<?php
/***	} //else postingan***/


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
