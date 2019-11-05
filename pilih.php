<?php
	include ("koneksi.php");
	$nama=$_SESSION['username'];
	$status = mysql_fetch_array(mysql_query("select * from status_bilik where nama='$nama'")); 
	if ($status['status']>0){
		$uplik = mysql_query("update status_bilik set status=0 where nama='$nama'");
	}

	$hadir = mysql_num_rows(mysql_query("select * from pemilih where status_memilih='Sudah'"));
	$mem = mysql_fetch_array(mysql_query("select * from total_suara"));
	$memilih = $mem['jumlah'];
	if (($memilih == $hadir) || ($status['kuota']==0) ){
		echo'
		<meta http-equiv=refresh content=5;url=?hl=pilih>
		<div class="row" style="margin-right:-10px;">
			<div class="col-lg-12" align="center">
				<p style="font-size:60px; color:black; height:60px; padding-top:80px;">
				<b> Tunggu Sebentar !</b> <br><br><br>
				Menunggu pemilih hadir terlebih dahulu.
				</p>
			</div>
		</div>
			';
	}else {
		$uplik = mysql_query("update status_bilik set status=1 where nama='$nama'");
?>
<div class="row" style="margin-right:-10px;">
	<div class="col-lg-12" style="padding-left:30px;">
		<h2><b> Cara Memilih :</b> <br>
		dengan pilih (klik) <b>GAMBAR Kandidat</b> yang tersedia dibawah ini.</h2>
	</div>
</div>
<br>

<div  align="center" class="row" style="margin-right:-10px; text-align:center">
	<div class="col-lg-12" style="padding-left:150px;">
		<?php 
		$calon=mysql_query("select * from calon_kepala_desa")or die (mysql_error());
		while ($hasil=mysql_fetch_array($calon)){
			echo"<a style='text-decoration:none; color:black;' href='bilik.php?hl=konfirmasi&id=$hasil[0]'>
			<div align='center' class='col-md-3' style='border:5px ridge; margin:30px; padding-right:0px; padding-left:0px; background: url(assets/img/latar.png);' >
			<h3> <b>Calon No $hasil[0]</b> </h3><hr>
			<img src='foto/$hasil[2]' width='250px' height='250px' class='img-thumbnail'/>
			<h2> $hasil[1]</h2>
			</div>
			</a>
			";
		}
		?>
	</div>
</div>
<meta http-equiv=refresh content=20;url=?hl=pilih>
<?php } ?>
