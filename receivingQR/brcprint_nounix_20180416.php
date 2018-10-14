<!--
****	modify by Mohamad Yunus
****	on 10 Juli 2017
****	modify:  get pc host name (on line 192 - 27 March 2017)
****	modify:  change to ipaddress (on line 193 remark - 04 Juli 2017)
****	modify:  untuk IP tertentu akan menggunakan ipaddress (on line 193)
-->
<html>
<head>
	<title>Barcode Print Sato - QRCode</title>
</head>
<body bgcolor="#ffffff">
<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	
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
		echo '</table>';
		
		
		if( $qtystd != 0){
			//	handle 1
			$barcode_a = '----------------';
			$barcode_c = '----------------';
			$esc = chr(27);
			$data = '';
			$data .= $esc . 'A';
			$data .= $esc . 'A3H1374V0001';
			$data .= $esc . 'H0155' . $esc . 'V0010' . $esc . 'L0303' . $esc . 'XU' . $barcode_a;
			$data .= $esc . 'H0155' . $esc . 'V0100' . $esc . 'L0303' . $esc . 'XU' . $barcode_c;
			$data .= $esc . 'Q1';
			$data .= $esc . 'Z';
			$handle1 = $data;
			
			//	handle 2
			$barcode 	= $partno . ' ' . $po . ' ' . $pack;
			$esc = chr(27);
			$data = '';
			$data .= $esc . 'A';
			$data .= $esc . 'H0050' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . $barcode;
			$data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $partno;
			$data .= $esc . 'H0540' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $lokasi;
			$data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $po;
			$data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $pack;
			$data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . $supp;
			$data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $invno;
			$data .= $esc . 'Q'. $qtystd .'';
			$data .= $esc . 'Z';
			$handle2 = $data;
		}
		
		if( $qtybal != 0){
			//	handle 3
			$barcode 	= $partno . ' ' . $po . ' ' . $qtybal;
			$esc = chr(27);
			$data = '';
			$data .= $esc . 'A';
			$data .= $esc . 'H0050' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . $barcode;
			$data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $partno;
			$data .= $esc . 'H0540' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $lokasi;
			$data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $po;
			$data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qtybal;
			$data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . $supp;
			$data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $invno;			
			$data .= $esc . 'Q1';
			$data .= $esc . 'Z';
			$handle3 = $data;
		}
		
		$print = $handle1 . $handle2 . $handle3;
		
		//Setting Jam Indonesia //
			date_default_timezone_set('Asia/Jakarta');
			$Ymd = gmdate("Ymd");
			$wkt = date('His');
		// ================= //
		
		$cekip		= getenv("REMOTE_ADDR");
		if($cekip == '10.230.37.150' || $cekip == '10.230.37.182' || $cekip == '136.198.117.189' || $cekip == '10.230.37.119' || $cekip == '10.230.37.124'){
			//echo 'pake ip';
			$host		= getenv("REMOTE_ADDR");
			$myfile 	= fopen("\\\\$host\\PrintSato\\print_". $Ymd . $wkt .".txt", "w") or die("Unable to open file!");
			$txt 		= $print;
			fwrite($myfile, $txt);
			fclose($myfile);			
		}
		else{
			//echo 'pake host';
			$host		= gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$myfile 	= fopen("\\\\$host\\PrintSato\\print_". $Ymd . $wkt .".txt", "w") or die("Unable to open file!");
			$txt 		= $print;
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	}
	
?>
</body>
</html>