<?php
	include "koneksi_edit.php";
	date_default_timezone_set("Asia/Jakarta");
	//$datenow  = "date_format(now(),'%Y-%m-%d %T')";
	$datenow  = "convert(varchar(20), getdate(), 120)";
	//$orderCodeDate = date('YmdHis');
	//echo"<br>";
	
	$micro_date = microtime();
	$date_array_temp = explode(" ",$micro_date);
	$date_array = substr($date_array_temp[0], 2, -4);
	$date = date("YmdHis");
	//$orderCodeDate = date("YmdHis",$date_array[1]);
	$orderCodeDate = $date.$date_array;
	
	
	$tmp_name = isset($_FILES['upl_partlist_android']['tmp_name']) ? $_FILES['upl_partlist_android']['tmp_name'] : '';
	$file_name= isset($_FILES['upl_partlist_android']['name']) ? $_FILES['upl_partlist_android']['name'] : '';
	$file_error	= isset($_FILES['upl_partlist_android']['error']) ? $_FILES['upl_partlist_android']['error'] : '';

	try{
		$sqlcheck = "SELECT * FROM partlist where filename = '{$file_name}'";
		$rscheck = $db->Execute($sqlcheck);
		$existcheck = $rscheck->RecordCount();
	}catch (exception $e){$var_msg = $db->ErrorNo();}
	
if($existcheck == 0){
	$pisah    = explode(".", $file_name);
	$arrays   = (count($pisah)-1);
	$typefile = $pisah[$arrays];
	
	$types		= 'CSV,csv';
	$lop		= explode(",",$types);
	$total		= count($lop);
	
	$validfile = false;
	for ($i = 0; $i < $total; $i++){
		if($typefile == $lop[$i]){
			$validfile = true;
		}
	}
	
	if($file_error > 0){
		echo 'error : '.$file_error.'<br><br><a href="http://136.198.117.48/receiving/frmupload_partlist.php">Back</a>';
	}
	else if ($validfile == false){
		echo 'file not valid, Please upload file with Format *.CSV !<br><br><a href="http://136.198.117.48/receiving/frmupload_partlist.php">Back</a>';
	}
	else{
		//echo 'valid';
		try{
		$departsub = substr($file_name, -11, 7); // returns "SMALLFA"

			if($departsub == 'SMALLFA'){
			
				$max_issue = "";
				$date_issue = "";
				$part = "";
				$sofa = "";
				$sosw = "";
				$line = "";
				$model = "";
				$prodno = "";
				$lot = "";
				$qtylot = "";
				
				if(is_uploaded_file($tmp_name)){
					$csv_file	= $tmp_name;
					$feed		= fopen($csv_file, 'r');
					$no			= 1;
					set_time_limit(3600);
					while($i = fgetcsv($feed, 1000, ",")){
						if ($no == 7)	{$max_issue = trim($i['34']);}
						if ($no == 8)	{$date_issue = trim($i['34']);}
						if ($no == 15)	{$part = trim($i['34']);}
						if ($no == 16)	{$sofa = trim($i['34']);}
						if ($no == 17)	{$sosw = trim($i['34']);}
						if ($no == 18)	{$line = trim($i['34']);}
						if ($no == 19)	{$model = trim($i['34']);}
						if ($no == 20)	{$prodno = trim($i['34']);}
						if ($no == 21)	{$lot = trim($i['34']);}
						if ($no == 22)	{$qtylot = trim(substr($i['34'],1));}
						$no++;
					}
					echo'<br>';
					/*kode otomatis*/
						$cd_line  = str_pad($line,2,"0", STR_PAD_LEFT);
						$cd_lot   = str_pad($lot,6,"0", STR_PAD_LEFT);
						$modelonly= str_replace('-','',$model);
						$cd_model = str_pad($modelonly,12,"0", STR_PAD_LEFT);
						$orderno  = $cd_line.$cd_lot.$cd_model;
					
						$partcode = str_pad($part,7,"0", STR_PAD_LEFT);
					//	$barcode	= $orderCodeDate.$cd_model.$partcode;
						$barcode	= $orderCodeDate;
					//	echo'<br><br><br>';
						/*
						try{
							$sqlcheck = "SELECT MAX(orderno) FROM partlist where orderno like '{$orderno}%'";
							$rscheck = $db->Execute($sqlcheck);
							$existcheck = $rscheck->RecordCount();
						}catch (exception $e){$var_msg = $db->ErrorNo();}
						
						echo'<br>'.$ordernokode = "090641510000KDX110UD99999";
						echo'<br>'.$kode = substr($ordernokode,-5);
								if($kode == '99999'){
									echo'<script type="text/javascript">alert("Data Model : ('.$model.') FULL !!")</script>';
								}
								else{
									echo'<br>'.$addkode = $kode+1;
									echo'<br>'.$hasilkode = str_pad($kode,5,"0", STR_PAD_LEFT);
									echo'<br>'.$ordernokode2 = $orderno.$hasilkode;
								}*/
					//	echo'<br><br><br>';
					/*end kode otomatis*/
					
					$csv_file2	= $tmp_name;
					$feed2		= fopen($csv_file2, 'r');
					$no2 = 1;
					set_time_limit(3600);
					while($i2 = fgetcsv($feed2, 1000, ",")){
						if($no2 >= 7){
							if(trim($i2['0']) == ""){ break; }
							for($issue_ke = 1; $issue_ke <= $max_issue; $issue_ke++){
								$issue = $issue_ke+5;
								if(trim($i2['0']) != ""){
									/*
									echo '<br>'. $line ." | ". $model ." | ".$prodno." | ".$lot." | ".$qtylot." | ".$date_issue.' | '. $part;
									echo ' | 0'. $so_part = trim($i2['33']);
									echo ' | '. $no_partlist = trim($i2['0']);
									echo ' | '. $zone = trim($i2['1']);
									echo ' | '. $partno = trim($i2['2']);
									echo ' | '. $partname = trim($i2['3']);
									echo ' |DEMAANNNND '. $demand = trim($i2['4']);
									echo ' | '. $issue_ke;
									echo ' |STDISSSSSUE '. $std_issue = trim($i2['5']);
									echo ' | '. $scan_issue = trim($i2[$issue]);
									*/
									
									$so_part = trim($i2['33']);
									$no_partlist = trim($i2['0']);
									$zone = trim($i2['1']);
									$partno = trim($i2['2']);
									$partname = trim($i2['3']);
									$demand = trim($i2['4']);
									$std_issue = trim($i2['5']);
									$scan_issue = trim($i2[$issue]);
									
									if($std_issue > $demand){ $std_issue2 = $demand; }
									else{ $std_issue2 =  $std_issue; }
									//echo ' |demandstdissue '. $std_issue2;
									
									
									if($scan_issue == 0){
										$sql = "INSERT INTO partlist (partdept, line, model, prod_no, lot, qty, date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, status_scan, upload_date, filename, orderno, kode) VALUES ('{$part}','{$line}','{$model}','{$prodno}','{$lot}','{$qtylot}','{$date_issue}','0{$so_part}','{$no_partlist}','{$zone}','{$partno}', '{$partname}','{$demand}','{$issue_ke}','{$std_issue2}','{$scan_issue}','2',$datenow,'{$file_name}','{$orderno}','{$barcode}')";
											$rs = $db->Execute($sql);
											//echo $sql.'<br>';
									}
									else{
										$sql = "INSERT INTO partlist (partdept, line, model, prod_no, lot, qty, date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, upload_date, filename, orderno, kode) VALUES ('{$part}','{$line}','{$model}','{$prodno}','{$lot}','{$qtylot}','{$date_issue}','0{$so_part}','{$no_partlist}','{$zone}','{$partno}', '{$partname}','{$demand}','{$issue_ke}','{$std_issue2}','{$scan_issue}',$datenow,'{$file_name}','{$orderno}','{$barcode}')";
											$rs = $db->Execute($sql);
											//echo $sql.'<br>';
									}
								}
								else{
									$no2++;
								}
							}
						}
						$no2++;
					}
				}
			}
			else{
			
				$max_issue = "";
				$date_issue = "";
				$part = "";
				$sofa = "";
				$sosw = "";
				$line = "";
				$model = "";
				$prodno = "";
				$lot = "";
				$qtylot = "";

				if(is_uploaded_file($tmp_name)){					
					$csv_file	= $tmp_name;
					$feed		= fopen($csv_file, 'r');
					$no			= 1;
					set_time_limit(3600);
					while($i = fgetcsv($feed, 1000, ",")){
						if ($no == 7){$max_issue = trim($i['34']);}
						if ($no == 8){$date_issue = trim($i['34']);}
						if ($no == 15){$part = trim($i['34']);}
						if ($no == 16){$sofa = trim($i['34']);}
						if ($no == 17){$sosw = trim($i['34']);}
						if ($no == 18){$line = trim($i['34']);}
						if ($no == 19){$model = trim($i['34']);}
						if ($no == 20){$prodno = trim($i['34']);}
						if ($no == 21){$lot = trim($i['34']);}
						if ($no == 22){$qtylot = trim(substr($i['34'],1));}
						$no++;
					}
			
			
			/*kode otomatis*/
				$cd_line  = str_pad($line,2,"0", STR_PAD_LEFT);
				$cd_lot   = str_pad($lot,6,"0", STR_PAD_LEFT);
				$modelonly= str_replace('-','',$model);
				$cd_model = str_pad($modelonly,12,"0", STR_PAD_LEFT);
				$orderno  = $cd_line.$cd_lot.$cd_model;
				
				$partcode = str_pad($part,7,"0", STR_PAD_LEFT);
			//	$barcode	= $orderCodeDate.$cd_model.$partcode;
				$barcode	= $orderCodeDate;
			
			
			
			//	echo'<br><br><br>';
				/*
				try{
					$sqlcheck = "SELECT MAX(orderno) FROM partlist where orderno like '{$orderno}%'";
					$rscheck = $db->Execute($sqlcheck);
					$existcheck = $rscheck->RecordCount();
				}catch (exception $e){$var_msg = $db->ErrorNo();}
				
				echo'<br>'.$ordernokode = "090641510000KDX110UD99999";
				echo'<br>'.$kode = substr($ordernokode,-5);
						if($kode == '99999'){
							echo'<script type="text/javascript">alert("Data Model : ('.$model.') FULL !!")</script>';
						}
						else{
							echo'<br>'.$addkode = $kode+1;
							echo'<br>'.$hasilkode = str_pad($kode,5,"0", STR_PAD_LEFT);
							echo'<br>'.$ordernokode2 = $orderno.$hasilkode;
						}*/
			//	echo'<br><br><br>';
			/*end kode otomatis*/
			
					$csv_file2	= $tmp_name;
					$feed2		= fopen($csv_file2, 'r');
					$no2 = 1;
					set_time_limit(3600);
					while($i2 = fgetcsv($feed2, 1000, ",")){
						if($no2 >= 7){
							if(trim($i2['0']) == ""){ break; }
							for($issue_ke = 1; $issue_ke <= $max_issue; $issue_ke++){
								$issue = $issue_ke+5;
								if(trim($i2['0']) != ""){
									/*echo '<br>'. $line ." | ". $model ." | ".$prodno." | ".$lot." | ".$qtylot." | ".$date_issue.' | '. $part;
									echo ' | 0'. $so_part = trim($i2['33']);
									echo ' | '. $no_partlist = trim($i2['0']);
									echo ' | '. $zone = trim($i2['1']);
									echo ' | '. $partno = trim($i2['2']);
									echo ' | '. $partname = trim($i2['3']);
									echo ' | '. $demand = trim($i2['4']);
									echo ' | '. $issue_ke;
									echo ' | '. $std_issue = trim($i2['5']);
									echo ' | '. $scan_issue = trim($i2[$issue]);
									*/
									
									$so_part = trim($i2['33']);
									$no_partlist = trim($i2['0']);
									$zone = trim($i2['1']);
									$partno = trim($i2['2']);
									$partname = trim($i2['3']);
									$demand = trim($i2['4']);
									$std_issue = trim($i2['5']);
									$scan_issue = trim($i2[$issue]);
									if($scan_issue == 0){
										$sql = "INSERT INTO partlist (partdept, line, model, prod_no, lot, qty, date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, status_scan, upload_date, filename, orderno, kode) VALUES ('{$part}','{$line}','{$model}','{$prodno}','{$lot}','{$qtylot}','{$date_issue}','0{$so_part}','{$no_partlist}','{$zone}','{$partno}', '{$partname}','{$demand}','{$issue_ke}','{$std_issue}','{$scan_issue}','2',$datenow,'{$file_name}','{$orderno}','{$barcode}')";
											$rs = $db->Execute($sql);
											//echo $sql.'<br>';
									}
									else{
										$sql = "INSERT INTO partlist (partdept, line, model, prod_no, lot, qty, date_issue, so_number, no, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, upload_date, filename, orderno, kode) VALUES ('{$part}','{$line}','{$model}','{$prodno}','{$lot}','{$qtylot}','{$date_issue}','0{$so_part}','{$no_partlist}','{$zone}','{$partno}', '{$partname}','{$demand}','{$issue_ke}','{$std_issue}','{$scan_issue}',$datenow,'{$file_name}','{$orderno}','{$barcode}')";
											$rs = $db->Execute($sql);
											//echo $sql.'<br>';
									}
								}
								else{
									$no2++;
								}
							}
						}
						$no2++;
					}
				}
			}
			
		/*	$sql1 = "select top 1 * from partiss";
			$rs1 = $db->Execute($sql1);
			while ($rs1->EOF){
				$test = $rs1->fields[1];
			}
		*/
			echo 'Upload File Success<br><br><a href="http://136.198.117.48/receiving/frmupload_partlist.php">Back</a>';
			//header('location:http://136.198.117.48/receiving/frmupload_partlist.php?i=success');
		}catch(exception $e){$var_msg = $db->ErrorNo();}
	}
}else{ echo 'Data Already Exists !!<br><br><a href="http://136.198.117.48/receiving/frmupload_partlist.php">Back</a>';
//header('location:http://136.198.117.48/receiving/frmupload_partlist.php?i=exist'); 
}	
	
	
$db->Close();
$db=null;
?>