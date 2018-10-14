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
	//var issueseq = document.getElementById('issueseq');
	var idbarcode1 = document.getElementById('idbarcode1');
	var parthdn1 = document.getElementById('parthdn1');

	if (nik.value == ""){
		nik.focus();
	}
	/*else if(issueseq.value == ""){
		issueseq.focus();
	}*/
	else if(idso.value == ""){
		idso.focus();
	}
	else{
		parthdn1.value = idbarcode1.value;   
		idbarcode1.value = "";
		idbarcode1.focus();
	}
	scanissue_onclick();
	//scanpart_onclick();
	/*
	$(function(){
		$("#issueseq").keyup(function(){
			$("#issueseq_label").val($(this).val());
		});
	});
	*/
}

$(document).ready(function(){
	/*$("#issueseq").keyup(
		function(){
			var issue = document.getElementById("issueseq").value;
			//alert(issue);
			document.getElementById("issueseq_label").innerHTML = issue;
		}
	);*/
	$("#idso").keyup(
		function(){
			var labelso = document.getElementById("idso").value;
			//alert(issue);
			document.getElementById("so_label").innerHTML = labelso;
		}
	);
	/*$("#hide_issueke").keyup(
		function(){
			var labelissue = document.getElementById("hide_issueke").value;
			//alert(issue);
			document.getElementById("issueseq_label").innerHTML = labelissue;
		}
	);*/
	
	$("#nik").focusin(function(){
		$(this).css("background-color", "lightblue");
	});
	/*$("#issueseq").focusin(function(){
		$(this).css("background-color", "lightblue");
	});*/
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
	/*$("#issueseq").focusout(function(){
		$(this).css("background-color", "#fff");
	});*/
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
	if (nik.value==""){
		startnik();
	}
	else{
		$('#scanissue').html(
			'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
		);
		$.post('scanissue_comboso.php',{
			nik		: $('[name=nik]').val(),
			idso	: $('[name=idso]').val(),
			parthdn1: $('[name=parthdn1]').val(),
			parthdn2: $('[name=parthdn2]').val(),
			partpo2	: $('[name=partpo2]').val(),
			partqty2: $('[name=partqty2]').val(),
			partqty2: $('[name=partqty2]').val(),
			partqty2: $('[name=partqty2]').val(),
			partqty2: $('[name=partqty2]').val(),
			dept_part: $('[name=hide_dept]').val(),
			issueke	: $('[name=hide_issueke]').val(),
			date_part: $('[name=hide_date]').val(),
			line: $('[name=hide_line]').val(),
			model: $('[name=hide_model]').val(),
			prodno: $('[name=hide_prodno]').val(),
			lot: $('[name=hide_lot]').val(),
			qty: $('[name=hide_qty]').val()
		},
		function(result){
			$('#scanissue').html(result).show();
		});
		return false;
	}
}
function scanpart_onclick(){
	$('#scanpart').html(
		'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanpart_comboso.php', {dept_part: $('[name=dept_part]').val(), date_part: $('[name=date_part]').val(), line: $('[name=line]').val(), model: $('[name=model]').val(), prodno: $('[name=prodno]').val(), lot: $('[name=lot]').val(), qty: $('[name=qty]').val()},
	function(result){
		$('#scanpart').html(result).show();
	});
	return false;
}
function scanpart_onclick2(){
	$('#scanpart').html(
		'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanpart_comboso.php', {dept_part: $('[name=hide_dept]').val(), issueke: $('[name=hide_issueke]').val(), date_part: $('[name=hide_date]').val(), line: $('[name=hide_line]').val(), model: $('[name=hide_model]').val(), prodno: $('[name=hide_prodno]').val(), lot: $('[name=hide_lot]').val(), qty: $('[name=hide_qty]').val()},
	function(result){
		$('#scanpart').html(result).show();
	});
	return false;
}
function issueke(){
	$('#issueseq_label').html(
		'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	
	$.post('scanissueke_comboso.php', {dept_part: $('[name=hide_dept]').val(), issueke: $('[name=hide_issueke]').val(), date_part: $('[name=hide_date]').val(), line: $('[name=hide_line]').val(), model: $('[name=hide_model]').val(), prodno: $('[name=hide_prodno]').val(), lot: $('[name=hide_lot]').val(), qty: $('[name=hide_qty]').val()},
	function(result){
		$('#issueseq_label').html(result).show();
	});
	return false;
}
function tombol_submit(){
	var issueseq_label	= document.getElementById('issueseq_label');
	var hide_issueke	= document.getElementById('hide_issueke');
	
	parthdn1.value = idbarcode1.value;   
	parthdn2.value = idbarcode2.value;   
	partpo2.value = po2.value;   
	partqty2.value = qty2.value;
	issueseq_label.innerHTML = hide_issueke.value;
	
	idbarcode1.value = "";
	idbarcode2.value = "";
	po2.value = "";
	qty2.value = "";
	scanissue_onclick();
	//scanpart_onclick();
}
function tombol_submitpart(){
	var issueseq_label	= document.getElementById('issueseq_label');
	
	var hide_dept	= document.getElementById('hide_dept');
	var hide_issueke= document.getElementById('hide_issueke');
	var hide_date	= document.getElementById('hide_date');
	var hide_line	= document.getElementById('hide_line');
	var hide_model	= document.getElementById('hide_model');
	var hide_prodno	= document.getElementById('hide_prodno');
	var hide_lot	= document.getElementById('hide_lot');
	var hide_qty	= document.getElementById('hide_qty');
	
	var list_dept	= document.getElementById('dept_part');
	var list_issueke= document.getElementById('issueke');
	var list_date	= document.getElementById('date_part');
	var list_line	= document.getElementById('line');
	var list_model	= document.getElementById('model');
	var list_prodno	= document.getElementById('prodno');
	var list_lot	= document.getElementById('lot');
	var list_qty	= document.getElementById('qty');
	
	//issueseq_label.innerHTML = list_issueke.value;
	
	hide_dept.value = list_dept.value;   
	hide_issueke.value = list_issueke.value;   
	hide_date.value = list_date.value;   
	hide_line.value = list_line.value;   
	hide_model.value = list_model.value;   
	hide_prodno.value = list_prodno.value;   
	hide_lot.value = list_lot.value;   
	hide_qty.value = list_qty.value;
	
	list_dept.value = "";
	list_issueke.value = "";
	list_date.value = "";
	list_line.value = "";
	list_model.value = "";
	list_prodno.value = "";
	list_lot.value = "";
	list_qty.value = "";
	
	scanpart_onclick2();
	issueke();
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
	var so_label = document.getElementById('so_label');
	var issueseq_label = document.getElementById('issueseq_label');
	/*================newlist===================*/
	var hide_dept	= document.getElementById('hide_dept');
	var hide_issueke= document.getElementById('hide_issueke');
	var hide_date	= document.getElementById('hide_date');
	var hide_line	= document.getElementById('hide_line');
	var hide_model	= document.getElementById('hide_model');
	var hide_prodno	= document.getElementById('hide_prodno');
	var hide_lot	= document.getElementById('hide_lot');
	var hide_qty	= document.getElementById('hide_qty');
	
	hide_dept.value = "";
	hide_issueke.value = "";
	hide_date.value = "";
	hide_line.value = "";
	hide_model.value = "";
	hide_prodno.value = "";
	hide_lot.value = "";
	hide_qty.value = "";
	/*================newlist===================*/
	
	/*hidden barcode 1*/
	show_barcode1.style.display = "block";
	setmanual.style.display = "block";
	//issueseq_label.innerHTML = "";//issueseqlabel
	so_label.innerHTML = "";
	issueseq_label.innerHTML = "";
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
	$.post('scanissue_comboso.php', {nik: $('[name=""]').val(), idso: $('[name=""]').val(), parthdn1: $('[name=""]').val(), parthdn2: $('[name=""]').val(), partpo2: $('[name=""]').val(), partqty2: $('[name=""]').val()},
	function(result){
		$('#scanissue').html(result).show();
	});
	$('#scanpart').html(
		'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	$.post('scanpart_comboso.php', {dept_part: $('[name=""]').val(), date_part: $('[name=""]').val(), line: $('[name=""]').val(), model: $('[name=""]').val(), prodno: $('[name=""]').val(), lot: $('[name=""]').val(), qty: $('[name=""]').val()},
	function(result){
		$('#scanpart').html(result).show();
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
	var so_label = document.getElementById('so_label');
	so_label.innerHTML = "";
	
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
/*
function etr(event){
	var x = event.which || event.keyCode;

	var nik	      = document.getElementById('nik');
	var idso	  = document.getElementById('idso');
	var issueseq  = document.getElementById('issueseq');
	var idbarcode1= document.getElementById('idbarcode1');
	var parthdn1  = document.getElementById('parthdn1');
	/*---------------*/
/*	var idbarcode2= document.getElementById('idbarcode2');
	var parthdn2  = document.getElementById('parthdn2');
	var po2       = document.getElementById('po2');
	var partpo2   = document.getElementById('partpo2');
	var qty2      = document.getElementById('qty2');
	var partqty2  = document.getElementById('partqty2');
	/*---------------*/
/*	var show_barcode1 = document.getElementById('show_barcode1');
	var show_barcode2 = document.getElementById('show_barcode2');
	
	//alert(x);
	if(x == 13) {
		if (nik.value==""){
			nik.focus();
			//alert('1 nik focus');
		}
		/*else if (issueseq.value==""){
			issueseq.focus();
			alert('2 issueseq focus');
		}*/
/*		else if (idso.value==""){
			idso.focus();
			//alert('3 idso focus');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value ==""){
			tombol_submit(); 
			if (show_barcode1.style.display == "block"){
				idbarcode1.focus();
			//alert('4 submit | barcode1  focus');
			}
			else if(show_barcode1.style.display == "none"){
				idbarcode2.focus();
			//alert('4 submit |  barcode2 focus');
			}
			
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value !="" && idbarcode2.value ==""){
			tombol_submit();
			idbarcode1.focus(); 
			//alert('5 submit | barcode1 focus');
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
				//alert('6 delete manual barcode');
			}
			else{
				parthdn1.value = "";
				idbarcode1.value = "";
				po2.focus();
				//alert('7 idbarcode1 clear | po2 focus');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && po2.value == "" && qty2.value == "" ){
			//po2.focus();
			if($('#po2').is(':focus') == true){
				parthdn1.value = "";
				idbarcode1.value = "";
				qty2.focus();
				//alert('8 barcode 1 clear | qty2 focus');
			}
			else if($('#po2').is(':focus') == false){
				parthdn1.value = "";
				idbarcode1.value = "";
				po2.focus();
				//alert('9 barcode 1 clear | po2 focus');
			}
			else if($('#qty2').is(':focus') == true){
				parthdn1.value = "";
				idbarcode1.value = "";
				tombol_submit();
				//alert('10 barcode 1 clear | submit');
			}
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && qty2.value != "" ){
			//var lenPO = po2.length;
			//alert(lenPO);

			tombol_submit();
			idbarcode2.focus(); 
			//alert('10 submit | barcode2 focus ');
		}
		else if (nik.value != "" && idso.value != "" && idbarcode1.value =="" && idbarcode2.value != "" && po2.value != "" && qty2.value != "" ){
			tombol_submit();
			idbarcode1.focus();
			//alert('11 submit | barcode1 focus');
		}
		else if (po2.value != ""){
			/*var lenPO = po2.value;
			var lenPO1 = lenPO.length;
			alert(lenPO1);*/
			//alert('9 idbarcode1 clear | po2 focus');
/*			qty2.focus();
		}
	}
}*/

function etr(event){
	var x = event.which || event.keyCode;
	/*********/
	var hide_dept  = document.getElementById('hide_dept');
	var hide_date  = document.getElementById('hide_date');
	var hide_line  = document.getElementById('hide_line');
	var hide_model = document.getElementById('hide_model');
	var hide_prodno= document.getElementById('hide_prodno');
	var hide_lot   = document.getElementById('hide_lot');
	var hide_qty   = document.getElementById('hide_qty');
	/********/
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
		else if (hide_dept.value=="" || hide_date.value=="" || hide_line.value=="" || hide_model.value=="" || hide_prodno.value=="" || hide_lot.value=="" || hide_qty.value==""){
			//dept_part.focus();
			alert('Tampilkan Partlist dulu dengan klik tombol (NEW LIST)');
			idso.value = "";
			so_label.innerHTML = "";
			show_po2.value = "";
			show_qty2.value = "";
			idbarcode1.value = "";
			idbarcode2.value = "";
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
function etr2(event){
	var x = event.which || event.keyCode;

	var dept_part= document.getElementById('dept_part');
	var issueke	 = document.getElementById('issueke');
	var date_part= document.getElementById('date_part');
	var line     = document.getElementById('line');
	var model    = document.getElementById('model');
	var prodno   = document.getElementById('prodno');
	var lot      = document.getElementById('lot');
	var qty      = document.getElementById('qty');
		
	//alert(x);
	if(x == 13) {
		if (dept_part.value==""){
			dept_part.focus();
			//alert('1 date_part focus');
		}
		else if (date_part.value==""){
			date_part.focus();
			//alert('1 date_part focus');
		}
		else if (line.value==""){
			line.focus();
			//alert('2 line focus');
		}
		else if (model.value==""){
			model.focus();
			//alert('3 model focus');
		}
		else if (prodno.value==""){
			prodno.focus();
			//alert('4 prodno focus');
		}
		else if (lot.value==""){
			lot.focus();
			//alert('5 lot focus');
		}
		else if (qty.value==""){
			qty.focus();
			//alert('6 qty focus');
		}
		else if($('#issueke').is(":focus")==false){
			issueke.focus();
		}
		else if($('#issueke').is(":focus")==true){
			tombol_submitpart();
			var show_partlist= document.getElementById('show_partlist');
			if($('#show_partlist').css('display') == 'block'){
				show_partlist.style.display = "none";
				show_issueke.style.display = "block";
				return false;
			}
		}
		else{
			tombol_submitpart();
			var show_partlist= document.getElementById('show_partlist');
			if($('#show_partlist').css('display') == 'block'){
				show_partlist.style.display = "none";
				show_issueke.style.display = "block";
				return false;
			}
			//alert('7 submit');
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

/************************PARTLIST***************************/
function newPart(){
	var dept_part= document.getElementById('dept_part');
	var issueke	 = document.getElementById('issueke');
	var date_part= document.getElementById('date_part');
	var line     = document.getElementById('line');
	var model    = document.getElementById('model');
	var prodno   = document.getElementById('prodno');
	var lot      = document.getElementById('lot');
	var qty      = document.getElementById('qty');
	
	/*DELETE VALUE TEXTBOX */
	document.getElementById('dept_part').value= "";
	document.getElementById('issueke').value  = "";
	document.getElementById('date_part').value= "";
	document.getElementById('line').value     = "";
	document.getElementById('model').value    = "";
	document.getElementById('prodno').value   = "";
	document.getElementById('lot').value      = "";
	document.getElementById('qty').value      = "";
	/*END DELETE VALUE TEXTBOX */
	
	var show_partlist= document.getElementById('show_partlist');
	var show_issueke= document.getElementById('show_issueke');
	if($('#show_partlist').css('display') == 'block'){
		show_partlist.style.display = "none";
		show_issueke.style.display = "block";
		
		return false;
	}
	else if($('#show_partlist').css('display') == 'none'){
		show_partlist.style.display = "block";
		show_issueke.style.display = "none";
		return false;
	}
	if (dept_part.value==""){
		dept_part.focus();
	}
	else if (date_part.value==""){
		date_part.focus();
	}
	else if (issueke.value==""){
		issueke.focus();
	}
	else if (line.value==""){
		line.focus();
	}
	else if (model.value==""){
		model.focus();
	}
	else if (prodno.value==""){
		prodno.focus();
	}
	else if (lot.value==""){
		lot.focus();
	}
	else if (qty.value==""){
		qty.focus();
	}
}
function refreshPart(){
	var hide_issueke	= document.getElementById('hide_issueke');
	var issueseq_label	= document.getElementById('issueseq_label');
	issueseq_label.innerHTML = hide_issueke.value;
	scanpart_onclick2();
	issueke();
}
/************************END PARTLIST***************************/
/*END NEW*/