   <html>
    <head>
	<script src='../../bootstrap/jquery/jquery-1.12.0.min.js'></script>
	</head>
    <body>
      <select id="DLState" onclick="callso()">
      </select>
    </body>
    </html>

<script>
/*    var jsonList = {"Table" : [{"stateid" : "2","statename" : "Tamilnadu"},
                {"stateid" : "3","statename" : "Karnataka"},
                {"stateid" : "4","statename" : "Andaman and Nicobar"},
                 {"stateid" : "5","statename" : "Andhra Pradesh"},
                 {"stateid" : "6","statename" : "Arunachal Pradesh"}]}
*/
    /*$.ajax({
		dataType: "json",
		url: "calljson.php",
		data: data,
		success: true,
	});
	*/
	var jsonList = (function(){
		var jsonList = null;
		$.ajax({
			'async' : false,
			'global': false,
			'url'	: "calljson.php",
			'dataType': "json",
			'success': function(data){
				json = data;
			}
		});
		return json;
	})();

    /*$(document).ready(function(){
      var listItems= "";
      for (var i = 0; i < jsonList.data.length; i++){
        listItems+= "<option value='" + jsonList.data[i].so_number + "'>" + jsonList.data[i].so_number + "</option>";
      }
      $("#DLState").html(listItems);
    });*/
	function callso(){
      var listItems= "";
      for (var i = 0; i < jsonList.data.length; i++){
        listItems+= "<option value='" + jsonList.data[i].so_number + "'>" + jsonList.data[i].so_number + "</option>";
      }
      $("#DLState").html(listItems);
    } 
</script>	