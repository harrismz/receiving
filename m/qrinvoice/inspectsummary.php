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

		$(document).on('pagebeforecreate', '[data-role="page"]', function() { loading('show', 1); });
		$(document).on('pageshow', '[data-role="page"]', function() { loading('hide', 1000); });
		function loading(showOrHide, delay) {
		  setTimeout(function() {
			$.mobile.loading(showOrHide);
		  }, delay);
		}

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
				headRow += "<th>Send. Flag</th>";
				headRow += "<th>QTY</th>";
				headRow += "<th>Category</th>";
				//headRow += "<th>IQC Status</th>";
				headRow += "<th>Scan Date</th>";
				headRow += "</tr>";
			tHead.append(headRow);

			$.getJSON("json/json_inspectdatasum.php", function(json){
				var color = "";
				no = 1;
				$.each(json, function(i, obj){
					if(no % 2 == 1){
						color = "#DCDCDC";
					}else{
						color = "";
					}

					var datastore={
						no			: no,
						userid		: obj.userid,
						supp		: obj.supp,
						inv			: obj.inv,
						part		: obj.part,
						po			: obj.po,
						sendflag	: obj.sendflag,
						qty			: obj.qty,
						rcvdate		: obj.rcvdate,
						custom		: obj.custom,
						category	: obj.category,
						//lot_out		: obj.lot_out,
						pr_name		: obj.pr_name,
						color		: color
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
				theRow += "<td data-rel=external width='57' >" + data.userid + "</td>";
				theRow += "<td data-rel=external width='57' >" + data.supp + "</td>";
				theRow += "<td data-rel=external>" + data.custom + "</td>";
				theRow += "<td data-rel=external>" + data.inv + "</td>";
				theRow += "<td data-rel=external>" + data.part + "</td>";
				theRow += "<td data-rel=external>" + data.po + "</td>";
				theRow += "<td data-rel=external>" + data.sendflag + "</td>";
				theRow += "<td data-rel=external>" + data.qty + "</td>";
				theRow += "<td data-rel=external>" + data.category + "</td>";
				//if(data.lot_out == ''){
				//	theRow += "<td data-rel=external align=\"center\">-</td>";
				//}
				//else if(data.lot_out != '' && data.pr_name == ''){
				//	theRow += "<td data-rel=external width='100' align=\"center\">" + data.lot_out + "</td>";
				//}
				//else if(data.lot_out != '' && data.pr_name != ''){
				//	theRow += "<td data-rel=external width='100' align=\"center\">" + data.lot_out + " (" + data.pr_name + " )</td>";
				//}
				theRow += "<td data-rel=external>" + data.rcvdate + "</td>";
				theRow += "</tr>";
			tBody.append(theRow);

			$("#app-status-table").table("refresh");

		}

		function back(){
			window.location.href = '../../index.php';
		}
		function tohome(){
			window.location.href = 'home.php';
		}
		function todatasum(){
			window.location.href = 'summary.php';
		}
		function todatatrx(){
			window.location.href = 'trx.php';
		}
		function toinspectdatasum(){
			window.location.href = 'inspectsummary.php';
		}
	</script>
</head>
<body onload="loadform()">
	<div data-role="page" id="pagedata">
		<div data-role="header">
			<h1>Summary Data Inspection</h1>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="#" class="ui-btn ui-icon-back ui-btn-icon-left" onclick="back()" title="Back to Menu Receiving">Menu Receiving</a></li>
				<li><a href="#" class="ui-btn ui-icon-home ui-btn-icon-left"onclick="tohome()" title="Home">Home</a></li>
				<li><a href="#" class="ui-btn ui-icon-bullets ui-btn-icon-left" onclick="todatatrx()" title="View Data Detail">Detail Data Receive</a></li>
				<li><a href="#" class="ui-btn ui-icon-bullets ui-btn-icon-left" onclick="todatasum()" title="View Data Summary">Summary Data Receive</a></li>
				<li><a href="#" class="ui-btn ui-icon-bullets ui-btn-icon-left" onclick="toinspectdatasum()" title="View Data Summary">Summary Data Inspection</a></li>
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
