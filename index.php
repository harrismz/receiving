<?php
/*
****	modify by Mohamad Yunus
****	on 23 Jan 2017
****	revise:	logo
*/

/*
****	modify by Harris Muhammad Zaki
****	on 5 Oct 2017
****	add function errWeb jika LINK 136.198.117.48 ERROR
		line 30-55 ( css error web )
		line 69-70 ( var gantiWeb )
		line 74-89 ( function errWeb )
		line 97 ( <h5 id="errorWeb" align="center"></h5> )
*/
?>

<html>
<title>
Receiving System
</title>
<head>
<style>
div
 {
   background-color:#000066;
   color:white;
 }
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

/*badge*/
.badge1 {
   position:relative;
   color: red;
}
.badge1:hover {
   color: green;
}
.badge1[data-badge]:after {
   content:attr(data-badge);
   position:absolute;
   top:-12px;
   right:-30px;
   font-size:.7em;
   background:red;
   color:white;
   width:40px;
   height:20px;
   text-align:center;
   line-height:22px;
   border-radius:50%;
   box-shadow:0 0 2px #333;
}
</style>

<script src="jquery-2.2.2.min.js"></script>
<script src="mobile.js"></script>
<script>
$(document).ready(function()
{
  if(jQuery.browser.mobile)
  {
    window.location.replace("http://136.198.117.48/receiving/m/index.php");
  }
  
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
</script>
</head>
<body>
<h2><img src="img/jvckenwood.jpg" alt="Logo: JVCKENWOOD" width="260" height="77"></h2>
<div>
<h3 align="center">NON TAPING BARCODE SYSTEM</h3>
</div>
<h5 id="errorWeb" align="center"></h5>
<table width="100%">
<tr>
 <td align="center"><a href="m/asset/WI_IF_ERROR_RECEIVING_WEB.pdf" class="badge1" data-badge="INFO">RECEIVING WEB Information</a></td>


</tr>
<tr>
 <td align="center"><a href="brcsupp_unix.php">Manual Barcode Printing</a></td>
<td align="center"><a href="brcsupp_new_unix.php">New Barcode Printing</a></td>


</tr>
<tr>
 <td align="center"><a href="frmupload.php">UPLOAD SO DATA - SA90.CSV</a></td>
 <td align="center"><a href="stdlocalsupp.php">Standard Packing Maintenance</a></td>

</tr>
<tr>
 <td align="center"><a href="partupdate.php">UPDATE PART AFTER UPLOAD SO DATA</a></td>
 <td align="center"><a href="soview.php">VIEW SO DATA - SA90</a></td>

</tr>
<tr>
 <td align="center"><a href="issueview.php">VIEW ACTIVE MONTH DETAIL DATA</a></td>
 <td align="center"><a href="scanform_unique.php">SCAN DATA WITH BARCODE</a></td>

</tr>
<tr>
 <td align="center"><a href="manual_so_number.php">Manual SO Number Printing</a></td>
 <td align="center"><a href="m/mcissue/scanform.php">SCAN DATA - MC ISSUE SYSTEM</a></td>

</tr>
<tr>
 <td align="center"><a href="allstdpack.php">Part All Supplier Maintenance</a></td>
 <td align="center"><a href="m/qrinvoice">SCAN DATA - RECEIVING INVOICE (Test Data)</a></td>

</tr>

<tr>
 <td align="center"><a href="sop_non_taping.htm">SOP NON TAPING</a></td>
 <td align="center"><a href="issueviewold.php">VIEW OLD DETAIL DATA</a></td>
</tr>

<tr>
 <td align="center"><a href="frmupload_partlist.php">MC ISSUE SYSTEM - Upload File .CSV</a></td>
 <td align="center"><a href="part_without_supplier_code.php">Part Without Supplier Code Maintenance</a></td>
</tr>

<tr>
 <td align="center"><a href="m/prodcheck_comboso.php">MC ISSUE SYSTEM - Production Checking Issue</a></td>
 <td align="center"><a href="warehouse_layout.htm">RECEIVING WAREHOUSE LAYOUT</a></td>
</tr>
<tr>
 <td align="center">Part Category Maintenance</td>
 <td align="center"><a href="print_partcode.php">MC ISSUE SYSTEM - Print Schedule of Partlist</a></td>
</tr>
<tr>
<td align="center">Issue Part List Non FA Printing</td>
 <td align="center">Issue Part List Printing</td>
</tr>
</table>

	

<hr>
<div>
<h3 align="center">B-CAS ISSUE BARCODE SYSTEM</h3>
</div>
	<table width="100%">
	<tr>
			<td align="center"><a href="bcasbarcode.php">SCAN B-CAS</a></td>
			<td align="center"><a href="bcasdata.php">VIEW B-CAS DETAIL</a></td>
           </tr><tr>
			<td align="center"><a href="bcasviewdel.php">DELETE B-CAS</a></td>
			<td align="center"><a href="#"></a></td>
</tr>
</table>
        
        

</body>

</html>