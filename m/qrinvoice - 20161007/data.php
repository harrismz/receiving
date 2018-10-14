<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href= "icons/qr.ico"/>
	
	<!--jQuery Mobile-->
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	
	<!--Content-->
	<script type="text/javascript">
		$.getJSON("json/json_data.php", function(json){
			var header= "<thead> <tr><th>User ID</th><th>Supp. Code</th><th>Invoice</th><th>Part No</th><th>PO</th><th>QTY</th><th>Scan Date</th></tr></thead>";
			var result= "";
			$.each(json, function(i, obj){
				//$('#tblbody').append("<tr><td>"+obj.userid+"</td> <td>"+obj.supp+"</td> <td>"+obj.inv+"</td> <td>"+obj.part+"</td> <td>"+obj.po+"</td> <td>"+obj.qty+"</td> <td>"+obj.rcvdate+"</td></tr>");
				//$('#tblbody').append("<tr><td>1</td> <td>2</td> <td>3</td> <td>4</td> <td>5</td> <td>6</td> <td>7</td></tr>");
				result+= "<tr><td>"+obj.userid+"</td> <td>"+obj.supp+"</td> <td>"+obj.inv+"</td> <td>"+obj.part+"</td> <td>"+obj.po+"</td> <td>"+obj.qty+"</td> <td>"+obj.rcvdate+"</td></tr>";
			});
			$("#tblbody").append("<tbody>");
			$("#tblbody").append("<tbody>");
			$("#tblbody").append(result);
			$("#tblbody").append("</tbody>");
		});
	</script>
</head>
<body>
	<div data-role="page" id="pagedata">
		<div data-role="header">
			<h1>Scan Receive Invoice</h1>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="home.php" data-icon="home"></a></li>
			</ul>
		</div>
		
		<div data-role="main" class="ui-content">				
			<form><input id="filterTable-input" data-type="search" placeholder="search by po"></form>
			<table data-role="table" class="ui-responsive" data-filter="true" data-input="#filterTable-input">
				<thead>
					<tr>
						<th>No.</th>
						<th>User ID</th>
						<th>Supp. Code</th>
						<th>Invoice</th>
						<th>Part No</th>
						<th>PO</th>
						<th>QTY</th>
						<th>Scan Date</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include('con_mysql.php');
					$rs 	= $db->Execute("select userid, supp, inv, part, po, qty, date_format(rcvdate, '%d %b %Y %T'), id from rectrx order by id desc limit 30");
					
					$no = 1;
					while(!$rs->EOF){
						if($no % 2 == 0){
							echo "<tr bgcolor=#DCDCDC>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . trim($rs->fields['0']) . "</td>";
							echo "<td>" . trim($rs->fields['1']) . "</td>";
							echo "<td>" . trim($rs->fields['2']) . "</td>";
							echo "<td>" . trim($rs->fields['3']) . "</td>";
							echo "<td>" . trim($rs->fields['4']) . "</td>";
							echo "<td>" . trim($rs->fields['5']) . "</td>";
							echo "<td>" . trim($rs->fields['6']) . "</td>";
							echo "</tr>";
						}
						else{
							echo "<tr>";
							echo "<td>" . $no . "</td>";
							echo "<td>" . trim($rs->fields['0']) . "</td>";
							echo "<td>" . trim($rs->fields['1']) . "</td>";
							echo "<td>" . trim($rs->fields['2']) . "</td>";
							echo "<td>" . trim($rs->fields['3']) . "</td>";
							echo "<td>" . trim($rs->fields['4']) . "</td>";
							echo "<td>" . trim($rs->fields['5']) . "</td>";
							echo "<td>" . trim($rs->fields['6']) . "</td>";
							echo "</tr>";
						}
						$no++;
						$rs->MoveNext();
					}
					
					$rs->Close();
					$db->Close();
				?>
				</tbody>
				
				
				<!--
				<thead>
					<tr>
						<th>User ID</th>
						<th>Supp. Code</th>
						<th>Invoice</th>
						<th>Part No</th>
						<th>PO</th>
						<th>QTY</th>
						<th>Scan Date</th>
					</tr>
				</thead>
				<tbody>
				<!--
					<tr>
						<td>1</td>
						<td>Alfreds Futterkiste</td>
						<td>Maria Anders</td>
						<td>Obere Str. 57</td>
						<td data-rel="external">Berlin</td>
						<td>12209</td>
						<td>Germany</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Alfreds Futterkiste</td>
						<td>Maria Anders</td>
						<td>Obere Str. 57</td>
						<td data-rel="external">Cirebon</td>
						<td>12209</td>
						<td>Germany</td>
					</tr>
				--
				</tbody>
				-->
			</table>
		</div>
		
		<div data-role="footer">
			<?php if (date("Y") == 2016){ ?>
			<h1 style="font-size:10px;color:#a3a2a2;">Copyright &copy; <?php echo date("Y"); ?> IT Department. All rights reserved.</h1>
			<?php }else{ ?>
			<h1 style="font-size:10px;color:#a3a2a2;">Copyright &copy; 2016 - <?php echo date("Y"); ?> IT Department. All rights reserved.</h1>
			<?php } ?>
		</div>
	</div>
</body>
</html>
