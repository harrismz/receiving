<html>
	<head>
		<title>UPLOAD PARTLIST</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'>
		<link rel="stylesheet" href="../bootstrap/jquery/jquery-ui/jquery-ui.css"> 
		<script src='../bootstrap/jquery/jquery-1.12.0.min.js'></script>
		<script src="../bootstrap/jquery/jquery-ui/jquery-ui.js"></script> 
		<script src='../bootstrap/js/bootstrap.js'></script>
		<script rel="text/javascript">
			/*upload file button*/
				$(document).on('change', '.btn-file :file', function() {
				  var input = $(this),
					  numFiles = input.get(0).files ? input.get(0).files.length : 1,
					  label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				  input.trigger('fileselect', [numFiles, label]);
				});

				$(document).ready( function() {
					$('.btn-file :file').on('fileselect', function(event, numFiles, label) {

						var input = $(this).parents('.input-group').find(':text'),
							log = numFiles > 1 ? numFiles + ' files selected' : label;

						if( input.length ) {
							input.val(log);
						} else {
							if( log ) alert(log);
						}

					});
				}); 
			/*-- upload file button*/
		</script>
		<style>
			*{
				margin: 0;
				padding: 0;
			}
			ul{
				list-style-type:none;
				overflow: hidden;
				background-color: #333;
			}
			li{
				float: left;
			}
			li a{
				display: block;
				color: #fff;
				text-align: center;
				padding: 10px 12px;
				text-decoration: none;
				font-weight: bold;
			}
			li font{
				display: block;
				color: #fff;
				text-align: center;
				padding: 6px 5px 0px 30px;
				text-decoration: none;
				font-weight: bold;
				font-size: 20px;
			}
			li a{
				background-color: #0f9292;
			}
			li a:hover{
				background-color: #fff;
				color: #333;
			}
			.btn-success{
				border-radius: 0 !important;
				font-weight: bold !important;
				background-color: #0f9292 !important;
				border:0 !important;
			}
			.btn-success:hover{
				border-radius: 0 !important;
				font-weight: bold !important;
				background-color: #fff !important;
				color: #0f9292 !important;
				border:0 !important;
			}
			/*
			#submit, #start_so, #reset{
				background-color: #4caf50;
				border: none;
				color: #fff;
				padding: 6px 52px;
				text-align:center;
				text-decoration: none;
				display: inline-block;
				font-size: 15px;
			}
			
			#submit:hover, #start_so:hover, #reset:hover, #submit:active, #start_so:active, #reset:active{
				background-color:#fff;
				color: #125BA8;
				box-shadow: 0px 0px 15px rgba(128, 128, 128,1);
			}*/
			
			.btn-file input[type=file] {
			  position: absolute;
			  top: 0;
			  right: 0;
			  width: 100%;
			  height: 100%;
			  font-size: 10px;
			  text-align: right;
			  filter: alpha(opacity=0);
			  opacity: 0;
			  background: red;
			  cursor: inherit;
			  display: block;
			}
			input[readonly] {
			  background-color: white !important;
			  cursor: text !important;
			}
		</style>
	</head>
	<body>
		<ul>
			<li>
				<a href="http://136.198.117.48/receiving/index.php">< BACK TO MENU</a>
			</li>
			<li><font>UPLOAD FILE PARTLIST (201...CSV)</font></li>
		</ul>
		<br>
		<form method="post" enctype="multipart/form-data" action="upl_partlist_csv.php">
			<div class="container col-sm-8 col-sm-offset-2" style="background-color: #dccaa6;">
				<br>
				<div class="form-group col-sm-12">
					<label class="control-label col-sm-2">Source file</label>
					<label class="control-label col-sm-10">\\Svrfile\sharing\MTR_CTRL\A_COMMON\PARTLIST\PICKING_PART_BY_ANDROID</label>
				</div>
				<div class="form-group col-sm-12">
					<label class="col-sm-2 control-label"  for="upl_csv">FILE </label>
					<div class="col-sm-10">
					<!--	<input type="file" name="upl_csv" id="upl_csv" accept=".csv"></input> -->
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Browse&hellip; <input type="file" name="upl_partlist_android" id="upl_partlist_android" accept=".csv"></input>
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                       <span class="help-block">
                            File type : *.csv only
                        </span>
					</div>
				</div>
				<!--<div class="form-group col-sm-12">
					<label class="control-label col-sm-2">FILE</label>
					<div class="col-sm-10">
						<input class="form-control " type="file" name="upl_partlist_android" id="upl_partlist_android"></input>
					</div>
				</div>-->
				<div class="form-group col-sm-12">
					<button class="btn btn-success col-sm-6 css_button" type="reset" name="reset" id="reset" value="RESET">RESET</button>
					<button class="btn btn-success col-sm-6 css_button" type="submit" name="submit" id="submit" value="SUBMIT">SUBMIT</button>
				</div>
			</div>
		</form>
	</body>
</html>