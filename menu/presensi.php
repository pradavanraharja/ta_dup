<?php
	include ("koneksi.php");
?>

<section class="content">
<div class="row">
	<div class="col-lg-6">
		<h1> Daftar Hadir Pemilih </h1>
		<hr>
	</div>
</div>
<div class="row">
    <div class="col-lg-12">
  	<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive"> 
					<table class="table table-striped table-bordered table-hover" id="dataPemilih">
						<thead>
							<tr>
								<th width=5%>No</th>
								<th>Nama</th>
								<th width='100px'>Jenis Kelamin</th>
								<th>NIK</th>
								<th>Alamat</th>
								<th width=12%>No Antrian</th>
								<th width=10%>Status</th>
							</tr>                 
						</thead>
						<tbody>
							<?php
								$i=1;
								$hadir=mysql_query("select pemilih.id_pemilih, pemilih.nama, t_jk.jenis_kelamin, pemilih.nik,  pemilih.alamat, pemilih.antrian, pemilih.status_memilih from pemilih join t_jk on pemilih.jenis_kelamin=t_jk.id_jk order by nama asc")or die (mysql_error());
								while ($hasil=mysql_fetch_array($hadir)){
								echo "<tr>
										<td align=center>$i</td>
										<td>$hasil[1]</td>
										<td>$hasil[2]</td>
										<td>$hasil[3]</td>
										<td>$hasil[4]</td>
										<td align=center>$hasil[5]</td>";
									if ($hasil[6]=='Belum'){?>
										<td align=center> 						
											<a href='index.php?hl=menu/hadir&id=<?=$hasil[0]?>'>
												<button class="btn btn-sm btn-info">
													<strong>Hadir<strong>
												</button>
											</a>
										</td>
									<?php
									} else if ($hasil[6]=='Antri'){ 
										echo "<td align=center> <a style='color:red'> Antri </a> </td>";
									}else{
										echo "<td align=center> <a style='color:green'> Sudah </a> </td>";
									}
									echo "</tr>";
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>         
			</div>
        </div>
    </div>
</div>	    
