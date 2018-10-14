<!DOCTYPE html>
<html>
<head>
<title>jQuery.post Demo</title>
<script src="jquery-1.11.1.js"></script>
<script>
$(document).ready(function()
  {
    $("button").click(function()
     {
     //  $("#div1").load("ajak.txt");
         $("#div1").append("Imam Prayudi");
         $("#div1").append("<br>TDS");
     });
   });
</script>

</head>
<body>


<div id="div1">divisi IT</div>

<button> klik </button>
</body>

</html>
