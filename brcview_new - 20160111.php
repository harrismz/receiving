<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	include "koneksi.php";
?>
<html>
<title>Barcode Print Part Select</title>
<body>
<?php
    $partno 	= trim($_REQUEST['part']);
	$suppcode 	= trim($_REQUEST['suppcode']);
    $po     	= $_REQUEST['po'];
    $qty    	= $_REQUEST['qty'];   
    $invno    	= $_REQUEST['invno'];
	
	$rs = $db->Execute("select suppname from supplier where suppcode = '".$suppcode."'");
	$suppname = $rs->fields[0];
	$rs->Close();
	
	
	echo '<table border="0" cellpadding="2" cellspacing="0" width="100%" style="font-size=13pt">';
		echo '<tr>';
			echo '<td width="200px" style="font-weight:bold;">SUPPLIER NAME</td>';
			echo '<td>: '. $suppname .' </td>';
		echo '</tr>';
		
		echo '<tr>';
			echo '<td style="font-weight:bold;">PART NUMBER</td>';
			echo '<td>: '. $partno .' </td>';
		echo '</tr>';
		
		echo '<tr>';
			echo '<td style="font-weight:bold;">PO</td>';
			echo '<td>: '. $po .' </td>';
		echo '</tr>';
		
		echo '<tr>';
			echo '<td style="font-weight:bold;">QTY</td>';
			echo '<td>: '. $qty .' </td>';
		echo '</tr>';
		
		echo '<tr>';
			echo '<td style="font-weight:bold;">INVOICE NO</td>';
			echo '<td>: '. $invno .' </td>';
		echo '</tr>';
		
		//	cari stdpacking dan lokasi
		$sql = "select * from stdpack where partnumber= '$partno'";
		$nt = $db->Execute($sql);
		while(!$nt->EOF)
		{
			echo '<tr>';
				echo '<td style="font-weight:bold;">STANDARD PACK</td>';
				echo '<td>: '. $nt->fields[3] .' </td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td style="font-weight:bold;">LOKASI</td>';
				echo '<td>: '. $nt->fields[6] .' </td>';
			echo '</tr>';
			
			$pack 	= $nt->fields[3]; 
			$lokasi = $nt->fields[6]; 
			$nt->MoveNext();
		}
		//	end
		
		//	ambil beberapa karakter supplier
		$sql2 = "select left(suppname, 7) from Supplier where suppname= '$suppname'";
		$nt2 = $db->Execute($sql2);
		while(!$nt2->EOF)
		{
			echo '<tr>';
				echo '<td style="font-weight:bold;">SUPPLIER (7 KARAKTER)</td>';
				echo '<td>: '. $nt2->fields[0] .' </td>';
			echo '</tr>';
			
			$supp = $nt2->fields[0]; 
			$nt2->MoveNext();
		}
		//	end
		
		$label 		= 0;
		$label 		= intval($qty / $pack);
		$sisa  		= $qty % $pack;
		$qtystd 	= $label;
		$qtybal 	= $sisa;
		if($sisa > 0)
		{
			$label++;
		}
	echo '</table>';
	
	
	
	//echo '<a href="http://136.198.117.5:85/barcode/brcview.php?partno=' . $partno . '&po=' . $po . '&pack=' . $pack . '&qtystd=' . $qtystd . '&qtybal=' . $qtybal . '&tgl=' . $tglbaik . '&suppname=' . $suppname . '&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print Samsung</a></td>'; 
	//echo '<br>';
	echo '<a href="http://10.230.30.84/receiving/brcpreview.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label New</a></td>';
	echo '<br>';
	echo '<a href="http://10.230.30.84/receiving128/brcpreview.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label 128</a></td>'; 

	$nt2->close();
	$nt->close();
	$db->close();
?>
</body>
</html>

