<html>
<head>
	<title>barcode print sato</title>
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
		
		$suppname 	= $_GET['suppname'];
		$pack   	= $_GET['pack'];
		$qtystd 	= $_GET['qtystd'];
		$qtybal 	= $_GET['qtybal'];
		$qty 		= $_GET['qty'];
		$lokasi 	= $_GET['lokasi'];
		$supp 		= $_GET['supp'];
		$invno 		= $_GET['invno'];
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
					echo '<a href="brcprint.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label</a>';
				echo '</td>';
			echo '</tr>';
		echo '</table>';
	}
?>
</body>
</html>