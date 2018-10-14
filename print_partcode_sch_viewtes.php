<?php 
//include "koneksi_edit.php";
include "koneksi.php";

//==GET SYSTEM TIME===========
date_default_timezone_set('Asia/Jakarta');
$Ymd = gmdate("Ymd");
$wkt = date('H:i:s');
$tgl_skrg = date('d F Y');
//============================
?>

<html>
	<head>
		<title>PRINT PARTLIST SCHEDULE</title>
		<style>
			#dt_printpartlist thead{
				_background-color:#009999;
				background-color:#003399;
				display: block;
				color:#fff;
				font-size:15px;
			}
			#dt_printpartlist tbody{
				display: block;
				overflow-y: scroll; 
				max-height: 550px;
				position: static;
				font-size:15px;
			}
			#dt_printpartlist th{
				vertical-align: top;
				padding:2px 2px;
				text-align: center;
			}
			#dt_printpartlist td{
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
			#dt_printpartlist th:nth-child(1), #dt_printpartlist td:nth-child(1)  { /*no*/
				min-width:25px;
			}
			#dt_printpartlist td:nth-child(1){ /**no*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(2), #dt_printpartlist td:nth-child(2) { /*dept*/
				min-width:70px;
			}
			#dt_printpartlist td:nth-child(2){ /**dept*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(3), #dt_printpartlist td:nth-child(3) { /*line*/
				min-width:45px;
			}
			#dt_printpartlist td:nth-child(3){ /*line*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(4), #dt_printpartlist td:nth-child(4) { /*model*/
				min-width:150px;
			}
			#dt_printpartlist td:nth-child(4){ /*model*/
				text-align:left;
			}
			#dt_printpartlist th:nth-child(5), #dt_printpartlist td:nth-child(5) { /*prodno*/
				min-width:80px;
			}
			#dt_printpartlist td:nth-child(5){ /*prodno*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(6), #dt_printpartlist td:nth-child(6){ /*lot*/
				min-width:60px;
			}
			#dt_printpartlist td:nth-child(6){ /*lot*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(7), #dt_printpartlist td:nth-child(7){ /*qty*/
				min-width:60px;
			}
			#dt_printpartlist td:nth-child(7){ /*qty*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(8), #dt_printpartlist td:nth-child(8){ /*dateissue*/
				min-width:110px;
			}
			#dt_printpartlist td:nth-child(8){ /*dateissue*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(9), #dt_printpartlist td:nth-child(9){ /*barcode*/
				min-width:310px;
			}
			#dt_printpartlist td:nth-child(9){ /*barcode*/
				text-align:center;
			}
			#dt_printpartlist th:nth-child(10), #dt_printpartlist td:nth-child(10){ /*pic*/
				min-width:90px;
			}
			#dt_printpartlist td:nth-child(10){ /*pic*/
				text-align:right;
			}
			#dt_printpartlist th:nth-child(11), #dt_printpartlist td:nth-child(11){ /*remark*/
				min-width:90px;
			}
			#dt_printpartlist td:nth-child(11){ /*remark*/
				text-align:right;
			}
			#dt_printpartlist th + th, #dt_printpartlist td + td {
				border-left:1px solid #ddd;
			}
			/*th{
				padding: 8px;
				background-color: #333;
				color: #fff;
				font-weight: bold;
			}
			td{
				padding: 5px;
			}*/
			#no, #dept, #line, #prodno, #dateissue, #MCcode{
				text-align: center;
			}
			#model{
				text-align: left;
			}
			#lot, #qty{
				text-align: right;
			}
			#no{min-width: 30px;}
			#dept{min-width: 70px;}
			#line{min-width: 40px;}
			#model{min-width: 180px;}
			#prodno{min-width: 50px;}
			#lot{min-width: 55px;}
			#qty{min-width: 55px;}
			#dateissue{min-width: 120px;}
			#MCcode{min-width: 270px;}
			#pic{min-width: 175px;}
			#remark{min-width: 175px;}
		</style>
	</head>
	<body>
		<?php
			$issue_date		= isset($_POST['issdate']) ? $_POST['issdate'] : ""; 
			$issue_dept		= isset($_POST['issdept']) ? $_POST['issdept'] : ""; 
			$issue_line     = isset($_POST['issue_line']) ? $_POST['issue_line'] : ""; 
			$issue_model    = isset($_POST['issue_model']) ? $_POST['issue_model'] : ""; 
			$issue_prodno   = isset($_POST['issue_prodno']) ? $_POST['issue_prodno'] : ""; 
			$issue_lot      = isset($_POST['issue_lot']) ? $_POST['issue_lot'] : ""; 
			$issue_qty      = isset($_POST['issue_qty']) ? $_POST['issue_qty'] : ""; 
			try{
				if($issue_date !="" && $issue_dept =="" && $issue_line =="" && $issue_model =="" && $issue_prodno =="" && $issue_lot =="" && $issue_qty ==""){
					$sql = "SELECT distinct(a.[kode]),a.[partdept],a.[line],a.[model],a.[prod_no]
							,a.[lot],a.[qty],a.[date_issue]
							,(select min(isnull(STATUS_SCAN, 0)) as status from partlist where kode = a.kode) as minsts
							,(select max(isnull(STATUS_SCAN, 0)) as status from partlist where kode = a.kode and status_scan <> 2) as maxsts
							FROM [partlist] a
							WHERE a.[date_issue] = '{$issue_date}'";
					$rssch = $db->Execute($sql);
					$exist = $rssch->RecordCount();
				}
				else if($issue_date !="" && $issue_dept !="" && $issue_line =="" && $issue_model =="" && $issue_prodno =="" && $issue_lot =="" && $issue_qty ==""){
					$sql = "SELECT distinct(a.[kode]),a.[partdept],a.[line],a.[model],a.[prod_no]
							,a.[lot],a.[qty],a.[date_issue]
							,(select min(isnull(STATUS_SCAN, 0)) as status from partlist where kode = a.kode) as minsts
							,(select max(isnull(STATUS_SCAN, 0)) as status from partlist where kode = a.kode and status_scan <> 2) as maxsts
							FROM [partlist] a
							WHERE a.[date_issue] = '{$issue_date}' and a.[partdept] = '{$issue_dept}'";
					$rssch = $db->Execute($sql);
					$exist = $rssch->RecordCount();
				}
				else{
					$sql = "SELECT distinct(a.[kode]),a.[partdept],a.[line],a.[model],a.[prod_no]
							,a.[lot],a.[qty],a.[date_issue]
							,(select min(isnull(STATUS_SCAN, 0)) as status from partlist where kode = a.kode) as minsts
							,(select max(isnull(STATUS_SCAN, 0)) as status from partlist where kode = a.kode and status_scan <> 2) as maxsts
							FROM [partlist] a
							  where a.partdept = '{$issue_dept}'
								and a.line = '{$issue_line}'
								and a.model='{$issue_model}'
								and a.prod_no = '{$issue_prodno}'
								and a.lot = '{$issue_lot}'
								and a.qty ='{$issue_qty}'
								and a.date_issue = '{$issue_date}'";
					$rssch = $db->Execute($sql);
					$exist = $rssch->RecordCount();
				}
				
				echo $sql;
			}
			catch (Exception $ex){
				echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
			}
		?>
	<!--	<h3 align="center">PARTLIST SCHEDULE <?/*=date_format(date_create($issue_date), 'd F Y')*/?></h3> -->
		<h4 align="center"><b>PARTLIST SCHEDULE <?=$tgl_skrg?><b></h4>
		<table id="dt_printpartlist" border="1" style="border-collapse: collapse;" class="table-hover">
			<thead>
				<tr>
					<th>NO</th>
					<th>DEPT</th>
					<th>LINE</th>
					<th>MODEL</th>
					<th>PROD NO</th>
					<th>LOT</th>
					<th>QTY</th>
					<th>DATE ISSUE</th>
					<th>PARTLIST CODE</th>
					<th>PIC</th>
					<th>REMARK</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if ($exist == 0){
				?>
					<tr>
						<td id="noavailable" colspan="11">
							<article>Sorry, No Data Available</article>
						</td>
					</tr>
				<?php
					}
					else{
						$no = 0;
						
						//include class require
						require('barcode128/class/BCGFont.php');
						require('barcode128/class/BCGColor.php');
						require('barcode128/class/BCGDrawing.php');
						
						//inlcude the barcode technology
						include('barcode128/class/BCGcode128.barcode.php');
						
						//loading font
						$font = new BCGFont('barcode128/class/font/Arial.ttf', 18);
						
						
						while(!$rssch->EOF){
							$no++;
							$prt_dept	= $rssch->fields['1'];
							if($prt_dept == "SMALLFA"){
								$prt_dept = "SMALL PART FA";
							}
							else{
								$prt_dept = $rssch->fields['1'];
							}
							$prt_line	= $rssch->fields['2'];
							$prt_model	= $rssch->fields['3'];
							$prt_prodno	= $rssch->fields['4'];
							$prt_lot	= $rssch->fields['5'];
							$prt_qty	= $rssch->fields['6'];
							$prt_dateissue	= date_format(date_create($rssch->fields['7']), 'd F Y');
							
							$minsts = $rssch->fields['8'];
							$maxsts = $rssch->fields['9'];
							
							$prt_barcode	= $rssch->fields['0'];
							
/***************************proses pembuatan barcode*/
							
							//create name barcode
							$namafile = $prt_barcode.'.jpg';
							
							//The argument are R, G, B for color.
							$color_black = new BCGColor(0, 0, 0);
							$color_white = new BCGColor(255, 255, 255);
							
							$code = new BCGcode128();
							$code->setScale(2); //Resolution
							$code->setThickness(30); //Thickness
							$code->setForegroundColor($color_black); //Color of bars
							$code->setBackgroundColor($color_white); //Color of spaces
							$code->setFont($font); //Font (or 0)
							$code->parse($prt_barcode); //Text
							
							/*
								Here is the list of the arguments
								1 - Filename (empty : display on screen)
								2 - background color
							*/
							$drawing = new BCGDrawing('', $color_white);
							$drawing->setBarcode($code);
							$drawing->setFilename('barcode128/img_MCcode/'.$namafile);
							$drawing->draw();
							
							// Header that says it is an image (remove it if you save the barcode to a file)
							// header('Content-Type : image.png');
							// Draw (or save) the image into ONG format.
							$drawing->finish(BCGDrawing::IMG_FORMAT_JPEG);
				
							
							if($minsts == 1 and $maxsts == 1){
				?>
								<tr style="background-color:lightgreen;">
				<?php			
							}elseif($minsts == 0 and $maxsts == 1){
				?>
								<tr style="background-color:yellow;">
				<?php			
							}else{
				?>
								<tr>
				<?php			
							}
				?>
								<td rowspan="2" id="no"><?=$no?></td>
								<td rowspan="2" id="dept"><?=$prt_dept?></td>
								<td rowspan="2" id="line"><?=$prt_line?></td>
								<td rowspan="2" id="model"><?=$prt_model?></td>
								<td rowspan="2" id="prodno"><?=$prt_prodno?></td>
								<td rowspan="2" id="lot"><?=$prt_lot?></td>
								<td rowspan="2" id="qty"><?=$prt_qty?></td>
								<td rowspan="2" id="dateissue"><?=$prt_dateissue?></td>
								<td id="MCcode"><img title="barcode" src="barcode128/img_MCcode/<?=$namafile?>" alt="gambar barcode" /></td>
								<td rowspan="2" id="pic"></td>
								<td rowspan="2" id="remark"></td>
							</tr>
				<?php
							if($minsts == 1 and $maxsts == 1){
				?>
								<tr style="background-color:lightgreen;">
				<?php			
							}elseif($minsts == 0 and $maxsts == 1){
				?>
								<tr style="background-color:yellow;">
				<?php			
							}else{
				?>
								<tr>
				<?php			
							}
				?>
								<td id="kode" align="center"><b><?=$prt_barcode?></b></td>
							</tr>
				<?php
							$rssch->MoveNext();
						}				
					}
				?>
			</tbody>
		</table>
	</body>
</html>