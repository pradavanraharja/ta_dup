<?php 
include('koneksi.php');
$id = $_GET['id'];

$query = mysql_query("delete from calon_kepala_desa where no_urut='$id'") or die(mysql_error());

if ($query) {
	echo "<meta http-equiv=refresh content=0;url=index.php?hl=menu/calon&info=3>"; 
}
?>