<html>
	<head><title>Kode Otomatis</title></head>
	<?php
		$data="1234567890";
		$kd = "090641510000KDX110UD";
		$kodeawal=substr($data,-5)+1;
		if($kodeawal<10){ $kode=$kd.'0000'.$kodeawal; }
		elseif($kodeawal > 9 && $kodeawal <=99){ $kode=$kd.'000'.$kodeawal; }
		elseif($kodeawal > 99 && $kodeawal <=999){ $kode=$kd.'00'.$kodeawal; }
		elseif($kodeawal > 999 && $kodeawal <=9999){ $kode=$kd.'0'.$kodeawal; }
		else{ $kode=$kd.$kodeawal; }
	?>
	<body>
		<form name="form1" method="post" action="">
			<div>
				Kode Otomatis :  <input type="text" name="tkode" id="tkode" value="<?php echo $kode;?>">
			</div>
		</form>
	</body>
</html>