<!DOCTYPE html>
<html>
<head>
<title>BCAS BARCODE</title>
<script src="jquery-1.11.1.js"></script>
<script>
$(document).ready(function()
  {


$("button").click(function(){
  $.post("bcaspost.php",
  {
    so:$("#idso").val(),
    partbcas:$("#partbcasid").val(),
    parthdn:$("#idbarcode").val(),
  },
  function(data,status){
   // alert("Data: " + data + "\nStatus: " + status);
   $("#div1").empty();
   $("#div1").append(data);
   $("#idbarcode").val('');

  });
});


$("#idbarcode").keyup(function(event){
    if(event.keyCode == 13){
        $("button").click();
    }
});


  });  // end of document ready



</script>

</head>
<body>
<a href="index.php">MENU</a>
<br><br>

SO NUMBER : <input type="text" name="so" id="idso" class="kelas1" /> <br>
     PART NUMBER : <input type="text" name="partbcas" id="partbcasid" /><br>
     BARCODE SCAN :
     <input type="text" name="barcode" id="idbarcode" class="kelas1" />
<button> Submit </button>

<div id="div1"></div>


</body>

</html>
