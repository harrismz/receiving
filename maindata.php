<?
require "connections.php";
//echo $magic;
$magic = "test";
function meta_redirect($url,$secs=0,$target="self_") {
  echo("<meta http-equiv=\"refresh\" content=\"$secs; URL=$url\" target=\"$target\">");
}

if ($_REQUEST["loadheader"] == "ok") { 
   if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) 
   {
   	//	echo "It really is an Uploaded File!\n"; 
       //echo "Stored in : " . $_FILES["userfile"]["tmp_name"] . "<br>";       	
       //echo "Upload : " . $_FILES["userfile"]["tmp_name"] . "<br>";
      $namatemp = $_FILES['userfile']['tmp_name'];
    //  $kopifile = "/var/lib/mysql/stuffing/header" .$magic . ".csv";
      $kopifile = "/tmp/header" .$magic . ".csv";
      echo "source file : " . $namatemp . "<br>";
     echo "dest file : "  . $kopifile . "<br>";
           copy($namatemp,  $kopifile);
      // 	$userfilez=$_FILES["userfile"]["name"];
//echo "<br>nama file yg diupload : " . $_FILES["userfile"]["name"] . "<br>";
   }
   else 
   {
      // echo "It is NOT\n"; 
       //meta_redirect("main.php",1);
   }
} 
//insert to table

//echo "magic=".$magic."<BR>";

$sqldeltbl = "drop table header" .$magic;
$qrydeltbl = mysql_query($sqldeltbl);

$sqc = "CREATE TABLE header".$magic." (ContNo varchar(15),SealNo varchar(10),VanningID varchar(15),VanningDate varchar(15),Destination varchar(30))";
//echo "sqc : " . $sqc."<BR>";  
$resc = mysql_query($sqc);

?>
<link href="lookatme.css" rel=STYLESHEET type=text/css>
<body class="body1">
<?
$tab=',';
//$sql = "load data infile '".$userfilez."' into table header".$magic." fields terminated by '".$tab."'";

$sql = "load data local infile '/tmp/header".$magic.".csv' into table header".$magic." fields terminated by '".$tab."'";
//echo $sql."<BR>";
$result = mysql_query($sql);
//unlink("/var/www/stuffing/files/$userfilez");
//echo "<font color=\"#996633\">Finish master data loading....., you must check first as shown below!!</font>"; 
?>
      <table width="500" align="center" cellpadding="0" cellspacing="1">
        <tr class="bluewhite"> 
          <td nowrap class="kotak1">No.</td>
          <td nowrap class="kotak1">Container No</td>
          <td nowrap class="kotak1">Seal No</td>
          <td nowrap class="kotak1">Vanning ID</td>
          <td nowrap class="kotak1">Vanning Date</td>
          <td nowrap class="kotak1">Destination</td>
        </tr>
        <?
		$sqz = "select * from header".$magic;
		//echo $sqz."<BR>";
		$rez = mysql_query($sqz);
		$no=1;
		$count=0;
		while ($mgz = mysql_fetch_array($rez, MYSQL_ASSOC)){
			$v = $mgz['model'];
			if ($count == 0) {$temp = $v;}
			if ($v == $temp) {$color = ($color=="F3F4FC")?"BFE0FB":"F3F4FC";}
		?>
        <tr bgcolor="<?=$color?>"> 
          <td nowrap> 
            <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" class=textblack> 
              <?=$no;?>
              </font></div>
          </td>
          <td nowrap> <font face="Verdana, Arial, Helvetica, sans-serif" size="2" class=textblack>&nbsp; 
            <?=$mgz["ContNo"];?>
            </font></td>
          <td nowrap><font face="Verdana, Arial, Helvetica, sans-serif" size="2" class=textblack>&nbsp; 
            <?=$mgz["SealNo"];?>
            </font></td>
          <td nowrap><font face="Verdana, Arial, Helvetica, sans-serif" size="2" class=textblack>&nbsp; 
            <?=$mgz["VanningID"];?>
            </font></td>
          <td nowrap><font face="Verdana, Arial, Helvetica, sans-serif" size="2" class=textblack>&nbsp; 
            <?=$mgz["VanningDate"];?>
            </font></td>
          <td nowrap><font face="Verdana, Arial, Helvetica, sans-serif" size="2" class=textblack>&nbsp; 
            <?=$mgz["Destination"];?>
            </font></td>
        </tr>
        <?
			$temp = $v;
			$color = ($color=="F3F4FC")?"BFE0FB":"F3F4FC";
			$count++;    
			$no++;}
		?>
      </table>
<div>
<span>
<form name="continue" method="post" action="maindata_go.php">
        <div align="right">
          <input type="submit" name="continue" value="Continue">
<!--          <input type="hidden" name="magic" value="<? echo $magic;?>"> -->
        </div>
      </form>
	  </span>
<form name="cancel" method="post" action="maindata_delete.php">
	<input type="submit" name="cancel" value="Cancel">
<!--   <input type="hidden" name="magic" value="<? echo $magic;?>">  -->
</form>
</div> 
</body>
