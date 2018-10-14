/*
function mulai()
{
var mypart = document.getElementById('partid');
var mytext = document.getElementById('idbarcode');
var myso_number = document.getElementById('idso');

mypart.value = mytext.value;   
mytext.value = "";
mytext.focus();
}

function start()
{
var myso_number = document.getElementById('idso');
myso_number.focus();
}
*/

/*NEW*/

window.onload = function scanissue(){
	var nik = document.getElementById('nik');
	var idso = document.getElementById('idso');
	var idbarcode1 = document.getElementById('idbarcode1');
	var parthdn1 = document.getElementById('parthdn1');

	if (nik.value == ""){
		nik.focus();
	}
	else if(idso.value == ""){
		idso.focus();
	}
	else{
		parthdn1.value = idbarcode1.value;   
		idbarcode1.value = "";
		idbarcode1.focus();
	}
	scanissue_onclick();
}

$(document).ready(function(){
	$("#idso").keyup(
		function(){
			var issue = document.getElementById("idso").value;
			//alert(issue);
		}
	);
	
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
});

function scanissue_onclick(){
	$('#scanissue').html(
		'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanissue.php', {nik: $('[name=nik]').val(), idso: $('[name=idso]').val(), parthdn1: $('[name=parthdn1]').val(), parthdn2: $('[name=parthdn2]').val(), partpo2: $('[name=partpo2]').val(), partqty2: $('[name=partqty2]').val()},
	function(result){
		$('#scanissue').html(result).show();
	});
	return false;
}

function tombol_submit(){
	parthdn1.value = idbarcode1.value;   
	parthdn2.value = idbarcode2.value;   
	partpo2.value = po2.value;   
	partqty2.value = qty2.value;   
	idbarcode1.value = "";
	idbarcode2.value = "";
	po2.value = "";
	qty2.value = "";
	scanissue_onclick();
}

function startnik(){
	/* SET FOCUS TO NIK (NOT USE DELETE VALUE BECAUSE THIS BUTTON TYPE IS RESET) */
	var show_barcode1  = document.getElementById('show_barcode1');
	var show_barcode2  = document.getElementById('show_barcode2');
	var show_po2  = document.getElementById('show_po2');
	var show_qty2  = document.getElementById('show_qty2');
	/*---------------*/
	var setmanual  = document.getElementById('setmanual');
	var setscanner  = document.getElementById('setscanner');
	/*------------*/
	var idbarcode1= document.getElementById('idbarcode1');
	var idbarcode2= document.getElementById('idbarcode2');
	/*------*/
	
	/*hidden barcode 1*/
	show_barcode1.style.display = "block";
	setmanual.style.display = "block";
	parthdn1.value = "";
	/*end hidden barcode 1*/

	/*show barcode 2*/
	show_barcode2.style.display = "none";
	setscanner.style.display = "none";
	show_po2.style.display = "none";
	show_qty2.style.display = "none";
	parthdn2.value = "";
	partpo2.value = "";
	partqty2.value = "";
	/*end show barcode 2*/
	
	document.getElementById('nik').focus();
	$('#scanissue').html(
	'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanissue.php', {nik: $('[name=""]').val(), idso: $('[name=""]').val(), parthdn1: $('[name=""]').val(), parthdn2: $('[name=""]').val(), partpo2: $('[name=""]').val(), partqty2: $('[name=""]').val()},
	function(result){
		$('#scanissue').html(result).show();
	});
	return false;
}

function startso(){
	/*DELETE VALUE TEXTBOX */
	document.getElementById('idso').value     = "";
	document.getElementById('parthdn1').value  = "";
	document.getElementById('idbarcode1').value= "";
	document.getElementById('parthdn2').value  = "";
	document.getElementById('idbarcode2').value= "";
	document.getElementById('po2').value       = "";
	document.getElementById('qty2').value      = "";
	document.getElementById('partpo2').value   = "";
	document.getElementById('partqty2').value  = "";
	/*END DELETE VALUE TEXTBOX */
	
	var show_barcode1  = document.getElementById('show_barcode1');
	var show_barcode2  = document.getElementById('show_barcode2');
	var show_po2  = document.getElementById('show_po2');
	var show_qty2  = document.getElementById('show_qty2');
	/*---------------*/
	var setmanual  = document.getElementById('setmanual');
	var setscanner  = document.getElementById('setscanner');
	/*------------*/
	var idbarcode1= document.getElementById('idbarcode1');
	var idbarcode2= document.getElementById('idbarcode2');
	/*------*/
	
	/*hidden barcode 1*/
	show_barcode1.style.display = "block";
	setmanual.style.display = "block";
	/*end hidden barcode 1*/

	/*show barcode 2*/
	show_barcode2.style.display = "none";
	setscanner.style.display = "none";
	show_po2.style.display = "none";
	show_qty2.style.display = "none";
	/*end show barcode 2*/
	
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
	/*---------------*/
	var show_barcode1 = document.getElementById('show_barcode1');
	var show_barcode2 = document.getElementById('show_barcode2');
	
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
			if ($('#show_barcode1').css('display') == 'block'){
				tombol_submit(); 
				idbarcode1.focus();
				//alert('3 submit | barcode1 focus');
			}
			else if($('#show_barcode1').css('display') == 'none'){
				tombol_submit(); 
				idbarcode2.focus();
				//alert('4 submit | barcode1 focus');
			}
			else {
				tombol_submit(); 
				idbarcode1.focus();
				//alert('5 submit | barcode1 focus (ELSE)');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value !="" && idbarcode2.value ==""){
			tombol_submit();
			idbarcode1.focus(); 
			//alert('6 submit | barcode1 focus');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value !="" && idbarcode2.value !=""){
			if ($('#idbarcode1').is(':focus')==true){
				idbarcode2.value = "";
				parthdn2.value = "";
				po2.value = "";
				partpo2.value = "";
				qty2.value = "";
				partqty2.value = "";
				tombol_submit(); 
				idbarcode1.focus(); 
				//alert('7 delete manual barcode');
			}
			else{
				parthdn1.value = "";
				idbarcode1.value = "";
				po2.focus();
				//alert('8 idbarcode1 clear | po2 focus');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && po2.value == "" && qty2.value == "" ){
			//po2.focus();
			if($('#po2').is(':focus') == true){
				parthdn1.value = "";
				idbarcode1.value = "";
				qty2.focus();
				//alert('9 barcode 1 clear | qty2 focus');
			}
			else if($('#po2').is(':focus') == false){
				parthdn1.value = "";
				idbarcode1.value = "";
				po2.focus();
				//alert('10 barcode 1 clear | po2 focus');
			}
			else if($('#qty2').is(':focus') == true){
				parthdn1.value = "";
				idbarcode1.value = "";
				tombol_submit();
				//alert('11 barcode 1 clear | submit');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && qty2.value != "" ){
			//var lenPO = po2.length;
			//alert(lenPO);

			tombol_submit();
			idbarcode2.focus(); 
			//alert('12 submit | barcode2 focus ');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && po2.value != "" && qty2.value != "" ){
			tombol_submit();
			idbarcode1.focus();
			//alert('13 submit | barcode1 focus');
		}
		else if (po2.value != ""){
			/*var lenPO = po2.value;
			var lenPO1 = lenPO.length;
			alert(lenPO1);*/
			qty2.focus();
			//alert('14 idbarcode1 clear | po2 focus');
		}
	}
}

function tomanual(){
	var nik	      = document.getElementById('nik');
	var idso	  = document.getElementById('idso');
	/*-------------------------*/
	var show_barcode1  = document.getElementById('show_barcode1');
	var show_barcode2  = document.getElementById('show_barcode2');
	var show_po2  = document.getElementById('show_po2');
	var show_qty2  = document.getElementById('show_qty2');
	/*---------------*/
	var setmanual  = document.getElementById('setmanual');
	var setscanner  = document.getElementById('setscanner');
	/*------------*/
	var idbarcode1= document.getElementById('idbarcode1');
	var idbarcode2= document.getElementById('idbarcode2');

	/*hidden barcode 1*/
	show_barcode1.style.display = "none";
	setmanual.style.display = "none";
	parthdn1.value = "";
	/*end hidden barcode 1*/

	/*show barcode 2*/
	show_barcode2.style.display = "block";
	setscanner.style.display = "block";
	show_po2.style.display = "block";
	show_qty2.style.display = "block";
	parthdn2.value = "";
	partpo2.value = "";
	partqty2.value = "";
	/*end show barcode 2*/
	
	if (nik.value==""){
		nik.focus();
		//alert('1 nik focus');
	}
	else if (idso.value==""){
		idso.focus();
		//alert('2 idso focus');
	}
	else{
		idbarcode2.focus();
	}
}

function toscanner(){
	var show_barcode1  = document.getElementById('show_barcode1');
	var show_barcode2  = document.getElementById('show_barcode2');
	var show_po2  = document.getElementById('show_po2');
	var show_qty2  = document.getElementById('show_qty2');
	/*---------------*/
	var setmanual  = document.getElementById('setmanual');
	var setscanner  = document.getElementById('setscanner');
	/*------------*/
	var idbarcode1= document.getElementById('idbarcode1');
	var idbarcode2= document.getElementById('idbarcode2');

	/*hidden barcode 1*/
	show_barcode1.style.display = "block";
	setmanual.style.display = "block";
	parthdn1.value = "";
	/*end hidden barcode 1*/

	/*show barcode 2*/
	show_barcode2.style.display = "none";
	setscanner.style.display = "none";
	show_po2.style.display = "none";
	show_qty2.style.display = "none";
	parthdn2.value = "";
	partpo2.value = "";
	partqty2.value = "";
	/*end show barcode 2*/

	if (nik.value==""){
		nik.focus();
		//alert('1 nik focus');
	}
	else if (idso.value==""){
		idso.focus();
		//alert('2 idso focus');
	}
	else{
		idbarcode1.focus();
	}
}
/*END NEW*/