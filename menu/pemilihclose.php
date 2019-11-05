<?php
	include ("koneksi.php");
?>

<section class="content">
<div class="row">
	<div class="col-lg-6">
		<h1> Data Pemilih </h1>
		<hr>
	</div>
	<div class="col-lg-4">
		<?php
			if (!empty($_GET['info'])) {
				echo '<div class="alert alert-success alert-dismissable" >';
       		    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>';
				if ($_GET['info'] == 1) {
					echo 'Tambah Pemilih Berhasil!';
				} else if ($_GET['info'] == 2) {
					echo 'Data Pemilih Diubah';
				} else if ($_GET['info'] == 3) {
					echo 'Data Pemilih Dihapus!';
				}
				else if ($_GET['info'] == 4) {
					echo 'Durasi Pemilihan Dirubah!';
				}
				else if ($_GET['info'] == 5) {
					echo 'Data Penanggung Jawab dan Saksi Tersimpan!';
				}
				echo '</h4></div>';
			}
		?>

		<?php
			//FORMAT PENANGGALAN INDONESIA
		          $tanggal = mysql_query("select * from tanggal")or die (mysql_error());
			  $row_Tanggal = mysql_fetch_array($tanggal);
			  $tglbln = $row_Tanggal["tanggal"];
                          $jam_awal = mysql_query("select *, DATE_FORMAT(awal_jam, '%H:%i:%s') AS jam FROM `awal_jam_pemilihan`")or die(mysql_error());
			  $row_jam_awal = mysql_fetch_array($jam_awal);

		?>

	</div>
</div>
<div class="row">
	<div class="col-lg-12">
     	<div class="panel panel-default">
			<div class="container">
				<br/>
			</div>
			<div class="panel-body">
				<div class="table-responsive"> 
					<table class="table table-striped table-bordered table-hover" id="dataPemilih">
						<thead>
							<tr>
								<th width=4%>No</th>
								<th>Nama</th>
								<th width='100px'>Jenis Kelamin</th>
								<th width='150'>NIM</th>
								<th>Prodi</th>
							</tr>                 
						</thead>
						<tbody>
							<?php
								$i=1;
								$pemilih=mysql_query("select * from pemilih order by nama asc")or die (mysql_error());
								while ($hasil=mysql_fetch_array($pemilih)){
									echo "<tr>
											<td align=center>$i</td>
											<td>$hasil[1]</td>
											<td>$hasil[2]</td>
											<td>$hasil[3]</td>
											<td>$hasil[6]</td>";
							?>
							<?php	
								echo "</tr>";
								$i++;
								}
							?>
						</tbody>
					</table>
				</div>         
			</div>
			<div class="panel-footer" align=right>
				<!--cetak daftar hadir pemilih-->
				<a style='color:white' href='cetak_daftar_hadir.php?tipe=print'>
					<button class="btn btn-success btn-md" >Cetak Daftar Hadir</button>
				</a>
				<!--cetak kartu pemilih-->
				<a style='color:white' href='cetak_kartu.php?tipe=print'>
					<button class="btn btn-primary btn-md" >Cetak Kartu Pemilih</button>
				</a>
			</div>
        </div>
    </div>
</div>