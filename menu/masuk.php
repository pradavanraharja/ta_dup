<?php 
	include("koneksi.php");
	
	$id = $_GET['id'];
	$cek1= mysql_num_rows(mysql_query("select * from status_bilik"));
	$cek2= mysql_num_rows(mysql_query("select * from status_bilik where status=0"));
	
	if ($cek1 == 0)
	{
		echo "<meta http-equiv=refresh content=0;url=?hl=menu/antri&error=1>";
	}
	else if ($cek2 == 0){
		echo "<meta http-equiv=refresh content=0;url=?hl=menu/antri&error=2>";
	}
	else{
		$query = mysql_query("update pemilih set status_memilih='Sudah' where id_pemilih='$id' ") or die(mysql_error());
		$order= mysql_fetch_array(mysql_query("select * from status_bilik where status=0 order by nama asc,kuota asc limit 1"));
		$setor = mysql_query("update status_bilik set kuota=kuota+1 where nama='$order[nama]'") or die(mysql_error());
		$bil=$order['nama'];
		$angka = substr($bil,6,1);
		if ($query) {
			echo "<meta http-equiv=refresh content=0;url=?hl=menu/antri&bilik=".$angka.">";
		}
	}
?>
