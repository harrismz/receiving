<?php
	include "koneksi_edit.php";
	
	$datenow  = "date_format(now(),'%Y-%m-%d %T')";
	$tmp_name = isset($_FILES['upl_partlist_android']['tmp_name']) ? $_FILES['upl_partlist_android']['tmp_name'] : '';
	$file_name= isset($_FILES['upl_partlist_android']['name']) ? $_FILES['upl_partlist_android']['name'] : '';
	$file_error	= isset($_FILES['upl_partlist_android']['error']) ? $_FILES['upl_partlist_android']['error'] : '';
	
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
		echo 'error : '.$file_error;
	}
	if ($validfile == false){
		echo 'file not valid, Please upload file with Format *.CSV !';
	}
	else{
		//echo 'valid';
		
		try{
			if(is_uploaded_file($tmp_name)){
				$csv_file	= $tmp_name;
				$feed		= fopen($csv_file, 'r');
				$no			= 1;
				set_time_limit(3600);
				while($i = fgetcsv($feed, 1000, ",")){
					if ($no == 7){
						echo '<br>maxissue='. $max_issue = trim($i['34']);
					}
					if ($no == 8){
						echo ' |dateissue= '. $date_issue = trim($i['34']);
					}
					if ($no == 15){
						echo ' |part= '. $part = trim($i['34']);
					}
					if ($no == 16){
						echo ' |sofa= 0'. $sofa = trim($i['34']);
					}
					if ($no == 17){
						echo ' |sosw= 0'. $sosw = trim($i['34']);
					}
					if ($no == 18){
						echo ' |line= '. $line = trim($i['34']);
					}
					if ($no == 19){
						echo ' |model= '. $model = trim($i['34']);
					}
					if ($no == 20){
						echo ' |prodno= '. $prodno = trim($i['34']);
					}
					if ($no == 21){
						echo ' |lot= '. $lot = trim($i['34']);
					}
					if ($no == 22){
						echo ' |qtylot= '. $qtylot = trim(substr($i['34'],1));
					}
					$no++;
				}
				
				$csv_file2	= $tmp_name;
				$feed2		= fopen($csv_file2, 'r');
				$no2 = 1;
				set_time_limit(3600);
				while($i2 = fgetcsv($feed2, 1000, ",")){
					if($no2 >= 7){
						if(trim($i2['0']) == ""){ break; }
						
						echo '<br><br>'.trim($i2['0']);
						
						for($issue_ke = 1; $issue_ke <= $max_issue; $issue_ke++){
							$issue = $issue_ke+5;
							if(trim($i2['0']) != ""){
								echo '<br>'. $line ." | ". $model ." | ".$prodno." | ".$lot." | ".$qtylot." | ".$date_issue.' | '. $part;
								echo ' | 0'. $so_part = trim($i2['33']);
								echo ' | '. $no_partlist = trim($i2['0']);
								echo ' | '. $zone = trim($i2['1']);
								echo ' | '. $partno = trim($i2['2']);
								echo ' | '. $partname = trim($i2['3']);
								echo ' | '. $demand = trim($i2['4']);
								echo ' | '. $issue_ke;
								echo ' | '. $std_issue = trim($i2['5']);
								echo ' | '. $scan_issue = trim($i2[$issue]);
							}
							else{
								$no2++;
							}
						}
						
					}
					$no2++;
				/*	
					if($no2 >= 7 && $no2 <= $max_issue2){
						$issue_ke = 1;
						echo '<br><br>'.trim($i2['0']).'<br>';
						for($issue_ke = 1; $issue_ke <= $max_issue; $issue_ke++){
							$issue = $issue_ke+5;
							if(trim($i2['0']) != ""){
								echo '<br>'. $line ." | ". $model ." | ".$prodno." | ".$lot." | ".$qtylot." | ".$date_issue.' | '. $part;
								echo ' | 0'. $so_part = trim($i2['33']);
								echo ' | '. $no_partlist = trim($i2['0']);
								echo ' | '. $zone = trim($i2['1']);
								echo ' | '. $partno = trim($i2['2']);
								echo ' | '. $partname = trim($i2['3']);
								echo ' | '. $demand = trim($i2['4']);
								echo ' | '. $issue_ke;
								echo ' | '. $std_issue = trim($i2['5']);
								echo ' | '. $scan_issue = trim($i2[$issue]);
							}
							else{
								$no2++;
							}
						}
					}
					$no2++;
				*/
				}
			}
		}catch(exception $e){$var_msg = $db->ErrorNo();}
	}
	
	
?>