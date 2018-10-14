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
		function loadform(){ $("input[type=text], textarea").val(''); $("#nik").focus(); }	
		
		$.getJSON("json/json_cbsupp.php", function(json){
			$('select').empty().append('<option>-- Select Supplier -- </option>').selectmenu('refresh');
			$.each(json, function(i, obj){
				$('#supp').append($('<option />').text(obj.suppcode+" - "+obj.suppname).attr('value', obj.suppcode));
			});
		});
		
		function reset(){
			$("#nik").val("");
			$("#invoice").val("");
			$("#custno").val("");
			$("#barcode").val("");
			$.getJSON("json/json_cbsupp.php", function(json){
				$('select').empty().append('<option>-- Select Supplier -- </option>').selectmenu('refresh');
				$.each(json, function(i, obj){
					$('#supp').append($('<option />').text(obj.suppcode+" - "+obj.suppname).attr('value', obj.suppcode));
				});
			});
			$("#nik").focus();
		}
		
		function submit(){
			var nik 	= $("#nik").val();
			var supp 	= $("#supp").val();
			var invoice = $("#invoice").val();
			var custno 	= $("#custno").val();
			var barcode	= $("#barcode").val();
			
			$.ajax({
				url: "resp/resp_scaninvoice.php",
				type: "post",
				data: {
					nik 	: nik,
					supp 	: supp,
					invoice : invoice,
					custno 	: custno,
					barcode	: barcode
				},
				complete: function(r){
					var msg = r.responseText.split(",");
					if(msg[0] == 0){
						alert(msg[1]);
						$("#barcode").val("");
						$("#barcode").focus();
					}
					else{
						alert(msg[1]);
						$("#barcode").val("");
						$("#barcode").focus();
					}
				}
			});
		}
	</script>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<h1>Scan Receive Invoice</h1>
		</div>
		
		<div data-role="main" class="ui-content">
			<div data-role="collapsible" data-collapsed="true">
				<h1 onclick="loadform()">Click me - I'm collapsible!</h1>
				
				<div class="ui-field-contain">
					<label for="nik" style="font-weight:bold;color:grey;">NIK</label>
						<input type="text" name="nik" id="nik" data-clear-btn="true">
					<label for="supp" style="font-weight:bold;color:grey;">Supplier</label>
						<select name="supp" id="supp"></select>
					<label for="invoice" style="font-weight:bold;color:grey;">Invoice</label>
						<input type="text" name="invoice" id="invoice" data-clear-btn="true">
					<label for="custno" style="font-weight:bold;color:grey;">Cust No.</label>
						<input type="text" name="custno" id="custno" data-clear-btn="true">
					<label for="barcode" style="font-weight:bold;color:grey;">Barcode</label>
						<input type="text" name="barcode" id="barcode" data-clear-btn="true">
				</div>
				<input type="button" value="Submit" onclick="submit()">
				<input type="button" value="Reset" onclick="reset()">
			</div>
		</div>
<!--
		<div data-role="main" class="ui-content">
			<div class="ui-field-contain">
				<label for="nik" style="font-weight:bold;color:grey;">NIK</label>
					<input type="text" name="nik" id="nik" data-clear-btn="true">
				<label for="supp" style="font-weight:bold;color:grey;">Supplier</label>
					<select name="supp" id="supp"></select>
				<label for="invoice" style="font-weight:bold;color:grey;">Invoice</label>
					<input type="text" name="invoice" id="invoice" data-clear-btn="true">
				<label for="custno" style="font-weight:bold;color:grey;">Cust No.</label>
					<input type="text" name="custno" id="custno" data-clear-btn="true">
				<label for="barcode" style="font-weight:bold;color:grey;">Barcode</label>
					<input type="text" name="barcode" id="barcode" data-clear-btn="true">
			</div>
			<input type="button" value="Submit" onclick="submit()">
			<input type="button" value="Reset" onclick="reset()">
		</div>
-->		
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
