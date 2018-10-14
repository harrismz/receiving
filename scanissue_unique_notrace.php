<?php
//	include "koneksi_edit.php";
		include "koneksi.php";

//	mendapatkan waktu sistem...
//	Setting Jam Indonesia //
		date_default_timezone_set('Asia/Jakarta');
		$Ymd = gmdate("Ymd");
		$wkt = date('H:i:s');
// 	==================== //

		$waktu		= getdate();
		$jam 			= $waktu['hours'];
		$menit 		= $waktu['minutes'];
		$detik	 	= $waktu['seconds'];
		$tanggal 	= $waktu['year']  . "-" . $waktu['mon'] . "-" . $waktu['mday'];
		$cjam 		= strlen($jam);
		$cmenit 	= strlen($menit);
		$cdetik 	= strlen($detik);
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
			#soNotReg {
				color:red;
				text-align:center;
			}
				p, #show_so{
					line-height: 50%;
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
				font-size: 16px;
			}
		</style>
	</head>
	<body>
		<?php
			$txtnikPost1	= isset($_POST['nik']) ? $_POST['nik'] : "";
			$txtsoPost1 	= isset($_POST['idso']) ? $_POST['idso'] : "";
			$varpartPost1	= isset($_POST['parthdn1']) ? $_POST['parthdn1'] : "";
			$varpartPost2	= isset($_POST['parthdn2']) ? $_POST['parthdn2'] : "";
			$varpoPost  	= isset($_POST['partpo2']) ? $_POST['partpo2'] : "";
			$varqtyPost 	= isset($_POST['partqty2']) ? $_POST['partqty2'] : "";

			$varuniquecode = ""; $varunique = "";
			if($varpartPost1 != "" and $varpartPost2 == ""){
				$varpartPost	= strtoupper($varpartPost1);
				$txtnik	    	= strtoupper(trim($txtnikPost1));
				$txtso	    	= strtoupper(trim($txtsoPost1));
				$varpart    	= trim(substr($varpartPost,0,15));
				$varpo      	= substr($varpartPost,16,7);
				$varqty     	= substr($varpartPost,24,5);
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


			if($txtsoPost1 == "" && $varpartPost1 == "" && $varpartPost2 == "" && $varpoPost == "" && $varqtyPost == "")
			//if($txtsoPost1 == "" && $varpartPost1 == "" )
			{
				echo "<br><h2 align='center'>Silahkan SCAN NIK ANDA untuk memulai</h2>";
			}
			else
			{
				echo '<p align="center">SO : <b>' . $txtso . '</b>&nbsp;&nbsp***';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PART NUMBER : <b>' . $varpart . '</b>&nbsp;&nbsp;***';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PO : <b>' . $varpo . '</b>&nbsp;&nbsp;***';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY : <b>' . $varqty . '</b>&nbsp;&nbsp;***';
				//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODE : <b>' . $varunique . '</b>&nbsp;&nbsp;***';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODE : <b>' . $varuniquecode . '</b>&nbsp;&nbsp;***</p>';

			//	cek data di detailcsv...
		  //	---    form pindah ke sini.......
		  	$sql_check = $db->Execute("select * from sa90m where so = '$txtso'");
		  	$row_check = $sql_check->RecordCount();
		  	if(!$row_check)
				{
			 		echo "<h1 id='soNotReg'>SO Number Belum Terdaftar</h1>";
				 	return false;
				}

				echo '<hr>';
				if($varpart != "")
				{
					$cekpart = 0;
					$wrongpart = 0;
					$duplikat = 0;

					$sqlduplicate = "select dbo.validateScan('{$varunique}')";
			 		$rsdup = $db->Execute($sqlduplicate);
					$duplikat = $rsdup->fields[0];
					$rsdup->Close();

					//	ambil data dari GROUP PARTNO SESUAI SO
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
							$wrongpart		= 1;
							$nilainama		= $row->fields[2];
							$nilaireq		= $row->fields[3];
							$nilaiscan		= $row->fields[4];
							$nilaibom		= $row->fields[5];
							$nilailot		= $row->fields[6];
							$nilailine		= $row->fields[7];
							$nilaimodel		= $row->fields[8];
							$cektotalqty	= $nilaiscan + $varqty;
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


					echo '<p align="center">STATUS :</p>';

					if ($wrongpart == 1)
					{
						if ($cekpart == 0)
						{
							echo "<h1 id='soNotReg'>QUANTITY OVER</h1>";
							$suara = 'Over2good.wav';
							//echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
							echo"<audio controls autoplay hidden=\"hidden\"><source src=\"$suara\" type=\"audio/mp3\"></audio>";
						}
						if ($cekpart == 1)
						{
								if($duplikat == 0)
								{
						 			$suara = 'ok1.wav';
									//echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									echo"<audio controls autoplay hidden=\"hidden\"><source src=\"$suara\" type=\"audio/mp3\"></audio>";
									echo "<br><h2 align='center'>Part OK...Inserting Data</h2>";

									//	part OK
											$sqlins = "insert into partiss(so,partno,partname,po,bom,reqqty,scanqty,lot,line,model,issdate, nik, uniqueid) values('$txtso','$varpart','$nilainama','$varpo','$nilaibom','$nilaireq','$varqty','$nilailot','$nilailine','$nilaimodel','$tglins','$txtnik','$varunique')";
											$hslins = $db->execute($sqlins);

											if($varunique != ''){
												$inputunique = "exec InsertScanUnique '{$varunique}','{$txtnik}'";
												$rsinputunique = $db->execute($inputunique);
											}
								}
								else
								{
									echo "<h1 id='soNotReg'>DUPLICATE SCAN !!!</h1>";
									$suara = 'partsudahdigunakan.mp3';
									//echo "<embed src =\"sound/$suara\" hidden=\"true\" autostart=\"true\"></embed>";
									echo"<audio controls autoplay hidden=\"hidden\"><source src=\"sound/$suara\" type=\"audio/mp3\"></audio>";
								}
						}
					}  // end if ($wrongpart == 1 )
					elseif ($wrongpart == 0)  // wrong part
					{
						echo "<h1 id='soNotReg'>WRONG Part !!!</h1>";
						$suara = 'WrongParts2good.wav';
						//echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
						echo"<audio controls autoplay hidden=\"hidden\"><source src=\"$suara\" type=\"audio/mp3\"></audio>";
					}


					//	-------------------------------------------------
					//	tampilkan data
				} //end of	if($txtbarcode != "")
				else
				{
					echo '<h1 align="center" id="show_so">' . $txtso . '</h1>';
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

					$sqlview = "select	a.so, a.partno, a.partname, a.qty,
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
						echo  '<td id="td_right_showpart">' . number_format($row->fields[5], 2, '.', '') . '</td>';
						echo  '<td id="td_showpart">' . $row->fields[6] . '</td>';
						echo  '<td id="td_showpart">' . $row->fields[7] . '</td>';
						echo  '<td id="td_showpart">' . $row->fields[8] . '</td>';
						echo  '</tr>';
						$partcek1 = $row->fields[1];
						$row->MoveNext();
					}

					echo '</table>';
					$row->close();
				}  // end of else -------> if($txtbarcode != "")
			} //else postingan
		?>
		<br>
		<br>
		<br>
	</body>
</html>
