<!DOCTYPE html>
<html>
<head>
<title>BCAS BARCODE</title>
<script src="jquery-1.11.1.js"></script>
<script>
$(document).ready(function()
  {
    $("button").click(function()
     {
         {
           $.POST("bcaspost.php",
               {
                 nama:"Imam Prayudi",
                 kota:"Jakarta"
               },
               function(data,status)
               {
                 alert(status);
               });
         });
      });
 
 
   });
</script>

</head>
<body>


<div id="div1">divisi IT</div>

<button> klik </button>
</body>

</html>
