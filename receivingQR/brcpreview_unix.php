<html>
<head>
	<title>Barcode Print Sato - QRCode</title>
</head>
<body bgcolor="#ffffff">
<?php
	if(isset($_GET['partno']))
	{

		$partno = $_GET['partno'];
		$pjgpartno = strlen($partno);
		
		switch ($pjgpartno)
		{  
			case 1:
			$partno .= '              ';
			break;
			case 2:
			$partno .= '             ';
			break;
			case 3:
			$partno .= '            ';
			break;
			case 4:
			$partno .= '           ';
			break;
			case 5:
			$partno .= '          ';
			break;
			case 6:
			$partno .= '         ';
			break;
			case 7:
			$partno .= '        ';
			break;
			case 8:
			$partno .= '       ';
			break;
			case 9:
			$partno .= '      ';
			break;
			case 10:
			$partno .= '     ';
			break;
			case 11:
			$partno .= '    ';
			break;
			case 12:
			$partno .= '   ';
			break;
			case 13:
			$partno .= '  ';
			break;
			case 14:
			$partno .= ' ';
			break;
			default:
		}
		
		$po		= $_GET['po'];
		if($po == '')
		{  
		  $po = '       '; 
		}
		
		$suppcode 		= $_GET['suppcode'];
		$suppname 		= $_GET['suppname'];
		$pack   		= $_GET['pack'];
		$qtystd 		= $_GET['qtystd'];
		$qtybal 		= $_GET['qtybal'];
		$qty 			= $_GET['qty'];
		$lokasi 		= $_GET['lokasi'];
		$supp 			= $_GET['supp'];
		$invno 			= $_GET['invno'];
		$sts_inspection = strtoupper($_GET['stsinsp']);
		//--critical part--
		$proddate		= $_GET['proddate'];
		$lotnosupp		= strtoupper($_GET['lotnosupp']);
		//-----------------
		$host		= getenv("REMOTE_ADDR");
		
		echo '<table border="0" cellpadding="5" cellspacing="0" width="100%" style="font-weight:bold; font-size=18pt">';
			echo '<tr>';
				echo '<td width="200px">Supplier Name</td>';
				echo '<td>: '. $suppname .'</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>Part No.</td>';
				echo '<td>: '. $partno .'</td>';
			echo '</tr>';
			
			echo '<tr>';			
				echo '<td>PO No.</td>';
				echo '<td>: '. $po .'</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>QTY</td>';
				echo '<td>: '. $qty .'</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>Invoice No.</td>';
				echo '<td>: '. $invno .'</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>Standard Packing</td>';
				echo '<td>: ' . $pack .'</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>Location</td>';
				echo '<td>: ' . $lokasi .'</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td>Status Inspection</td>';
				echo '<td>: ' . $sts_inspection .'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">------------------- CRITICAL PART -------------------</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Prod. Date</td>';
				echo '<td>: ' . $proddate .'</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td>Lot No Supplier</td>';
				echo '<td>: ' . $lotnosupp .'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">---------------------------------------------------------------</td>';
			echo '</tr>';
			
			echo '<tr>';
				if( $qtybal != 0){
					$qtylbl = $qtystd + 1;
					
					echo '<td>Total Label Print</td>';
					echo '<td style="color:#0000ff">: '. $qtylbl .'</td>';
				}else
				{
					$qtylbl = $qtystd;
					
					echo '<td>Total Label Print</td>';
					echo '<td style="color:#0000ff">: '. $qtylbl .'</td>';
				}
			echo '</tr>';
			
			echo '<tr>';
				echo '<td style="color:#0000ff" colspan="2">';
					echo '<a href="brcprint_unix.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'&suppcode='. $suppcode .'&stsinsp=' . $sts_inspection . '&proddate=' . $proddate . '&lotnosupp=' . $lotnosupp . '">Print SATO Label</a>';
				echo '</td>';
			echo '</tr>';
		echo '</table>';
	}
?>
</body>
</html>