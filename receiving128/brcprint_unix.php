<html>
<head>
	<title>barcode print sato</title>
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

		$pack		 = $_GET['pack'];
		$pjgpack = strlen($pack);
		switch ($pjgpack)
		{
			case 1:
			$pack .= '    ';
			break;
			case 2:
			$pack .= '   ';
			break;
			case 3:
			$pack .= '  ';
			break;
			case 4:
			$pack .= ' ';
			break;
			default:
		}

		$qtybal	   = $_GET['qtybal'];
		$pjgqtybal = strlen($qtybal);
		switch ($pjgqtybal)
		{
			case 1:
			$qtybal .= '    ';
			break;
			case 2:
			$qtybal .= '   ';
			break;
			case 3:
			$qtybal .= '  ';
			break;
			case 4:
			$qtybal .= ' ';
			break;
			default:
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
		echo '</table>';


		if( $qtystd != 0){
			//write data to printer
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

			//-------------------------------------------------------
			//-------------------------------------------------------
			//-------------------------------------------------------

			$barcode 	= $partno . ' ' . $po . ' ' . $pack;

			//write data to printer
			$barcode_a = '  ' . $supp . '  ';
			$barcode_b = $barcode;
			$barcode_c = ' ' . $po . '    ' . $pack;

			$esc = chr(27);
			$data = '';
			$data .= $esc . 'A';
			$data .= $esc . 'A3H1374V0001';
			$data .= $esc . 'H0155' . $esc . 'V0017' . $esc . 'L0202' . $esc . 'L0202' . $esc . 'S' . $invno . $esc . 'XU' . $barcode_a . $esc . 'L0202' . $esc . 'S' . $lokasi;
			$data .= $esc . 'H0100' . $esc . 'V0045' . $esc . 'BG02050' . $barcode_b . '';
			$data .= $esc . 'H0160' . $esc . 'V0100' . $esc . 'L0202' . $esc . 'S' . $partno . $esc . 'L0203' . $esc . 'XU' . $barcode_c;
			$data .= $esc . 'Q'. $qtystd .'';
			$data .= $esc . 'Z';

			$handle2 = $data;
		}

		if( $qtybal != 0){
			$barcode 	= $partno . ' ' . $po . ' ' . $qtybal;

			//write data to printer
			$barcode_a = '  ' . $supp . '  ';
			$barcode_b = $barcode;
			$barcode_c = ' ' . $po . '    ' . $qtybal;

			$esc = chr(27);
			$data = '';
			$data .= $esc . 'A';
			$data .= $esc . 'A3H1374V0001';
			$data .= $esc . 'H0155' . $esc . 'V0017' . $esc . 'L0202' . $esc . 'L0202' . $esc . 'S' . $invno . $esc . 'XU' . $barcode_a . $esc . 'L0202' . $esc . 'S' . $lokasi;
			$data .= $esc . 'H0100' . $esc . 'V0045' . $esc . 'BG02050' . $barcode_b . '';
			$data .= $esc . 'H0160' . $esc . 'V0100' . $esc . 'L0202' . $esc . 'S' . $partno . $esc . 'L0203' . $esc . 'XU' . $barcode_c;
			$data .= $esc . 'Q1';
			$data .= $esc . 'Z';

			$handle3 = $data;
		}


		$print = $handle1 . $handle2 . $handle3;
		//$print = $handle1;
		//$print = $handle2;
		//$print = $handle3;

		//Setting Jam Indonesia //
			date_default_timezone_set('Asia/Jakarta');
			$Ymd = gmdate("Ymd");
			$wkt = date('His');
		// ================= //

		$host		= getenv("REMOTE_ADDR");
		$myfile 	= fopen("\\\\$host\\PrintSato\\print_". $Ymd . $wkt .".txt", "w") or die("Unable to open file!");
		$txt 		= $print;
		fwrite($myfile, $txt);
		fclose($myfile);
	}
?>
</body>
</html>
