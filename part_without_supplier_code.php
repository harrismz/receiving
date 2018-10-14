<?php
	include "koneksi.php";
	// include('../ADODB/connection.php');
		
	// hapus record table partnull
	$sqldeltemp = "delete from partnull";
	$hasildeltemp = $db->Execute($sqldeltemp);
	
	// insert data ke  partnull
	$sqlins = "insert into partnull select distinct a.partno, a.partname from sa90m a left join stdpack b on a.partno = b.PartNumber where b.PartName is null";
	$hasilins= $db->Execute($sqlins);
	
	// bersihkan double quote
	$sqlupd = "update partnull set partno = REPLACE(partno,CHAR(34),''), partname = REPLACE(partname,CHAR(34),'')";
	$hasilupd = $db->Execute($sqlupd);

	
	// insert data ke  stdpack
	$sqlins_stdpack = "insert into stdpack(SuppCode, StdPack, PartNumber,PartName,Kategori) select '99000','1',partno, partname,'SML' from partnull";
	$hasilins_stdpack = $db->Execute($sqlins_stdpack);
	
	// bersihkan double quote
	$sqlupd_stdpack = "update stdpack set SuppCode = REPLACE(SuppCode,CHAR(34),''), StdPack = REPLACE(StdPack,CHAR(34),''), PartNumber = REPLACE(PartNumber,CHAR(34),''), PartName = REPLACE(PartName,CHAR(34),''), Kategori = REPLACE(Kategori,CHAR(34),'')";
	$hasilupd= $db->Execute($sqlupd_stdpack);

	echo '<a href="index.php">Kembali menu</a><br /><br />';
	
	echo '<font size="5" color="red">Mohon Diubah SuppCode</font><br /><br />';

 	// query untuk menampilkan dan hitung data :
	// $rs = $db->Execute("select * from stdpack where (SuppCode='99000') or (suppCode='99999') and (Kategori='SML') and (StdPack='1')");
        $rs = $db->Execute("select * from stdpack where (SuppCode='99000') or (suppCode='99999') order by partnumber");
	$numrows = $rs->RecordCount();
		
	// tampilkan data
	echo '<table border="1" cellpadding=0 cellspacing=0 width=800>';
	echo '<tr>';
	echo '<td colspan=6 align=center>';
			if ($numrows!=0){
				echo 'Ditemukan data ( <b>'.$numrows.'</b> ) record<br />';
			}
			else{
				echo 'Ditemukan data ( <b>'.$numrows.'</b> ) record<br />';
			}
	echo '</td>';
	echo '</tr>';
	echo '<th>SUPPCODE</th>';
	echo '<th>PART.NO</th>';
	echo '<th>PART.NAME</th>';
	echo '<th>StdPack</th>';
	echo '<th>Kategori</th>';
	echo '<th>ACTION</th>';
	
	while (!$rs->EOF)
	{
		switch ($rs->fields[4]) 
		{
			case 'SML':
				$rs->fields[4]="SMALL PARTS";
				break;
			case 'MDL':
				$rs->fields[4]="MIDDLE PARTS";
				break;
			case "BIG":
				$rs->fields[4]="BIG PARTS";
				break;
		}
		
		echo '<tr>';
		echo '<td align=center>'. $rs->fields[0] .'</td>';
		echo '<td>'. $rs->fields[1] .'</td>';
		echo '<td>'. $rs->fields[2] .'</td>';
		echo '<td align=right>'. $rs->fields[3] .'</td>';
		echo '<td align=center>'. $rs->fields[4] .'</td>';
		echo '<td align=center><a href="suppcode_edit.php?supp=' . trim($rs->fields[0]) . '&partno=' . $rs->fields[1] . '&partname=' . $rs->fields[2] . '">EDIT</a></td>' ;
		echo '</tr>';
		
		$rs->MoveNext();			
	} // end while (!$rs->EOF)	
	echo '</table>';
	
	$rs->Close(); $db->Close(); 

?>




