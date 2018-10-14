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
		function loadform(){ $("#filterTable-input").focus(); }
		
		$(document).on("pagecreate","#pagedata", function(){
			var tHead = $('table#app-status-table thead');
			var headRow = "<tr>";
				headRow += "<th>No.</th>";
				headRow += "<th>User ID</th>";
				headRow += "<th>Supp. Code</th>";
				headRow += "<th>Custom</th>";
				headRow += "<th>Invoice</th>";
				headRow += "<th>Part No</th>";
				headRow += "<th>PO</th>";
				headRow += "<th>QTY</th>";				
				headRow += "<th>Scan Date</th>";
				headRow += "</tr>";
			tHead.append(headRow);
			
			$.getJSON("json/json_datasum.php", function(json){
				var color = "";
				no = 1;
				$.each(json, function(i, obj){
					if(no % 2 == 0){
						color = "#DCDCDC";
					}else{
						color = "";
					}
				
					var datastore={
						no		: no,
						userid	: obj.userid,
						supp	: obj.supp,
						inv		: obj.inv,
						part	: obj.part,
						po		: obj.po,
						qty		: obj.qty,
						rcvdate	: obj.rcvdate,
						custom	: obj.custom,
						id		: obj.id,
						color	: color
					};
					showAppStatusData(datastore);
					no++;
				});
			});
		});
		
		function showAppStatusData(data) {
			var pageData = data;
			
			var tBody = $('#app-status-table tbody');
			var theRow = "<tr bgcolor="+data.color+">";
				theRow += "<td data-rel=external>" + data.no + "</td>";
				theRow += "<td data-rel=external>" + data.userid + "</td>";
				theRow += "<td data-rel=external>" + data.supp + "</td>";
				theRow += "<td data-rel=external>" + data.custom + "</td>";
				theRow += "<td data-rel=external>" + data.inv + "</td>";
				theRow += "<td data-rel=external>" + data.part + "</td>";
				theRow += "<td data-rel=external>" + data.po + "</td>";
				theRow += "<td data-rel=external>" + data.qty + "</td>";				
				theRow += "<td data-rel=external>" + data.rcvdate + "</td>";
				theRow += "</tr>";
			tBody.append(theRow);
			
			$("#app-status-table").table("refresh");
		}		
		
		function tohome(){
			window.location.href = 'home.php';
		}
		function todata(){
			window.location.href = 'data.php';
		}
	</script>
</head>
<body onload="loadform()">
	<div data-role="page" id="pagedata">
		<div data-role="header">
			<h1>Recap Data Receive Invoice</h1>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="#" class="ui-btn ui-icon-home ui-btn-icon-left"onclick="tohome()" title="Home">Home</a></li>
				<li><a href="#" class="ui-btn ui-icon-grid ui-btn-icon-left" onclick="todata()" title="View Data">Data Receive</a></li>
			</ul>
		</div>
		
		<div data-role="main" class="ui-content">
			<form><input id="filterTable-input" data-type="search" placeholder="search by"></form>
			<table id="app-status-table" data-role="table" class="ui-responsive" data-filter="true" data-input="#filterTable-input" >
				<thead>
                </thead>
                <tbody></tbody>
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
