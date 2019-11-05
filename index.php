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
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin | Sistem E-Voting </title>
  
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="asset/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="asset/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="asset/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="asset/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="asset/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="asset/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!--NEW-->
  <link rel="stylesheet" href="asset/plugins/validationengine/css/validationEngine.jquery.css" /> 
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- PAGE LEVEL STYLES -->
    <link href="asset/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="asset/css/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="asset/plugins/validationengine/css/validationEngine.jquery.css" /> 
  <!-- END PAGE LEVEL  STYLES -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- ICON WEBSITE -->
  <link rel="icon" href="asset/Images/kabbanyumas.png" type="image/png">
  <!-- END ICON -->
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

<body class="hold-transition skin-blue sidebar-mini" onload="setInterval('displayServerTime()', 1000);">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?hl=menu/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ADP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>&nbsp;Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           <li class="dropdown user user-menu">
              <a style="color:white;" class="dateset">
              <?php print hari(date('w'));?>, 
              <?php print DateToIndo(date('d-m-Y'));?> ~ 
              <span id="clock">
              <?php print date('H:i:s'); ?>
              </span> 
            </a>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="asset/dist/img/admin.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrator</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="asset/dist/img/admin.jpg" class="img-circle" alt="User Image">

                <p>
                  Admininstrator
                  <small></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="index.php?hl=logout" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-wrench"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><center>MENU UTAMA</center></li>
        <li>
          <a href="index.php?hl=menu/home">
            <i class="fa fa-home"></i> <span>Halaman Utama</span>
          </a>
        </li>
        <?php
          $tanggal = mysql_query("select * from tanggal")or die (mysql_error());
          $row_Tanggal = mysql_fetch_array($tanggal);
          $tglbln = $row_Tanggal["tanggal"];

          $jam_awal = mysql_query("select *, DATE_FORMAT(awal_jam, '%H:%i:%s') AS jam FROM `awal_jam_pemilihan`")or die(mysql_error());
          $row_jam_awal = mysql_fetch_array($jam_awal);
          ?>
        <?php
          if (($tglbln&&(date('H:i:s')>=$row_jam_awal[2])))
          {
            echo'
                    <li>
                      <a href="index.php?hl=menu/pemilihclose">
                          <font color="red"><i class="fa fa-database"></i> <span>Data Pemilih</span></font>
                    </a>
                </li>
            ';
          }
          else{
            echo'
            <li>
                      <a href="index.php?hl=menu/pemilih">
                          <i class="fa fa-database"></i> <span>Data Pemilih</span>
                    </a>
                </li>
            ';
          }
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>Daftar Hadir</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?hl=menu/presensi"><i class="fa fa-circle-o text-aqua"></i> Absensi Pemilih</a></li>
          </ul>
        </li>
    <li>
          <a href="index.php?hl=menu/antri">
            <i class="fa fa-list-ol"></i> <span>Daftar Antrian</span>
          </a>
        </li>
      <?php
          if (($tglbln&&(date('H:i:s')>=$row_jam_awal[2])))
          {
            echo'
                            <li>
                   <a href="index.php?hl=menu/calonclose">
                        <font color="red"><span><i class="fa fa-user"></i> Kandidat</span></font>
                  </a>
              </li>
            ';
          }
          else{
            echo'
              <li>
                   <a href="index.php?hl=menu/calon">
                        <i class="fa fa-user"></i> <span>Kandidat</span>
                  </a>
              </li>
            ';
          }
        ?>
    <li>
          <a href="index.php?hl=menu/prosespemilihan">
            <i class="fa fa-bar-chart"></i> <span>Proses Pemilihan</span>
          </a>
        </li>
    <li>
          <a href="index.php?hl=menu/bilikstatus">
            <i class="fa fa-edit"></i> <span>Status Bilik</span>
          </a>
        </li>
    <!--li>
          <a href="index.html">
            <i class="fa fa-gears"></i> <span>Konfigurasi</span>
          </a>
        </li-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
          <div id="page-wrapper" >
              <div id="page-inner">
                  <div id="content">
                  <?php
                    if ($_GET['hl']==""){
                        $halaman="menu/home";
                        include "$halaman.php";
                    }else{
                        $halaman=$_GET['hl'];
                        include "$halaman.php";
                    }
                  ?> 
                  </div>
              </div>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="http://informatika.ump.ac.id">Teknik Informatika UMP</a> | </strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        
        <!-- /.control-sidebar-menu -->
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="asset/plugins/jquery-2.0.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="asset/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="asset/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="asset/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="asset/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="asset/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="asset/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="asset/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="asset/dist/js/demo.js"></script>

</body>
<!-- PAGE LEVEL SCRIPTS -->
    <script src="asset/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="asset/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="asset/plugins/jasny/js/bootstrap-fileupload.js"></script>
  <script src="asset/plugins/jasny/js/bootstrap-inputmask.js"></script>
  <script src="asset/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="asset/plugins/validationengine/js/languages/jquery.validationEngine-id.js"></script>
    <script src="asset/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="asset/js/validationInit.js"></script>


    <script type="text/javascript" src="asset/js/bootbox.min.js"></script>
    <script type="text/javascript" src="asset/js/deleteRecords.js"></script>



    <script type="text/javascript">
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
        modal.find('#hapus-true').attr("href","menu/hapuscalonkades.php?id="+id);
         
      });
    });
    </script>
    <script>
  $('#dataPemilih').dataTable({
        "order": [[ 0, "asc" ]]
    });
  </script>
</html>
