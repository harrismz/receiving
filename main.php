<?php

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title>SO DATA UPLOAD</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body class="body1">
<br /><br /><div class="header2">Import Stuffing Data</div>
<div>
<form method="post" action="maindata.php" ENCTYPE="multipart/form-data">
Upload Vanning Header (header.csv)<br />
<input type="file" name="userfile">
<input type="submit" value="Upload">
<input type="hidden" name="loadheader" value="ok">
<input type="hidden" name="magic" value="<?php echo $magic; ?>">
</form>
</div>
<form method="post" action="detaildatacsv.php" ENCTYPE="multipart/form-data">
<div>
Upload Vanning Detail (detail.csv)<br />
<input type="file" name="userfile">
<input type="submit" value="Upload">
<input type="hidden" name="loaddetail2" value="ok">
<input type="hidden" name="magic" value="<? echo $magic; ?>">
</div>
</form>
<form method="post" action="detaildata.php" ENCTYPE="multipart/form-data">
<div>
Upload Vanning Result (Scan result)<br />
<input type="file" name="userfile">
<input type="submit" value="Upload">
<input type="hidden" name="loaddetail" value="ok">
<input type="hidden" name="magic" value="<?php echo $magic; ?>">
</div>
</form>
</body>
</html>
