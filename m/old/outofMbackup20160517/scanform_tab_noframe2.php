<?php
	include "koneksi_edit.php";
?>

<!-- START HTML -->
<html>
	<!---------------------------------------------------------------------------------------------------------------->
	<!-- START HEAD -->
	<head>
		<!-- CREATE TITLE WEB -->
		<title>MC ISSUE TO PRODUCTION SCAN</title>
		<!-- END CREATE TITLE WEB -->
		<!------------------------------------------------------------------------------------------------------------>
		<!-- CALL JQUERY -->
		<script src='jquery/jquery-1.12.0.min.js'></script>
		<script src="jquery/jquery-ui.js"></script>
		<script src="jquery/jquery.limit-1.2.source.js"></script>
		<link rel="stylesheet" href="jquery/jquery-ui.css" />
		<!-- END CALL JQUERY -->
		<!------------------------------------------------------------------------------------------------------------>
		<!-- START FUNCTION SCRIPT -->
		<script>
			window.onload = function scanissue(){
				$('#scanissue').html(
					'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
				);
				$.post('scanissue_tab_noframe2.php', {so: $('[name=so]').val(), parthdn: $('[name=parthdn]').val()},
					function(result){
						$('#scanissue').html(result).show();
					}
				);
				return false;
			}
			
			$(function(){
				$("#tabs").tabs();
				$("#tabs").addClass('ui-tabs-vertical ui-helper-clearfix');
				
				$("#nik1").keyup(function(){
					$("#nik2").val($(this).val());
				});
				$("#idso1").keyup(function(){
					$("#idso2").val($(this).val());
				});
				
				$("#nik2").keyup(function(){
					$("#nik1").val($(this).val());
				});
				$("#idso2").keyup(function(){
					$("#idso1").val($(this).val());
				});
			});
			
			document.onkeypress = fkey;
			function fkey(e){
				e= e || window.event;
				if(e.keyCode == 116){
					document.getElementById("tabactive").value = "1";
				}
			}
			
			function resetTab1(){
				document.getElementById("tabactive").value = "1";
				var x = document.getElementById("tabactive").innerText;
				
				/* CALL TEXTBOX */
				var nik1      = document.getElementById('nik1');
				var idso1     = document.getElementById('idso1');
				var idbarcode1= document.getElementById('idbarcode1');
				var parthdn1  = document.getElementById('parthdn1');
				/*---------------*/
				var nik2      = document.getElementById('nik2');
				var idso2     = document.getElementById('idso2');
				var idbarcode2= document.getElementById('idbarcode2');
				var parthdn2  = document.getElementById('parthdn2');
				var po2       = document.getElementById('po2');
				var partpo2   = document.getElementById('partpo2');
				var qty2      = document.getElementById('qty2');
				var partqty2  = document.getElementById('partqty2');
				/* END CALL TEXTBOX */
			
				/* RESET ALL TEXTBOX IN TAB */
				document.getElementById('parthdn1').value  = "";
				document.getElementById('idbarcode1').value= "";
				document.getElementById('parthdn2').value  = "";
				document.getElementById('idbarcode2').value= "";
				document.getElementById('po2').value       = "";
				document.getElementById('qty2').value      = "";
				document.getElementById('partpo2').value   = "";
				document.getElementById('partqty2').value  = "";
				document.getElementById('tabactive').value = "1";
				/* END RESET ALL TEXTBOX IN TAB */
				
				/* SET FOCUS */
				if (x==1){
					if(nik1.value=="" && nik2.value==""){
						nik1.focus();
					}
					else if(idso1.value=="" && idso2.value==""){
						idso1.focus();
					}
					else if(idbarcode1.value==""){
						idbarcode1.focus();
					}
				}
				else{
					if(nik1.value=="" && nik2.value==""){
						nik2.focus();
					}
					else if(idso1.value=="" && idso2.value==""){
						idso2.focus();
					}
					else if(idbarcode2.value==""){
						idbarcode2.focus();
					}
				}
				/* END SET FOCUS */
			}
			
			function resetTab2(){
				document.getElementById("tabactive").innerHTML = "2";
				var x = document.getElementById("tabactive").innerText;
				
				/* CALL TEXTBOX */
				var nik1      = document.getElementById('nik1');
				var idso1     = document.getElementById('idso1');
				var idbarcode1= document.getElementById('idbarcode1');
				var parthdn1  = document.getElementById('parthdn1');
				/*---------------*/
				var nik2      = document.getElementById('nik2');
				var idso2     = document.getElementById('idso2');
				var idbarcode2= document.getElementById('idbarcode2');
				var parthdn2  = document.getElementById('parthdn2');
				var po2       = document.getElementById('po2');
				var partpo2   = document.getElementById('partpo2');
				var qty2      = document.getElementById('qty2');
				var partqty2  = document.getElementById('partqty2');
				/* END CALL TEXTBOX */
				
				/* RESET ALL TEXTBOX IN TAB */
				document.getElementById('parthdn1').value  = "";
				document.getElementById('idbarcode1').value= "";
				document.getElementById('parthdn2').value  = "";
				document.getElementById('idbarcode2').value= "";
				document.getElementById('po2').value       = "";
				document.getElementById('qty2').value      = "";
				document.getElementById('partpo2').value   = "";
				document.getElementById('partqty2').value  = "";
				document.getElementById('tabactive').value = "2";
				/* END RESET ALL TEXTBOX IN TAB */
				
				/* SET FOCUS */
				if (x==1){
					if(nik1=="" && nik2==""){
						nik1.focus();
					}
					else if(idso1=="" && idso2==""){
						idso1.focus();
					}
					else if(idbarcode1==""){
						idbarcode1.focus();
					}
				}
				else{
					if(nik1=="" && nik2==""){
						nik2.focus();
					}
					else if(idso1=="" && idso2==""){
						idso2.focus();
					}
					else if(idbarcode2==""){
						idbarcode2.focus();
					}
				}
				/* END SET FOCUS */
			}
			
			function mulai(){
				var x         = document.getElementById('tabactive');
				
				/* CALL TEXTBOX */
				var nik1      = document.getElementById('nik1');
				var idso1     = document.getElementById('idso1');
				var idbarcode1= document.getElementById('idbarcode1');
				var parthdn1  = document.getElementById('parthdn1');
				/*---------------*/
				var nik2      = document.getElementById('nik2');
				var idso2     = document.getElementById('idso2');
				var idbarcode2= document.getElementById('idbarcode2');
				var parthdn2  = document.getElementById('parthdn2');
				var po2       = document.getElementById('po2');
				var partpo2   = document.getElementById('partpo2');
				var qty2      = document.getElementById('qty2');
				var partqty2  = document.getElementById('partqty2');
				/* END CALL TEXTBOX */
				
				/* SET FOCUS */
				if(x.value=="1"){
					if (nik1.value == "" ){
						nik1.focus();
					}
					else if(idso1.value == "" ){
						idso1.focus();
					}
					else if((idbarcode1.value != "" && idbarcode2.value == "") || (parthdn1.value != "" && parthdn2.value == "")){
						/* MOVE VALUE IDBARCODE1 TO PARTHDN1 */
						parthdn1.value = idbarcode1.value;
						/* DELETE VALUE IDBARCODE1 */
						idbarcode1.value = "";
						/* SET FOCUS IDBARCODE1 */
						idbarcode1.focus();
					}
				}
				else if(x.value=="2"){
					if (nik2.value==""){
						nik2.focus();
					}
					else if(idso2.value==""){
						idso2.focus();
					}
					else if((idbarcode1.value == "" && idbarcode2.value != "") || (parthdn1.value == "" && parthdn2.value != "")){
						/* 
						** MOVE VALUE IDBARCODE2 TO PARTHDN2
						** MOVE VALUE PO2 TO PARTPO2
						** MOVE VALUE QTY1 TO PARTQTY2
						*/
						parthdn2.value = idbarcode2.value;
						partpo2.value = po2.value;
						partqty2.value = qty2.value;
						/* END MOVE VALUE */
						
						/* DELETE VALUE */
						idbarcode2.value = "";
						po2.value = "";
						qty2.value = "";
						/* END DELETE VALUE */
						
						/* SET FOCUS IDBARCODE2 */
						idbarcode2.focus();
					}
				}
				/* END SET FOCUS */
				
		/*		
				if ((idbarcode1.value != "" && idbarcode2.value == "") || (parthdn1.value != "" && parthdn2.value == "")){
					/* MOVE VALUE IDBARCODE1 TO PARTHDN1 */
		/*			parthdn1.value = idbarcode1.value;
					/* DELETE VALUE IDBARCODE1 */
		/*			idbarcode1.value = "";
					/* SET FOCUS IDBARCODE1 */
		/*			idbarcode1.focus();
				}
				else if ((idbarcode1.value == "" && idbarcode2.value != "") || (parthdn1.value == "" && parthdn2.value != "")){
					/* 
					** MOVE VALUE IDBARCODE2 TO PARTHDN2
					** MOVE VALUE PO2 TO PARTPO2
					** MOVE VALUE QTY1 TO PARTQTY2
					*/
		/*			parthdn2.value = idbarcode2.value;
					partpo2.value = po2.value;
					partqty2.value = qty2.value;
					/* END MOVE VALUE */
					
					/* DELETE VALUE */
		/*			idbarcode2.value = "";
					po2.value = "";
					qty2.value = "";
					/* END DELETE VALUE */
					
					/* SET FOCUS IDBARCODE2 */
		/*			idbarcode2.focus();
				}
				/* END SET FOCUS */
			}
			
			/*function submitfocus(){
				var x         = document.getElementById('tabactive');
				
				/* CALL TEXTBOX */
			/*	var nik1      = document.getElementById('nik1');
				var nik2      = document.getElementById('nik2');
				var idso1     = document.getElementById('idso1');
				var idso2     = document.getElementById('idso2');
				
				var idbarcode1= document.getElementById('idbarcode1');
				var parthdn1  = document.getElementById('parthdn1');
				
				var idbarcode2= document.getElementById('idbarcode2');
				var parthdn2  = document.getElementById('parthdn2');
				/* CALL TEXTBOX */
				
				/* SET FOCUS */
			/*	if(x.value == "1"){
					if(nik1.value == ""){
						nik1.focus();
					}
					else if(idso1.value == ""){
						idso1.focus();
					}
					else if(idbarcode1.value == ""){
						idbarcode1.focus();
					}
				}
				else if(x.value == "2"){
					if(nik2.value == ""){
						nik2.focus();
					}
					else if(idso2.value == ""){
						idso2.focus();
					}
					else if(idbarcode2.value == ""){
						idbarcode2.focus();
					}
				}
				/* END SET FOCUS */
			//}
			
			function startnik(){
				/* SET FOCUS TO NIK (NOT USE DELETE VALUE BECAUSE THIS BUTTON TYPE IS RESET) */
				var x = document.getElementById('tabactive');
				
				if (x.value=="1"){
					document.getElementById('nik1').focus();
				}
				else if (x.value=="2"){
					document.getElementById('nik2').focus();
				}
			}
			
			function startso(){
				var x = document.getElementById('tabactive');
				
				/*DELETE VALUE TEXTBOX */
				document.getElementById('idso1').value     = "";
				document.getElementById('idso2').value     = "";
				document.getElementById('parthdn1').value  = "";
				document.getElementById('idbarcode1').value= "";
				document.getElementById('parthdn2').value  = "";
				document.getElementById('idbarcode2').value= "";
				document.getElementById('po2').value       = "";
				document.getElementById('qty2').value      = "";
				document.getElementById('partpo2').value   = "";
				document.getElementById('partqty2').value  = "";
				/*END DELETE VALUE TEXTBOX */
				
				/* SET FOCUS TO SO */
				if (x.value=="1"){
					document.getElementById('idso1').focus();
				}
				else if (x.value=="2"){
					document.getElementById('idso2').focus();
				}
				/* END SET FOCUS TO SO */
			}
		</script>
		<!-- END FUNCTION SCRIPT -->
		<!------------------------------------------------------------------------------------------------------------>
		<!-- START STYLE -->
		<style>
			/*.ui-tabs.ui-tabs-vertical{
				padding: 0;
				width: 42em;
			}
			.ui-tabs.ui-tabs-vertical .ui-widget-header{
				border: none;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav{
				float: left;
				width: 8em;
				background: #CCC;
				border-radius: 4px 0 0 4px;
				border-right: 1px solid gray;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li {
				clear:left;
				width: 100%;
				margin: 0.1em 0;
				border: 1px solid gray;
				border-width: 1px 0 1px 1px;
				border-radius: 4px 0 0 4px;
				overflow: hidden;
				position: relative;
				right: -2px;
				z-index: 2;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a{
				display: block;
				width: 100%;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a:hover{
				cursor: pointer;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active{
				margin-bottom: 0.2em;
				padding-bottom: 0;
				border-right: 1px solid white;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li:last-child{
				margin-bottom: 10px;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-panel{
				float: left;
				width: 28em;
				border-left: 1px solid gray;
				border-radius: 0;
				position: relative;
				left: -1px;
			}
			*/
			/*---------use-------------------------------*/
			.ui-tabs.ui-tabs-vertical{
				padding: 0;
				_width: 509px;
				width: 600px;
			}
			.ui-tabs.ui-tabs-vertical .ui-widget-header{
				border: none;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav{
				float: right;
				width: 10em;
				background: #CCC;
				_border-radius: 0 4px 4px 0;
				border-left: 1px solid gray;
				height: 225px;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li {
				clear:right;
				width: 100%;
				margin: 0.1em 0;
				border: 1px solid gray;
				border-width: 1px 1px 1px 0;
				_border-radius: 0 4px 4px 0;
				overflow: hidden;
				position: relative;
				right: 4px;
				z-index: 2;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a{
				display: block;
				width: 100%;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li a:hover{
				cursor: pointer;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active{
				margin-bottom: 0.2em;
				padding-bottom: 0;
				border-left: 1px solid white;
				_background : green;
			}
			.ui-tabs.ui-tabs-vertical .ui-tabs-nav li:last-child{
				margin-bottom: 10px;
			}
			/*.ui-tabs.ui-tabs-vertical .ui-tabs-panel{
				_float: right;
				width: 50em;
				border-right: 1px solid gray;
				border-radius: 0;
				position: relative;
				right: -1px;
			}*/
			#top-table{
				padding-left: 16px;
				_border: 1px solid blue;
			}
			#line{
				border-bottom: 1px solid gray;
			}
		</style>
		<!-- END STYLE -->
	</head>
	<!-- END HEAD -->
	<!----------------------------------------------------------------------------------------------------------------->
	<!-- START BODY
	<body onload="document.forms[0].nik.focus();"> -->
	<body>
		<!----------------------------------------------------------------------------------------------------------------->
		<!-- START TAB -->
		<div id="tabs">
			<!---------------------------------------------------------------------------------------------------------->
			<!-- START FORM 
				<form method="post" action="scanissue_tab.php" target="scanissue" onsubmit="return mulai();"> -->
				<form method="post" onsubmit="return mulai();">
					<!---------------------------------------------------------------------------------------------------------->
					<!-- TABLE TOP 
					<table id="top-table">
						<tr><td width="120px">NIK</td>			<td>:</td>	<td><input type="text"	name="nik"	id="nik"	class="kelas1" required/></td></tr>
						<tr><td width="120px">SO NUMBER</td>	<td>:</td>	<td><input type="text"	name="idso"	id="idso"	class="kelas1" required/></td></tr>
					</table>
					<div id="line"></div>
					<!-- END TABLE TOP -->
					<!---------------------------------------------------------------------------------------------------------->
					<!-- TAB PANEL -->
					<ul>
						<li><a href="#tabs-1" onclick="resetTab1()" class="tab_blue">Barcode Scan</a></li>
						<li><a href="#tabs-2" onclick="resetTab2()" class="tab_green">Barcode Manual</a></li>
					</ul>
					<!-- END TAB PANEL -->
					<!---------------------------------------------------------------------------------------------------------->
					<!-- TAB BARCODE SCAN -->
					<div id="tabs-1">
						<table>
							<tr><td width="160px">NIK</td>			<td>:</td>	<td><input type="text"	name="nik1"	id="nik1"	class="kelas1"/></td></tr>
							<tr><td width="160px">SO NUMBER</td>	<td>:</td>	<td><input type="text"	name="idso1"	id="idso1"	class="kelas1"/></td></tr>
							<tr><td width="160px">BARCODE SCAN</td><td>:</td><td><input type="text" name="idbarcode1" id="idbarcode1" class="kelas1" autofocus/></td></tr>
						</table>
					</div>
					<!-- END TAB BARCODE SCAN -->
					<!---------------------------------------------------------------------------------------------------------->
					<!-- TAB MANUAL -->
					<div id="tabs-2">
						<table>
							<tr><td width="160px">NIK</td>			<td>:</td>	<td><input type="text"	name="nik2"	id="nik2"	class="kelas1"/></td></tr>
							<tr><td width="160px">SO NUMBER</td>	<td>:</td>	<td><input type="text"	name="idso2"	id="idso2"	class="kelas1"/></td></tr>
							<tr><td width="160px">PART NO</td>	<td>:</td>	<td><input type="text"	name="idbarcode2"	id="idbarcode2"	class="kelas1" autofocus/></td></tr>
							<tr><td width="160px">PO</td>		<td>:</td>	<td><input type="text"	name="po2"			id="po2"		class="kelas1" maxlength="7" onKeypress="return isNumberKey(event)"/></td></tr>
							<tr><td width="160px">QTY</td>		<td>:</td>	<td><input type="text"	name="qty2"			id="qty2"		class="kelas1" /></td></tr>
						</table>
					</div>
					<!-- END TAB MANUAL -->
					<!---------------------------------------------------------------------------------------------------------->
					<!-- TAB BUTTON SUBMIT DAN RESET -->
					<table width="384px">
						<tr>
							<td colspan="3" align="right">
								<!--<input	type="submit"	name="submit"	id="submit"		value="Submit"		onclick="submitfocus()"	class="dua"/>-->
								<input	type="submit"	name="submit"	id="submit"		value="Submit"		onclick="submitfocus()"	class="dua"/>
								<input	type="button"	name="start_so"	id="start_so"	value="Start SO" 	onclick="startso()"/>
								<input	type="reset"	name="reset"	id="reset"		value="Start NIK"	onclick="startnik()"/>
							</td>
						</tr>
					</table>
					<!-- END TAB BUTTON SUBMIT DAN RESET -->
					<!---------------------------------------------------------------------------------------------------------->
					<!-- HIDDEN TEXT FOR SUBMIT -->
					<input	type="text"	name="parthdn1"	id="parthdn1" />
					<input	type="text"	name="parthdn2"	id="parthdn2" />
					<input	type="text"	name="partpo2"	id="partpo2" />
					<input	type="text"	name="partqty2"	id="partqty2" />
					<!--<input	type="text"	name="tabactive"id="tabactive" value="1"/>-->
					<!-- END HIDDEN TEXT FOR SUBMIT -->
					<!---------------------------------------------------------------------------------------------------------->
				</form> 
					<input	type="text"	name="tabactive"id="tabactive" value="1"/>
			<!-- END FORM -->
			<!---------------------------------------------------------------------------------------------------------->
		</div>
		<!-- END TABS -->
		<!---------------------------------------------------------------------------------------------------------->
		<!-- END METHOD CONDITION -->
		<div id="scanissue" onload="scanissue()">
		<!--  TAMPILKAN DATA HASIL SCAN -->
		</div>
	<!----------------------------------------------------------------------------------------------------------------->
	</body>
	<!-- END BODY -->
	<!----------------------------------------------------------------------------------------------------------------->
</html>
<!-- END HTML -->