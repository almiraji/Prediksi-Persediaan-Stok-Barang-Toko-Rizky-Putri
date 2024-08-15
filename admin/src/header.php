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
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
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
   <link rel="stylesheet" href="../assets/admin/css/bootstrap-select.css" />
   <link rel="stylesheet" href="../assets/admin/css/perfect-scrollbar.css" />
   <link rel="stylesheet" href="../assets/admin/css/custom.css" />
</head>

<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">
         <nav id="sidebar">
         <div class="sidebar_blog_2">
               <h4>TOKO RIZKY PUTRI</h4>
               <ul class="list-unstyled components">
                  <li><a href="index.php"><i class="fa fa-dashboard yellow_color"></i><span>Dashboard</span></a></li>
                  <?php if ($_SESSION['level'] !== 'pemilik') : ?>
                     <li><a href="data_kategori.php"><i class="fa fa-archive green_color"></i><span>Data Kategori</span></a></li>
                     <li><a href="data_barang.php"><i class="fa fa-bookmark red_color"></i><span>Stok Barang</span></a></li>
                     <li class="active">
                        <a href="#transaksi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-shopping-cart blue1_color"></i> <span>Transaksi</span></a>
                        <ul class="collapse list-unstyled" id="transaksi">
                           <li>
                              <a href="data_pembelian.php">> <span>Pembelian</span></a>
                           </li>
                           <li>
                              <a href="data_penjualan.php">> <span>Penjualan</span></a>
                           </li>
                        </ul>
                     </li>
                  <?php endif; ?>
                  <li><a href="data_rekap.php"><i class="fa fa-book brown_color"></i><span>Rekap Penjualan</span></a></li>
                  <li class="active">
                     <a href="#prediksi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-pencil red_color"></i> <span>Prediksi</span></a>
                     <ul class="collapse list-unstyled" id="prediksi">
                        <li>
                           <a href="prediksi.php">> <span>Prediksi</span></a>
                        </li>
                        <li>
                           <a href="performa.php">> <span>Performance</span></a>
                        </li>
                        
                     </ul>
                  </li>
                  <?php if ($_SESSION['level'] !== 'pemilik') : ?>
                     <li><a href="data_user.php"><i class="fa fa-gear orange_color"></i><span>Akun</span></a></li>
                  <?php endif; ?>
               </ul>
            </div>
         </nav>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <div class="topbar">
               <nav class="navbar navbar-expand-lg navbar-light">
                  <div class="full">
                     <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                     <div class="right_topbar">
                        <div class="icon_info">
                           <ul class="user_profile_dd">
                              <li>
                                 <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="../logo.png" alt="#" /><span class="name_user"><?= $datauser['nama_user'] ?></span></a>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </nav>
            </div>
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                        </div>
                     </div>
                  </div>