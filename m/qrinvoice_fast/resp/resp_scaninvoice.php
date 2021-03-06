<?php
	/*
	****	create by Mohamad Yunus
	****	on 28 Sept 2016
	****	remark:  merubah nama koneksi (on line 8 - by Mohamad Yunus - 20171101)
	*/
	
	include('../con_qrinvoice.php');
	

	//	declare
	$nik 		= strtoupper(@$_REQUEST["nik"]);
	$supp 		= strtoupper(@$_REQUEST["supp"]);
	$invoice 	= strtoupper(@$_REQUEST["invoice"]);
	$custno 	= strtoupper(@$_REQUEST["custno"]);
	$barcode 	= strtoupper(@$_REQUEST["barcode"]);
	$ip			= getenv("REMOTE_ADDR");
	
	//	execute query
	try
	{
		//	get nik
		if( strlen($nik) == 8 ){
			$varnik	= trim(substr($nik,2,5));
		}else{
			$varnik = $nik;
		}	
		
		//	parse barcode
		$varpart 		= trim(substr($barcode,0,15));
		$varpo 			= trim(substr($barcode,16,7));
		$varqty  		= trim(substr($barcode,24,5));
		$varunique  	= substr($barcode,30,46);
		
		//	cek part no in sa96
		//echo "select count(*) from sa96t where iprod = '{$varpart}' and icfac = 'D1'";
		$rs 		= $db->Execute("select count(*) from sa96t where iprod = '{$varpart}' and icfac = 'D1'");
		$ceksa96	= $rs->fields[0];
		$rs->Close();
		if($ceksa96 == 0){
			$var_msg = 91;
		}
		else{
			//	cek po+supplier in vb36
			//echo "select count(*) from vb36t where vb36pono = '{$varpo}' and vb36vend = '{$supp}'";
			$rs 		= $db->Execute("select count(*) from vb36t where vb36pono = '{$varpo}' and vb36vend = '{$supp}'");
			$cekvb36	= $rs->fields[0];
			$rs->Close();
			if($cekvb36 == 0){
				$var_msg = 92;
			}
			else{
				
				$duplikat = 0;
				
				//echo "select dbo.validateScan('{$varunique}')";
				$sqlduplicate = "select dbo.validateScan('{$varunique}')";
				$rsdup = $db->Execute($sqlduplicate);
				$duplikat = $rsdup->fields[0];
				$rsdup->Close();
				
				$checkunix = 0;
				$checkunix = strlen($varunique);
				if ($checkunix == 46 or $varunique == "" or $checkunix == 0)
				{
					if($duplikat == 0)
					{
						//	get flag
						//echo "select count(*) from sa96t where iprod = '{$varpart}' and icfac = 'D1' and imincl = 1";
					
						$rs 		= $db->Execute("select count(*) from sa96t where iprod = '{$varpart}' and icfac = 'D1' and imincl = 1");
						$cekflag	= $rs->fields[0];
						$rs->Close();
						if( $cekflag == 0){
							//	Inspection
							$flag = 2;
						}
						else{
							//	Direct
							$flag = 1;
						}
						//echo "insert into rectrx(	part, po, qty, supp, inv, custom, insflg, 
						//												rcvdate, sndflg, snddate, userid, wsid, partname,
						//												lbldate, supprddate, supqcpic, shift, vl, electest)
						//										select 	'{$varpart}', '{$varpo}', '{$varqty}', '{$supp}', '{$invoice}', '{$custno}', '{$flag}', 
						//												convert(varchar(20), getdate(), 120), 'TES', convert(varchar(20), getdate(), 120), '{$varnik}', '{$ip}', 'TesPName',
						//												convert(varchar(20), getdate(), 120), convert(varchar(20), getdate(), 120), 'TesSPic', 'TesShift', 'TesVL', 'TesElecTest'";
						$rs 		= $db->Execute("insert into rectrx(	part, po, qty, supp, inv, custom, insflg, 
																		rcvdate, sndflg, snddate, userid, wsid, partname,
																		lbldate, supprddate, supqcpic, shift, vl, electest, UNIQUEID)
																select 	'{$varpart}', '{$varpo}', '{$varqty}', '{$supp}', '{$invoice}', '{$custno}', '{$flag}', 
																		convert(varchar(20), getdate(), 120), 'N', convert(varchar(20), getdate(), 120), '{$varnik}', '{$ip}', 'TesPName',
																		convert(varchar(20), getdate(), 120), convert(varchar(20), getdate(), 120), 'TesSPic', 'TesShift', 'TesVL', 'TesElecTest','{$varunique}'");
						$rs->Close();
						
						if($varunique != ''){
							echo $inputunique = "exec InsertScanUnique '{$varunique}','{$nik}'";
							$rsinputunique = $db->execute($inputunique);
						}
						
						$var_msg = 1;
					}
					else
					{
						$var_msg = 1000;
					}
				}
				else
				{
					$var_msg = 1001;
					//	echo "<h1 id='soNotReg'>SCAN SALAH !!!</h1>";
					//	$suara = 'scansalah.mp3';
					//	//echo "<embed src =\"sound/$suara\" hidden=\"true\" autostart=\"true\"></embed>";
					//	echo '<audio controls autoplay hidden="hidden"><source src="sound/scansalah.mp3" type"audio/mp3"></audio>';
				}
			}
			//	end of cek po+supplier in vb36
		}
		//	end of cek part no in sa96
	}
	catch (exception $e)
	{
		$var_msg = $db->ErrorNo();
	}
	
	//	message
	switch ($var_msg)
	{
		case $db->ErrorNo():
			$err		= $db->ErrorMsg();
			$error 		= str_replace(chr(39), "", $err);
			
			//	"0," fungsi untuk pembeda error message
			echo "0,".$error;
			break;
		
		case 91:
			//	"0," fungsi untuk pembeda error message
			echo '0, Part Number Not Available in SA96, Part_Tidak_Ada';
			break;
		
		case 92:
			//	"02," fungsi untuk pembeda error message
			echo '0, PO and Supplier Not Available in VB36, Order_Tidak_Ada';
			break;
		
		case 1000:
			//	"0," fungsi untuk pembeda success message
			echo '0, Duplicate Part, partsudahdigunakan';
			break;
			
		case 1001:
			//	"0," fungsi untuk pembeda success message
			echo '0, Scan Salah, scansalah';
			break;
			
		case 1:
			//	"1," fungsi untuk pembeda success message
			echo '1, OKE';
			break;
	}
	
	//	connection close
	$db->Close();
?>