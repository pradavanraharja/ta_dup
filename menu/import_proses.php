<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]> <!--><html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="evoting" name="description" />
  <meta content="informatika|UMP" name="author" />
  
  <!-- STYLE -->
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.css" />
  <!-- END STYLE -->
  
  <!-- ICON WEBSITE -->
  <link rel="icon" href="assets/img/demateknik.png" type="image/png">
  <!-- END ICON -->
  
  <!-- PAGE LEVEL STYLES -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
  <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" /> 
  <!-- END PAGE LEVEL  STYLES -->
</head>
<!-- END HEAD -->

<!-- BODY -->
<body onload="setInterval('displayServerTime()', 1000);">
<section class="content">
  <div id="wrapper">
  <header class="modal-header" style="background:url(assets/img/bak.jpg);">
    <div style="height:80px;padding-right:20px;">
      <div style="position:inherit; float:left">
        <img src="" class="user-image img-responsive"/>
      </div>
      <div style="float:left; padding-left:25px;">
        <h2 style="color:black;"><b>Import Data Pemilih</b></h2>
      </div>
      </div>
  </header>
  <a style='text-decoration:none;' href='index.php?hl=menu/pemilih'>
    <button type="button" class="btn btn-info">Kembali</button>
  </a>
  <!--div style="padding:1px; background-color:#036"></div-->        
  <table>
    <tr>
      <div align="" class="row">
        <div class="col-lg-6">
          <h1><b>&nbsp;</b> </h1><hr>
        </div>
      </div>
    </tr>
    <tr>
      <?php
        // menggunakan class phpExcelReader
        include "asset/plugins/excel_reader2.php";

        // koneksi ke mysql
        include "koneksi.php";

        // membaca file excel yang diupload
        $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

        // membaca jumlah baris dari data excel
        $baris = $data->rowcount($sheet_index=0);

        // nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
        $sukses = 0;
        $gagal = 0;

        // import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
        for ($i=2; $i<=$baris; $i++){
            // membaca data nim (kolom ke-1)
            $id = $data->val($i, 1);
            // membaca data nama (kolom ke-2)
            $nama = $data->val($i, 2);
            // membaca data alamat (kolom ke-3)
            $jk = $data->val($i, 3);
            // membaca data alamat (kolom ke-4)
            $nim = $data->val($i, 4);
            // membaca data alamat (kolom ke-5)
            $antrian = $data->val($i, 5);
            // membaca data alamat (kolom ke-6)
            $status = $data->val($i, 6);
            // membaca data alamat (kolom ke-7)
            $prodi = $data->val($i, 7);
            // membaca data alamat (kolom ke-8)
            $tgl = $data->val($i, 8);
            // membaca data alamat (kolom ke-9)
            $tmpt = $data->val($i, 9);

            // setelah data dibaca, sisipkan ke dalam tabel mhs
            $query = "INSERT INTO pemilih VALUES ('$id', '$nama', '$jk', '$nim', '$antrian', '$status', '$prodi', '$tgl', '$tmpt')";
            $hasil = mysql_query($query);

            // jika proses insert data sukses, maka counter $sukses bertambah
            // jika gagal, maka counter $gagal yang bertambah
            if ($hasil) $sukses++;
            else $gagal++;
        }
        // tampilan status sukses dan gagal
        echo "<center>";
        echo "<h3>Proses import data berhasil.</h3>";
        echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
        echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
        echo "</center>";
      ?>
    </tr>
  </table>
  </section>
</body>
</html>