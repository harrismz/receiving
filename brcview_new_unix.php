<?php
	/*
	****	create by Mohamad Yunus
	****	on 19 December 2016
	****	revise: line (53) menambahkan kondisi kode supplier dan partno
	*/

	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	include "koneksi.php";
	include "../adodb/con_qrinvoice.php";
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
     //--critical part--
    $proddate 	= $_REQUEST['proddate'];
    $lotnosupp	= $_REQUEST['lotnosupp'];
	//-----------------

	$rs = $db->Execute("select suppname from supplier where suppcode = '".$suppcode."'");
	$suppname = $rs->fields[0];
	$rs->Close();
	
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
		$sql2 = "select left('$suppname', 7)";
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
	


	echo '<a href="receiving128/brcpreview.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'&suppcode='. $suppcode .'&stsinsp=' . $sts_inspection .'&proddate=' . $proddate .'&lotnosupp=' . $lotnosupp . '">Print SATO Label 128</a></td>';
	echo '<br>';
	echo '<a href="receivingqr/brcpreview_unix.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'&invno='. $invno .'&suppcode='. $suppcode .'&stsinsp=' . $sts_inspection .'&proddate=' . $proddate .'&lotnosupp=' . $lotnosupp . '">Print SATO Label QRCode</a></td>';
	echo '<br>';

	$nt2->close();
	$nt->close();
	$db->close();
?>
</body>
</html>
