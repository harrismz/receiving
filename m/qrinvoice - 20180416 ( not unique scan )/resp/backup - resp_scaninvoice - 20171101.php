<?php
	/*
	****	create by Mohamad Yunus
	****	on 28 Sept 2016
	*/
	
	include('../con_mysql.php');
	

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
		$varpart 	= trim(substr($barcode,0,15));
		$varpo 		= trim(substr($barcode,16,7));
		$varqty  	= trim(substr($barcode,24,5));
		
		//	cek part no in sa96
		$rs 		= $db->Execute("select count(*) from sa96t where iprod = '{$varpart}' and icfac = 'D1'");
		$ceksa96	= $rs->fields[0];
		$rs->Close();
		if($ceksa96 == 0){
			$var_msg = 91;
		}
		else{
			//	cek po+supplier in vb36
			$rs 		= $db->Execute("select count(*) from vb36t where vb36pono = '{$varpo}' and vb36vend = '{$supp}'");
			$cekvb36	= $rs->fields[0];
			$rs->Close();
			if($cekvb36 == 0){
				$var_msg = 92;
			}
			else{
				//	get flag
				$rs 		= $db->Execute("select count(*) from sa96t where iprod = '{$varpart}' and icfac = 'D1' and imincl = 1");
				$cekflag	= $rs->fields[0];
				$rs->Close();
				if( $cekflag == 0){
					$flag = 2;
				}
				else{
					$flag = 1;
				}
				
				$rs 		= $db->Execute("insert into rectrx(	part, po, qty, supp, inv, custom, insflg, 
																rcvdate, sndflg, snddate, userid, wsid, partname,
																lbldate, supprddate, supqcpic, shift, vl, electest)
														select 	'{$varpart}', '{$varpo}', '{$varqty}', '{$supp}', '{$invoice}', 'TesCustom', '{$flag}', 
																now(), 'N', date_format(now(), '%Y-%m-%d'), '{$varnik}', '{$ip}', 'TesPName',
																date_format(now(), '%Y-%m-%d'), date_format(now(), '%Y-%m-%d'), 'TesSPic', 'TesShift', 'TesVL', 'TesElecTest'");
				$rs->Close();
				
				//$echo = $varpart.'@@'.$varpo.'@@'.$varqty.'@@'.$supp.'@@'.$invoice.'@@TesCustom'.$flag.'@@NOW()@@TesSndFlg';
				
				$var_msg = 1;
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
			
		case 1:
			//	"1," fungsi untuk pembeda success message
			echo '1, OKE';
			break;
	}
	
	//	connection close
	$db->Close();
?>