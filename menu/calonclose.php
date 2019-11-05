<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]> <!--><html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
</head>
<!-- BODY -->
<body onload="setInterval('displayServerTime()', 1000);">
<div id="wrapper">     
	<div id="page-inner">
		<div id="content">
			<div class="row" style="margin-right:-10px;">
				<div class="col-lg-12" style="padding-left:30px;">
					<h2><b> Menambah, merubah dan menghapus calon telah ditutup!!</b> <br>
					Berikut ini adalah <b>contoh</b> surat suara pada bilik suara.</h2>
				</div>
			</div>
			<br>
			<div align="center" class="row" style="margin-right:-10px; text-align:center">
				<div class="col-lg-12" style="padding-left:150px;">
					<?php 
						$calon=mysql_query("select * from calon_kepala_desa")or die (mysql_error());
						
						while ($hasil=mysql_fetch_array($calon)){
							echo"
								<div align='center' class='col-md-3' style='border:5px ridge; margin:30px; padding-right:0px; padding-left:0px; background: url(asset/Images/latar.png);' >
									<h3><b>Calon No $hasil[0]</b></h3><hr>
									<img src='foto/$hasil[2]' width='250px' height='250px' class='img-thumbnail'/>
									<h2> $hasil[1]</h2>
								</div>
							";
						}
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>