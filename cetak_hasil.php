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
	$sql = mysql_query("select * from pemilih order by nama desc");
?> 
<?php 
	$calon = mysql_fetch_array(mysql_query("select * from calon_pemilih order by jumlah_suara desc"));
	$dipilih = $calon[3];
	$persen = round(($dipilih/$total) * 100,2);

	//FORMAT PENANGGALAN INDONESIA
	$tanggal = mysql_query("select * from tanggal")or die (mysql_error());
	$row_Tanggal = mysql_fetch_array($tanggal);
	$tglbln = $row_Tanggal["tanggal"];
	$tglfrmt = date("d F Y", strtotime($tglbln));
?>
<html>  
<head>  
	<title></title>  
    <style>
		body{
			font-family:"Times New Roman";
			height:35,56cm;
			width:21,59cm;
		}
		table{
			border-collapse: collapse;
			width: 19cm;
		}
		th{
			font-size:11pt;
		}
		tr{
			border-collapse: collapse;
		}
		td{
			border-collapse: collapse;
			font-size:10pt;
			height: 25px;
		}
		hr.style2 {
					border-top: 3px double #8c8b8b;
		}
		hr.style8 {
					border-top: 1px solid #8c8b8b;
					border-bottom: 1px solid #fff;
		}
	</style>
</head>  
<body>
	<table>
			<tbody>
				<tr>
					<td style="text-align: center;" width="117"><img src='asset\Images\logo_surat.png' height="110" width="110"></td>
					<td style="text-align: center;" width="484">
					<font size="4">
						PANITIA PEMILIHAN KEPALA DESA <br/>
						<strong>PEMERINTAH KABUPATEN BAMYUMAS</strong><br/>
					</font>
						Alamat: Jl Balai Desa No. 1 Desa Karangrau Kecamatan Sokaraja Telp (0281) 6512954<br/>
						   Fax. xxxxx Sokaraja 53181
					</td>
				</tr>
			</tbody>
	</table>
	<hr class="style2" color="black">
		<p>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bamyumas, <?=$tglfrmt?></p>
		<p>Lampiran&nbsp;&nbsp;: -</p>
		<p>Hal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <strong>Hasil Pemilihan </strong></p>
		<p><strong>&nbsp;</strong></p>
		<p>Assalamu&rsquo;alaikum wr. wb.,</p>
		<p>Berdasarkan hasil <em>e-Voting</em> Kepala Desa Karangrau Kecamatan Sokaraja yang dilaksanakan pada tanggal <?=$tglfrmt?> di Balai Desa Karangrau, menyatakan bahwa:</p>
	
<table class="table table-striped table-bordered table-hover"  style="border: 1px solid black; border-spacing: 0px;" border="1" align="center">
	<thead>
		<tr>
			<th width=10%>No. Urut</th>
			<th>Nama</th>
			<th width='200px'>Perolehan Suara</th>
		</tr>                 
	</thead>
		<tbody align="center">
							<?php

								$i=1;
								$calon=mysql_query("select * from calon_kepala_desa order by no_urut asc")or die (mysql_error());
								$calon_menang = mysql_fetch_array(mysql_query("select * from calon_gubernur order by jumlah_suara desc"));
								while ($hasil=mysql_fetch_array($calon)){
									echo "<tr>
											<td>$hasil[0].</td>
											<td>$hasil[1]</td>
											<td>$hasil[3]</td>";
							?>
							<?php	
								echo "</tr>";
								$i++;
								}
							?>
						</tbody>
</table>
	<p>&nbsp;</p>
	<?php?>

	<p style="text-align: justify;">Dengan perolehan suara tersebut maka saudara <?=$calon_menang[1];?> dinyatakan sebagai pemenang pemilihan yang <strong>sah</strong>. Demikian pengumuman ini kami sampaikan agar dipatuhi oleh pihak-pihak terkait, atas perhatiannya kami ucapkan terimakasih.</p>
	<p>Wassalamu&rsquo;alaikum wr. wb.</p>
<table border="0" align="center">
	<tbody>
			<tr>
				<td width="301" align="center">
					Mengetahui,</br>
					Camat Sokaraja
				</td>
				<td width="301" align="center">
					
				</td>
				<td width="301" align="center">
					Menyetujui,<br>
					Ketua Panitia Pemilihan Kepala Desa
				</td>
			</tr>
			<tr>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td width="301" align="center">
					<?php
							$ketuaDEMAFT = mysql_query("select * from aktor_penanggung_jawab where id_aktor=1");
							if (!$ketuaDEMAFT) {
								echo 'could not run query: '.mysql_error();
								exit;
							}

							$row = mysql_fetch_row($ketuaDEMAFT);

							echo $row[1];
					?>
				</td>
				<td width="301" align="center">
				</td>
				<td width="301" align="center">
					<?php
							$ketuaKPUFT = mysql_query("select * from aktor_penanggung_jawab where id_aktor=2");
							if (!$ketuaDEMAFT) {
								echo 'could not run query: '.mysql_error();
								exit;
							}

							$row = mysql_fetch_row($ketuaKPUFT);

							echo $row[1];
					?>
				</td>
			</tr>
			<!--batas -->
			<tr>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td width="301" align="center">
					Pihak Saksi Pertama,
				</td>
				<td width="301" align="center">
					Pihak Saksi Kedua,
				</td>
				<td width="301" align="center">
					Pihak Saksi Ketiga,
				</td>
			</tr>
			<tr>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
				<td width="301">
					<p>&nbsp;</p>
				</td>
			</tr>
			<tr>
				<td width="301" align="center">
					<?php
							$saksi1 = mysql_query("select * from aktor_penanggung_jawab where id_aktor=3");
							if (!$saksi1) {
								echo 'could not run query: '.mysql_error();
								exit;
							}

							$row = mysql_fetch_row($saksi1);

							echo $row[1];
					?>
				</td>
				<td width="301" align="center">
					<?php
							$saksi2 = mysql_query("select * from aktor_penanggung_jawab where id_aktor=4");
							if (!$saksi2) {
								echo 'could not run query: '.mysql_error();
								exit;
							}

							$row = mysql_fetch_row($saksi2);

							echo $row[1];
					?>
				</td>
				<td width="301" align="center">
					<?php
							$saksi3 = mysql_query("select * from aktor_penanggung_jawab where id_aktor=5");
							if (!$saksi3) {
								echo 'could not run query: '.mysql_error();
								exit;
							}

							$row = mysql_fetch_row($saksi3);

							echo $row[1];
					?>
				</td>
			</tr>
	</tbody>
</table>
</body>  
</html> 
<meta http-equiv=refresh content=0;url=index.php?hl=menu/prosespemilihan>