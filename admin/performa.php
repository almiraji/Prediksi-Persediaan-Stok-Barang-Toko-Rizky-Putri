<?php
include 'src/header.php';
$total = 0;
$accuracy = 0;
$precision = 0;
$recall = 0;

$qryPerforma = mysqli_query($koneksi, "SELECT * FROM data_performa");
while ($resPerforma = mysqli_fetch_array($qryPerforma)) {
  $accuracy += $resPerforma['akurasi'];
  $precision += $resPerforma['presisi_cukup'] + $resPerforma['presisi_kurang'];
  $recall += $resPerforma['recall_cukup'] + $resPerforma['recall_kurang'];
  $total++; // menambahkan 1 untuk setiap data
}

// menghitung rata-rata
$accuracy = $total > 0 ? ($accuracy / $total) : 0;
$precision = $total > 0 ? ($precision / $total) : 0;
$recall = $total > 0 ? ($recall / $total) : 0;
?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>PERFORMA HASIL PREDIKSI</h2>
        </div>
      </div>

      <div class="row column1 p-3">
        <div class="col-md-6 col-lg-4">
          <div class="full counter_section margin_bottom_30 bg-danger">
            <div class="counter_no">
              <div>
                <p class="total_no text-white"><?= number_format($accuracy, '2', ',', '.') ?>%</p>
                <p class="head_couter"><a href="data_kategori.php" class="text-white">Akurasi</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="full counter_section margin_bottom_30 bg-success">
            <div class="counter_no">
              <div>
                <p class="total_no text-white"><?= number_format($precision, '2', ',', '.') ?>%</p>
                <a href="data_barang.php">
                  <p class="head_couter text-white">Presisi</p>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="full counter_section margin_bottom_30 bg-primary">
            <div class="counter_no">
              <div>
                <p class="total_no text-white"><?= number_format($recall, '2', ',', '.') ?>%</p>
                <a href="data_pembelian.php">
                  <p class="head_couter text-white">Recall</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class=" full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <div class="table-responsive-sm">
                <canvas id="myChart" width="20" height="20"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>