<?php 
//include "koneksi_edit.php";
include "koneksi.php";

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
				font-size:12px;
			}
			#dt_partlist tbody{
				display: block;
				overflow-y: scroll; 
				max-height: 480px;
				position: static;
				font-size:10px;
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
				min-width:25px;
			}
			#dt_partlist td:nth-child(1){ /**no*/
				text-align:center;
			}
			#dt_partlist th:nth-child(2), #dt_partlist td:nth-child(2) { /*so*/
				min-width:70px;
			}
			#dt_partlist td:nth-child(2){ /**so*/
				text-align:center;
			}
			#dt_partlist th:nth-child(3), #dt_partlist td:nth-child(3) { /*zone*/
				min-width:45px;
			}
			#dt_partlist td:nth-child(3){ /*zone*/
				text-align:center;
			}
			#dt_partlist th:nth-child(4), #dt_partlist td:nth-child(4) { /*partname*/
				min-width:150px;
			}
			#dt_partlist td:nth-child(4){ /*partno*/
				text-align:left;
			}
			#dt_partlist th:nth-child(5), #dt_partlist td:nth-child(5) { /*partno*/
				min-width:100px;
			}
			#dt_partlist td:nth-child(5){ /*partname*/
				text-align:left;
			}
			#dt_partlist th:nth-child(6), #dt_partlist td:nth-child(6){ /*demand*/
				min-width:60px;
			}
			#dt_partlist td:nth-child(6){ /*demand*/
				text-align:right;
			}
			#dt_partlist th:nth-child(7), #dt_partlist td:nth-child(7){ /*stdissue*/
				min-width:60px;
			}
			#dt_partlist td:nth-child(7){ /*stdissue*/
				text-align:right;
			}
			#dt_partlist th:nth-child(8), #dt_partlist td:nth-child(8){ /*scanissue*/
				min-width:60px;
			}
			#dt_partlist td:nth-child(8){ /*scanissue*/
				text-align:right;
			}
			#dt_partlist th:nth-child(9), #dt_partlist td:nth-child(9){ /*totalscan*/
				min-width:60px;
			}
			#dt_partlist td:nth-child(9){ /*totalscan*/
				text-align:right;
			}
			#dt_partlist th + th, #dt_partlist td + td {
				border-left:1px solid #ddd;
			}
			#noavailable{
				background-color:red;
				color:#fff;
				font-size: 15px;
				width : 910px;
			}
			.ast-focus:hover{
				font-weight: bold;
				font-size: 12px;
				color:navy;
				background-color:#ffccb3;
			}
		</style>
	</head>
	<body>
		<?php
			$partcode = isset($_POST['partcode']) ? $_POST['partcode'] : ""; 
			$issueke  = isset($_POST['issueke']) ? $_POST['issueke'] : ""; 
			try{
				if ($issueke == ""){
					$sql = "SELECT b.no, b.so_number, b.zone, b.partno, b.partname, b.demand, b.issue_ke, b.std_issue, b.scan_issue, b.tot_scan, b.status_scan,
					(select sum(a.scanqty) from partiss a where a.so = b.so_number and a.partno = b.partno) as alltotscan
					FROM partlist b
						WHERE (b.kode = '$partcode') 
						AND (b.issue_ke = (SELECT MIN(issue_ke) as issueke FROM partlist
											WHERE (status_scan IS NULL)
											AND (kode = '$partcode')
											AND (scan_issue <> 0)))";
						$rspart = $db->Execute($sql);
						$exist = $rspart->RecordCount();

				}
				else{
					$sql = "SELECT b.no, b.so_number, b.zone, b.partno, b.partname, b.demand, b.issue_ke, b.std_issue, b.scan_issue, b.tot_scan, b.status_scan,
					(select sum(a.scanqty) from partiss a where a.so = b.so_number and a.partno = b.partno) as alltotscan
					FROM partlist b
						WHERE (b.kode = '$partcode') 
						AND (b.issue_ke = '$issueke')";
						$rspart = $db->Execute($sql);
						$exist = $rspart->RecordCount();
				}
			}
			catch (Exception $ex){
				echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
			}
		?>
		
		<table id="dt_partlist" align="center">
			<thead>
				<tr>
					<th>NO</th>
					<th>SO NUMBER</th>
					<th>ZONE</th>
					<th>PART NAME</th>
					<th>PART NO</th>
					<th>DEMAND</th>
					<th>STD<br>ISSUE</th>
					<th>SCAN<br>ISSUE</th>
					<th>TOTAL<br>SCAN</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if ($exist == 0){
				?>
					<tr>
						<td id="noavailable" colspan="9">
							<article>Sorry, No Data Available</article>
						</td>
					</tr>
				<?php
					}
					else{
						$no = 0;
						while(!$rspart->EOF){
							$no++;
							$prt_no         = $rspart->fields['0'];
							$prt_sonum      = $rspart->fields['1'];
							$prt_zone       = $rspart->fields['2'];
							$prt_partno     = $rspart->fields['3'];
							$prt_partname   = $rspart->fields['4'];
							$prt_demand     = number_format($rspart->fields['5'], 2, '.', '');
							$prt_issue_ke   = $rspart->fields['6'];
							$prt_std_issue  = number_format($rspart->fields['7'], 2, '.', '');
							$prt_scan_issue = number_format($rspart->fields['8'], 2, '.', '');
							$prt_tot_scan   = number_format($rspart->fields['9'], 2, '.', '');
							$prt_status_scan= intval($rspart->fields['10']);
							if($prt_status_scan == "1"){
								echo'<tr style="background-color:lightgreen;">';
							}
							elseif($prt_status_scan == "2"){
								echo'<tr style="background-color:gray;">';
							}
							else{
								echo'<tr class="ast-focus">';
							}
							$alltot_scan   = number_format($rspart->fields['11'], 2, '.', '');
				?>
								<td><?=$no?></td>
								<td><?=$prt_sonum?></td>
								<td><?=$prt_zone?></td>
								<td><?=$prt_partname?></td>
								<td><?=$prt_partno?></td>
								<td><?=$prt_demand?></td>
								<td><?=$prt_scan_issue?></td>
								<td><?=$prt_tot_scan?></td>
								<td><?=$alltot_scan?></td>
							</tr>
				<?php
							$rspart->MoveNext();
						}				
					}
				?>
			</tbody>
		</table>
	</body>
</html>