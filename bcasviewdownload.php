<?php
include "koneksi.php";
echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Download Report : <br />';

echo '<form method="post" action="bcasdownloadori.php">';
echo 'Input Year & date YYYYMM ex: 201410 : &nbsp;&nbsp;';
echo '&nbsp;&nbsp;';
echo '<input type="text" name="txtso" id="txtso" />';
echo '&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<input type="submit" name="submit" value="Submit" />';
echo '</form>';


echo '</body>';
echo '</html>';

?>
