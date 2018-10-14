<html>
<head>
<title>outgoing</title>
<script type="text/javascript"></script>
<!--<script>
	window.onload = function scanissue(){
		/*$('#scanissue').html(
			'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
		);
		$.post('scanissue_tab.php',
			function(result){
				$('#scanissue').html(result).show();
			}
		);
		return false;*/
		$('#scanissue').html(
			'<p align="center" class="loading"><img src="img/load.gif" alt="loading" height="100" width="100"/></p>'
		);
		$.post('scanissue_tab.php',
			function(result){
				$('#scanissue').html(result).show();
			}
		);
		return false;
	}
</script>-->
</head>

<iframe src="scanform_tab_noframe3.php" name="scanform" style="height:30%;width:100%;"></iframe>
<iframe src="scanissue_tab_noframe3.php" name="scanissue" style="height:70%;width:100%;"></iframe>
<body>
</body>
<noframes>
<a href="scanframe_tab_noframe3.php">your browser</a>
</noframes>






</html>
