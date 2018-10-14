<?php
session_start();
$myusername = $_SESSION['smyid'];
?>
<html>
<head>
<TITLE>STANDARD PACKING DATA MAINTENANCE</TITLE>
</head>
<body bgcolor="#ffffff">
<p>
<h3>
<IMG src="jvclogo.gif" align="left">
</h3>
PT.JVC ELECTRONICS INDONESIA<br>
STANDARD PACKING DATA MAINTENANCE<br>
<a href="menu.php">menu</a>
</p>
<br>
<br>
<?php
include "koneksi.php";
// Connect to server and select databse.
$con = mssql_connect($_MSSQL[Host], $_MSSQL[User],$_MSSQL[Pass]) or die("Cant connect to database");
mssql_select_db($_MSSQL[DBNa], $con);
$sql="SELECT * FROM usersupp WHERE userid='$myusername' order by suppname";
//$sql = "select * from usersupp where userid='jein' order by suppname";
$result=mssql_query($sql,$con);
//$count=mysql_num_rows($result);
//echo $count;
//echo "Welcome ". $myusername; 
//retrieve data$today = getdate();
//print_r($today[mon]);$tgl1 = $today[mday];$tgl2 = $today[mday];$bln1 = $today[mon];$bln2 = $today[mon];$thn1 = $today[year];$thn2 = $today[year];
//echo $bln1;

?>

<?php
while($nt=mssql_fetch_array($result))
{ 
  echo $nt[2].' ***** '.$nt[1];   $vsuppcode = trim($nt[1]);

}
echo '<br />';
// display standard packing dataecho '<table border="1">';
echo '<th>PARTNO</th><th>PART NAME</th><th>QTY</th><th>EDIT</th>';
$sqlstd = "select * from stdpack where suppcode = '$vsuppcode' order by partnumber"; 
$resstd = mssql_query($sqlstd,$con);
while($recstd=mssql_fetch_array($resstd))  
{     
  echo '<tr>';     
  echo '<td>' . $recstd[1] . '</td>';     
  echo '<td>' . $recstd[2] . '</td>';     
  echo '<td align="right">' . $recstd[3] . '</td>';     
  echo '<td><a href="stdfrm.php?supp=' . $vsuppcode . '&partno=' . $recstd[1] . '">edit</a></td>';     
  echo '</tr>';  
}

mssql_close($con);
?>
</table>
</body>
</html>