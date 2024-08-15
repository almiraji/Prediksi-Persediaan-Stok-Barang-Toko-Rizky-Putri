<?php
session_start();
include '../koneksi.php';
if ($_SESSION['login'] == "") {
  echo "<script>alert('Anda Harus Login Terlebih Dahulu');window.location='../index.php'</script>";
} else {
  $id         = $_SESSION['id'];
  $queryuser  = mysqli_query($koneksi, "SELECT * FROM data_user WHERE id_user = '$_SESSION[id]'");
  $datauser   = mysqli_fetch_array($queryuser);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Prediksi Persediaan Stok Barang Toko Rizky Putri</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../logo.png" type="image/png" />
  <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="../assets/admin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/admin/style.css" />
  <link rel="stylesheet" href="../assets/admin/css/responsive.css" />
  <link rel="stylesheet" href="../assets/admin/css/colors.css" />
  <link rel="stylesheet" href="../assets/admin/css/bootstrap-select.css" />
  <link rel="stylesheet" href="../assets/admin/css/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/admin/css/custom.css" />
  <style type="text/css">
    #kiri {
      float: left;
      width: 250px;
      padding: 10px;
      text-align: center;
    }

    #kanan {
      float: right;
      width: 250px;
      padding: 10px;
      text-align: center;
    }
  </style>
  <style type="text/css">
    body {
      font-family: arial;
      background-color: #ccc
    }

    .rangkasurat {
      width: 1000px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
    }

    table {
      border-bottom: 5px solid #000;
      padding: 2px;
    }

    .tengah {
      width: 900px;
      text-align: center;
      line-height: 5px;
    }
  </style>
</head>

<body>
  <div class="modal-view">
    <div class="rangkasurat">
      <table width="100%">
        <tr>
          <td><img src="../logo.png" width="100px"></td>
          <td class="tengah">
            <h3>LAPORAN DATA STOK BARANG</h3>
            <h3>PADA TOKO RIZKY PUTRI</h3>
          </td>
          <td><img src="../space.png" width="100px"></td>
        </tr>
      </table>
      <br>
      <?php
      if (isset($_GET['id_kategori'])) {
        $querykategori = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE id_kategori = '$_GET[id_kategori]'");
        $datakategori  = mysqli_fetch_array($querykategori);
        echo "<h4 align='center'>LAPORAN DATA STOK BARANG UNTUK KATEGORI " . strtoupper($datakategori['kategori']) . "</h3>";
      }
      ?>
      <br>
      <table class="table table-bordered" id="tabel-data">
        <thead>
          <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama Barang</th>
            <th>Ukuran</th>
            <th>Jumlah Stok</th>
            <th>Tanggal Terupdate</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no  = 1;
          if (isset($_GET['id_kategori'])) {
            $query = mysqli_query($koneksi, "SELECT * FROM data_barang a, data_kategori b WHERE a.id_kategori = b.id_kategori AND a.id_kategori = '$_GET[id_kategori]' ORDER BY a.id_barang DESC");
          } else {
            $query = mysqli_query($koneksi, "SELECT * FROM data_barang a, data_kategori b WHERE a.id_kategori = b.id_kategori ORDER BY a.id_barang DESC");
          }

          while ($data = mysqli_fetch_array($query)) {
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['kategori'] ?></td>
              <td><?= $data['nama_barang'] ?></td>
              <td><?= $data['ukuran'] ?></td>
              <td><?= $data['stok_barang'] ?></td>
              <td><?= $data['tanggal_update'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div id="kanan">
        <br />
        <br />
        <br />
        <b>MUARA TEWEH, <?= date("m-d-Y") ?>
          <br>
          <b>ADMINISTRATOR</b>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <u><?= $datauser['nama_user'] ?></u>
      </div>
    </div>


  </div>

</body>

<script type="text/javascript">
  window.print();
</script>

</html>