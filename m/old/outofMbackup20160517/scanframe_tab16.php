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
<frameset rows="250,*" border="NO">
<frame src="scanform_tab16.php" name="scanform">
<frame src="scanissue_tab16.php" name="scanissue">
</frameset>
<body>
</body>
<noframes>
<a href="scanframe_tab.php">your browser</a>
</noframes>
</html>
