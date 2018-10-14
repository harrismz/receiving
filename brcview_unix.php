<?php
	/*
	****	modify by Mohamad Yunus
	****	on 25 Jan 2017
	****	revise: penambahan supplier code di pengambilan stdpack
	*
	****	modify by Harris
	****	on 28 Feb 2018
	****	revise: qrcode unique
	****	on 16 August 2018
	****	revise: add critical part category
	
	*/
?>
<html>
<title>Barcode Print Part Select</title>
<body>
<?php

include "koneksi.php";
include "../adodb/con_qrinvoice.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST')
  {
    // bukan dari posting
  }
else
  {
    $partno 	= trim($_POST['part']);
	$suppname 	= trim($_POST['suppname']);
	$suppcode 	= trim($_POST['suppcode']);
    $po     	= $_POST['po'];
    $qty    	= $_POST['qty'];
    $invno    	= $_POST['invno'];
    //--critical part--
    $proddate 	= $_POST['proddate'];
    $lotnosupp	= $_POST['lotnosupp'];
	//-----------------
	$rs4 = $db_qrinvoice->Execute("select case imincl when '1' then 'Direct' else 'Inspection' end as sts_insp from sa96t where iprod = '". $partno ."'");
	$sts_inspection = $rs4->fields[0];
	$rs4->Close();

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
		$sql = "select * from stdpack where suppcode = '{$suppcode}' and partnumber= '{$partno}'";
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
		
		echo '<tr>';
			echo '<td width="200px" style="font-weight:bold;">STATUS INSPECTION</td>';
			echo '<td>: '. strtoupper($sts_inspection) .' </td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td colspan="2">&nbsp;</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td colspan="2">-------------------- CRITICAL PART --------------------</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td style="font-weight:bold;">PROD. DATE</td>';
			echo '<td>: '. $proddate .' </td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td style="font-weight:bold;">LOT NO SUPPLIER</td>';
			echo '<td>: '. $lotnosupp .' </td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td colspan="2">---------------------------------------------------------------</td>';
		echo '</tr>';



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
	//echo '<a href="http://136.198.117.5:85/barcode/brcview.php?partno=' . $partno . '&po=' . $po . '&pack=' . $pack . '&qtystd=' . $qtystd . '&qtybal=' . $qtybal . '&suppname=' . $suppname . '&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print Samsung</a></td>';
	//echo '<br>';
	//echo '<a href="http://10.230.30.84/receiving/brcpreview.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label New</a></td>';

	echo '<a href="receiving128/brcpreview.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'&suppcode='. $suppcode .'&stsinsp=' . $sts_inspection . '">Print SATO Label 128</a></td>';
	echo '<br>';
	echo '<a href="receivingqr/brcpreview_unix.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'&suppcode='. $suppcode .'&stsinsp=' . $sts_inspection . '&proddate=' . $proddate . '&lotnosupp=' . $lotnosupp . '">Print SATO Label QRCode</a></td>';
	echo '<br>';

	$host		= getenv("REMOTE_ADDR");
	if(  $host == '10.230.30.104' || $host == '10.230.30.115' || $host == '136.198.117.40' || $host == '10.230.30.102' ){
	// tidak dipakai	
	}
/*
	if(  $host == '10.230.30.104' || $host == '136.198.117.40' ){
		echo '<br>';
		echo '<a target="_blank" href="http://136.198.117.40/barcode_sato/tes_index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label (SVRPAYROLL)</a></td>';
		echo '<br>';
		echo '<a target="_blank" href="http://136.198.117.18:85/barcode_sato/tes_index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label (SVRDBP)</a></td>';
		echo '<br>';
	echo '<a href="http://10.230.30.84/barcode_sato/index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label (Training)</a></td>';
	}

	if(  $host == '10.23037119' ){
		echo '<br>';
		echo '<a target="_blank" href="http://136.198.117.18:85/barcode_sato/tes_index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'">Print SATO Label (SVRDBP)</a></td>';
	}
*/
} // end of if post...

$nt->close();
$nt2->close();
?>
</body>
</html>
