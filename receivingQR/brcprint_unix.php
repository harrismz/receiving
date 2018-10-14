<!--
****	modify by Mohamad Yunus
****	on 10 Juli 2017
****	modify:  get pc host name (on line 192 - 27 March 2017)
****	modify:  change to ipaddress (on line 193 remark - 04 Juli 2017)
****	modify:  untuk IP tertentu akan menggunakan ipaddress (on line 193)

*

**** modify by Harris Muhammad Zaki
****	on 1-2 Maret 2018
****	modify:  Add Qrcode Unique in label format using  for looping
-->
<html>
<head>
	<title>Barcode Print Sato - QRCode</title>
</head>
<body bgcolor="#ffffff">
<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	//include('koneksi.php');
	date_default_timezone_set('Asia/Jakarta');

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

		$suppcode 	= $_GET['suppcode'];
		$suppname 	= $_GET['suppname'];
		//$pack   	= $_GET['pack'];
		$qtystd 	= $_GET['qtystd'];
		//$qtybal 	= $_GET['qtybal'];
		$qty 		= $_GET['qty'];
		$lokasi 	= $_GET['lokasi'];
		$supp 		= $_GET['supp'];
		$invno 		= $_GET['invno'];
		$stsinsp 	= strtoupper($_GET['stsinsp']);


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
				echo '<td>: ' . $stsinsp .'</td>';
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


			// $items = array();
			// foreach($group_membership as $username) {
			// $items[] = $username;
			// }
			//
			// print_r($items);




			$handle2 = '';
			for($i=0;$i<$qtystd;$i++){
					$j = $i+1;
				//	handle 2
				//	soucrdb ( suppQR : P | ediweb : B | 48JEIN : I ) 
					$srcdb_unx[$j]	   		= 'I';
					$suppcode_unx[$j]   	= str_pad($suppcode,6," ", STR_PAD_RIGHT);
					$partno_code[$j]   		= str_pad($partno,15," ", STR_PAD_RIGHT);
					$date_unx[$j] 			= date("YmdHis");
					$micro_date_unx[$j]		= microtime();
					$date_array_temp_unx[$j]= explode(" ",$micro_date_unx[$j]);
					$date_array_unx[$j]		= substr($date_array_temp_unx[$j][0], 2, -4);
					$orderCodeDate_unx[$j]	= $date_unx[$j] . $date_array_unx[$j];
					$datetime_unx[$j] 		= $orderCodeDate_unx[$j];
					$printcode_unx[$j] 		= str_pad($j,6,"0", STR_PAD_LEFT);
					$unique_unx[$j]   		= $srcdb_unx[$j] . $suppcode_unx[$j] . $partno_code[$j] . $datetime_unx[$j] . $printcode_unx[$j];
			
				
				
				$barcode 	= $partno . ' ' . $po . ' ' . $pack . ' ' . $unique_unx[$j];
				$esc = chr(27);
				$data = '';
				$data .= $esc . 'A';
				$data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $barcode;
				$data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $partno;
				$data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $lokasi;
				$data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $po;
				$data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $pack;
				$data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . $supp;
				$data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $invno;
				$data .= $esc . 'H0530' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Type: ' . $stsinsp;
				//$data .= $esc . 'H0340' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . $unique_unx[$j];
				//$data .= $esc . 'Q'. $qtystd .'';
				$data .= $esc . 'Q1';
				$data .= $esc . 'Z';
				$handle2 .= $data;
			}
			$handle_join = $handle2;
		}

		if( $qtybal != 0){
			//	handle 3
			//	soucrdb ( suppQR : P | ediweb : B | 48JEIN : I ) 
			$k = $i+1;
			$srcdb300	   		= 'I';
			$supp300 	   		= str_pad($suppcode,6," ", STR_PAD_RIGHT);
			$partno_code300   	= str_pad($partno,15," ", STR_PAD_RIGHT);
			$date300 			= date("YmdHis");
			$micro_date300		= microtime();
			$date_array_temp300 = explode(" ",$micro_date300);
			$date_array300		= substr($date_array_temp300[0], 2, -4);
			$orderCodeDate300	= $date300 . $date_array300;
			$datetime300 		= $orderCodeDate300;
			$printcode300 		= str_pad($k,6,"0", STR_PAD_LEFT);
			$unique300   		= $srcdb300 . $supp300 . $partno_code300 . $datetime300 . $printcode300;
	
			$barcode 	= $partno . ' ' . $po . ' ' . $qtybal . ' ' . $unique300;
			$esc = chr(27);
			$data = '';
			$data .= $esc . 'A';
			$data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $barcode;
			$data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $partno;
			$data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $lokasi;
			$data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $po;
			$data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qtybal;
			$data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . $supp;
			$data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $invno;
			$data .= $esc . 'H0530' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Type: ' . $stsinsp;
				//$data .= $esc . 'H0340' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . $unique300;
			$data .= $esc . 'Q1';
			$data .= $esc . 'Z';
			$handle3 = $data;
		}

		$print = $handle1 . $handle_join . $handle3;

		//Setting Jam Indonesia //
			date_default_timezone_set('Asia/Jakarta');
			$Ymd = gmdate("Ymd");
			$wkt = date('His');
		// ================= //

		$cekip		= getenv("REMOTE_ADDR");
		if($cekip == '10.230.37.150' || $cekip == '136.198.117.189' || $cekip == '10.230.37.119' || $cekip == '10.230.37.143'){
			//echo 'pake ip';
			$host		= getenv("REMOTE_ADDR");
			$myfile 	= fopen("\\\\$host\\PrintSato\\print_". $Ymd . $wkt .".txt", "w") or die("Unable to open file!");
			$txt 		= $print;
			fwrite($myfile, $txt);
			fclose($myfile);
		}
		elseif($cekip == '10.230.30.117'){
			//echo 'pake ip';
			$host		= 'newedp5';
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
