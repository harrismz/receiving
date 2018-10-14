<html>
<head>
	<title>barcode print sato</title>
</head>
<body bgcolor="#ffffff">
<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
		
	$esc = chr(27);
	$data = '';
	$data .= $esc . 'A';
	/*
	$data .= $esc . 'H0100' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100526 IT03-00001-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00001';
	$data .= $esc . 'H0350' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100528-IT03-00002-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00002';
	$data .= $esc . 'H0600' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100525-IT03-00003-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00003';
	$data .= $esc . 'H0100' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100527-IT03-00004-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00004';
	$data .= $esc . 'H0350' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100527-IT03-00004-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00004';
	$data .= $esc . 'H0600' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100524-IT03-00005-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00005';
	
	$data .= $esc . 'H0100' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100523-IT03-00006-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00006';
	$data .= $esc . 'H0350' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100515-IT03-00007-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00007';
	$data .= $esc . 'H0600' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100536-IT03-00008-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00008';
	$data .= $esc . 'H0100' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100539-IT03-00009-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00009';
	$data .= $esc . 'H0350' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100538-IT03-00010-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00010';
	$data .= $esc . 'H0600' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100540-IT03-00011-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00011';
	
	$data .= $esc . 'H0100' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100541-IT03-00012-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00012';
	$data .= $esc . 'H0350' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100569-IT03-00013-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00013';
	$data .= $esc . 'H0600' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100565-IT03-00014-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00014';
	$data .= $esc . 'H0100' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100568-IT03-00015-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00015';
	$data .= $esc . 'H0350' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100571-IT03-00016-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00016';
	$data .= $esc . 'H0600' . $esc . 'V0165' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100564-IT03-00017-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0255' . $esc . 'L0202' . $esc . 'S' . 'IT03-00017';
	
	$data .= $esc . 'H0100' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100566-IT03-00018-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0040' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00018';
	$data .= $esc . 'H0350' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100570-IT03-00019-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0290' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00019';
	$data .= $esc . 'H0600' . $esc . 'V0015' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . 'P100567-IT03-00020-BARCODE SCANNER CM2D600W'; $data .= $esc . 'H0540' . $esc . 'V0105' . $esc . 'L0202' . $esc . 'S' . 'IT03-00020';
	*/
	
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