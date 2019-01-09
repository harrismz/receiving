<html>
<head>
<title>MC ISSUE TO PRODUCTION SCAN</title>
<script src='jquery/jquery-1.12.0.min.js'></script>
<script type="text/javascript">

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
	scanissue_onclick();
}

$(document).ready(function(){
	$("#nik").focusin(function(){
        $(this).css("background-color", "lightblue");
    });
    $("#idso").focusin(function(){
        $(this).css("background-color", "lightblue");
    });
    $("#idbarcode1").focusin(function(){
        $(this).css("background-color", "lightblue");
    });
    $("#idbarcode2").focusin(function(){
        $(this).css("background-color", "lightgreen");
    });
    $("#po2").focusin(function(){
        $(this).css("background-color", "lightgreen");
    });
    $("#qty2").focusin(function(){
        $(this).css("background-color", "lightgreen");
    });

	$("#nik").focusout(function(){
        $(this).css("background-color", "#fff");
    });
    $("#idso").focusout(function(){
       $(this).css("background-color", "#fff");
    });
    $("#idbarcode1").focusout(function(){
        $(this).css("background-color", "#fff");
    });
    $("#idbarcode2").focusout(function(){
        $(this).css("background-color", "#fff");
    });
    $("#po2").focusout(function(){
        $(this).css("background-color", "#fff");
    });
    $("#qty2").focusout(function(){
        $(this).css("background-color", "#fff");
    });

	var gantiWeb = '<button class="btn btn-warning" type="button" onclick="errWeb()">Klik disini jika WEB ini ERROR</button>';
	//document.getElementById("errorWeb").innerHTML = gantiWeb;
});

function errWeb(){
	//var pathArray = window.location.pathname.split( '/' );
	var pathArray = window.location.href.split( '/' );
	var totArray = pathArray.length;
	var i;
	var segment = "";
	var segment_1 = pathArray[0];
	var segment_2 = pathArray[1];
	var segment_3 = pathArray[2];

	for (i=3; i < totArray; i++){
		segment += "/"+pathArray[i];
	}
	window.location.replace('http://136.198.117.75'+segment);
}

function scanissue_onclick(){
	$('#scanissue').html(
		'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanissue_unique.php', {nik: $('[name=nik]').val(), idso: $('[name=idso]').val(), parthdn1: $('[name=parthdn1]').val(), parthdn2: $('[name=parthdn2]').val(), partpo2: $('[name=partpo2]').val(), partqty2: $('[name=partqty2]').val()},
		function(result){
			$('#scanissue').html(result).show();
		}
	);
	// $.post('scanissue_unique.php', {nik: $('[name=nik]').val(), idso: $('[name=idso]').val(), parthdn1: $('[name=parthdn1]').val()},
	// 	function(result){
	// 		$('#scanissue').html(result).show();
	// 	}
	// );
	return false;
}
function tombol_submit(){
	parthdn1.value = idbarcode1.value;
	idbarcode1.value = "";
	parthdn2.value = idbarcode2.value;
	partpo2.value = po2.value;
	partqty2.value = qty2.value;
	idbarcode2.value = "";
	po2.value = "";
	qty2.value = "";
	scanissue_onclick();
}

function startnik(){
	/* SET FOCUS TO NIK (NOT USE DELETE VALUE BECAUSE THIS BUTTON TYPE IS RESET) */
		document.getElementById('nik').focus();
		$('#scanissue').html(
			'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
		);
		$.post('scanissue_unique.php', {nik: $('[name=""]').val(), idso: $('[name=""]').val(), parthdn1: $('[name=""]').val(), parthdn2: $('[name=""]').val(), partpo2: $('[name=""]').val(), partqty2: $('[name=""]').val()},
			function(result){
				$('#scanissue').html(result).show();
			}
		);
		return false;
		//$.post('scanissue_unique.php', {nik: $('[name=""]').val(), idso: $('[name=""]').val(), parthdn1: $('[name=""]').val()},
		//	function(result){
		//		$('#scanissue').html(result).show();
		//	}
		//);
		//return false;
}

function startso(){
	/*DELETE VALUE TEXTBOX */
	document.getElementById('idso').value      = "";
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
		document.getElementById('idso').focus();
	/* END SET FOCUS TO SO */
}


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
			//alert('1 nik focus');
		}
		else if (idso.value==""){
			idso.focus();
			//alert('2 idso focus');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value ==""){
		//else if (nik.value != "" && idso.value != "" && idbarcode1.value ==""){
			tombol_submit();
			idbarcode1.focus();
			//alert('3 submit | barcode1 focus');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value !="" && idbarcode2.value ==""){
		//else if (nik.value != "" && idso.value != "" && idbarcode1.value !=""){
			tombol_submit();
			idbarcode1.focus();
			//alert('4 submit | barcode1 focus');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value !="" && idbarcode2.value !=""){
		//else if (nik.value != "" && idso.value != "" && idbarcode1.value !=""){
			if ($('#idbarcode1').is(':focus')==true){
				idbarcode2.value = "";
				parthdn2.value = "";
				po2.value = "";
				partpo2.value = "";
				qty2.value = "";
				partqty2.value = "";
				tombol_submit();
				idbarcode1.focus();
				//alert('5 delete manual barcode');
			}
			else{
				parthdn1.value = "";
				idbarcode1.value = "";
				po2.focus();
				//alert('6 idbarcode1 clear | po2 focus');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && po2.value == "" && qty2.value == "" ){
		//else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" ){
			//po2.focus();
			if($('#po2').is(':focus') == true){
				parthdn1.value = "";
				idbarcode1.value = "";
				qty2.focus();
				//alert('7 barcode 1 clear | qty2 focus');
			}
			else if($('#po2').is(':focus') == false){
				parthdn1.value = "";
				idbarcode1.value = "";
				po2.focus();
				//alert('8 barcode 1 clear | po2 focus');
			}
			else if($('#qty2').is(':focus') == true){
				parthdn1.value = "";
				idbarcode1.value = "";
				tombol_submit();
				//alert('9 barcode 1 clear | submit');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && qty2.value != "" ){
		//else if (nik.value != "" && idso.value != "" && idbarcode1.value ==""){
			//var lenPO = po2.length;
			//alert(lenPO);

			tombol_submit();
			idbarcode2.focus();
			//alert('10 submit | barcode2 focus ');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && po2.value != "" && qty2.value != "" ){
		//else if (nik.value != "" && idso.value != "" && idbarcode1.value ==""){
			tombol_submit();
			idbarcode1.focus();
			//alert('11 submit | barcode1 focus');
		}
	}
}
</script>
<style>
	#submit, #start_so, #reset{
		background-color: #4caf50;
		border: none;
		color: #fff;
		padding: 6px 28px;
		text-align:center;
		text-decoration: none;
		display: inline-block;
		font-size: 15px;
	}

	#submit:hover, #start_so:hover, #reset:hover, #submit:active, #start_so:active, #reset:active{
		background-color:#fff;
		color: #125BA8;
		box-shadow: 0px 0px 15px rgba(128, 128, 128,1);
	}

	/* css for gantiWeb jika error */
	.btn {
		border-radius: 0px;
		border: 0px;
		margin: 3px;
		padding: 5px;
		font-size: 15px;
		font-weight: bold;
	}
	.btn:hover{
		box-shadow: 0px 0px 15px rgba(128, 128, 128, 1);
	}
	.btn-warning{
		color:#fff;
		background-color:#f0ad4e;
		border-color:#eea236
	}
	.btn-warning.focus,.btn-warning:focus{
		color:#fff;
		background-color:#ec971f;
		border-color:#985f0d
	}
	.btn-warning:hover{
		color:#fff;
		background-color:#ec971f;
		border-color:#d58512
	}
</style>
</head>
<body>
	<form method="post" id="form1">
		<table align="center" style="border-collapse: collapse">
			<tr><td style="border-top: 2px solid red; border-right: 2px solid red; border-left: 2px solid red;">&nbsp;Memulai dengan user/orang <u>yang sama</u> klik <b>( START SO )</b></td></tr>
			<tr><td style="border-bottom: 2px solid red; border-right: 2px solid red; border-left: 2px solid red;">&nbsp;Memulai dengan user/orang <u>yang berbeda</u> klik <b>( START NIK )</b></td></tr>
		</table>
		<h5 id="errorWeb" align="center"></h5>

		<br>
		<table align="center">
			<tr>
				<td>
					<table style="border-right:2px solid gray;">
						<tr>
							<td width="130px">NIK</td><td>:</td><td><input type="text" name="nik" id="nik" class="kelas1" onkeypress="etr(event)" /></td>
						</tr>
						<tr>
							<td width="130px">SO NUMBER</td><td>:</td><td><input type="text" name="idso" id="idso" class="kelas1" onkeypress="etr(event)" /></td>
						</tr>
						<tr>
							<td width="130px">BARCODE SCAN</td>	<td>:</td>	<td><input type="text"	name="idbarcode1"	id="idbarcode1"	class="kelas1" onkeypress="etr(event)" /></td>
						</tr>
					</table>
				</td>
				<td>
					<table style="border-right:2px solid gray;">
						<tr>
							<td width="80px">PART NO</td><td>:</td><td><input type="text" name="idbarcode2" id="idbarcode2" class="kelas1" onkeypress="etr(event)" maxlength="15"/></td>
						</tr>
						<tr>
							<td width="80px">PO</td><td>:</td><td><input type="text" name="po2" id="po2" class="kelas1" onkeypress="etr(event)" maxlength="7"/></td>
						</tr>
						<tr>
							<td width="80px">QTY</td>			<td>:</td>	<td><input type="text"	name="qty2"			id="qty2"		class="kelas1" onkeypress="etr(event)" maxlength="5"/></td>
						</tr>
					</table>
				</td>
				<td>
					<table>
						<tr>
							<td width="120px">PROD.DATE SUPP</td>			<td>:</td>	<td><input type="text"	name="supproddate2"			id="supproddate2"		class="kelas1" onkeypress="etr(event)" maxlength="5"/></td>
						</tr>
						<tr>
							<td width="120px">LOTNO SUPP</td>			<td>:</td>	<td><input type="text"	name="lotnosupp2"			id="lotnosupp2"		class="kelas1" onkeypress="etr(event)" maxlength="5"/></td>
						</tr>
					</table>
				</td>
			</tr>
			<td/>
			<tr>
				<td colspan="9" style="background-color:gray;"></td>
			</tr>
			<td/>
			<tr>
				<td colspan="9" align="center">
					<input	type="button"	name="submit"	id="submit"		value="SUBMIT"		onclick="tombol_submit()"	class="dua"/>
					<input	type="button"	name="start_so"	id="start_so"	value="START SO" 	onclick="startso()"/>
					<input	type="reset"	name="reset"	id="reset"		value="START NIK"	onclick="startnik()"/>
				</td>
			</tr>
		</table>
	</form>
	<input	type="hidden"	name="parthdn1"	id="parthdn1" />
	<input	type="hidden"	name="parthdn2"	id="parthdn2" />
	<input	type="hidden"	name="partpo2"	id="partpo2" />
	<input	type="hidden"	name="partqty2"	id="partqty2" />
	<input	type="hidden"	name="partpdate2"	id="partpdate2" />
	<input	type="hidden"	name="partlotno2"	id="partlotno2" />
<div id="scanissue" onload="scanissue()"></div>
</body>
</html>
