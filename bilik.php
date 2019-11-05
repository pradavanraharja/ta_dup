<?php
	error_reporting(0); 
	include('ceklogin.php');
?>
<?php
	include "koneksi.php";
?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
	<title> Sistem E-Voting </title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="EVoting Gubernur BEM FT UMP" name="description" />
	<meta content="Pradana Ananda R" name="author" />
	
	<!-- STYLE -->
	<link rel="stylesheet" href="asset/plugins/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="asset/css/custombilik.css" />
    	<link rel="stylesheet" href="asset/Font-Awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="asset/css/font-awesome.css" />
	<!-- END STYLE -->
	
	<!-- ICON WEBSITE -->
	<link rel="icon" href="asset/Imags/kab_bamyumas.png" type="image/png">
	<!-- END ICON -->

</head>

	<script type="text/javascript">
    	<?php date_default_timezone_set('Asia/Jakarta'); ?>
	    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
        var clientTime = new Date();
    	var Diff = serverTime.getTime() - clientTime.getTime();    

    	function displayServerTime(){
        	var clientTime = new Date();
        	var time = new Date(clientTime.getTime() + Diff);
       		var sh = time.getHours().toString();
        	var sm = time.getMinutes().toString();
        	var ss = time.getSeconds().toString();
        	document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    	}
	</script>
	<?php
		function hari($hari){
			switch ($hari){
			    case 0 : $hari="Minggu";
			        Break;
			    case 1 : $hari="Senin";
			        Break;
			    case 2 : $hari="Selasa";
			        Break;
			    case 3 : $hari="Rabu";
			        Break;
			    case 4 : $hari="Kamis";
			        Break;
			    case 5 : $hari="Jum'at";
			        Break;
			    case 6 : $hari="Sabtu";
			        Break;
			}
			return $hari;
		}
	?>
<?php
function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
	   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
	$BulanIndo = array("Januari", "Februari", "Maret",
	   "April", "Mei", "Juni",
	   "Juli", "Agustus", "September",
	   "Oktober", "November", "Desember");
	$tgl   = substr($date, 0, 2); // memisahkan format tanggal menggunakan substring	
	$bulan = substr($date, 3, 2); // memisahkan format bulan menggunakan substring	
	$tahun = substr($date, 6, 4); // memisahkan format tahun menggunakan substring

	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
	return($result);
}
?>
<!-- BODY -->
<body onload="setInterval('displayServerTime()', 1000);">
<div id="wrapper">
<header class="modal-header" style="background:url(asset/Images/bak.jpg);">
	<div style="height:80px;padding-right:20px;">
		<div style="position:inherit; float:left">
			<img src="asset/Images/kabbanyumas.png" class="user-image img-responsive" width="80" height="80"/>
		</div>
		<div style="float:left; padding-left:25px;">
			<h2 style="color:black;"><b>Sistem E-Voting<br></b></h2>
		</div>
		<div style="position:inherit; float:right">
			<a style="color:white;" class="dateset"><?php print hari(date('w'));?>, <?php print DateToIndo(date('d-m-Y'));?> ~ <span id="clock"><?php print date('H:i:s'); ?></span> </a>
			&nbsp;&nbsp;&nbsp;&nbsp; <label style="color:white;">
			<?php
			if($_SESSION['username']==""){
				echo "None";
			}
			else{
				echo $_SESSION['username'];
			}
			?>
			</label>
			
			<a href="index.php?hl=logout" style="color:#FFFFFF">
				<button type="button" class="btn btn-sm btn-embossed btn-primary">
			<i class="icon-signout icon-white"></i> Keluar</button></a>
			
		</div>
	</div>
</header>
<div style="padding:1px; background-color:#036"></div>        
	<div id="page-inner">
		<div id="content">
	<?php
	if ($_GET['hl']==""){
		$halaman="pilih";
		include "$halaman.php";
	}else{
		$halaman=$_GET['hl'];
		include "$halaman.php";
	}
	?> 
		</div>
	</div>
</body>
<!-- END BODY -->

<!-- SCRIPT -->
    <script src="asset/plugins/jquery-2.0.3.min.js"></script>
    <script src="asset/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END SCRIPT -->
<!-- PAGE LEVEL SCRIPTS -->
    <script src="asset/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="asset/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="asset/plugins/jasny/js/bootstrap-fileupload.js"></script>
    <script src="asset/plugins/jasny/js/bootstrap-inputmask.js"></script>
    <script src="asset/plugins/validationengine/js/jquery.validationEngine.js"></script> 
    <script src="asset/plugin/validationengine/js/languages/jquery.validationEngine-id.js"></script> 
    <script src="asset/plugin/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="asset/js/validationInit.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
</html>
