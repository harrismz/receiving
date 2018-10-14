<?php
include "koneksi.php";
echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Updating Partno <br />';

	//  insert or update data to SA90M  table  (   used by transacation  and history )	
set_time_limit(7200);  // Set limit time fpr maximum execute
$baris = 0;
$sqlbaca = "select ab, i, j from sa90temp";
$brsbaca = $db->Execute($sqlbaca);	
while(!$brsbaca->EOF)
 {
   $ceksuppcode = $brsbaca->fields[0];  
   $cekpartno = $brsbaca->fields[1];
   $cekpartname = $brsbaca->fields[2];
      
   $sqlada = $db->Execute("select * from stdpack where partnumber = '$cekpartno'");
   $cekdata = $sqlada->RecordCount();
   
   if($cekdata == 0)
    {
	 $baris++;
     $cekso = $brsbaca->fields[0];
	 echo ' ** ';
	 echo $baris;
	 echo ' ** partno : ';
	 echo $cekpartno;
	 echo ' , Supplier code : ';
	 echo $ceksuppcode;
	 echo ' is nothing.. inserting ...<br />';
     $sqlins = " insert into stdpack(suppcode,partnumber,partname,stdpack )";
	 $sqlins .= "values('$ceksuppcode','$cekpartno','$cekpartname',999999)";
     $hslins = $db->Execute($sqlins);
    }

   $brsbaca->MoveNext(); 
 }
 //$hslins->Close();
$brsbaca->close();
	
// update suppcode stdpack sama dengan sa90temp
// update Yunus - 17 September 2015
$sqlupd = "	update stdpack  
			set stdpack.suppcode = sa90temp.ab
			from stdpack  
			right join sa90temp on stdpack.partnumber = sa90temp.i
			where stdpack.suppcode <> sa90temp.ab";
$hslupd = $db->Execute($sqlupd);
$hslupd->close();
//	end of update suppcode stdpack sama dengan sa90temp			echo '<br />';
echo 'Additional part number finished ...total add : ';
echo $baris;
echo '</body>';echo '</html>';

// tutup koneksi 12 des 2011
// update 19 April 2013 - Imam Prayudi
$db->Close();
?>