<?php 
include "koneksi_edit.php";

//==GET SYSTEM TIME===========
date_default_timezone_set('Asia/Jakarta');
$Ymd = gmdate("Ymd");
$wkt = date('H:i:s');
//============================
?>

<html>
	<head>
		<style>
			#dt_partlist thead{
				_background-color:#009999;
				background-color:#003399;
				display: block;
				color:#fff;
			}
			#dt_partlist tbody{
				display: block;
				overflow-y: scroll; 
				max-height: 400px;
				position: static;
				font-size:14px;
			}
			#dt_partlist th{
				vertical-align: top;
				padding:2px 2px;
				text-align: center;
			}
			#dt_partlist td{
				vertical-align: top;
				padding:2px 2px;
				text-align: center;
				white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
				white-space: -webkit-pre-wrap; /*Chrome & Safari */ 
				white-space: -pre-wrap;      /* Opera 4-6 */
				white-space: pre-wrap;       /* css-3 */
				word-wrap: break-word;       /* Internet Explorer 5.5+ */
				word-break: break-all;
				white-space: normal;
			}
			#dt_partlist th:nth-child(1), #dt_partlist td:nth-child(1)  { /*no*/
				min-width:50px;
			}
			#dt_partlist td:nth-child(1){ /**no*/
				text-align:center;
			}
			#dt_partlist th:nth-child(2), #dt_partlist td:nth-child(2) { /*so*/
				min-width:100px;
			}
			#dt_partlist td:nth-child(2){ /**so*/
				text-align:center;
			}
			#dt_partlist th:nth-child(3), #dt_partlist td:nth-child(3) { /*zone*/
				min-width:70px;
			}
			#dt_partlist td:nth-child(3){ /*zone*/
				text-align:center;
			}
			#dt_partlist th:nth-child(4), #dt_partlist td:nth-child(4) { /*partno*/
				min-width:150px;
			}
			#dt_partlist td:nth-child(4){ /*partno*/
				text-align:left;
			}
			#dt_partlist th:nth-child(5), #dt_partlist td:nth-child(5) { /*partname*/
				min-width:200px;
			}
			#dt_partlist td:nth-child(5){ /*partname*/
				text-align:left;
			}
			#dt_partlist th:nth-child(6), #dt_partlist td:nth-child(6){ /*demand*/
				min-width:70px;
			}
			#dt_partlist td:nth-child(6){ /*demand*/
				text-align:right;
			}
			/*
			#dt_partlist th:nth-child(7), #dt_partlist td:nth-child(7){ /*issueke*/
			/*	min-width:80px;
			}
			#dt_partlist td:nth-child(7){ /*issueke*/
			/*	text-align:center;
			}
			*/
			#dt_partlist th:nth-child(7), #dt_partlist td:nth-child(7){ /*stdissue*/
				min-width:70px;
			}
			#dt_partlist td:nth-child(7){ /*stdissue*/
				text-align:right;
			}
			#dt_partlist th:nth-child(8), #dt_partlist td:nth-child(8){ /*scanissue*/
				min-width:70px;
			}
			#dt_partlist td:nth-child(8){ /*scanissue*/
				text-align:right;
			}
			#dt_partlist th:nth-child(9), #dt_partlist td:nth-child(9){ /*totalscan*/
				min-width:70px;
			}
			#dt_partlist td:nth-child(9){ /*totalscan*/
				text-align:right;
			}
			/*
			#dt_partlist th:nth-child(10){ /*statusscan*/
			/*   min-width:50px;
			}
			#dt_partlist td:nth-child(10){ /*statusscan*/
			/*	min-width:50px;
				text-align: left;
			}
			*/
			#dt_partlist th + th, #dt_partlist td + td {
				border-left:1px solid #ddd;
			}
		</style>
	</head>
	<body>
		<?php
			$dept_part= isset($_POST['dept_part']) ? $_POST['dept_part'] : ""; 
			$issueke  = isset($_POST['issueke']) ? $_POST['issueke'] : ""; 
			$date_part= isset($_POST['date_part']) ? $_POST['date_part'] : ""; 
			$line     = isset($_POST['line']) ? $_POST['line'] : ""; 
			$model    = isset($_POST['model']) ? $_POST['model'] : ""; 
			$prodno   = isset($_POST['prodno']) ? $_POST['prodno'] : ""; 
			$lot      = isset($_POST['lot']) ? $_POST['lot'] : ""; 
			$qty      = isset($_POST['qty']) ? $_POST['qty'] : ""; 
			try{
			/*	echo $sql = "SELECT no, so_number, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, tot_scan, status_scan FROM partlist
				WHERE (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty')
				AND (issue_ke = (SELECT MIN(issue_ke) AS min_issue FROM partlist AS issue_partlist WHERE (status_scan IS NULL) AND (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty')))";
			*/
			if ($issueke == ""){
				echo'<br>'. $sql = "SELECT no, so_number, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, tot_scan, status_scan,
				(  SELECT sum(a.tot_scan) FROM partlist a WHERE (a.partdept = '$dept_part') AND (a.date_issue = '$date_part') AND (a.line = '$line') AND (a.model = '$model') AND (a.prod_no = '$prodno') AND (a.lot = '$lot') AND (a.qty = '$qty') AND (a.partno =  partlist.partno)) as alltotscan
				FROM partlist
					WHERE (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty')
					AND (issue_ke = (SELECT MIN(issue_ke) as issueke FROM partlist WHERE (status_scan IS NULL) AND (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty') and (scan_issue <> 0)))";
					$rspart = $db->Execute($sql);
				//	$exist = $rspart->RecordCount();

			}
			else{
				echo'<br>'. $sql = "SELECT no, so_number, zone, partno, partname, demand, issue_ke, std_issue, scan_issue, tot_scan, status_scan,
				(  SELECT sum(a.tot_scan) FROM partlist a WHERE (a.partdept = '$dept_part') AND (a.date_issue = '$date_part') AND (a.line = '$line') AND (a.model = '$model') AND (a.prod_no = '$prodno') AND (a.lot = '$lot') AND (a.qty = '$qty') AND (a.partno =  partlist.partno)) as alltotscan
				FROM partlist
					WHERE (partdept = '$dept_part') AND (date_issue = '$date_part') AND (line = '$line') AND (model = '$model') AND (prod_no = '$prodno') AND (lot = '$lot') AND (qty = '$qty')
					AND (issue_ke = '$issueke')";
					$rspart = $db->Execute($sql);
				//	$exist = $rspart->RecordCount();
			}
			
			
			}
			catch (Exception $ex){
				echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
			}
		?>
		
		<table id="dt_partlist">
			<thead>
				<tr>
					<th>NO</th>
					<th>SO NUMBER</th>
					<th>ZONE</th>
					<th>PART NO</th>
					<th>PART NAME</th>
					<th>DEMAND</th>
					<!--<th>ISSUE KE</th>-->
					<th>STD<br>ISSUE</th>
					<th>SCAN<br>ISSUE</th>
					<th>TOTAL<br>SCAN</th>
					<!--<th>STATUS<br>SCAN</th>-->
				</tr>
			</thead>
			<tbody>
				<?php
		//			if ($exist == 0){
				?>
		<!--			<tr>
						<td align="center" colspan="11">
							<article>Sorry, No Data Available</article>
						</td>
					</tr>
		-->		<?php
		//			}
		//			else{
						$no = 0;
						while(!$rspart->EOF){
							$no++;
							$prt_no         = $rspart->fields['0'];
							$prt_sonum      = $rspart->fields['1'];
							$prt_zone       = $rspart->fields['2'];
							$prt_partno     = $rspart->fields['3'];
							$prt_partname   = $rspart->fields['4'];
							$prt_demand     = $rspart->fields['5'];
							$prt_issue_ke   = $rspart->fields['6'];
							$prt_std_issue  = $rspart->fields['7'];
							$prt_scan_issue = $rspart->fields['8'];
							$prt_tot_scan   = $rspart->fields['9'];
							$prt_status_scan= intval($rspart->fields['10']);
							if($prt_status_scan == "1"){
								echo'<tr style="background-color:lightgreen;">';
							}
							elseif($prt_status_scan == "2"){
								echo'<tr style="background-color:gray;">';
							}
							else{
								echo'<tr>';
							}
							$alltot_scan   = $rspart->fields['11'];
				?>
								<td><?=$no?></td>
								<td><?=$prt_sonum?></td>
								<td><?=$prt_zone?></td>
								<td><?=$prt_partno?></td>
								<td><?=$prt_partname?></td>
								<td><?=$prt_demand?></td>
								<!--<td><?//=$prt_issue_ke?></td>-->
								<!--<td><?//=$prt_std_issue?></td>-->
								<td><?=$prt_scan_issue?></td>
								<td><?=$prt_tot_scan?></td>
								<td><?=$alltot_scan?></td>
								<!--<td><?//=$prt_status_scan?></td>-->
							</tr>
				<?php
							$rspart->MoveNext();
						}				
		//			}
				?>
			</tbody>
		</table>
		
		
		<?php
			
		?>
	</body>
</html>