<html>
<head>
<title>Issue Part List Printing</title>
<script type="text/javascript">
	function mulai()
	{
		var myso = document.getElementById('idso');
		out.println(myso);
		
	    myso.value = "";
	    myso.focus();
	}
</script>
</head>
<body onload="document.forms[0].idso.focus()">
<a href="index.php">Kembali menu</a><br /><br />
<?php
	if ($_SERVER['REQUEST_METHOD'] != 'POST')
	{
?>
	<form method="post" action="../barcode/issue_part_list_preview.php" onsubmit="mulai()">
	<table border="0" cellpadding="0" width="1000">
		<tr>
			<td width="100" valign="top">Separation Kategori</td>
			<td width="600">
				<input type="radio" name="kategori" value="SML" checked>Small Parts<br />
				<input type="radio" name="kategori" value="MDL">Medium Parts<br />
				<input type="radio" name="kategori" value="BIG">Big Parts
			</td>
		</tr>
		<tr>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="600"> 
				<input type="text" name="idso" class="kelas1" /> 
				<input type="submit" name="submit" value="Submit" class="dua" />
			</td>
		</tr>
	</table>	
	</form>
<?php 	} //end  if ($_SERVER['REQUEST_METHOD'] != 'POST') ?>
</body>
</html>
