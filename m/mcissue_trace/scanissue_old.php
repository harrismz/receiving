<?php
//include "koneksi_edit.php";
include "koneksi.php";

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
        $varunique = "";
		$varuniquecode = "";
		
		if($varpartPost1 != "" and $varpartPost2 == ""){
			$varpartPost= strtoupper($varpartPost1);
			$txtnik	    = strtoupper(trim($txtnikPost1));
			$txtso	    = strtoupper(trim($txtsoPost1));
			$varpart    = trim(substr($varpartPost,0,15));
			$varpo      = substr($varpartPost,16,7);
			$varqty     = substr($varpartPost,24,5);
			$varunique  	= substr($varpartPost,30,46); //( 1+6+15+18+6 = 46 ) //( 15+8+6 = 29 )
			$varuniquecode	= substr($varpartPost,56,20); //( 1 +6 +15+18+6 = 46 ) (57+20 = month+day+time+microtime+code) //( 49+10 = month+day+code )
		}
		else{
			$varpartPost= strtoupper($varpartPost2);
		
			$txtnik	    = strtoupper(trim($txtnikPost1));
			$txtso	    = strtoupper(trim($txtsoPost1));
			$varpart    = strtoupper(trim($varpartPost));
			$varpo      = strtoupper(trim($varpoPost));
			$varqty     = strtoupper(trim($varqtyPost));
		}

		/*==================== PARTLIST DATA====================================*/
			$partcode= isset($_POST['partcode']) ? $_POST['partcode'] : "";
			$issueke	= isset($_POST['issueke']) ? $_POST['issueke'] : "";
		/*==================== END-PARTLIST-DATA ====================================*/



		if($txtsoPost1 == "" && $varpartPost1 == "" && $varpartPost2 == "" && $varpoPost == "" && $varqtyPost == ""){
		//if($txtsoPost1 == "" && $varpartPost1 == "" ){
			echo "<p id='SoNum'>SCAN NIK ANDA untuk memulai</p>";
		}
		else{
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
						echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/LEBIH.mp3\" type=\"audio/mp3\"></audio>";
						/*
						$suara = 'Over2good.wav';
						echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
						*/
					}
					if ($cekpart == 1){

						if ($issueke != ""){

							$sqlchkcode = "SELECT partdept, line, model, prod_no, lot, qty, date_issue FROM partlist
										WHERE kode = '{$partcode}'";
							$rschkcode = $db->execute($sqlchkcode);

							$dept_part = $rschkcode->fields[0];
							$line = $rschkcode->fields[1];
							$model = $rschkcode->fields[2];
							$prodno = $rschkcode->fields[3];
							$lot = $rschkcode->fields[4];
							$qty = $rschkcode->fields[5];
							$date_part = $rschkcode->fields[6];

							/* --- without MCCode ---
							$sqlpartlist = "SELECT id_partlist, partdept, line, model, prod_no, lot, qty,
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
							$chkpartlist = $rspartlist->RecordCount();
							$scan_issue = $rspartlist->fields['16'];
							$tot_scan = $rspartlist->fields['17'];

							 //--- without MCCode ---
							 */

							$sqlpartlist = "SELECT id_partlist, partdept, line, model, prod_no, lot, qty,
										date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue,
										scan_issue, tot_scan,status_scan, upload_nik, upload_date, scan_nik, scan_date
										FROM partlist
										WHERE
											(status_scan IS NULL)
										AND (kode = '$partcode')
										and (scan_issue <> 0)
										and so_number = '$txtso'
										and partno = '$varpart'
										AND issue_ke = '$issueke'";
							$rspartlist = $db->execute($sqlpartlist);
							$chkpartlist = $rspartlist->RecordCount();
							$scan_issue = $rspartlist->fields['16'];
							$tot_scan = $rspartlist->fields['17'];

							$qtyscan = $varqty;
							/*$tot_qtyscan = intval($tot_scan) + intval($qtyscan);*/
							$tot_qtyscan = floatval($tot_scan) + floatval($qtyscan);

							if ($chkpartlist != 0 && ($tot_qtyscan > $scan_issue) ){
								echo "<h1 id='soNotReg'>QTY SCAN OVER THAN STD ISSUE !!!</h1>";
								echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/LEBIH.mp3\" type=\"audio/mp3\"></audio>";
								/*
								$suara = 'WrongParts2good.wav';
								echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
								*/
							}
							else if ($chkpartlist != 0 && ($tot_qtyscan < $scan_issue)){
								$duplikat = 0;

								$sqlduplicate = "select dbo.validateScan('{$varunique}')";
								$rsdup = $db->Execute($sqlduplicate);
								$duplikat = $rsdup->fields[0];
								$rsdup->Close();
								if($duplikat == 0)
								{
									$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik, uniqueid) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik','$varunique')";
									$hslins = $db->execute($sqlins);

									$sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
									$hslsel = $db->execute($sqlsel);
									$chk_inspartiss = $hslsel->RecordCount();

									if ($chk_inspartiss != 0){
										/* --- without MCCode ---
										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', scan_nik = '$txtnik', scan_date = '$tglins'
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
										/* --- end without MCCode ---*/

										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', scan_nik = '$txtnik', scan_date = '$tglins'
																WHERE
																		(status_scan IS NULL)
																	AND (kode = '$partcode')
																	and (scan_issue <> 0)
																	and so_number = '$txtso'
																	and partno = '$varpart'
																	AND issue_ke = '$issueke'";
										$upd_partlist = $db->execute($sqlupd_partlist);
									}

									if($varunique != ''){
										$inputunique = "exec InsertScanUnique '{$varunique}','{$txtnik}'";
										$rsinputunique = $db->execute($inputunique);
									}

									/*
									$suara = 'ok1.wav';
									echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									*/
									echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/OK.mp3\" type=\"audio/mp3\"></audio>";
									echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data</h2>";
								}
								else
								{
									echo "<h1 id='soNotReg'>DUPLICATE SCAN !!!</h1>";
									$suara = 'partsudahdigunakan.mp3';
									//echo "<embed src =\"sound/$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									echo"<audio controls autoplay hidden=\"hidden\"><source src=\"../asset/sound/$suara\" type=\"audio/mp3\"></audio>";
								}
							}
							else if($chkpartlist != 0 && ($tot_qtyscan = $scan_issue)){
								$duplikat = 0;

								$sqlduplicate = "select dbo.validateScan('{$varunique}')";
								$rsdup = $db->Execute($sqlduplicate);
								$duplikat = $rsdup->fields[0];
								$rsdup->Close();
								if($duplikat == 0)
								{
									$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik, uniqueid) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik','$varunique')";
									$hslins = $db->execute($sqlins);

									$sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
									$hslsel = $db->execute($sqlsel);
									$chk_inspartiss2 = $hslsel->RecordCount();

									if ($chk_inspartiss2 != 0){
										/* --- without MCCode ---
										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', status_scan = '1', scan_nik = '$txtnik', scan_date = '$tglins'
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
										/* --- end without MCCode ---*/

										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', status_scan = '1', scan_nik = '$txtnik', scan_date = '$tglins'
																WHERE
																		(status_scan IS NULL)
																	AND (kode = '$partcode')
																	and (scan_issue <> 0)
																	and so_number = '$txtso'
																	and partno = '$varpart'
																	AND issue_ke = '$issueke'";
										$upd_partlist = $db->execute($sqlupd_partlist);
									}
									if($varunique != ''){
										$inputunique = "exec InsertScanUnique '{$varunique}','{$txtnik}'";
										$rsinputunique = $db->execute($inputunique);
									}
									/*
									$suara = 'ok1.wav';
									echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									*/
									echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/OK.mp3\" type=\"audio/mp3\"></audio>";
									echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data</h2>";
								}
								else
								{
									echo "<h1 id='soNotReg'>DUPLICATE SCAN !!!</h1>";
									$suara = 'partsudahdigunakan.mp3';
									//echo "<embed src =\"sound/$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									echo"<audio controls autoplay hidden=\"hidden\"><source src=\"../asset/sound/$suara\" type=\"audio/mp3\"></audio>";
								}
							}
							else if ($chkpartlist == 0){
								echo "<h1 id='soNotReg'>Check Partlist Table !!!</h1>";
								echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/SALAH.mp3\" type=\"audio/mp3\"></audio>";

								/*
								$suara = 'WrongParts2good.wav';
								echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
								*/
							}
						}
						else if ($issueke == ""){

							$sqlchkcode = "SELECT partdept, line, model, prod_no, lot, qty, date_issue FROM partlist
										WHERE kode = '{$partcode}'";
							$rschkcode = $db->execute($sqlchkcode);

							$dept_part = $rschkcode->fields[0];
							$line = $rschkcode->fields[1];
							$model = $rschkcode->fields[2];
							$prodno = $rschkcode->fields[3];
							$lot = $rschkcode->fields[4];
							$qty = $rschkcode->fields[5];
							$date_part = $rschkcode->fields[6];

							/* -- without MCCode --
							$sqlchkissue = "SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') and (scan_issue <> 0)";
							$chkissue = $db->Execute($sqlchkissue);
							$issueke_oto = $chkissue->fields['0'];
							/*-- without MCCode --*/

							$sqlchkissue = "SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (kode = '$partcode') AND (scan_issue <> 0)";
							$chkissue = $db->Execute($sqlchkissue);
							$issueke_oto = $chkissue->fields['0'];

							/* -- without MCCode --
							$sqlpartlist = "SELECT id_partlist, partdept, line, model, prod_no, lot, qty,
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
										AND issue_ke = '$issueke_oto'";
							$rspartlist = $db->execute($sqlpartlist);
							$chkpartlist = $rspartlist->RecordCount();
							$scan_issue = $rspartlist->fields['16'];
							$tot_scan = $rspartlist->fields['17'];
							/* -- without MCCode -- */

							$sqlpartlist = "SELECT id_partlist, partdept, line, model, prod_no, lot, qty,
										date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue,
										scan_issue, tot_scan,status_scan, upload_nik, upload_date, scan_nik, scan_date
										FROM partlist
										WHERE
											(status_scan IS NULL)
										AND (kode = '$partcode')
										and (scan_issue <> 0)
										and so_number = '$txtso'
										and partno = '$varpart'
										AND issue_ke = '$issueke_oto'";
							$rspartlist = $db->execute($sqlpartlist);
							$chkpartlist = $rspartlist->RecordCount();
							$scan_issue = $rspartlist->fields['16'];
							$tot_scan = $rspartlist->fields['17'];

							$qtyscan = $varqty;
							//$tot_qtyscan = intval($tot_scan) + intval($qtyscan);
							$tot_qtyscan = floatval($tot_scan) + floatval($qtyscan);

							if ($chkpartlist != 0 && ($tot_qtyscan > $scan_issue) ){
								echo "<h1 id='soNotReg'>QTY SCAN OVER THAN STD ISSUE !!!</h1>";
								echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/LEBIH.mp3\" type=\"audio/mp3\"></audio>";
								/*
								$suara = 'WrongParts2good.wav';
								echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
								*/
							}
							else if ($chkpartlist != 0 && ($tot_qtyscan < $scan_issue)){
								$duplikat = 0;

								$sqlduplicate = "select dbo.validateScan('{$varunique}')";
								$rsdup = $db->Execute($sqlduplicate);
								$duplikat = $rsdup->fields[0];
								$rsdup->Close();
								if($duplikat == 0)
								{
									$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik, uniqueid) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik','$varunique')";
									$hslins = $db->execute($sqlins);

									$sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
									$hslsel = $db->execute($sqlsel);
									$chk_inspartiss = $hslsel->RecordCount();

									if ($chk_inspartiss != 0){
										/* -- without MCCode --
										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', scan_nik = '$txtnik', scan_date = '$tglins'
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
																	AND issue_ke = '$issueke_oto'";
										$upd_partlist = $db->execute($sqlupd_partlist);
										/* -- without MCCode -- */

										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', scan_nik = '$txtnik', scan_date = '$tglins'
																WHERE
																		(status_scan IS NULL)
																	AND (kode = '$partcode')
																	and (scan_issue <> 0)
																	and so_number = '$txtso'
																	and partno = '$varpart'
																	AND issue_ke = '$issueke_oto'";
										$upd_partlist = $db->execute($sqlupd_partlist);
									}
									if($varunique != ''){
										$inputunique = "exec InsertScanUnique '{$varunique}','{$txtnik}'";
										$rsinputunique = $db->execute($inputunique);
									}
									/*
									$suara = 'ok1.wav';
									echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									*/
									echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/OK.mp3\" type=\"audio/mp3\"></audio>";
									echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data</h2>";
								}
								else
								{
									echo "<h1 id='soNotReg'>DUPLICATE SCAN !!!</h1>";
									$suara = 'partsudahdigunakan.mp3';
									//echo "<embed src =\"sound/$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									echo"<audio controls autoplay hidden=\"hidden\"><source src=\"../asset/sound/$suara\" type=\"audio/mp3\"></audio>";
								}
							}
							else if($chkpartlist != 0 && ($tot_qtyscan = $scan_issue)){
								$duplikat = 0;

								$sqlduplicate = "select dbo.validateScan('{$varunique}')";
								$rsdup = $db->Execute($sqlduplicate);
								$duplikat = $rsdup->fields[0];
								$rsdup->Close();
								if($duplikat == 0)
								{
									$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik, uniqueid) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik','$varunique')";
									$hslins = $db->execute($sqlins);

									$sqlsel = "select * from partiss where so = '$txtso' and partno = '$varpart' and partname = '$nilainama' and po = '$varpo' and bom = '$nilaibom' and reqqty = '$nilaireq' and scanqty = '$varqty' and lot = '$nilailot' and line = '$nilailine' and model = '$nilaimodel' and issdate = '$tglins' and nik = '$txtnik'";
									$hslsel = $db->execute($sqlsel);
									$chk_inspartiss2 = $hslsel->RecordCount();

									if ($chk_inspartiss2 != 0){
										/* -- without MCCode --
										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', status_scan = '1', scan_nik = '$txtnik', scan_date = '$tglins'
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
																	AND issue_ke = '$issueke_oto'";
										$upd_partlist = $db->execute($sqlupd_partlist);
										/* -- without MCCode -- */

										$sqlupd_partlist = "UPDATE partlist set tot_scan = '$tot_qtyscan', status_scan = '1', scan_nik = '$txtnik', scan_date = '$tglins'
																WHERE
																		(status_scan IS NULL)
																	AND (kode = '$partcode')
																	and (scan_issue <> 0)
																	and so_number = '$txtso'
																	and partno = '$varpart'
																	AND issue_ke = '$issueke_oto'";
										$upd_partlist = $db->execute($sqlupd_partlist);

									}

									if($varunique != ''){
										$inputunique = "exec InsertScanUnique '{$varunique}','{$txtnik}'";
										$rsinputunique = $db->execute($inputunique);
									}
									/*
									$suara = 'ok1.wav';
									echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									*/
									echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/OK.mp3\" type=\"audio/mp3\"></audio>";
									echo "<h2 align='center' id='SoNum'>Part OK...Inserting Data</h2>";
								}
								else
								{
									echo "<h1 id='soNotReg'>DUPLICATE SCAN !!!</h1>";
									$suara = 'partsudahdigunakan.mp3';
									//echo "<embed src =\"sound/$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									echo"<audio controls autoplay hidden=\"hidden\"><source src=\"../asset/sound/$suara\" type=\"audio/mp3\"></audio>";
								}

							}
							else if ($chkpartlist == 0){
								echo "<h1 id='soNotReg'>Check Partlist Table !!!</h1>";
								echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/SALAH.mp3\" type=\"audio/mp3\"></audio>";
								/*
								$suara = 'WrongParts2good.wav';
								echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
								*/
							}
						}
					}
				}  // end if ($wrongpart == 1 )

				if ($wrongpart == 0)  // wrong part
				{
					echo "<h1 id='soNotReg'>WRONG Part !!!</h1>";
					echo "<audio controls autoplay hidden=\"hidden\"><source src =\"../asset/sound/SALAH.mp3\" type=\"audio/mp3\"></audio>";
					/*
					$suara = 'WrongParts2good.wav';
					echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
					*/
				}

				// -------------------------------------------------
				// tampilkan data
			} //end of	if($txtbarcode != "")

			else{/* sebelumnya berisi table part issue */}  // end of else -------> if($txtbarcode != "")
		}
	?>
	<br>
	</body>
</html>
