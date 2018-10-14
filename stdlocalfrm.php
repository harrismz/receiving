<?php
include "koneksi.php";

if(isset($_GET['supp']))  
  {    
    $vsupp = $_GET['supp'];    
    $vpartno = $_GET['partno'];         
    // tampilkan data lama....    
	$rs = $db->Execute("select * from stdpack where suppcode ='$vsupp' and partnumber = '$vpartno'");
  
while (!$rs->EOF)	
      {      
        $partname = $rs->fields[2];      
        $qty = $rs->fields[3];    
		$lokasi = $rs->fields[6];
		$rs->MoveNext();
      }            
        // form ........    
    echo '<form method="post" action="stdlocaledit.php">';    
    echo 'PART NUMBER : ';    
    echo '<input type="text" name="partno" id="partno" value="' . $vpartno . '" readonly="readonly"/>';    
    echo '<br />PART NAME    : ';    
    echo '<input type="text" name="partname" id="partname" value="' . $partname . '" readonly="readonly" /><br />';        
    echo 'QTY : ';    echo '<input type="text" name="qty" id="qty" value="' . $qty . '" />';    
    echo '<br />';    
    echo 'LOCATION : ';    echo '<input type="text" name="loc" id="loc" value="' . $lokasi . '" />';    
    echo '<br />';    
	echo '<input type="hidden" name="hdnsupp" id="hdnsupp" value="' . $vsupp . '" />';    
    echo '<input type="submit" name="submit" value="UPDATE" />';    
    echo '</form>';  
  }

$rs->Close();

?>