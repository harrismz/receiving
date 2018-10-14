$(document).ready(function(){
	if ( $('.dt')[0].type != 'date' ) $('.dt').datepicker({ dateFormat: 'yy-mm-dd' });
});	

function scanpart_onclick2(){
	$('#scanpart').html(
		'<p align="center" class="loading"><img src="../img/loading.gif" alt="loading" height="100" width="100"/></p>'
	);
	/*call data part*/
	$.post('prodcheck_list_comboso.php', {dept_part: $('[name=hide_dept]').val(), issueke: $('[name=hide_issueke]').val(), date_part: $('[name=hide_date]').val(), line: $('[name=hide_line]').val(), model: $('[name=hide_model]').val(), prodno: $('[name=hide_prodno]').val(), lot: $('[name=hide_lot]').val(), qty: $('[name=hide_qty]').val()},
	function(result){
		$('#scanpart').html(result).show();
	});
	/*end call data part*/

	issueke();
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
	
	var model_label = document.getElementById('model_label');
	var line_label = document.getElementById('line_label');
	
	var list_dept	= document.getElementById('dept_part');
	var list_issueke= document.getElementById('issueke');
	var list_date	= document.getElementById('date_part');
	var list_line	= document.getElementById('line');
	var list_model	= document.getElementById('model');
	var list_prodno	= document.getElementById('prodno');
	var list_lot	= document.getElementById('lot');
	var list_qty	= document.getElementById('qty');
	
	hide_dept.value = list_dept.value;   
	hide_issueke.value = list_issueke.value;   
	hide_date.value = list_date.value;   
	hide_line.value = list_line.value;   
	hide_model.value = list_model.value;   
	hide_prodno.value = list_prodno.value;   
	hide_lot.value = list_lot.value;   
	hide_qty.value = list_qty.value;
	model_label.innerHTML = hide_model.value;
	line_label.innerHTML = hide_line.value;
	
	/*
	list_dept.value = "";
	list_issueke.value = "";
	list_date.value = "";
	list_line.value = "";
	list_model.value = "";
	list_prodno.value = "";
	list_lot.value = "";
	list_qty.value = "";
	*/
	scanpart_onclick2();
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
	model_label.innerHTML = hide_model.value;
	//scanpart_onclick2();
	tombol_submitpart();
}
/************************END PARTLIST***************************/
/*END NEW*/