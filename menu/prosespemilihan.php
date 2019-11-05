<?php
	include ("koneksi.php");
?>

<section class="content">
<div class="row">
	<div class="col-lg-12">
		<h1> Proses Pemilihan  </h1>
	</div>
</div>
<hr />
<!--Prosentase Kehadiran-->
<?php
	$total = mysql_num_rows(mysql_query("select * from pemilih")); 
	$hadir = mysql_num_rows(mysql_query("select * from pemilih where status_memilih='Antri' or  status_memilih='Sudah'"));
	$blm = mysql_num_rows(mysql_query("select * from pemilih where status_memilih='Belum' or  status_memilih='Antri'"));
	$mem = mysql_fetch_array(mysql_query("select * from total_suara"));
	$memilih = $mem['jumlah'];
	$phadir = round(($hadir/$total) * 100);
	$psuara = round(($memilih/$total) * 100);
	//$skosong = $phadir - $psuara;
	$skosong = round(($blm/$total) * 100);
?>

<h2>
Jumlah Suara Masuk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b> <?=$memilih?> 
</b><br>
Jumlah Pemilih yang Hadir : <b> <?=$hadir?> 
</b><br>
Jumlah Total Pemilih &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b> <?=$total?> 
</b><br><br>

<b>Persentase Kehadiran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?=$phadir?> %</b>
<br>
</h2>
<div class="progress progress-striped active">
	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$phadir?>%;">
	</div>
</div>
<br>
<h2>
<b>Persentase Suara Masuk &nbsp;&nbsp;: <?=$psuara?> %</b>(Warna Biru)<br>
<b>Persentase Suara Kosong : <?=$skosong?> %</b>(Warna Merah)
<br>
<div class="progress progress-striped active">
	<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$psuara?>%;">
	</div>
	<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$skosong?>%;">
	</div>
</div>
<br>
<?php

	//FORMAT PENANGGALAN INDONESIA
	$tanggal = mysql_query("select * from tanggal")or die (mysql_error());
	$row_Tanggal = mysql_fetch_array($tanggal);
	$tglbln = $row_Tanggal["tanggal"];

	$jam_akhir = mysql_query("select *, DATE_FORMAT(akhir_jam, '%H:%i:%s') AS jam FROM `akhir_jam_pemilihan`")or die(mysql_error());
	$row_jam_akhir = mysql_fetch_array($jam_akhir);
?>

<?php
	if (($psuara==100)||($tglbln&&(date('H:i:s')>=$row_jam_akhir[2]))){
		echo"
		<a style='color:white' href='index.php?hl=/menu/akhir&code=hasilakhirpemilihan'>
			<button class='btn btn-success btn-md' >Hasil Pemilihan Kepala Desa</button>
		</a>
		<a style='color:white' href='cetak_hasil.php?tipe=print'>
					<button class='btn btn-primary btn-md' >Cetak Hasil</button>
		</a>
		<br/>
		<br/>
		";
	}
?>
<meta http-equiv=refresh content=10;url=?hl=menu/prosespemilihan>
