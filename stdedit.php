<?phpinclude "koneksi.php";
// Connect to server and select databse.$con = mssql_connect($_MSSQL[Host], $_MSSQL[User], $_MSSQL[Pass]) or die("Cant connect to database");
mssql_select_db($_MSSQL[DBNa], $con);
// next.....
if(isset(if ($_SERVER['REQUEST_METHOD'] != 'POST')   
  {    
    // echo 'PROSES BUKAN DARI POSTING';   
  } 
else   
  {     
    $vsupp = $_POST['hdnsupp'];     
    $vpartno = $_POST['partno'];     
    $vqty = $_POST['qty'];    
    // update data     
    $sql = "update stdpack set stdpack = " . $vqty . " where suppcode = '" . $vsupp . "' and partnumber = '" . $vpartno . "'";     
    echo $sql;     
    $rs = mssql_query($sql,$con);     
    if(!$rs)       
      {         
        echo "sql error : " . mssql_get_last_message();       
      }   
   } //end of else request method post...
     // page redirectecho "<script language="javascript">location.href='stdpack.php';</script>"; 
ob_start();header("Location:stdpack.php");ob_flush();
mssql_close($con);
?>