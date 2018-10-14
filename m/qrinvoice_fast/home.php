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
						var snd = new Audio('../'+msg[2].trim()+'.mp3');
						snd.play();
						//alert(msg[2]);
						$("#barcode").val("");
						$("#barcode").focus();
					}
					else{
						var snd = new Audio('../BERHASIL.mp3');
						snd.play();
						//alert(msg[1]);
						$("#barcode").val("");
						$("#barcode").focus();
					}
				}
			});
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
		
		function keynik(e){
			if(e.keyCode == 13){
				$("#supp").focus();
			}
		}
		function keybar(e){
			if(e.keyCode == 13){
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
							var snd = new Audio('../'+msg[2].trim()+'.mp3');
							snd.play();
							//alert(msg[2]);
							$("#barcode").val("");
							$("#barcode").focus();
						}
						else{
							var snd = new Audio('../BERHASIL.mp3');
							snd.play();
							//alert(msg[1]);
							$("#barcode").val("");
							$("#barcode").focus();
						}
					}
				});
			}
		}
	</script>
</head>
<body onload="loadform()">
	<div data-role="page" id="pagehome">
		<div data-role="header">
			<h1>Scan Receive Invoice</h1>
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
			<div class="ui-field-contain">
				<label for="nik" style="font-weight:bold;color:grey;">NIK</label>
					<input type="text" name="nik" id="nik" data-clear-btn="true" placeholder="NIK" onkeypress="keynik(event)">
				<label for="supp" style="font-weight:bold;color:grey;">Supplier</label>
					<select name="supp" id="supp"></select>
				<label for="invoice" style="font-weight:bold;color:grey;">Invoice</label>
					<input type="text" name="invoice" id="invoice" data-clear-btn="true" placeholder="Invoice">
				<label for="custno" style="font-weight:bold;color:grey;">Cust No.</label>
					<input type="text" name="custno" id="custno" data-clear-btn="true" placeholder="Cust No.">
				<label for="barcode" style="font-weight:bold;color:grey;">Barcode</label>
					<input type="text" name="barcode" id="barcode" data-clear-btn="true" placeholder="Barcode" onkeypress="keybar(event)" maxlength="80">
			</div>
			
			<div style="float:left; width:50%;">
				<input type="button" value="Reset" onclick="reset()" data-mini="true">
			</div>
			<div style="float:right; width:50%;">
				<input type="button" value="Submit" onclick="submit()" data-mini="true">
			</div>
			
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
