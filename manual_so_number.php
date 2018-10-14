<html>
<head>
<title>Manual Barcode Printing</title>
<script type="text/javascript">
	function mulai()
	{
		var myso = document.getElementById('idso0');
		out.println(myso);
		
	    myso.value = "";
	    myso.focus();
	}
</script>
</head>
<body onload="document.forms[0].idso0.focus()">
<a href="index.php">Kembali menu</a><br /><br />
<?php
	if ($_SERVER['REQUEST_METHOD'] != 'POST')
	{
?>
	<form method="post" action="barcode128/manual_so_number_preview.php" onsubmit="mulai()">
	<table border="0" cellpadding="0" width="800">
		<tr>
			<td width="10" valign="top">&nbsp;&nbsp;1.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso0" class="kelas1" /> </td>
			<td width="10" valign="top">&nbsp;&nbsp;2.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso1" class="kelas1" /> </td>
		</tr>
		<tr>
			<td width="10" valign="top">&nbsp;&nbsp;3.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso2" class="kelas1" /> </td>
			<td width="10" valign="top">&nbsp;&nbsp;4.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso3" class="kelas1" /> </td>
		</tr>
		<tr>
			<td width="10" valign="top">&nbsp;&nbsp;5.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso4" class="kelas1" /> </td>
			<td width="10" valign="top">&nbsp;&nbsp;6.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso5" class="kelas1" /> </td>
		</tr>
		<tr>
			<td width="10" valign="top">&nbsp;&nbsp;7.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso6" class="kelas1" /> </td>
			<td width="10" valign="top">&nbsp;&nbsp;8.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso7" class="kelas1" /> </td>
		</tr>
		<tr>
			<td width="10" valign="top">&nbsp;&nbsp;9.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso8" class="kelas1" /> </td>
			<td width="10" valign="top">10.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso9" class="kelas1" /> </td>
		</tr>
		<tr>
			<td width="10" valign="top">11.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso10" class="kelas1" /> </td>
			<td width="10" valign="top">12.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso11" class="kelas1" /> </td>
		</tr>
		<tr>
			<td width="10" valign="top">13.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso12" class="kelas1" /> </td>
			<td width="10" valign="top">14.</td>
			<td width="100" valign="top">SO NUMBER</td>
			<td width="200"> <input type="text" name="idso13" class="kelas1" /> </td>
		</tr>
		<tr>
			<td colspan="6"> <input type="submit" name="submit" value="Preview Barcode" class="dua" /> </td>
		</tr>
	</table>		
	</form>
<?php 	} //end if ($_SERVER['REQUEST_METHOD'] != 'POST') ?>
</body>
</html>
