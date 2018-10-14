<html>
<head>
	<title>Barcode Print Sato - QRCode</title>
</head>
<body bgcolor="#ffffff">
<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	$data .= $esc . 'H0050' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . 'Mohamad Yunus - IT Section';
	//$data .= $esc . 'H0250' . $esc . 'V0015' . $esc . '2D30,L,04,0,0' . $esc . 'DS2,' . 'Arif Firmansyah - IT Section';
	//$data .= $esc . 'H0400' . $esc . 'V0015' . $esc . '2D30,M,04,0,0' . $esc . 'DS2,' . 'Arif Firmansyah - IT Section';
	//$data .= $esc . 'H0550' . $esc . 'V0015' . $esc . '2D30,M,04,0,0' . $esc . 'DS2,' . 'Harris Muhammad Zaki - IT Section';
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