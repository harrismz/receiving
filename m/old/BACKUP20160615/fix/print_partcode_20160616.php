<html>
	<head>
		<title>PRINT SCHEDULE</title>
		<link rel="stylesheet" href="jquery/jquery-ui.css"> 
		<script src="jquery/jquery-1.12.0.min.js"></script> 
		<script src="jquery/jquery-ui.js"></script> 
		<script>
			$(document).ready(function(){
				if ( $('.dt')[0].type != 'date' ) $('.dt').datepicker({ dateFormat: 'yy-mm-dd' });
			});	
		</script>
	</head>
	<body>
		<a href="http://136.198.117.48/receiving/index_edit.php">BACK TO MENU</a>
		<br>
		<form method="post" enctype="multipart/form-data" action="print_partcode_sch.php">
			<h3>PARTLIST SCHEDULE</h3>
			<hr>
			<table>
				<tr>
					<td><label>DATE ISSUE</label></td>
					<td>:</td>
					<td><input type="date" class="dt" name="issue_date" id="issue_date"></input></td>
				</tr>
				<tr>
					<td><label>LINE</label></td>
					<td>:</td>
					<td><input type="text" name="issue_date" id="issue_date"></input></td>
				</tr>
				<tr>
					<td><label>MODEL</label></td>
					<td>:</td>
					<td><input type="text" name="issue_model" id="issue_model"></input></td>
				</tr>
				<tr>
					<td><label>PROD NO</label></td>
					<td>:</td>
					<td><input type="text" name="issue_prodno" id="issue_prodno"></input></td>
				</tr>
				<tr>
					<td><label>LOT</label></td>
					<td>:</td>
					<td><input type="text" name="issue_lot" id="issue_lot"></input></td>
				</tr>
				<tr>
					<td><label>QTY</label></td>
					<td>:</td>
					<td><input type="text" name="issue_qty" id="issue_qty"></input></td>
				</tr>
				<tr>
					<td colspan="3" align="right">
						<input type="submit" value="SUBMIT" />
					</td>
				</tr>
			</table>
			
			
		</form>
	</body>
</html>