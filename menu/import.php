<!DOCTYPE html>

<!-- BEGIN HEAD -->
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="evoting" name="description" />
	<meta content="informatika|UMP" name="author" />
	
	<!-- STYLE -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/css/custom.css" />
        	<link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/css/font-awesome.css" />
	<!-- END STYLE -->
	
	<!-- ICON WEBSITE -->
	<link rel="icon" href="assets/img/demateknik.png" type="image/png">
	<!-- END ICON -->
	
	<!-- PAGE LEVEL STYLES -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
	<link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" /> 
	<!-- END PAGE LEVEL  STYLES -->
</head>
<!-- END HEAD -->

<!-- BODY -->
<body onload="setInterval('displayServerTime()', 1000);">
	<section class="content">
	<div id="wrapper">
	<header class="modal-header" style="background:url(assets/img/bak.jpg);">
		<div style="height:80px;padding-right:20px;">
			<div style="position:inherit; float:left">
				<img src="" class="user-image img-responsive"/>
			</div>
			<div style="float:left; padding-left:25px;">
				<h2 style="color:black;"><b>Import Data Pemilih</b></h2>
			</div>
    	</div>
	</header>
	<a style='text-decoration:none;' href='index.php?hl=menu/pemilih'>
		<button type="button" class="btn btn-info">Kembali</button>
	</a>
	<table>
		<tr>
			<div align="" class="row">
				<div class="col-lg-6">
					<h1><b>&nbsp;</b> </h1><hr>
				</div>
			</div>
		</tr>
		<tr>
			<!-- Validasi upload -->
			<script language="Javascript">
				function IsEmpty(){
  					if(document.forms['frm'].userfile.value == ""){
    					alert("File yang akan dimasukkan kosong! Harap memasukkan file berformat .xls");
    					return false;
  					}
    				return true;
				}
			</script>
			<form name="frm" method="post"enctype="multipart/form-data" action='index.php?hl=menu/import_proses'>
			  <b>
				<p align="center" class="help-block">Silahkan pilih file Excel berformat .xls:</p>
			  </b>
			  <div class="form-group">
				<center>
					<input name="userfile" type="file">
					<input name="upload" type="submit" onclick="return IsEmpty();" value="Submit" class="btn btn-default">
				</center>
			  </div>
			</form>
		</tr>
	</table>
<!-- END BODY -->
</section>
</body>
</html>
