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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Stok Kurang</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .header {
      text-align: center;
      font-size: 42px;
      font-weight: bold;
      color: red;
    }

    .subheader {
      text-align: center;
      margin-top: 10px;
      font-size: 18px;
    }

    .lines {
      text-align: center;
    }

    .line {
      border-bottom: 2px solid black;
      width: 100%;
      margin: 0 auto;
    }

    .footer {
      text-align: right;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <?php
  $tanggalSebelumnya = date('n', strtotime('-1 month'));
  if (!empty($_GET['bulan']) && !empty($_GET['tahun'])) {
    $query = mysqli_query($koneksi, "SELECT *
    FROM data_kategori a
    JOIN data_barang b ON b.id_kategori = a.id_kategori
    JOIN data_hasil c ON c.id_barang = b.id_barang
    WHERE a.id_kategori = '$_GET[id_kategori]'
      AND MONTH(c.tanggal) = '$_GET[bulan]'
      AND YEAR(c.tanggal) = '$_GET[tahun]'
      AND c.hasil_prediksi = 'kurang'
    ORDER BY c.id_hasil DESC;
    ");
  } else {
    $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_hasil c WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND MONTH(c.tanggal) = '$tanggalSebelumnya' AND c.hasil_prediksi = 'kurang' ORDER BY c.id_hasil DESC");
  }
  ?>
  <div class="container">
    <div class="header">TOKO RIZKY PUTRI</div>
    <div class="lines">
      <div class="line"></div>
      <div class="line" style="margin-top: 5px;"></div>
    </div>
    <div class="subheader">LAPORAN STOK KURANG<br>Bulan:Januari <br> Tahun:2024</div>
    <div class="row mt-4">
      <?php while ($data = mysqli_fetch_array($query)) { ?>
        <div class="col-md-6 p-2">
          <div class="border border-dark p-3 rounded">
            <strong><?= $data['nama_barang'] ?></strong><br>
            Kategori: <?= $data['kategori'] ?><br>
            Ukuran: <?= $data['ukuran'] ?><br>
            Harga: <?= number_format($data['harga'], 2, ',', '.') ?><br>
            Stok: <?= $data['stok'] ?><br>
            Terjual Bulan Ini: <?= $data['terjual'] ?><br>
            
            <?php if ($data['terjual'] == $data['terjual_sebelumnya']) { ?>
              Penjualan pakaian ini sama dengan bulan sebelumnya. Perhatikan stok untuk bulan selanjutnya.
            <?php } else if ($data['terjual'] < $data['terjual_sebelumnya']) { ?>
              Penjualan pakaian bulan ini mengalami penurunan dari bulan sebelumnya. Perhatikan stok untuk bulan ini.
            <?php } else { ?>
              Penjualan pakaian bulan ini mengalami peningkatan dari bulan sebelumnya. Perhatikan stok untuk bulan selanjutnya.
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="footer">
      <span class="font-weight-bold">Banjarmasin, <?php echo date('Y-m-d'); ?></span>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      Pimpinan
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>