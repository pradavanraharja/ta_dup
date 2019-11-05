<?php
  error_reporting(0); 
  include('ceklogin.php');
?>
<?php
  include "koneksi.php";
  $log=$_SESSION['username'];
  $hasil=mysql_fetch_array(mysql_query("select * from login where username='$log'"));
  if($hasil['sebagai']!='admin'){
    echo"<meta http-equiv=refresh content=0;url=bilik.php>";
  }
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>Sistem E-Voting</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="evoting" name="description" />
  <meta content="Pradana Ananda R" name="author" />
  
  <!-- STYLE -->
  <link rel="stylesheet" href="asset/plugins/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="asset/css/custom.css" />
    <link rel="stylesheet" href="asset/plugins/Font-Awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="asset/css/font-awesome.css" />
  <!-- END STYLE -->
  
  <!-- ICON -->
  <link rel="icon" href="assets/img/demateknik.png" type="image/png">
  <!-- END ICON -->
  
  <!-- PAGE LEVEL STYLES -->
    <link href="asset/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="asset/css/bootstrap-fileupload.min.css" />
  <link rel="stylesheet" href="asset/plugins/validationengine/css/validationEngine.jquery.css" /> 
  <!-- END PAGE LEVEL  STYLES -->
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
  function DateToIndo($date){

    $BulanIndo = array(
              "Januari", "Februari", "Maret",
                "April", "Mei", "Juni",
                "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
                );
    $tgl   = substr($date, 0, 2);   
    $bulan = substr($date, 3, 2); 
    $tahun = substr($date, 6, 4); 

    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    return($result);
  }
?>
<!-- BODY -->
<body onload="setInterval('displayServerTime()', 1000);">
  <div id="wrapper">
    <div style="padding:1px; background-color:#036"></div>

    <?php
          $tanggal = mysql_query("select * from tanggal")or die (mysql_error());
          $row_Tanggal = mysql_fetch_array($tanggal);
          $tglbln = $row_Tanggal["tanggal"];

          $jam_awal = mysql_query("select *, DATE_FORMAT(awal_jam, '%H:%i:%s') AS jam FROM `awal_jam_pemilihan`")or die(mysql_error());
          $row_jam_awal = mysql_fetch_array($jam_awal);
    ?>
        
  <div id="page-wrapper" >
    <div id="page-inner">
      <div id="content">
<section class="content">
<div class="row">
  <div class="col-lg-6">
    <h1> Data Kandidat</h1><br>
  </div>

  <div class="col-lg-4">
    <?php
      if (!empty($_GET['info'])) {
        echo '<div class="alert alert-success alert-dismissable" >';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>';
        if ($_GET['info'] == 1) {
          echo 'Tambah Calon Kepala Desa Berhasil!';
        } 
        else if ($_GET['info'] == 2) {
          echo 'Data Calon Kepala Desa Diubah';
        } 
        else if ($_GET['info'] == 3) {
          echo 'Data Calon Kepala Desa Dihapus!';
        }
        echo '</h4></div>';
      }
    ?>
  </div>
</div>
    
<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
      <div class="container"><br />
      <?php
          //FORMAT PENANGGALAN INDONESIA
          $tanggal = mysql_query("select * from tanggal")or die (mysql_error());
          $row_Tanggal = mysql_fetch_array($tanggal);
          $tglbln = $row_Tanggal["tanggal"];

          $jam_awal = mysql_query("select *, DATE_FORMAT(awal_jam, '%H:%i:%s') AS jam FROM `awal_jam_pemilihan`")or die(mysql_error());
          $row_jam_awal = mysql_fetch_array($jam_awal);
      ?>
      <?php
        if (($tglbln&&(date('H:i:s')>=$row_jam_awal[2]))){

        }
        else{
        echo'<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Tambah Data Calon</button>';
        }
      ?>
        <a style='color:white' href='?hl=menu/contohbilik'>
          <button class="btn btn-success btn-md" >Gambaran Bilik</button>
        </a>
      </div>
      <div class="panel-body">
        <div class="table-responsive"> 
          <table class="table table-striped table-bordered table-hover" id="dataCalon">
            <thead>
              <tr>
                <th width=8%>No Urut</th>
                <th>Nama</th>
                <th>Foto</th>
                <?php
                  if (($tglbln&&(date('H:i:s')>=$row_jam_awal[2]))){

                  }
                  else{
                    echo'<th width=16%>Aksi</th>';
                  }
                ?>
                
              </tr>                 
            </thead>
            <tbody>
              <?php
                $i=1;
                $calon=mysql_query("select * from calon_kepala_desa")or die (mysql_error());

                while ($hasil=mysql_fetch_array($calon)){
                echo "<tr>
                    <td align=center>$hasil[0]</td>
                    <td>$hasil[1]</td>
                    <td>
                      <img src='foto/$hasil[2]' width='150px' height='150px' />
                    </td>";
              ?>
              
                <td align=center> 
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCalon" data-id="<?=$hasil[0]?>" data-nama="<?=$hasil[1]?>" data-foto="<?=$hasil[2]?>">
                  <i class="icon-pencil icon-white"></i> Edit
                </button>           
                <a style="color:white; text-decoration:none;" href="javascript:;" data-id="<?php echo $hasil[0] ?>" data-toggle="modal" data-target="#modal-konfirmasirt">
                  <button class="btn btn-sm btn-danger">
                    <i class="icon-remove icon-white"></i> Hapus
                  </button>
                </a>
               
              <?php 
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Calon Kepala Desa </h4>
            </div>
            <div class="modal-body">                     
              <div id="div-4" class="accordion-body collapse in body">  
          <div id="collapse2" class="collapse in body">
            <form class="form-horizontal" method="post" name="tambahpemilih" action="" id="popup-validation" enctype="multipart/form-data">
              <div class="form-group">
                <label for="text1" class="control-label col-lg-4">No. Urut</label>
                <div class="col-lg-6">
                  <input id="req" name="nourut" class="validate[required] form-control" type="text" />
                </div>
              </div>
              <div class="form-group">
                <label for="text1" class="control-label col-lg-4">Nama</label>
                <div class="col-lg-6">
                  <input id="req" name="nama" class="validate[required] form-control" type="text" />
                </div>
              </div>
              <div class="form-group">
                <label for="text1" class="control-label col-lg-4">Foto</label>
                <div class="col-lg-6">
                  <img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
                  <input id="uploadImage" type="file" name="foto" onchange="PreviewImage();" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="tambahcalon" value="Tambah Calon" class="btn btn-success " />
              </div>
            </form>
          </div>
        </div>
            </div>
      </div>
  </div>
</div>

<div class="modal fade" id="editCalon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Calon Kepala Desa </h4>
            </div>
            <div class="modal-body"> 
        <div id="div-4" class="accordion-body collapse in body">
          <div id="collapse2" class="collapse in body">
            <form class="form-horizontal" method="post" name="editpemilih" action="" id="popup-validation" enctype="multipart/form-data">
              <div class="form-group">
                <label for="text1" class="control-label col-lg-4">No Urut</label>
                <div class="col-lg-6">
                  <input name="id" id="id" class="form-control" type="hidden" />
                  <input id="nourut" name="enourut" class="validate[required] form-control" type="text"/>
                </div>
              </div>
              <div class="form-group">
                <label for="text1" class="control-label col-lg-4">Nama</label>
                <div class="col-lg-6">
                  <input id="nama" name="enama" class="validate[required] form-control" type="text"/>
                </div>
              </div>
              <div class="form-group">
                <label for="text1" class="control-label col-lg-4">Foto</label>
                <div class="col-lg-6">
                  <input name="fotolama" id="foto" class="form-control" type="hidden" />
                  <img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
                  <input id="uploadImage" type="file" name="foto" onchange="PreviewImage();" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="editCalon" value="Edit Calon" class="btn btn-success " />
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
  </div>
</div>

<!-- modal konfirmasi-->
<div id="modal-konfirmasirt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body btn-info">
        Apakah Anda yakin ingin menghapus data Calon Kepala Desa ini?
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn btn-danger" id="hapus-true">Ya</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>  

<?php
  if ($_POST['tambahcalon'])
  {
    $nourut = $_POST['nourut'];
    $nama = $_POST['nama'];
    $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file   = $_FILES['foto']['type'];
        $nama_file   = $_FILES['foto']['name'];
        $direktori   = "foto/$nama_file";
    move_uploaded_file($lokasi_file,$direktori);
    $query = mysql_query("insert into calon_kepala_desa values('$nourut','$nama','$nama_file',0)") or die(mysql_error());
  
    if ($query) {
      echo "<meta http-equiv=refresh content=0;url=?hl=menu/calon&info=1>";
    }
  }
?>

<?php
  if ($_POST['editCalon'])
  {
    $id = $_POST['id'];
    $nourut = $_POST['enourut'];
    $nama = $_POST['enama']; 
    $fotolama = $_POST['fotolama'];
    $lokasi_file = $_FILES['foto']['tmp_name'];
        $tipe_file   = $_FILES['foto']['type'];
        $nama_file   = $_FILES['foto']['name'];
        $direktori   = "foto/$nama_file";
    move_uploaded_file($lokasi_file,$direktori);
    if(empty($nama_file)){
      $query = mysql_query("update calon_kepala_desa set no_urut='$nourut', nama='$nama' where no_urut='$id' ") or die(mysql_error());
    }
    else{
      $query = mysql_query("update calon_kepala_desa set no_urut='$nourut', nama='$nama', foto='$nama_file' where no_urut='$id' ") or die(mysql_error());
    }
    if ($query) {
      echo "<meta http-equiv=refresh content=0;url=?hl=menu/calon&info=2>";
    }
  }
?>
      </div>
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
    <script src="asset/plugins/validationengine/js/languages/jquery.validationEngine-id.js"></script>
    <script src="asset/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="asset/js/validationInit.js"></script>
    
    
    <script>
    $(function () { formValidation(); });
    function PreviewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
      oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
    };
        $(document).ready(function () {
      $('#dataPemilih').dataTable();
      $('#dataHadir').dataTable({
        "order": [5, "asc"],
      });
      $('#dataAntri').dataTable();
      $('#editPemilih').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var jeniskelamin = button.data('jeniskelamin');
        var nim = button.data('nim');
        $('.modal-body #id').val( id );
        $('.modal-body #nama').val( nama );
        $('.modal-body #jeniskelamin').val( jeniskelamin );
        $('.modal-body #nim').val( nim );
      });
      $('#editCalon').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var foto = button.data('foto');
        $('.modal-body #id').val( id );
        $('.modal-body #nourut').val( id );
        $('.modal-body #nama').val( nama );
        $('.modal-body #foto').val( foto );
      });
      $('#modal-konfirmasip').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget) 
        // Tombol dimana modal di tampilkan 
        // Untuk mengambil nilai dari data-id="" yang telah ditempatkan pada link hapus
        
        var id = div.data('id')
        var modal = $(this)
         
        // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
        modal.find('#hapus-true').attr("href","hapuspemilih.php?id="+id);
         
      });
      $('#modal-konfirmasirt').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget) 
        // Tombol dimana modal di tampilkan 
        // Untuk mengambil nilai dari data-id="" yang telah ditempatkan pada link hapus
        var id = div.data('id')
         
        var modal = $(this)
         
        // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
        modal.find('#hapus-true').attr("href","hapuscalonkades.php?id="+id);
         
      });
    });
    </script>
</html>