<html>
<title>Standard Packing Maintenance -  Part Select</title>
<body>
<?php

include "koneksi.php";

if(isset($_GET['supp']))

  {
    $supp = $_GET['supp'];
  }


if ($_SERVER['REQUEST_METHOD'] != 'POST')
  {
    // bukan dari posting
  }
else
  {
    $supp = $_POST['supp'];
  }	   
// nampilin Supplier name : 
$rs = $db->Execute("select * from supplier where suppcode = '$supp'");
while (!$rs->EOF)
   {
      $suppname = $rs->fields[1];
	  $rs->MoveNext();
   }

echo 'Supplier name : ' . $suppname . ' - ' . $supp . ' - ';
echo '&nbsp;&nbsp;';
echo '<a href="index.php">menu</a>';

$rs = $db->Execute("select * from stdpack where suppcode = '$supp'");
// $sql = "select * from stdpack where suppcode = '$supp'";
// $result=mssql_query($sql,$con);

// buat table
echo '<table border="1">';
echo '<th>Part.No</th>';
echo '<th>Part Name</th>';
echo '<th>Std.Pack</th>';
echo '<th>LOCATION</th>';
echo '<th>EDIT</th>';

while (!$rs->EOF)
  {
    echo '<tr>';
	echo '<td>' . $rs->fields[1] . '</td><td>' . $rs->fields[2] . '</td><td align="right">' . $rs->fields[3] . '<td>' . $rs->fields[6] ;
	echo '</td><td><a href="stdlocalfrm.php?supp=' . trim($supp) . '&partno=' . $rs->fields[1] . '">EDIT</a></td>' ;  
    echo '</tr>';
 //    echo $nt[0] . ' - ' . $nt[1] . '<br />';
    $rs->MoveNext();
  } // end of while
 echo '</table>';


$rs->Close();
?>
</body>
</html>

