<?php
include 'src/header.php';

if (isset($_POST['cari'])) {
   $produk = mysqli_query($koneksi, "SELECT * from data_rekap a, data_barang b, data_kategori c WHERE b.id_kategori = c.id_kategori AND a.id_barang = b.id_barang AND b.id_kategori = '$_POST[id_kategori]'");
   while ($row = mysqli_fetch_array($produk)) {
      $nama_barang[] = $row['nama_barang'] . " " . $row['stok'] . " " . $row['stok_terjual'];
      $kategori      = $row['kategori'];

      $query = mysqli_query($koneksi, "SELECT * from data_rekap WHERE id_barang='" . $row['id_barang'] . "'");
      $row = $query->fetch_array();
      $stok_terjual[] = $row['stok_terjual'];
   }
} else {
   $produk = mysqli_query($koneksi, "SELECT * from data_rekap a, data_barang b, data_kategori c WHERE b.id_kategori = c.id_kategori AND a.id_barang = b.id_barang AND b.id_kategori = '1'");
   while ($row = mysqli_fetch_array($produk)) {
      $nama_barang[] = $row['nama_barang'] . " " . $row['stok'] . " " . $row['stok_terjual'];
      $kategori      = $row['kategori'];

      $query = mysqli_query($koneksi, "SELECT * from data_rekap WHERE id_barang='" . $row['id_barang'] . "'");
      $row = $query->fetch_array();
      $stok_terjual[] = $row['stok_terjual'];
   }
   // AND a.bulan = 'Januari' AND a.tahun = '2023'
}


?>

<?php if ($_SESSION['level'] !== 'pemilik') { ?>
   <div class="row column1">
      <div class="col-md-6 col-lg-4">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="data_kategori.php"><i class="fa fa-archive green_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_kategori");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <p class="head_couter"><a href="data_kategori.php">Data Kategori</a></p>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-lg-4">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="data_barang.php"><i class="fa fa-bookmark red_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_barang");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <a href="data_barang.php">
                     <p class="head_couter">Data Barang</p>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-lg-4">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="data_pembelian.php"><i class="fa fa-shopping-cart blue1_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_pembelian");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <a href="data_pembelian.php">
                     <p class="head_couter">Data Pembelian</p>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row column1">
      <div class="col-md-6 col-lg-6">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="data_penjualan.php"><i class="fa fa-shopping-cart yellow_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <a href="data_penjualan.php">
                     <p class="head_couter">Data Penjualan</p>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-lg-6">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="data_rekap.php"><i class="fa fa-book brown_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_rekap");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <a href="data_rekap.php">
                     <p class="head_couter">Rekap Penjualan</p>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } else { ?>
   <div class="row column1">
      <div class="col-md-6 col-lg-6">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="prediksi.php"><i class="fa fa-shopping-cart yellow_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_hasil");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <a href="prediksi.php">
                     <p class="head_couter">Data Hasil Prediksi</p>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-lg-6">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div>
                  <a href="data_rekap.php"><i class="fa fa-book brown_color"></i></a>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM data_rekap");
                  $data  = mysqli_num_rows($query);
                  ?>
                  <p class="total_no"><?= $data ?></p>
                  <a href="data_rekap.php">
                     <p class="head_couter">Rekap Penjualan</p>
                  </a>
               </div>
            </div>
         </div>
      </div>

      <!-- <div class="row column2 graph margin_bottom_30">
      <div class="col-md-l2 col-lg-12">
         <div class="white_shd full">
            <div class="full graph_head">
               <div class="heading1 margin_0">
                  <h2>SISTEM PREDIKSI MANAJEMEN STOK BARANG TOKO RIZKY PUTRI</h2>
               </div>
            </div>
            <div class="full progress_bar_inner">
               <div class="row">
                  <div class="col-md-12">
                     <div class="full">
                        <div class="padding_infor_info">
                           <form method="POST" action="">
                              <div class="row">
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <select class="form-control" name="id_kategori" id="id_kategori" required>
                                          <option value=""> Pilih Kategori</option>
                                          <?php
                                          $query = mysqli_query($koneksi, "SELECT * FROM data_kategori ORDER BY kategori");
                                          while ($row = mysqli_fetch_array($query)) {
                                          ?>
                                             <option value="<?php echo $row['id_kategori']; ?>">
                                                <?php echo $row['kategori']; ?>
                                             </option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <select class="form-control" name="bulan">
                                          <option value="Januari">Januari</option>
                                          <option value="Februari">Februari</option>
                                          <option value="Maret">Maret</option>
                                          <option value="April">April</option>
                                          <option value="Mei">Mei</option>
                                          <option value="Juni">Juni</option>
                                          <option value="Juli">Juli</option>
                                          <option value="Agustus">Agustus</option>
                                          <option value="September">September</option>
                                          <option value="Oktober">Oktober</option>
                                          <option value="November">November</option>
                                          <option value="Desember">Desember</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <input type="number" class="form-control" placeholder="Masukkan Tahun" value="2023" name="tahun">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <button data-toggle="tooltip" data-placement="top" type="submit" name="cari" title="Lihat Grafik" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Grafik</button>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     </div>

                     <div style="width: 100%">
                        <canvas id="myChart"></canvas>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
   </div>
<?php } ?>

<script src="../assets/admin/js/Chart.js"></script>
<script>
   var ctx = document.getElementById("myChart").getContext('2d');
   var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: <?php echo json_encode($nama_barang); ?>,
         datasets: [{
            label: 'Grafik Data Rekap Penjualan Kategori <?= $kategori ?>',
            data: <?php echo json_encode($stok_terjual); ?>,
            backgroundColor: [
               'rgba(255, 99, 132, 0.2)',
               'rgba(54, 162, 235, 0.2)',
               'rgba(255, 206, 86, 0.2)',
               'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
               'rgba(255,99,132,1)',
               'rgba(54, 162, 235, 1)',
               'rgba(255, 206, 86, 1)',
               'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            yAxes: [{
               ticks: {
                  beginAtZero: true
               }
            }]
         }
      }
   });
</script>


<?php include 'src/footer.php'; ?>