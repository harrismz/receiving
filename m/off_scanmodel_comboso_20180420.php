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
		.panel-default{
			background-color: rgba(220, 202, 166, 0.1);
		}
				
		.ast-focus:hover{
			font-weight: bold;
			font-size: 15px;
			color:navy;
			background-color:#ffccb3;
		}
		td{
			font-size : 13px;
		}
		</style>
	</head>
	<body>
		<?php
			$partcode = isset($_POST['partcode']) ? $_POST['partcode'] : ""; 
			try{
				$sql = "SELECT distinct([model]),[partdept],[line],[prod_no],[lot],[qty],[date_issue]
					FROM [partlist] WHERE [kode] = '{$partcode}'";
				$rspart = $db->Execute($sql);
				$exist = $rspart->RecordCount();
			}
			catch (Exception $ex){
				echo '[[[SQL SERVER]]] :::'.$ex->getMessage();
			}
		?>
		
		
				<?php
					if ($exist == 0){}
					else{
						$model     = $rspart->fields['0'];
						$partdept  = $rspart->fields['1'];
						$line      = $rspart->fields['2'];
						$prodno    = $rspart->fields['3'];
						$lot       = $rspart->fields['4'];
						$qty       = $rspart->fields['5'];
						$dateissue = date_format(date_create($rspart->fields['6']), 'd F Y');
				?>
						<div class="panel panel-default col-sm-8 col-sm-offset-2">
							<br>
							<table id="view_asset" class="col-sm-12">
								<tr class="ast-focus">
									<td class="result_view">DEPARTMENT</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
									<td class="ast-exist"><?php echo $partdept;?></td>
								</tr>
								<tr class="ast-focus">
									<td class="result_view">LINE</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td class="ast-status"><?php echo $line;?></td>
								</tr>
								<tr class="ast-focus">
									<td class="result_view">MODEL</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $model;?></td>
								</tr>
								<tr class="ast-focus">
									<td class="result_view">DATE</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td class="ast-cond"><?php echo $dateissue;?></td>
								</tr>
								<tr class="ast-focus">
									<td class="result_view">PROD NO</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td class="ast-exist"><?php echo $prodno;?></td>
								</tr>
								<tr class="ast-focus">
									<td class="result_view">LOT</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $lot;?></td>
								</tr>
								<tr class="ast-focus">
									<td class="result_view">QTY</td>
									<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $qty;?></td>
								</tr>
							</table>
						</div>
				<?php
					}
				?>
		</table>
	</body>
</html>