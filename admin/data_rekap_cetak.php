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
            <h3>LAPORAN DATA REKAP PENJUALAN BARANG</h3>
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
        echo "<h4 align='center'>LAPORAN DATA REKAP PENJUALAN BARANG UNTUK KATEGORI " . strtoupper($datakategori['kategori']) . "</h3>";
      } else if (isset($_GET['id_kategori']) && isset($_GET['bulan']) && isset($_GET['tahun'])) {
        $querykategori = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE id_kategori = '$_GET[id_kategori]'");
        $datakategori  = mysqli_fetch_array($querykategori);
        echo "<h4 align='center'>LAPORAN DATA REKAP PENJUALAN BARANG UNTUK KATEGORI " . strtoupper($datakategori['kategori']) . " BULAN " . $_GET['bulan'] . " TAHUN " . $_GET['tahun'] . "</h3>";
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
            <th>Harga</th>
            <th>Stok</th>
            <th>Stok Terjual</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no  = 1;
          if ($_GET['bulan'] != 0 && !empty($_GET['tahun'])) {
            $whereBulan = "AND MONTH(d.tanggal_jual) = '$_GET[bulan]' AND YEAR(d.tanggal_jual) = '$_GET[tahun]'";
          } else {
            $whereBulan = "";
          }
          if (isset($_GET['id_kategori'])) {
            $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_rekap c, data_penjualan d WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND b.id_kategori = '$_GET[id_kategori]' AND c.id_penjualan = d.id_penjualan $whereBulan ORDER BY c.id_rekap DESC");
          } else {
            $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_rekap c, data_penjualan d WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND c.id_penjualan = d.id_penjualan ORDER BY c.id_rekap DESC");
          }
          function getBulan($bln)
          {
            switch ($bln) {
              case  1:
                return  "Januari";
                break;
              case  2:
                return  "Februari";
                break;
              case  3:
                return  "Maret";
                break;
              case  4:
                return  "April";
                break;
              case  5:
                return  "Mei";
                break;
              case  6:
                return  "Juni";
                break;
              case  7:
                return  "Juli";
                break;
              case  8:
                return  "Agustus";
                break;
              case  9:
                return  "September";
                break;
              case  10:
                return  "Oktober";
                break;
              case  11:
                return  "November";
                break;
              case  12:
                return  "Desember";
                break;
            }
          }
          while ($data = mysqli_fetch_array($query)) {
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['kategori'] ?></td>
              <td><?= $data['nama_barang'] ?></td>
              <td><?= $data['ukuran'] ?></td>
              <td><?= $data['harga'] ?></td>
              <td><?= $data['stok'] ?></td>
              <td><?= $data['stok_terjual'] ?></td>
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