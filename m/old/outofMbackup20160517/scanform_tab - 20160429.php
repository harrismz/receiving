<?php


/*

koneksi tdk diperlukan di halaman ini

include "koneksi.php";

*/


?>
<html>
<head>
<title>MC ISSUE TO PRODUCTION SCAN</title>
<script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
<link rel="stylesheet" href="jquery/jquery-ui.css">
<script src="jquery/jquery-ui.js"></script>
<script>
	function mulai1()
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
	
	function resetTab(){
		document.getElementById('partid1').value = "";
		document.getElementById('idbarcode1').value = "";
		document.getElementById('partid2').value = "";
		document.getElementById('idbarcode2').value = "";
		document.getElementById('po2').value = "";
		document.getElementById('qty2').value = "";
		document.getElementById('partpo2').value = "";
		document.getElementById('partqty2').value = "";
	}
	
	$(function(){
		$("#tabs").tabs();
		$("#tabs").addClass('ui-tabs-vertical ui-helper-clearfix');
	});
	
	function start()
	{
		document.getElementById('nik').value = "";
		document.getElementById('idso').value = "";
		document.getElementById('idbarcode1').value = "";
		document.getElementById('partid1').value = "";
		
		document.getElementById('idbarcode2').value = "";
		document.getElementById('po2').value = "";
		document.getElementById('qty2').value = "";
		
		var mynik = document.getElementById('nik');
		mynik.focus();
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
	
</script>
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
		width: 480px;
	}
	.ui-tabs.ui-tabs-vertical .ui-widget-header{
		border: none;
	}
	.ui-tabs.ui-tabs-vertical .ui-tabs-nav{
		float: right;
		width: 8em;
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
</head>
<body onload="document.forms[0].nik.focus();">

<?php

IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {

?>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<!-- <a href="index.php">menu</a><br /> -->

<div id="tabs">
	<form method="post" action="scanissue_tab.php" target="scanissue" onsubmit="mulai1()">
		<table id="top-table">
			<tr><td width="120px">NIK</td><td>:</td><td><input type="text" name="nik" id="nik" class="kelas1" /></td></tr>
			<tr><td width="120px">SO NUMBER</td><td>:</td><td><input type="text" name="so" id="idso" class="kelas1" /></td></tr>
		</table>
		<div id="line"></div>
		<ul>
			<li><a href="#tabs-1" onclick="resetTab()">Barcode Scan</a></li>
			<li><a href="#tabs-2" onclick="resetTab()">Manual</a></li>
		</ul>
		<div id="tabs-1">
			<table>
				<tr><td width="120px">BARCODE SCAN</td><td>:</td><td><input type="text" name="barcode1" id="idbarcode1" class="kelas1" /></td></tr>
				<tr>
					<td colspan="3" align="right">
						<input type="submit" name="submit1" value="Submit" class="dua"/>
						<input type="button" name="start_so" id="start_so" value="Start SO" onclick="startso()"/>
						<input type="reset" name="reset1" value="Start NIK" onclick="start()"/>
					</td>
				</tr>
			</table>
			<input type="text" name="parthdn1" id="partid1" />
	</div>
	<div id="tabs-2">
			<table>
				<tr><td width="120px">PART NO</td><td>:</td><td><input type="text" name="barcode2" id="idbarcode2" class="kelas1" /></td></tr>
				<tr><td width="120px">PO</td><td>:</td><td><input type="text" name="po2" id="po2" class="kelas1" /></td></tr>
				<tr><td width="120px">QTY</td><td>:</td><td><input type="text" name="qty2" id="qty2" class="kelas1" /></td></tr>
				<tr>
					<td colspan="3" align="right">
						<input type="submit" name="submit2" value="Submit" class="dua"/>
						<input type="button" name="start_so" id="start_so" value="Start SO" onclick="startso()"/>
						<input type="reset" name="reset2" value="Start NIK" onclick="start()"/>
					</td>
				</tr>
			</table>
			<input type="text" name="parthdn2" id="partid2" />
			<input type="text" name="partpo2" id="partpo2" />
			<input type="text" name="partqty2" id="partqty2" />
		</form> 
	</div>
</div>
<br>
<br>
</body>
</html>

<?php
	}

?>
