<?php
include "connections.php";
?>
<html>
<head>
<title>OUTGOING SCAN</title>
<script type="text/javascript">
function mulai()
{
var mymodel = document.getElementById('modelid');
var mytext = document.getElementById('idbarcode');
    mymodel.value = mytext.value;   
    mytext.value = "";
    mytext.focus();
}
</script>

</head>
<body onload="document.forms[0].barcode.focus()">

<?php
IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {

?>
     <form method="post" action="foutscan.php" target="foutscan" onsubmit="mulai()">
     CONT ID :
     <select name="cont" id="idcont">
<?php

     $sql = "select * from header order by contno";
     $rec = mysql_query($sql);
     while ($row = mysql_fetch_array($rec))
       {
         echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
       }
     echo '</select>';

?>
   &nbsp;&nbsp;&nbsp;&nbsp;
     SELECT SCAN TYPE :
     <select name="scantype" id="idscantype">
       <option value="AUTO">AUTO</option>
       <option value="MANUAL">MANUAL</option>
     </select>
     <br><br><br>
     
     BARCODE SCAN :
     <input type="text" name="barcode" id="idbarcode" class="kelas1" />
     <input type="submit" name="submit" value="Submit" class="dua" />
     <input type="hidden" name="modelhdn" id="modelid" />
   </form>    


<br>
<br>
</body>
</html>

<?php
   }

?>
