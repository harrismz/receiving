<html>
<head>
	<title>barcode print sato</title>
</head>
<body bgcolor="#ffffff">
<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	/*
	$barcode 	= 'Mohamad Yunus';
	//write data to printer
	$barcode_b = $barcode;
	$barcode_c = $barcode;
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	$data .= $esc . 'A3H1374V0001';
	$data .= $esc . 'H0220' . $esc . 'V0038' . $esc . 'BG02050' . $barcode_b . '';
	$data .= $esc . 'H0300' . $esc . 'V0093' . $esc . 'L0202' . $esc . 'S' . $partno . $esc . 'L0203' . $esc . 'XU' . $barcode_c;
	$data .= $esc . 'Q1';
	$data .= $esc . 'Z';
	$handle3 = $data;
	*/
	
	/*
	$barcode 	= 'Alfiandi Hakim';
	//write data to printer
	$barcode_b = $barcode;
	$barcode_c = $barcode;
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	$data .= $esc . 'A3H1374V0001';
	$data .= $esc . 'H0200' . $esc . 'V0038' . $esc . 'BG02050' . $barcode_b . '';
	$data .= $esc . 'H0300' . $esc . 'V0093' . $esc . 'L0202' . $esc . 'S' . $partno . $esc . 'L0203' . $esc . 'XU' . $barcode_c;
	$data .= $esc . 'Q1';
	$data .= $esc . 'Z';
	$handle3 = $data;
	*/
	/*
	$barcode 	= 'Arif Firmansyah';
	//write data to printer
	$barcode_b = $barcode;
	$barcode_c = $barcode;
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	$data .= $esc . 'A3H1374V0001';
	$data .= $esc . 'H0200' . $esc . 'V0038' . $esc . 'BG02050' . $barcode_b . '';
	$data .= $esc . 'H0300' . $esc . 'V0093' . $esc . 'L0202' . $esc . 'S' . $partno . $esc . 'L0203' . $esc . 'XU' . $barcode_c;
	$data .= $esc . 'Q1';
	$data .= $esc . 'Z';
	$handle3 = $data;
	*/
	/*
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	$data .= $esc . 'H0280' . $esc . 'V0100' . $esc . 'L0202' . $esc . 'L0202' . $esc . 'S' . '--EPON MAC--';
	$data .= $esc . 'H0150' . $esc . 'V0185' . $esc . 'L0202' . $esc . 'L0202' . $esc . 'S' . '00 : D0 : CB : FE : 2F : 3F';
	$data .= $esc . 'Q1';
	$data .= $esc . 'Z';
	$handle3 = $data;
	*/
	
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	$data .= $esc . 'H0100' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . 'BAOFENG - 1';
	$data .= $esc . 'H0040' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT Asset 1';
	$data .= $esc . 'H0040' . $esc . 'V0185' . $esc . 'L0202' . $esc . 'S' . 'IT Asset 1';
	
	$data .= $esc . 'H0350' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . 'BAOFENG - 2';
	$data .= $esc . 'H0290' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT Asset 2';
	$data .= $esc . 'H0290' . $esc . 'V0185' . $esc . 'L0202' . $esc . 'S' . 'IT Asset 2';
	
	$data .= $esc . 'H0600' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . 'BAOFENG - 3';
	$data .= $esc . 'H0540' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT Asset 3';
	$data .= $esc . 'H0540' . $esc . 'V0185' . $esc . 'L0202' . $esc . 'S' . 'IT Asset 3';
	$data .= $esc . 'Q1';
	$data .= $esc . 'Z';
	$handle3 = $data;
	
	$print = $handle3;
	
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
	
?>
</body>
</html>