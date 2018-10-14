<html>
<head>
<title>MC ISSUE TO PRODUCTION SCAN</title>
<script src='jquery/jquery-1.12.0.min.js'></script>
<script type="text/javascript">
/*
window.onload = function scanissue(){
	var nik1 = document.getElementById('nik');
	var idso1 = document.getElementById('idso');
	var idbarcode1 = document.getElementById('idbarcode1');
	var parthdn1 = document.getElementById('parthdn1');
	
	if (nik1.value == ""){
		nik1.focus();
	}
	else if(idso1.value == ""){
		idso1.focus();
	}
	else{
		parthdn1.value = idbarcode1.value;   
		idbarcode1.value = "";
		idbarcode1.focus();
	}
	
	
	$('#scanissue').html(
		'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanissue_tab_3.php', {so: $('[name=idso1]').val(), parthdn: $('[name=parthdn1]').val()},
		function(result){
			$('#scanissue').html(result).show();
		}
	);
	return false;
}

function scanissue2(){
	var nik1 = document.getElementById('nik');
	var parthdn1 = document.getElementById('parthdn1');
	var idbarcode1 = document.getElementById('idbarcode1');
	var idso1 = document.getElementById('idso1');
	
	parthdn1.value = idbarcode1.value;   
	idbarcode1.value = "";
	idbarcode1.focus();
	
	
	$('#scanissue').html(
		'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanissue_tab_3.php', {so: $('[name=idso]').val(), parthdn: $('[name=parthdn1]').val()},
		function(result){
			$('#scanissue').html(result).show();
		}
	);
	return false;
}
*/

function scanissue2(){
	var nik = document.getElementById('nik');
	var idso = document.getElementById('idso');
	var idbarcode1 = document.getElementById('idbarcode1');
	var parthdn1 = document.getElementById('parthdn1');
	
	parthdn1.value = idbarcode1.value;   
	idbarcode1.value = "";
	if (nik.value = ""){
		nik.focus();
	}
	else if (idso.value = ""){
		idso.focus();
	}
	else if (idbarcode1.value = ""){
		idbarcode1.focus();
	}
}




/*function barcodeActive(){
	if (document.getElementById('barcode1').checked) {
        document.getElementById('scan').style.display = 'block';
        document.getElementById('manual').style.display = 'none';
    }
    else {
		document.getElementById('scan').style.display = 'none';
        document.getElementById('manual').style.display = 'block';
	}
}*/

$(function(){
	$("form input").keypress(function (e){
		if((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)){
			$('button[type=submit].default').click();
			return false;
		}
		else{
			return true;
		}
	});
});
function etr(event){
	var x = event.which || event.keyCode;
	
	var nik	      = document.getElementById('nik');
	var idso	  = document.getElementById('idso');
	var idbarcode1= document.getElementById('idbarcode1');
	var parthdn1  = document.getElementById('parthdn1');
	/*---------------*/
	var idbarcode2= document.getElementById('idbarcode2');
	var parthdn2  = document.getElementById('parthdn2');
	var po2       = document.getElementById('po2');
	var partpo2   = document.getElementById('partpo2');
	var qty2      = document.getElementById('qty2');
	var partqty2  = document.getElementById('partqty2');
	//alert(x);
	if(x == 13) {
		if (nik.value==""){
			nik.focus();
		}
		else if (idso.value==""){
			idso.focus();
		}
		else if (idbarcode1.value==""){
			idbarcode1.focus();
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value!=""){
			parthdn1.value = idbarcode1.value;   
			parthdn2.value = idbarcode2.value;   
			idbarcode1.value = "";
			idbarcode2.value = "";
			po2.value = "";
			qty2.value = "";
			idbarcode1.focus();
		}
	}
}

function firstfocus(){
	var nik	      = document.getElementById('nik');
	var idso	  = document.getElementById('idso');
	var idbarcode1= document.getElementById('idbarcode1');
	
	if (nik.value==""){
		document.forms[0].nik.focus();
	}
	else if (idso.value==""){
		document.forms[0].idso.focus();
	}
	else if (idbarcode1.value==""){
		document.forms[0].idbarcode1.focus();
	}
}
</script>

</head>
<body onload="firstfocus()">
<body>

<?php
IF ($_SERVER['REQUEST_METHOD'] != 'POST'){
?>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<!-- <a href="index.php">menu</a><br /> -->
	<form method="post" id="form1" action="scanissue_tab_noframe16.php" target="scanissue" onsubmit="scanissue2()">
		<table>
			<tr><td width="160px">NIK</td>			<td>:</td>	<td><input type="text"	name="nik"			id="nik"		class="kelas1" onkeypress="etr(event)" /></td></tr>
			<tr><td width="160px">SO NUMBER</td>	<td>:</td>	<td><input type="text"	name="idso"			id="idso"		class="kelas1" onkeypress="etr(event)" /></td></tr>
			<tr><td width="160px">BARCODE SCAN</td>	<td>:</td>	<td><input type="text"	name="idbarcode1"	id="idbarcode1"	class="kelas1" onkeypress="etr(event)" /></td></tr>
			<tr><td width="160px">PART NO</td>		<td>:</td>	<td><input type="text"	name="idbarcode2"	id="idbarcode2"	class="kelas1" onkeypress="etr(event)" /></td></tr>
			<tr><td width="160px">PO</td>			<td>:</td>	<td><input type="text"	name="po2"			id="po2"		class="kelas1" onkeypress="etr(event)" /></td></tr>
			<tr><td width="160px">QTY</td>			<td>:</td>	<td><input type="text"	name="qty2"			id="qty2"		class="kelas1" onkeypress="etr(event)" /></td></tr>
			
		
		<!--<tr><td width="160px">NIK</td>			<td>:</td>	<td><input type="text"	name="nik"			id="nik"		class="kelas1" /></td></tr>
			<tr><td width="160px">SO NUMBER</td>	<td>:</td>	<td><input type="text"	name="idso"			id="idso"		class="kelas1" /></td></tr>
			<tr><td width="160px">BARCODE SCAN</td>	<td>:</td>	<td><input type="text"	name="idbarcode1"	id="idbarcode1"	class="kelas1" /></td></tr>
			<tr><td width="160px">PART NO</td>		<td>:</td>	<td><input type="text"	name="idbarcode2"	id="idbarcode2"	class="kelas1" /></td></tr>
			<tr><td width="160px">PO</td>			<td>:</td>	<td><input type="text"	name="po2"			id="po2"		class="kelas1" /></td></tr>
			<tr><td width="160px">QTY</td>			<td>:</td>	<td><input type="text"	name="qty2"			id="qty2"		class="kelas1" /></td></tr>
		-->
			<tr>
				<td colspan="3" align="right">
					<!--<input	type="submit"	name="submit"	id="submit"		value="Submit"		onclick="submitfocus()"	class="dua"/>-->
					<input	type="submit"	name="submit"	id="submit"		value="Submit"		onclick="scanissue2()"	class="dua"/>
					<input	type="button"	name="start_so"	id="start_so"	value="Start SO" 	onclick="startso()"/>
					<input	type="reset"	name="reset"	id="reset"		value="Start NIK"	onclick="startnik()"/>
				</td>
			</tr>
		</table>
		<!--<button type="submit" name="submit" value="Submit" class="dua" onclick="scanissue2()">SUBMIT</button>-->
	<!--
		SO NUMBER : <input type="text" name="so" id="idso" class="kelas1" /> <br>
		BARCODE SCAN : <input type="text" name="barcode" id="idbarcode" class="kelas1" />
	-->
	</form>    
	<input	type="text"	name="parthdn1"	id="parthdn1" />
	<input	type="text"	name="parthdn2"	id="parthdn2" />
	<input	type="text"	name="partpo2"	id="partpo2" />
	<input	type="text"	name="partqty2"	id="partqty2" />
<?php
   }
?>
</body>
</html>