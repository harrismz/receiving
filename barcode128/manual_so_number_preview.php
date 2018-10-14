<a href="../index.php">Kembali menu</a><br /><br />

<?php
	include('../../ADODB/adodb5/adodb.inc.php');
	
	$db = ADONewConnection('odbc_mssql');
	$dsn = "Driver={SQL Server};Server=SVRDBN\JEINSQL2012;Database=edi;";
	$db->Connect($dsn,'sa','JvcSql@123');
	
	// Including all required classes
	require('class/BCGFont.php');
	require('class/BCGColor.php');
	require('class/BCGDrawing.php'); 

	// Including the barcode technology
	include('class/BCGcode128.barcode.php'); 
	
	$txtso0 = $_POST['idso0'];
	$txtso1 = $_POST['idso1'];
	$txtso2 = $_POST['idso2'];
	$txtso3 = $_POST['idso3'];
	$txtso4 = $_POST['idso4'];
	$txtso5 = $_POST['idso5'];
	$txtso6 = $_POST['idso6'];
	$txtso7 = $_POST['idso7'];
	$txtso8 = $_POST['idso8'];
	$txtso9 = $_POST['idso9'];
	$txtso10 = $_POST['idso10'];
	$txtso11 = $_POST['idso11'];
	$txtso12 = $_POST['idso12'];
	$txtso13 = $_POST['idso13'];
	
	$a = array(); 
	$a[0]		= $txtso0;
	$a[1]		= $txtso1; 
	$a[2]		= $txtso2;
	$a[3]		= $txtso3;
	$a[4]		= $txtso4;
	$a[5]		= $txtso5;
	$a[6]		= $txtso6;
	$a[7]		= $txtso7;
	$a[8]		= $txtso8; 
	$a[9]		= $txtso9;
	$a[10]		= $txtso10;
	$a[11]		= $txtso11;
	$a[12]		= $txtso12;
	$a[13]		= $txtso13;
?>
	
<table border="0" cellpadding="0" cellspacing="0" width="800">
<tr>
<?php
	$counter = 0;
	foreach($a as $so_number)
	{
		
		$sql_check = $db->Execute("select * from sa90m where so = '$so_number'");
		$row_check = $sql_check->fields[0];

		if(!$row_check)
		{
			$so_number = str_replace($so_number,"",$so_number);
		} // end if(!$row_check)
		else
		{
			$so_number;
		} // end else
		
	        if($counter != 0 && $counter%2 == 0) 
			{
?>
</tr>
<tr>
<?php  		} // end if($counter != 0 && $counter%2 == 0) ?>
	<td>
		<table border="0" cellpadding="0" width="250">
		<?php 
				if($so_number != "")
				{
					$rs = $db->Execute("select top 1 * from sa90m where so = '$so_number'");

					$namafile = $rs->fields[0] . '.jpg';

					// Loading Font
					$font = new BCGFont('./class/font/Arial.ttf', 18);

					// The arguments are R, G, B for color.
					$color_black = new BCGColor(0, 0, 0);
					$color_white = new BCGColor(255, 255, 255); 

					$code = new BCGcode128();
					$code->setScale(2); // Resolution
					$code->setThickness(30); // Thickness
					$code->setForegroundColor($color_black); // Color of bars
					$code->setBackgroundColor($color_white); // Color of spaces
					$code->setFont($font); // Font (or 0)
					$code->parse($rs->fields[0]); // Text

					/* Here is the list of the arguments
					1 - Filename (empty : display on screen)
					2 - Background color */
					$drawing = new BCGDrawing('', $color_white);
					$drawing->setBarcode($code);
					$drawing->setFilename('image_so_number/'.$namafile);
					$drawing->draw();

					// Header that says it is an image (remove it if you save the barcode to a file)
					//header('Content-Type: image/png');

					// Draw (or save) the image into PNG format.
					$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);	

					echo '<tr>';
					echo '<td align="center"><font size="2">'. $rs->fields[5] . '</font></td>';
					echo '<td align="center"><font size="2">'. $rs->fields[6] . '</font></td>';
					echo '<td align="center"><font size="2">'. $rs->fields[7] . '</font></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="3" align=center><img width="250" height="95" title="barcode" src="image_so_number/' . $namafile . '" alt="gambar barcode" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="3"><br /></td>';
					echo '</tr>';
				} // end if($so_number != "")
		?>
		</table>
	</td>
<?php
		$counter++;
	} // end foreach($a as $so_number)
?>
</tr>
</table>

<?php 
	$rs->Close(); 
	$db->Close();
?>