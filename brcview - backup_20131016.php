<html>
<title>Barcode Print Part Select</title>
<body>
<?php

include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST')
  {
    // bukan dari posting
  }
else
  {
    $partno = trim($_POST['part']);
	$suppname = trim($_POST['suppname']);
    $po     = $_POST['po'];
    $qty    = $_POST['qty'];   
echo 'Supplier name : ' . $suppname . '<br />';
echo 'Part Number : ' . $partno . '<br />';
echo 'PO          : ' . $po . '<br />';
echo 'qty         : ' . $qty . '<br />';

$sql = "select * from stdpack where partnumber= '$partno'";
$nt = $db->Execute($sql);
while(!$nt->EOF)
  {
    echo 'standard pack : ' . $nt->fields[3] . '<br />';
	echo 'lokasi : ' . $nt->fields[6] . '<br />';
    $pack = $nt->fields[3]; 
    $lokasi = $nt->fields[6]; 
	$nt->MoveNext();
  }
  $nt->close();
  
$sql2 = "select left(suppname, 30) from Supplier where suppname= '$suppname'";
$nt2 = $db->Execute($sql2);
while(!$nt2->EOF)
  {
    echo 'supp : ' . $nt2->fields[0] . '<br />';
    $supp = $nt2->fields[0]; 
	$nt2->MoveNext();
  }

$label = 0;
$label = intval($qty / $pack);
$sisa  = $qty % $pack;
$qtystd = $label;
$qtybal = $sisa;
if($sisa > 0)
  {
    $label++;
  }

echo '<a href="http://136.198.117.5:85/barcode/brcview.php?partno=' . $partno . '&po=' . $po . '&pack=' . $pack . '&qtystd=' . $qtystd . '&qtybal=' . $qtybal . '&tgl=' . $tglbaik . '&suppname=' . $suppname . '&lokasi='. $lokasi .'&supp='. $supp .'">Print Samsung</a></td>'; 
//echo '<br>';
//echo '<a href="http://10.230.30.104/barcode_sato/index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'">Print SATO Label</a></td>'; 
echo '<br>';
echo '<a href="http://136.198.117.40/barcode_sato/index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'">Print SATO Label</a></td>'; 
$host		= getenv("REMOTE_ADDR");
if(  $host == '10.230.30.104' || $host == '136.198.117.40' ){
	echo '<br>';
	echo '<a target="_blank" href="http://10.230.30.104/barcode_sato/tes_index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'">Print SATO Label (EDP3)</a></td>'; 
}

if(  $host == '10.230.30.104' || $host == '136.198.117.40' ){
	echo '<br>';
	echo '<a target="_blank" href="http://136.198.117.40/barcode_sato/tes_index.php?partno='. $partno .'&po='. $po .'&suppname='. $suppname .'&pack='. $pack .'&qtystd='. $qtystd .'&qtybal='. $qtybal .'&qty='. $qty .'&lokasi='. $lokasi .'&supp='. $supp .'">Print SATO Label (SVRPAYROLL)</a></td>'; 
}

} // end of if post... 

$nt2->close();
?>
</body>
</html>

