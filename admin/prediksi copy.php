<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>PERHITUNGAN PREDIKSI</h2>
        </div>
      </div>
      <div class="full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <form method="POST" action="">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <select class="form-control" name="id_kategori">
                        <option value="">-- Pilih Kategori Barang --</option>
                        <?php
                        $querykategori = mysqli_query($koneksi, "SELECT * FROM data_kategori");
                        while ($datakategori = mysqli_fetch_array($querykategori)) {
                        ?>
                          <option value="<?= $datakategori['id_kategori'] ?>"><?= $datakategori['kategori'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select class="form-control" name="bulan" id="bulan">
                        <option value="0">--Pilih Bulan--</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="number" name="tahun" id="tahun" placeholder="Masukkan Tahun" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <button data-toggle="tooltip" data-placement="top" type="submit" name="cari" title="Prediksi" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Prediksi</button>
                      <?php if ($_SESSION['level'] == 'admin2') : ?>
                        <?php if (isset($_POST['cari'])) { ?>
                          <a href="prediksi_cetak.php?id_kategori=<?= $_POST['id_kategori'] ?>&bulan=<?= $_POST['bulan'] ?>&tahun=<?= $_POST['tahun'] ?>" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                        <?php } else { ?>
                          <a href="prediksi_cetak.php" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                        <?php } ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </form>
              <hr>
              <?php
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
              if (isset($_POST['cari'])) {
                $querykategori = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE id_kategori = '$_POST[id_kategori]'");
                $datakategori  = mysqli_fetch_array($querykategori);
                $bulan = getBulan($_POST['bulan']);
                $tahun = $_POST['tahun'];
                echo "<b> Hasil Prediksi : Kategori $datakategori[kategori] </b>";
                echo "<br />";
                echo "<b> Hasil Prediksi : Bulan $bulan </b>";
                echo "<br />";
                echo "<b> Hasil Prediksi : Tahun $tahun </b>";
                echo "<hr>";
              }
              ?>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel-data">
                  <thead>
                    <tr>
                      <th class="text-dark">No</th>
                      <th class="text-dark">Nama Barang</th>
                      <th class="text-dark">Ukuran</th>
                      <th class="text-dark">Harga</th>
                      <th class="text-dark">Stok</th>
                      <th class="text-dark">Stok Terjual</th>
                      <th class="text-dark">Hasil Prediksi</th>
                      <th class="text-dark">Jumlah Sisa Stok</th>
                      <th class="text-dark">Jumlah Restock</th>
                      <th class="text-dark">Harga yang Disiapkan</th>
                      <th class="text-dark">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($_POST['cari'])) {
                      $urut = 1;
                      if ($_POST['bulan'] != 0 && !empty($_POST['tahun'])) {
                        $whereBulan = "AND MONTH(tanggal_update) = '$_POST[bulan]' AND YEAR(tanggal_update) = '$_POST[tahun]'";
                        $whereBulan2 = "AND MONTH(d.tanggal_jual) = '$_POST[bulan]' AND YEAR(d.tanggal_jual) = '$_POST[tahun]'";
                      } else {
                        $whereBulan = "";
                        $whereBulan2 = "";
                      }

                      $qryBrg = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_kategori = '$_POST[id_kategori]' $whereBulan ORDER BY id_barang DESC");
                      $qryBrg = mysqli_num_rows($qryBrg);

                      if ($qryBrg > 0) {
                        $query = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_kategori = '$_POST[id_kategori]' $whereBulan ORDER BY id_barang DESC");
                        while ($data = mysqli_fetch_array($query)) {
                          // Mengambil data yang dibutuhkan untuk Naive Bayes
                          $query_rekap = mysqli_query($koneksi, "SELECT a.*, b.*, c.*, d.* FROM data_rekap a, data_barang b, data_kategori c, data_penjualan d WHERE a.id_barang = '$data[id_barang]' AND c.id_kategori = '$_POST[id_kategori]' AND a.id_penjualan = d.id_penjualan $whereBulan2 ORDER BY a.id_rekap DESC");
                          $num_rekap = mysqli_num_rows($query_rekap);

                          if ($num_rekap > 0) {
                            $query_rekap = mysqli_query($koneksi, "SELECT a.*, b.*, c.*, d.* FROM data_rekap a, data_barang b, data_kategori c, data_penjualan d WHERE a.id_barang = '$data[id_barang]' AND c.id_kategori = '$_POST[id_kategori]' AND a.id_penjualan = d.id_penjualan $whereBulan2 ORDER BY a.id_rekap DESC");
                          } else {
                            $query_rekap = mysqli_query($koneksi, "SELECT a.*, b.*, c.*, d.* FROM data_rekap a, data_barang b, data_kategori c, data_penjualan d WHERE a.id_barang = '$data[id_barang]' AND c.id_kategori = '$_POST[id_kategori]' AND a.id_penjualan = d.id_penjualan ORDER BY a.id_rekap DESC");
                          }

                          $true_positives = 0;
                          $false_positives = 0;
                          $false_negatives = 0;
                          $correct_predictions = 0;
                          $total_predictions = 0;
                          $jumlah_cukup = 0;
                          $jumlah_kurang = 0;
                          $nama_barang_cukup = 0;
                          $nama_barang_kurang = 0;
                          $kategori_cukup = 0;
                          $kategori_kurang = 0;
                          $ukuran_cukup = 0;
                          $ukuran_kurang = 0;
                          $harga_cukup = 0;
                          $harga_kurang = 0;

                          $total_stok_cukup = 0;
                          $total_stok_kurang = 0;
                          $total_jual_cukup = 0;
                          $total_jual_kurang = 0;

                          $total_harga_cukup = 0;
                          $total_harga_kurang = 0;

                          while ($rekap = mysqli_fetch_array($query_rekap)) {
                            if ($rekap['hasil'] == 'cukup') {
                              $jumlah_cukup++;
                              $total_stok_cukup += $rekap['stok'];
                              $total_jual_cukup += $rekap['stok_terjual'];
                              $total_harga_cukup += $rekap['harga'];
                              if ($rekap['nama_barang'] == $data['nama_barang']) $nama_barang_cukup++;
                              if ($rekap['kategori'] == $rekap['kategori']) $kategori_cukup++;
                              if ($rekap['ukuran'] == $data['ukuran']) $ukuran_cukup++;
                            } else if ($rekap['hasil'] == 'kurang') {
                              $jumlah_kurang++;
                              $total_stok_kurang += $rekap['stok'];
                              $total_jual_kurang += $rekap['stok_terjual'];
                              $total_harga_kurang += $rekap['harga'];
                              if ($rekap['nama_barang'] == $data['nama_barang']) $nama_barang_kurang++;
                              if ($rekap['kategori'] == $rekap['kategori']) $kategori_kurang++;
                              if ($rekap['ukuran'] == $data['ukuran']) $ukuran_kurang++;
                            }
                          }

                          $total = $jumlah_cukup + $jumlah_kurang;

                          if ($total > 0) {
                            $p_cukup = $jumlah_cukup / $total;
                            $p_kurang = $jumlah_kurang / $total;
                          } else {
                            $p_cukup = 0;
                            $p_kurang = 0;
                          }

                          $p_nama_cukup = ($jumlah_cukup > 0) ? $nama_barang_cukup / $jumlah_cukup : 0;
                          $p_nama_kurang = ($jumlah_kurang > 0) ? $nama_barang_kurang / $jumlah_kurang : 0;

                          $p_kategori_cukup = ($jumlah_cukup > 0) ? $kategori_cukup / $jumlah_cukup : 0;
                          $p_kategori_kurang = ($jumlah_kurang > 0) ? $kategori_kurang / $jumlah_kurang : 0;

                          $p_ukuran_cukup = ($jumlah_cukup > 0) ? $ukuran_cukup / $jumlah_cukup : 0;
                          $p_ukuran_kurang = ($jumlah_kurang > 0) ? $ukuran_kurang / $jumlah_kurang : 0;

                          $p_hasil_cukup = $p_cukup * $p_nama_cukup * $p_kategori_cukup * $p_ukuran_cukup;
                          $p_hasil_kurang = $p_kurang * $p_nama_kurang * $p_kategori_kurang * $p_ukuran_kurang;

                          $hasil_prediksi = ($p_hasil_cukup > $p_hasil_kurang) ? 'cukup' : 'kurang';

                          // Prediksi harga berdasarkan rata-rata historis
                          $rata2_harga_cukup = ($jumlah_cukup > 0) ? $total_harga_cukup / $jumlah_cukup : 0;
                          $rata2_harga_kurang = ($jumlah_kurang > 0) ? $total_harga_kurang / $jumlah_kurang : 0;

                          $prediksi_harga = ($hasil_prediksi == 'cukup') ? $rata2_harga_cukup : $rata2_harga_kurang;

                          // Prediksi stok dan penjualan berdasarkan rata-rata historis
                          $rata2_stok_cukup = ($jumlah_cukup > 0) ? $total_stok_cukup / $jumlah_cukup : 0;
                          $rata2_stok_kurang = ($jumlah_kurang > 0) ? $total_stok_kurang / $jumlah_kurang : 0;

                          $rata2_jual_cukup = ($jumlah_cukup > 0) ? $total_jual_cukup / $jumlah_cukup : 0;
                          $rata2_jual_kurang = ($jumlah_kurang > 0) ? $total_jual_kurang / $jumlah_kurang : 0;

                          $prediksi_stok = ($hasil_prediksi == 'cukup') ? round($rata2_stok_cukup) : round($rata2_stok_kurang);
                          $prediksi_terjual = ($hasil_prediksi == 'cukup') ? round($rata2_jual_cukup) : round($rata2_jual_kurang);
                          if ($prediksi_stok > $prediksi_terjual) {
                            $selisih_stok = $prediksi_stok - $prediksi_terjual;
                          } else {
                            $selisih_stok = $prediksi_terjual - $prediksi_stok;
                          }
                          $hasil_prediksi = ($selisih_stok > 6) ? 'cukup' : 'kurang';
                          $restock = $selisih_stok > 3 ? 6 : 12;
                          $jumlah_harga_siapkan = $selisih_stok > 3 ? $prediksi_harga * 6 : $prediksi_harga * 12;

                          // Menyimpan prediksi dan hasil aktual untuk menghitung akurasi
                          $query_rekap2 = mysqli_query($koneksi, "SELECT a.*, b.*, c.*, d.* FROM data_rekap a, data_barang b, data_kategori c, data_penjualan d WHERE a.id_barang = '$data[id_barang]' AND a.id_penjualan = d.id_penjualan $whereBulan2 ORDER BY a.id_rekap DESC");
                          while ($rekap2 = mysqli_fetch_array($query_rekap2)) {
                            if ($rekap2['hasil'] == $hasil_prediksi) {
                              $correct_predictions++;
                            }
                            $total_predictions++;
                          }


                          $query_hasil = mysqli_query($koneksi, "SELECT * FROM data_hasil WHERE id_barang ='$data[id_barang]'");
                          $query_hasil = mysqli_num_rows($query_hasil);

                          if ($query_hasil > 0) {
                            // tidak melakukan simpan data
                          } else {
                            // Buat objek DateTime dari tanggal yang ada
                            $date = new DateTime($data['tanggal_update']);

                            // Tambahkan satu bulan ke tanggal tersebut
                            $date->modify('+1 month');

                            // Perbarui tanggal di dalam array $data

                            $data['tanggal_update'] = $date->format('Y-m-d');

                            $simpan = mysqli_query($koneksi, "INSERT INTO data_hasil (id_hasil,id_barang,harga,stok,terjual,selisih_stok,jumlah_harga_siapkan,hasil_prediksi,tanggal) VALUES (NULL,'$data[id_barang]','$prediksi_harga', '$prediksi_stok', '$prediksi_terjual', '$selisih_stok', '$jumlah_harga_siapkan', '$hasil_prediksi','$data[tanggal_update]')");
                            $last_id_hasil = mysqli_insert_id($koneksi);

                            // Menghitung akurasi
                            $accuracy = ($total_predictions > 0) ? ($correct_predictions / $total_predictions) * 100 : 0;
                            $precision_cukup = ($jumlah_cukup > 0) ? ($nama_barang_cukup / $jumlah_cukup) * 100 : 0;
                            $precision_kurang = ($jumlah_kurang > 0) ? ($nama_barang_kurang / $jumlah_kurang) * 100 : 0;
                            $recall_cukup = ($jumlah_cukup > 0) ? ($nama_barang_cukup / $nama_barang_cukup) * 100 : 0;
                            $recall_kurang = ($jumlah_kurang > 0) ? ($nama_barang_kurang / $jumlah_kurang) * 100 : 0;

                            $addPerforma = mysqli_query($koneksi, "INSERT INTO data_performa (id_performa,id_kategori,id_hasil,bulan,tahun,akurasi,presisi_cukup,presisi_kurang,recall_cukup,recall_kurang) VALUES (NULL, '$_POST[id_kategori]', '$last_id_hasil', '$_POST[bulan]', '$_POST[tahun]', '$accuracy', '$precision_cukup', '$precision_kurang', '$recall_cukup', '$recall_kurang')");
                          }
                    ?>
                          <tr>
                            <td class="text-dark"><?= $urut++ ?></td>
                            <td class="text-dark"><?= $data['nama_barang'] ?></td>
                            <td class="text-dark"><?= $data['ukuran'] ?></td>
                            <td class="text-dark"><?= $prediksi_harga ?></td>
                            <td class="text-dark"><?= $prediksi_stok ?></td>
                            <td class="text-dark"><?= $prediksi_terjual ?></td>
                            <td class="text-dark"><?= $hasil_prediksi ?></td>
                            <td class="text-dark"><?= $selisih_stok; ?></td>
                            <td class="text-dark"><?= $hasil_prediksi == 'kurang' ? $restock : 0 ?></td>
                            <td class="text-dark"><?= $hasil_prediksi == 'kurang' ? $jumlah_harga_siapkan : 0 ?></td>
                            <td>
                              <a href="data_prediksi_view.php?nama_barang=<?= $data['nama_barang'] ?>&ukuran=<?= $data['ukuran'] ?>&harga=<?= $prediksi_harga ?>&stok=<?= $prediksi_stok ?>&terjual=<?= $prediksi_terjual ?>&hasil=<?= $hasil_prediksi ?>&selisih=<?= $selisih_stok ?>&restock=<?= $hasil_prediksi == 'kurang' ? $restock : 0 ?>&harga_siapkan=<?= $hasil_prediksi == 'kurang' ? $jumlah_harga_siapkan : 0 ?>"><button data-toggle="tooltip" data-placement="top" title="View Data" type="button" class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span class="fa fa-eye" aria-hidden="true"></span></button></a>
                            </td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr>
                          <td colspan="11" align="center">Data hasil prediksi hanya sampai bulan selanjutnya</td>
                        </tr>
                      <?php } ?>
                  </tbody>
                  <!-- <tfoot>
                    <td colspan="11">
                      <a href="performa.php?akurasi=<?= $accuracy ?>&p_cukup=<?= $precision_cukup ?>&p_kurang=<?= $precision_kurang ?>&r_cukup=<?= $recall_cukup ?>&r_kurang=<?= $recall_kurang ?>"><button data-toggle="tooltip" data-placement="top" title="View Data" type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'>Lihat Performa Prediksi</button></a>
                    </td>
                  </tfoot> -->
                <?php } ?>
                </table>
              </div>
              <!-- <div class="table-responsive-sm mt-5">
                <div class="heading1 margin_0">
                  <h2>PERFORMA HASIL PREDIKSI</h2>
                  <?php
                  $accuracy = 0;
                  $precision_cukup = 0;
                  $precision_kurang = 0;
                  $recall_cukup = 0;
                  $recall_kurang = 0;
                  $total = 0; // untuk menghitung total data

                  $qryPerforma = mysqli_query($koneksi, "SELECT * FROM data_performa");
                  while ($resPerforma = mysqli_fetch_array($qryPerforma)) {
                    $accuracy += $resPerforma['akurasi'];
                    $precision_cukup += $resPerforma['presisi_cukup'];
                    $precision_kurang += $resPerforma['presisi_kurang'];
                    $recall_cukup += $resPerforma['recall_cukup'];
                    $recall_kurang += $resPerforma['recall_kurang'];
                    $total++; // menambahkan 1 untuk setiap data
                  }

                  // menghitung rata-rata
                  $accuracy = $total > 0 ? $accuracy / $total : 0;
                  $precision_cukup = $total > 0 ? $precision_cukup / $total : 0;
                  $precision_kurang = $total > 0 ? $precision_kurang / $total : 0;
                  $recall_cukup = $total > 0 ? $recall_cukup / $total : 0;
                  $recall_kurang = $total > 0 ? $recall_kurang / $total : 0;
                  ?>
                </div>
                <canvas id="myChart" width="400" height="400"></canvas>
              </div> -->
              <!-- <div class="row">
                <div class="col-lg-6">
                  <div class="table-responsive mt-5">
                    <div class="heading1 margin_0">
                      <h2>PERHITUNGAN NAIVE BAYES</h2>
                    </div>
                    <table class="table table-striped table-bordered mt-5" id="tabel-data">
                      <thead>
                        <tr>
                          <th colspan="2" class="bg-warning text-dark text-center"><b>Tahap 1</b></th>
                        </tr>
                        <tr>
                          <th colspan="2" class="bg-info text-dark text-center"><b>Menghitung jumlah atribut kelas</b></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>P(Y = Cukup)</td>
                          <td>Jumlah Data/Jumlah Cukup</td>
                        </tr>
                        <tr>
                          <td>P(Y = Kurang)</td>
                          <td>Jumlah Data/Jumlah Kurang</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="table-responsive mt-5">
                    <table class="table table-striped table-bordered mt-5" id="tabel-data">
                      <thead>
                        <tr>
                          <th colspan="2" class="bg-warning text-dark text-center"><b>Tahap 3</b></th>
                        </tr>
                        <tr>
                          <th colspan="2" class="bg-info text-dark text-center"><b>Kalikan semua hasil kelas cukup dan kurang</b></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>P(Hasil|Cukup)</td>
                          <td>Di kalikan semua hasil cukup dari tahap 1 dan 2</td>
                        </tr>
                        <tr>
                          <td>P(Hasil|Kurang)</td>
                          <td>Di kalikan semua hasil kurang dari tahap 1 dan 2</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-5" id="tabel-data">
                      <thead>
                        <tr>
                          <th colspan="2" class="bg-warning text-dark text-center"><b>Tahap 2</b></th>
                        </tr>
                        <tr>
                          <th colspan="2" class="bg-info text-dark text-center"><b>Menghitung jumlah kasus yg sama dengan kelas yg sama</b></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>P(Nama Barang|Y = Cukup)</td>
                          <td>Jumlah Data/Jumlah Cukup</td>
                        </tr>
                        <tr>
                          <td>P(Nama Barang|Y = Kurang)</td>
                          <td>Jumlah Data/Jumlah Kurang</td>
                        </tr>
                        <tr>
                          <td>P(Kategori|Y = Cukup)</td>
                          <td>Jumlah Data/Jumlah Cukup</td>
                        </tr>
                        <tr>
                          <td>P(Kategori|Y = Kurang)</td>
                          <td>Jumlah Data/Jumlah Kurang</td>
                        </tr>
                        <tr>
                          <td>P(Ukuran|Y = Cukup)</td>
                          <td>Jumlah Data/Jumlah Cukup</td>
                        </tr>
                        <tr>
                          <td>P(Ukuran|Y = Kurang)</td>
                          <td>Jumlah Data/Jumlah Kurang</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-5" id="tabel-data">
                      <thead>
                        <tr>
                          <th colspan="3" class="bg-warning text-dark text-center"><b>Tahap 4</b></th>
                        </tr>
                        <tr>
                          <th colspan="3" class="bg-info text-dark text-center"><b>Bandingkan hasil probabilitas kelas cukup dan kurang</b></th>
                        </tr>
                        <tr>
                          <th colspan="3" class="bg-info text-dark text-center"><b>Perbandingan hasil yang lebih besar itulah hasil akhirnya</b></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align="center">Cukup</td>
                          <td align="center"> >< </td>
                          <td align="center">Kurang</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>