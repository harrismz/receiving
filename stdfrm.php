<?php



include "koneksi.php";
$con = mssql_connect($_MSSQL[Host], $_MSSQL[User], $_MSSQL[Pass]) or die("Cant connect to database");
mssql_select_db($_MSSQL[DBNa], $con);



if(isset($_GET['supp']))  
  {    
    $vsupp = $_GET['supp'];    
    $vpartno = $_GET['partno'];         
    // tampilkan data lama....    
    $sqlstd = "select * from stdpack where suppcode ='$vsupp' and partnumber = '$vpartno'";    
    $resstd=mssql_query($sqlstd,$con);    
    while($recstd=mssql_fetch_array($resstd))    
      {      
        $partname = $recstd[2];      
        $qty = $recstd[3];    
      }            
        // form ........    
    echo '<form method="post" action="stdedit.php">';    
    echo 'PART NUMBER : ';    
    echo '<input type="text" name="partno" id="partno" value="' . $vpartno . '" readonly="readonly" />';    
    echo '<br />PART NAME    : ';    
    echo '<input type="text" name="partname" id="partname" value="' . $partname . '" readonly="readonly" /><br />';    
    echo 'QTY : ';    
    echo '<input type="text" name="qty" id="qty" value="' . $qty . '" />';    
    echo '<br />';    
    echo '<input type="hidden" name="hdnsupp" id="hdnsupp" value="' . $vsupp . '" />';    
    echo '<input type="submit" name="submit" value="UPDATE QTY" />';    
    echo '</form>';  
  }

mssql_close($con);

?>