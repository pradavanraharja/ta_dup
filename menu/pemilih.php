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
				<a style='color:white' href='?hl=menu/import'>
								<button class="btn btn-success btn-md" >Upload Data Excel</button>
						</a>
				
				<?php
					$tgl=mysql_query("select * from tanggal where id_tanggal=1")or die (mysql_error());
					$tanggalan=mysql_fetch_array($tgl);

					$awl=mysql_query("select *, DATE_FORMAT(awal_jam, '%H:%i') AS jam FROM `awal_jam_pemilihan`")or die (mysql_error());
					$awlwaktu=mysql_fetch_array($awl);

					$akhr=mysql_query("select *, DATE_FORMAT(akhir_jam, '%H:%i') AS jam FROM `akhir_jam_pemilihan`")or die (mysql_error());
					$akhrwaktu=mysql_fetch_array($akhr);
				?>
				<button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#editDurasiPemilu" 
				data-id="<?=$tanggalan[0]?>" data-nama="<?=$tanggal[1]?>"><i class="icon-pencil icon-white"></i> Edit Durasi Pemilihan</button>

				<?php
					$ketuadema=mysql_query("select * from aktor_penanggung_jawab where id_aktor=1") or die(mysql_error());
					$ketua_DemaFT=mysql_fetch_array($ketuadema);

					$ketuakpu=mysql_query("select * from aktor_penanggung_jawab where id_aktor=2") or die(mysql_error());
					$ketua_KPUFT=mysql_fetch_array($ketuakpu);

					$saksisatu=mysql_query("select * from aktor_penanggung_jawab where id_aktor=3") or die(mysql_error());
					$saksi_1=mysql_fetch_array($saksisatu);

					$saksidua=mysql_query("select * from aktor_penanggung_jawab where id_aktor=4") or die(mysql_error());
					$saksi_2=mysql_fetch_array($saksidua);

					$saksitiga=mysql_query("select * from aktor_penanggung_jawab where id_aktor=5") or die(mysql_error());
					$saksi_3=mysql_fetch_array($saksitiga);
				?>

				<button type="button" class="btn btn-md btn-danger" data-toggle="modal" data-target="#editPenJwbSaksi" 
				data-id="<?=$ketua_DemaFT[0]?>" data-nama="<?=$ketua_demaft[1]?>"> Penanggung Jawab dan Saksi</button>
			</div>
			<div class="panel-body">
				<div class="table-responsive"> 
					<table class="table table-striped table-bordered table-hover" id="dataPemilih">
						<thead>
							<tr>
								<th width=4%>No</th>
								<th>Nama</th>
								<th width='100px'>Jenis Kelamin</th>
								<th width='150'>NIK</th>
								<th>Alamat</th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
							</tr>                 
						</thead>
						<tbody>
							<?php
								$i=1;
								$pemilih=mysql_query("select pemilih.id_pemilih, pemilih.nama, t_jk.jenis_kelamin, pemilih.nik,  pemilih.alamat, pemilih.tgl_lahir, pemilih.tmpt_lahir from pemilih join t_jk on pemilih.jenis_kelamin=t_jk.id_jk order by nama asc")or die (mysql_error());
								while ($hasil=mysql_fetch_array($pemilih)){
									echo "<tr>
											<td align=center>$i</td>
											<td>$hasil[1]</td>
											<td>$hasil[2]</td>
											<td>$hasil[3]</td>
											<td>$hasil[4]</td>
											<td>$hasil[6]</td>
											<td>$hasil[5]</td>";
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
<!--DURASI PEMILIHAN-->
<div class="modal fade" id="editDurasiPemilu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Durasi Pemilihan</h4>
            </div>
            		<div class="modal-body"> 
				<div id="div-4" class="accordion-body collapse in body">
					<div id="collapse2" class="collapse in body">
						<form class="form-horizontal" method="post" name="editdurasipemilu" action="" id="popup-validation">
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Tanggal (yy-mm-dd)</label>
								<div class="col-lg-6">
									<input name="eid_tanggal" id="eid_tanggal" class="form-control" type="hidden" />
									<input id="etanggal" name="etanggal" value=<?php echo $tanggalan[1] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">	
								<label for="text1" class="control-label col-lg-4">Mulai</label>
								<div class="col-lg-6">
									<input name="eid_awal_jam" id="eid_awal_jam" class="form-control" type="hidden" />
									<input id="eawal_jam" name="eawal_jam" value=<?php echo $awlwaktu[2] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Selesai</label>
								<div class="col-lg-6">
									<input name="eid_akhir_jam" id="eid_akhir_jam" class="form-control" type="hidden" />
									<input id="eakhir_jam" name="eakhir_jam" value=<?php echo $akhrwaktu[2] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" name="editdurasipemilu" value="Edit Durasi Pemilihan" class="btn btn-success " />
							</div>
						</form>
					</div>
				</div>
			</div>
    	</div>
	</div>
</div>

<!--Penanggung Jawab dan Saksi Pemilihan-->
<div class="modal fade" id="editPenJwbSaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Penanggung Jawab dan Saksi Pemilihan</h4>
            </div>
            <div class="modal-body"> 
				<div id="div-4" class="accordion-body collapse in body">
					<div id="collapse2" class="collapse in body">
						<form class="form-horizontal" method="post" name="editpenanggungjawab" action="" id="popup-validation">
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Camat</label>
								<div class="col-lg-6">
									<input name="eid_ketua_demaft" id="eid_ketua_demaft" class="form-control" type="hidden" />
									<input id="eketua_demaft" name="eketua_demaft" value=<?php echo $ketua_DemaFT[1] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">	
								<label for="text1" class="control-label col-lg-4">Ketua Panitia</label>
								<div class="col-lg-6">
									<input name="eid_ketua_kpuft" id="eid_ketua_kpuft" class="form-control" type="hidden" />
									<input id="eketua_kpuft" name="eketua_kpuft" value=<?php echo $ketua_KPUFT[1] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Saksi 1</label>
								<div class="col-lg-6">
									<input name="eid_saksi_pertama" id="eid_saksi_pertama" class="form-control" type="hidden" />
									<input id="esaksi_pertama" name="esaksi_pertama" value=<?php echo $saksi_1[1] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="form-group">
								<label for="text1" class="control-label col-lg-4">Saksi 2</label>
								<div class="col-lg-6">
									<input name="eid_saksi_kedua" id="eid_saksi_kedua" class="form-control" type="hidden" />
									<input id="esaksi_kedua" name="esaksi_kedua" value=<?php echo $saksi_2[1] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div><div class="form-group">
								<label for="text1" class="control-label col-lg-4">Saksi 3</label>
								<div class="col-lg-6">
									<input name="eid_saksi_ketiga" id="eid_saksi_ketiga" class="form-control" type="hidden" />
									<input id="esaksi_ketiga" name="esaksi_ketiga" value=<?php echo $saksi_3[1] ?> class="validate[required] form-control" type="text"/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" name="editpenanggungjawab" value="Simpan" class="btn btn-success " />
							</div>
						</form>
					</div>
				</div>
			</div>
    	</div>
	</div>
</div>

<?php
	if ($_POST['editdurasipemilu']){

		$id_tanggal=$_POST['eid_tanggal'];
		$tanggal=$_POST['etanggal'];
	
		$id_awal_jam = $_POST['eid_awal_jam'];
		$awal_jam = $_POST['eawal_jam'];

		$id_akhir_jam = $_POST['eid_akhir_jam'];
		$akhir_jam = $_POST['eakhir_jam'];
		
		$query = mysql_query("update `tanggal` SET `tanggal`='$tanggal' WHERE `id_tanggal`='1'; ") or die(mysql_error());

		$query_awl = mysql_query("update `awal_jam_pemilihan` SET `awal_jam`='$awal_jam' WHERE `id_awal_jam`='1'; ") or die(mysql_error());

		$query_akhr = mysql_query("update `akhir_jam_pemilihan` SET `akhir_jam`='$akhir_jam' WHERE `id_akhir_jam`='1'; ") or die(mysql_error());

		if ($query || $query_awl || $query_akhr) {
			echo "<meta http-equiv=refresh content=0;url=?hl=menu/pemilih&info=4>";
		}
	}
?> 

<?php
	if ($_POST['editpenanggungjawab']){

		$id_ketua_demaft=$_POST['eid_ketua_demaft'];
		$ketua_demaft=$_POST['eketua_demaft'];
		
		$id_ketua_kpuft=$_POST['eid_ketua_kpuft'];
		$ketua_kpuft=$_POST['eketua_kpuft'];

		$id_saksi_pertama=$_POST['eid_saksi_pertama'];
		$saksi_pertama=$_POST['esaksi_pertama'];

		$id_saksi_kedua=$_POST['eid_saksi_kedua'];
		$saksi_kedua=$_POST['esaksi_kedua'];

		$id_saksi_ketiga=$_POST['eid_saksi_ketiga'];
		$saksi_ketiga=$_POST['esaksi_ketiga'];
		
		$query_dema = mysql_query("update `aktor_penanggung_jawab` SET `nama_aktor`='$ketua_demaft' WHERE `id_aktor`='1'; ") or die(mysql_error());

		$query_kpu = mysql_query("update `aktor_penanggung_jawab` SET `nama_aktor`='$ketua_kpuft' WHERE `id_aktor`='2'; ") or die(mysql_error());

		$query_saksipertama = mysql_query("update `aktor_penanggung_jawab` SET `nama_aktor`='$saksi_pertama' WHERE `id_aktor`='3'; ") or die(mysql_error());

		$query_saksikedua = mysql_query("update `aktor_penanggung_jawab` SET `nama_aktor`='$saksi_kedua' WHERE `id_aktor`='4'; ") or die(mysql_error());

		$query_saksiketiga = mysql_query("update `aktor_penanggung_jawab` SET `nama_aktor`='$saksi_ketiga' WHERE `id_aktor`='5'; ") or die(mysql_error());

		if ($query_dema || $query_kpu || $query_saksipertama || $query_saksikedua || $query_saksiketiga ) {
			echo "<meta http-equiv=refresh content=0;url=?hl=menu/pemilih&info=5>";
		}
	}
?> 
