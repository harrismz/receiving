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
		<title>PRINT PARTLIST SCHEDULE</title>
		<style>
			th{
				padding: 8px;
				background-color: #333;
				color: #fff;
				font-weight: bold;
			}
			td{
				padding: 5px;
			}
			#no, #dept, #line, #prodno, #dateissue, #barcode{
				text-align: center;
			}
			#model{
				text-align: left;
			}
			#lot, #qty{
				text-align: right;
			}
			#no{min-width: 30px;}
			#dept{min-width: 72px;}
			#line{min-width: 40px;}
			#model{min-width: 180px;}
			#prodno{min-width: 50px;}
			#lot{min-width: 55px;}
			#qty{min-width: 55px;}
			#dateissue{min-width: 140px;}
			#pic{min-width: 140px;}
			#remark{min-width: 140px;}
		</style>
	</head>
	<body>
		<?php
			$issue_date		= isset($_POST['issue_date']) ? $_POST['issue_date'] : ""; 
			$issue_dept		= isset($_POST['issue_dept']) ? $_POST['issue_dept'] : ""; 
			$issue_line     = isset($_POST['issue_line']) ? $_POST['issue_line'] : ""; 
			$issue_model    = isset($_POST['issue_model']) ? $_POST['issue_model'] : ""; 
			$issue_prodno   = isset($_POST['issue_prodno']) ? $_POST['issue_prodno'] : ""; 
			$issue_lot      = isset($_POST['issue_lot']) ? $_POST['issue_lot'] : ""; 
			$issue_qty      = isset($_POST['issue_qty']) ? $_POST['issue_qty'] : ""; 
			try{
				if($issue_date !="" && $issue_dept =="" && $issue_line =="" && $issue_model =="" && $issue_prodno =="" && $issue_lot =="" && $issue_qty ==""){
					$sql = "SELECT distinct([kode]),[partdept],[line],[model],[prod_no]
							,[lot],[qty],[date_issue]
							FROM [testedi].[dbo].[partlist]
							WHERE [date_issue] = '{$issue_date}'";
					$rssch = $db->Execute($sql);
					$exist = $rssch->RecordCount();
				}
				else{
					$sql = "SELECT distinct([kode]),[partdept],[line],[model],[prod_no]
							  ,[lot],[qty],[date_issue] FROM [testedi].[dbo].[partlist]
							  where partdept = '{$issue_dept}'
								and line = '{$issue_line}'
								and model='{$issue_model}'
								and prod_no = '{$issue_prodno}'
								and lot = '{$issue_lot}'
								and qty ='{$issue_qty}'
								and date_issue = '{$issue_date}'";
					$rssch = $db->Execute($sql);
					$exist = $rssch->RecordCount();
				}
			}
			catch (Exception $ex){
				echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
			}
		?>
		<h3 align="center">PARTLIST SCHEDULE <?=date_format(date_create($issue_date), 'd F Y')?></h3>
		<table id="dt_partlist" border="1" style="border-collapse: collapse;">
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
					<th>BARCODE</th>
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
							$prt_line	= $rssch->fields['2'];
							$prt_model	= $rssch->fields['3'];
							$prt_prodno	= $rssch->fields['4'];
							$prt_lot	= $rssch->fields['5'];
							$prt_qty	= $rssch->fields['6'];
							$prt_dateissue	= date_format(date_create($rssch->fields['7']), 'd F Y');
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
							$drawing->setFilename('barcode128/img_partcode/'.$namafile);
							$drawing->draw();
							
							// Header that says it is an image (remove it if you save the barcode to a file)
							// header('Content-Type : image.png');
							// Draw (or save) the image into ONG format.
							$drawing->finish(BCGDrawing::IMG_FORMAT_JPEG);
				?>
								<td id="no"><?=$no?></td>
								<td id="dept"><?=$prt_dept?></td>
								<td id="line"><?=$prt_line?></td>
								<td id="model"><?=$prt_model?></td>
								<td id="prodno"><?=$prt_prodno?></td>
								<td id="lot"><?=$prt_lot?></td>
								<td id="qty"><?=$prt_qty?></td>
								<td id="dateissue"><?=$prt_dateissue?></td>
								<td id="MCcode"><img title="barcode" src="barcode128/img_partcode/<?=$namafile?>" alt="gambar barcode" /></td>
								<td id="pic"></td>
								<td id="remark"></td>
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