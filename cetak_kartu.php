<?php
	error_reporting(0);
	include("koneksi.php");
	if ($_GET['tipe']=="print"){
		echo'<script>  
			window.load = cetak();  
			function cetak(){  
				window.print();  
			}  
			</script>';
	}
	$sql = mysql_query("select pemilih.id_pemilih, pemilih.nama, t_jk.jenis_kelamin, pemilih.nik,  pemilih.alamat, pemilih.tgl_lahir, pemilih.tmpt_lahir from pemilih join t_jk on pemilih.jenis_kelamin=t_jk.id_jk");
?> 
<html>  
<head>  
	<!--Set Format Kartu-->
	<title>Cetak Kartu Pemilih</title>  
    <style>
		body{
			font-family:"Times New Roman";
			height:35,56cm;
			width:21,59cm;
		}
		p.u{
			margin-top:1.3cm;
			margin-left:2.3cm;
			margin-bottom:0cm;
			position:absolute;
		}
		table{
			border-collapse: collapse;
			width: 7.2cm;
			margin-top:2.0cm;
			margin-left:0.6cm;
			margin-bottom:0.4cm;
			position:absolute;
		}
		td{
			font-size:10pt;
			vertical-align: top;
		}
		p.nb{
			font-size:10pt;
			margin-top:4.9cm;
			margin-left:0.3cm;
			position:absolute;
		}
		div.b{
			background: url(asset/Images/kartu_pemilihdes.png);
			height: 6cm;
			width: 8.43cm;
			float:left;
			border-collapse: collapse;
			position:relative;
			margin-right:0.25cm;
			margin-bottom:0.30cm; 
		}
		div.a{
			background: url(asset/Images/kartu_pemilihdes.png);
			height: 6cm;
			width: 8.43cm;
			float:left;
			border-collapse: collapse;
			position:relative;
			margin-right:0.25cm;
			margin-bottom:0.23cm; 
			<!-- kalo mau legal 
			margin-bottom:0.23cm 
			A4
			margin-bottom:1.05cm-->
		}
	</style>
</head>  
<body>
<?php
	$tanggal = mysql_query("select * from tanggal")or die (mysql_error());
	$row_Tanggal = mysql_fetch_array($tanggal);
	$Tanggal = $row_Tanggal["tanggal"];

	function DateToIndo($date){ 
		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");
	
		$tahun = substr($date, 0, 4); 
		$bulan = substr($date, 5, 2); 
		$tgl   = substr($date, 8, 2); 
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
	}

	//FORMAT AWAL JAM PEMILIHAN
	$jam_awal = mysql_query("select *, DATE_FORMAT(awal_jam, '%H:%i') AS jam FROM `awal_jam_pemilihan`")or die(mysql_error());
	$row_jam_awal = mysql_fetch_array($jam_awal);

	//FORMAT AKHIR JAM PEMILIHAN
	$jam_akhir = mysql_query("select *, DATE_FORMAT(akhir_jam, '%H:%i') AS jam FROM `akhir_jam_pemilihan`")or die(mysql_error());
	$row_jam_akhir = mysql_fetch_array($jam_akhir);

	$i=1;
	while($hasil = mysql_fetch_array($sql)) {  
		if ($i==9){
			echo "
			<div class=a>
				<p class=u>NIK:</td><td width=300px>$hasil[3]</p>
					<table align=left>
						<thead>							
							<tr>
								<td width=170px>Nama</td><td width=10px><b>:</b></td><td width=300px>$hasil[1]</td>
							</tr>
							<tr>
								<td width=170px>Tempat/Tgl. Lahir</td><td width=10px><b>:</b></td><td width=300px>$hasil[6], $hasil[5]</td>
							</tr>
							<tr>
								<td width=170px>Jenis Kelamin</td><td width=10px>:</td><td width=300px>$hasil[2]</td>
							</tr>
							<tr>
								<td width=170px>Alamat</td><td width=10px>:</td><td width=300px>$hasil[4]</td>
							</tr>
						</thead>
					</table>
				<p class=nb>Hadir untuk memberikan suara pada,</b> <br>Tanggal <b>
			"; 
			echo(DateToIndo($Tanggal));
			echo "</b> Jam <b>$row_jam_awal[2]-$row_jam_akhir[2]</b> WIB.</p>
			</div>
			";
		}
		else if ($i==10){
			echo "
			<div class=a>
				<p class=u>NIK:</td><td width=300px>$hasil[3]</p>
					<table align=left>
						<thead>							
							<tr>
								<td width=170px>Nama</td><td width=10px><b>:</b></td><td width=300px>$hasil[1]</td>
							</tr>
							<tr>
								<td width=170px>Tempat/Tgl. Lahir</td><td width=10px><b>:</b></td><td width=300px>$hasil[6], $hasil[5]</td>
							</tr>
							<tr>
								<td width=170px>Jenis Kelamin</td><td width=10px>:</td><td width=300px>$hasil[2]</td>
							</tr>
							<tr>
								<td width=170px>Alamat</td><td width=10px>:</td><td width=300px>$hasil[4]</td>
							</tr>
						</thead>
					</table>
					<p class=nb>Hadir untuk memberikan suara pada,</b> <br>Tanggal <b>
			"; 
				echo(DateToIndo($Tanggal));
				echo "</b> Jam <b>$row_jam_awal[2]-$row_jam_akhir[2]</b> WIB.</p>
				</div>
			";
		$i=0;	
		} 
		else {	
			echo "
			<div class=a>
				<p class=u>NIK:</td><td width=300px>$hasil[3]</p>
					<table align=left>
						<thead>							
							<tr>
								<td width=170px>Nama</td><td width=10px><b>:</b></td><td width=300px>$hasil[1]</td>
							</tr>
							<tr>
								<td width=170px>Tempat/Tgl. Lahir</td><td width=10px><b>:</b></td><td width=300px>$hasil[6], $hasil[5]</td>
							</tr>
							<tr>
								<td width=170px>Jenis Kelamin</td><td width=10px>:</td><td width=300px>$hasil[2]</td>
							</tr>
							<tr>
								<td width=170px>Alamat</td><td width=10px>:</td><td width=300px>$hasil[4]</td>
							</tr>
						</thead>
					</table>
					<p class=nb>Hadir untuk memberikan suara pada,</b> <br>Tanggal <b>
			"; 
				echo(DateToIndo($Tanggal));
				echo "</b> Jam <b>$row_jam_awal[2]-$row_jam_akhir[2]</b> WIB.</p>
				</div>
			";
		}
		$i=$i+1;
	}
?>
</body>  
</html> 
<meta http-equiv=refresh content=0;url=index.php?hl=menu/pemilih>
