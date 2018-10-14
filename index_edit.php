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
  else if(navigator.appVersion.indexOf("Android")!=-1){
	  window.location.replace("http://136.198.117.48/receiving/android/index.php");
  }
  
	/*//check resolution
	$(document).ready(function(){
			var _w = Math.max($(window).width(),$(window).height());
			var _h = Math.min($(window).width(),$(window).height());
			alert(_w+" | "+_h);
		})
	*/
});

</script>
</head>
<body>
<h2><img src="../images/logo.gif" alt="Logo: JVCKENWOOD" width="214" height="77"</h2>
<div>
<h3 align="center">NON TAPING BARCODE SYSTEM</h3>
</div>
<table width="100%">
<tr>
<td align="center"><a href="brcsupp.php">Manual Barcode Printing</a></td>
<td align="center"><a href="brcsupp_new.php">New Barcode Printing</a></td>
</tr>
<tr>
  <td align="center"><a href="frmupload.php">UPLOAD SO DATA - SA90.CSV</a></td>
 <td align="center"><a href="stdlocalsupp.php">Standard Packing Maintenance</a></td>
</tr>
 <!--
<tr>
 <td align="center"><a href="frmupload_partlist.php">MC ISSUING SYSTEM - UPLOAD FILE .CSV</a></td>

</tr>
 -->
<tr>
 <td align="center"><a href="partupdate.php">UPDATE PART AFTER UPLOAD SO DATA</a></td>
 <td align="center"><a href="soview.php">VIEW SO DATA - SA90</a></td>

</tr>
<tr>
 <td align="center"><a href="issueview.php">VIEW ACTIVE MONTH DETAIL DATA</a></td>
 <td align="center"><a href="scanframe_tab.php">SCAN DATA WITH BARCODE</a></td>

</tr>
<tr>
 <td align="center"><a href="manual_so_number.php">Manual SO Number Printing</a></td>
 <td align="center"><a href="issueviewold.php">VIEW OLD DETAIL DATA</a></td>

</tr>
<tr>
 <td align="center"><a href="part_category.php">Part Category Maintenance</a></td>
 <td align="center"><a href="part_without_supplier_code.php">Part Without Supplier Code Maintenance</a></td>

</tr>
<tr>
 <td align="center"><a href="issue_part_list_non_fa.php">Issue Part List Non FA Printing</a></td>
 <td align="center"><a href="issue_part_list.php">Issue Part List Printing</a></td>

</tr>
<tr>
 <td align="center"><a href="sop_non_taping.htm">SOP NON TAPING</a></td>
 <td align="center"><a href="warehouse_layout.htm">RECEIVING WAREHOUSE LAYOUT</a></td>
</tr>
<tr>
 <td align="center"><a href="frmupload_partlist.php">MC ISSUING SYSTEM - UPLOAD FILE .CSV</a></td>
 <td align="center"><a href="print_partcode.php">MC ISSUING SYSTEM - PRINT SCHEDULE OF PARTLIST</a></td>
</tr>
</table>

	

<hr>
<div>
<h3 align="center">B-CAS ISSUE BARCODE SYSTEM</h3>
</div>
	<table width="100%">
	<tr>
			<td align="center"><a href="bcasbarcode.php">SCAN B-CAS</a></td>
			<td align="center"><a href="bcasview.php">VIEW B-CAS DETAIL</a></td>
           </tr><tr>
			<td align="center"><a href="bcasviewdel.php">DELETE B-CAS</a></td>
			<td align="center"><a href="bcasviewdownload.php">DOWNLOAD B-CAS REPORT</a></td>
</tr>
</table>
        
        

</body>

</html>