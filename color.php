<!DOCTYPE html>
<html>
<body>

<p>Click the button to display a random number.</p>

<button onclick="myFunction()">Try it</button>

<h1 id="demo"></h1>

<script>
function myFunction() {
   var x = document.getElementById("demo").innerHTML = Math.floor(Math.random()*4)+1;
 switch (x) {
	  case 1: 
		document.getElementById("demo").innerHTML = "<div style='color:#299617'>ABC</div>";
	break;
	case 2:
	 document.getElementById("demo").innerHTML = "<div style='color:#2243B6'>ABC</div>";
	break;
	 case 3: 
		document.getElementById("demo").innerHTML = "<div style='color:#FF7A00'>ABC</div>";
	break;
	case 4:
	 document.getElementById("demo").innerHTML = "<div style='color:#0066FF'>ABC</div>";
	break;
	}
}
</script>

</body>
</html>

