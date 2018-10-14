<?php
	/*
	** koneksi tdk diperlukan di halaman ini
	** include "koneksi.php";
	*/
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
		<script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
		<script src="jquery/jquery-ui.js"></script>
		<script src="jquery/jquery.limit-1.2.source.js"></script>
		<link rel="stylesheet" href="jquery/jquery-ui.css" />
		<!-- END CALL JQUERY -->
		<!------------------------------------------------------------------------------------------------------------>
		<!-- START FUNCTION SCRIPT -->
		<script>
			$(function(){
				$("#tabs").tabs();
				$("#tabs").addClass('ui-tabs-vertical ui-helper-clearfix');
				
				/*limit character PO*/
				$("#po2").limit('7', '#limitpo');
				
				/*function submit with enter key*/
				$("form input").keypress(function (e){
					if((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)){
						$('button[type=submit] .default').click();
						return false;
					}
					else{
						return true;
					}
				});
			});
			
			function resetTab(){
				/* RESET ALL TEXTBOX IN TAB */
				document.getElementById('parthdn1').value = "";
				document.getElementById('idbarcode1').value = "";
				document.getElementById('parthdn2').value = "";
				document.getElementById('idbarcode2').value = "";
				document.getElementById('po2').value = "";
				document.getElementById('qty2').value = "";
				document.getElementById('partpo2').value = "";
				document.getElementById('partqty2').value = "";
				/* END RESET ALL TEXTBOX IN TAB */
			}
			
			function mulai(){
				/* CALL TEXTBOX */
				var nik = document.getElementById('nik');
				var idso = document.getElementById('idso');
				
				var idbarcode1 = document.getElementById('idbarcode1');
				var parthdn1 = document.getElementById('parthdn1');
				
				var idbarcode2 = document.getElementById('idbarcode2');
				var parthdn2 = document.getElementById('parthdn2');
				
				var po2	= document.getElementById('po2');
				var partpo2	= document.getElementById('partpo2');
				
				var qty2 = document.getElementById('qty2');
				var partqty2 = document.getElementById('partqty2');
				/* CALL TEXTBOX */
				
				/*
				if ((nik.value == "" && idbarcode1.value != "" && idbarcode2.value == "") || (nik.value == "" && idbarcode1.value == "" && idbarcode2.value != "")){
					alert('Insert your NIK Please..');
					window.history.back();
					nik.focus();
					return false;
				}
				else{
					alert('Are you sure want to submit this part? ');
					return true;
				}
				*/
				if ((idbarcode1.value != "" && idbarcode2.value == "") || (parthdn1.value != "" && parthdn2.value == "")){
					/* MOVE VALUE IDBARCODE1 TO PARTHDN1 */
					parthdn1.value = idbarcode1.value;
					/* DELETE VALUE IDBARCODE1 */
					idbarcode1.value = "";
					/* SET FOCUS IDBARCODE1 */
					idbarcode1.focus();
				}
				else if ((idbarcode1.value == "" && idbarcode2.value != "") || (parthdn1.value == "" && parthdn2.value != "")){
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
			
			function barcodefocus(){
				/* CALL TEXTBOX */
				var nik = document.getElementById('nik');
				var idso = document.getElementById('idso');
				
				var idbarcode1 = document.getElementById('idbarcode1');
				var parthdn1 = document.getElementById('parthdn1');
				
				var idbarcode2 = document.getElementById('idbarcode2');
				var parthdn2 = document.getElementById('parthdn2');
				/* CALL TEXTBOX */
				
				if ((idbarcode1.value != "" && idbarcode2.value == "") || (parthdn1.value != "" &&parthdn2.value != "")){
					/* SET FOCUS IDBARCODE1 */
					idbarcode1.focus();
				}
				else if ((idbarcode1.value == "" && idbarcode2.value != "") || (parthdn1.value == "" && parthdn2.value != "")){
					/* SET FOCUS IDBARCODE2 */
					var x = document.getElementById("limitpo").innerText
					if (x<7 && x>0){
						alert('PO Must be 7 Character or null');
						po2.focus();
					}
					else{
						idbarcode2.focus();
					}
				}
				else if (nik.value == ""){
					/* SET FOCUS NIK */
					nik.focus();
				}
				else if (idso.value == ""){
					/* SET FOCUS IDSO */
					idso.focus();
				}
			/*	else if ((nik.value == "" && idbarcode1.value != "" && idbarcode2.value == "") || (nik.value == "" && idbarcode1.value == "" && idbarcode2.value != "")){
					
				}*/
				else{}
			}
			
			function startnik(){
				/* SET FOCUS TO NIK (NOT USE DELETE VALUE BECAUSE THIS BUTTON TYPE IS RESET) */
				document.getElementById('nik').focus();
			}
			
			function startso(){
				
				/*DELETE VALUE TEXTBOX */
				document.getElementById('idso').value = "";
				document.getElementById('parthdn1').value = "";
				document.getElementById('idbarcode1').value = "";
				document.getElementById('parthdn2').value = "";
				document.getElementById('idbarcode2').value = "";
				document.getElementById('po2').value = "";
				document.getElementById('qty2').value = "";
				document.getElementById('partpo2').value = "";
				document.getElementById('partqty2').value = "";
				/*END DELETE VALUE TEXTBOX */
				
				/* SET FOCUS TO SO */
				document.getElementById('idso').focus();
			}
			
			/*	function mulai1()
				{
					var myso_number = document.getElementById('idso');
					var mynik = document.getElementById('mynik');
					
					var mytext1 = document.getElementById('idbarcode1');
					
					var mypart1 = document.getElementById('partid1');
					
					mypart1.value = mytext1.value;   
					mytext1.value = "";
					mytext1.focus();
				}
				
				function mulai2()
				{
					var myso_number = document.getElementById('idso');
					var mynik = document.getElementById('mynik');
					
					var mytext2 = document.getElementById('idbarcode2');
					var mypo2 = document.getElementById('po2');
					var myqty2 = document.getElementById('qty2');
					
					var mypart2 = document.getElementById('partid2');
					var mypartpo2 = document.getElementById('partpo2');
					var mypartqty2 = document.getElementById('partqty2');
					
					mypart2.value = mytext2.value; 
					mypartpo2.value = mypo2.value;	
					mypartqty2.value = myqty2.value;
					
					mytext2.value = "";
					mypo2.value = "";
					myqty2.value = "";
					
					mytext2.focus();
				}
			*/	
			/*	
				function start()
				{
					document.getElementById('nik').value = "";
					document.getElementById('idso').value = "";
					
					document.getElementById('idbarcode1').value = "";
					document.getElementById('partid1').value = "";
					
					document.getElementById('idbarcode2').value = "";
					document.getElementById('po2').value = "";
					document.getElementById('qty2').value = "";
					
					document.getElementById('nik').focus();
				}
				
				function startso(){
					document.getElementById('idso').value = "";
					
					document.getElementById('idbarcode1').value = "";
					document.getElementById('partid1').value = "";
					
					document.getElementById('idbarcode2').value = "";
					document.getElementById('po2').value = "";
					document.getElementById('qty2').value = "";
					
					document.getElementById('idso').focus();
				}
				*/
		
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
				width: 509px;
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
				height: 175px;
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
			.ui-tabs.ui-tabs-vertical .ui-tabs-panel{
				_float: right;
				width: 22em;
				border-right: 1px solid gray;
				border-radius: 0;
				position: relative;
				right: -1px;
			}
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
	<!-- START BODY -->
	<body onload="document.forms[0].nik.focus();">
		<!----------------------------------------------------------------------------------------------------------------->
		<!-- START METHOD CONDITION -->
<?php
		IF ($_SERVER['REQUEST_METHOD'] != 'POST'){
?>
			<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			<!-- <a href="index.php">menu</a><br /> -->
			<!---------------------------------------------------------------------------------------------------------->
			<!-- START TAB -->
			<div id="tabs">
				<!---------------------------------------------------------------------------------------------------------->
				<!-- START FORM -->
					<form method="post" action="scanissue_tab.php" target="scanissue" onsubmit="return mulai();">
						<!---------------------------------------------------------------------------------------------------------->
						<!-- TABLE TOP -->
						<table id="top-table">
							<tr><td width="120px">NIK</td>			<td>:</td>	<td><input type="text"	name="nik"	id="nik"	class="kelas1" required/></td></tr>
							<tr><td width="120px">SO NUMBER</td>	<td>:</td>	<td><input type="text"	name="idso"	id="idso"	class="kelas1" required/></td></tr>
						</table>
						<div id="line"></div>
						<!-- END TABLE TOP -->
						<!---------------------------------------------------------------------------------------------------------->
						<!-- TAB PANEL -->
						<ul>
							<li><a href="#tabs-1" onclick="resetTab()" class="tab_blue">Barcode Scan</a></li>
							<li><a href="#tabs-2" onclick="resetTab()" class="tab_green">Barcode Manual</a></li>
						</ul>
						<!-- END TAB PANEL -->
						<!---------------------------------------------------------------------------------------------------------->
						<!-- TAB BARCODE SCAN -->
						<div id="tabs-1">
							<table>
								<tr><td width="120px">BARCODE SCAN</td><td>:</td><td><input type="text" name="idbarcode1" id="idbarcode1" class="kelas1" autofocus/></td></tr>
							</table>
						</div>
						<!-- END TAB BARCODE SCAN -->
						<!---------------------------------------------------------------------------------------------------------->
						<!-- TAB MANUAL -->
						<div id="tabs-2">
							<table>
								<tr><td width="120px">PART NO</td>	<td>:</td>	<td><input type="text"	name="idbarcode2"	id="idbarcode2"	class="kelas1" autofocus/></td></tr>
								<tr><td width="120px">PO</td>		<td>:</td>	<td><input type="text"	name="po2"			id="po2"		class="kelas1" maxlength="7" onKeypress="return isNumberKey(event)" size="7"/> <span id="limitpo"></span> Char</td></tr>
								<tr><td width="120px">QTY</td>		<td>:</td>	<td><input type="text"	name="qty2"			id="qty2"		class="kelas1" /></td></tr>
							</table>
						</div>
						<!-- END TAB MANUAL -->
						<!---------------------------------------------------------------------------------------------------------->
						<!-- TAB BUTTON SUBMIT DAN RESET -->
						<table width="340px">
							<tr>
								<td colspan="3" align="right">
									<input	type="submit"	name="submit"	id="submit"		value="Submit"		onclick="barcodefocus()"	class="dua"/>
									<input	type="button"	name="start_so"	id="start_so"	value="Start SO" 	onclick="startso()"/>
									<input	type="reset"	name="reset"	id="reset"		value="Start NIK"	onclick="startnik()"/>
								</td>
							</tr>
						</table>
						<!-- END TAB BUTTON SUBMIT DAN RESET -->
						<!---------------------------------------------------------------------------------------------------------->
						<!-- HIDDEN TEXT FOR SUBMIT -->
						<input	type="hidden"	name="parthdn1"	id="parthdn1" />
						<input	type="hidden"	name="parthdn2"	id="parthdn2" />
						<input	type="hidden"	name="partpo2"	id="partpo2" />
						<input	type="hidden"	name="partqty2"	id="partqty2" />
						<!-- END HIDDEN TEXT FOR SUBMIT -->
						<!---------------------------------------------------------------------------------------------------------->
					</form> 
				<!-- END FORM -->
				<!---------------------------------------------------------------------------------------------------------->
			</div>
			<!-- END TABS -->
			<!---------------------------------------------------------------------------------------------------------->
			<br>
			<br>
<?php
		}
?>
	<!-- END METHOD CONDITION -->
	<!----------------------------------------------------------------------------------------------------------------->
	</body>
	<!-- END BODY -->
	<!----------------------------------------------------------------------------------------------------------------->
</html>
<!-- END HTML -->