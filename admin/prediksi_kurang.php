<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>DATA HASIL PREDIKSI YANG KURANG DAN PERLU RESTOCK</h2>
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
                      <select class="form-control" name="bulan" id="bulan">
                        <option value=0>--Pilih Bulan--</option>
                        <option value=1>Januari</option>
                        <option value=2>Februari</option>
                        <option value=3>Maret</option>
                        <option value=4>April</option>
                        <option value=5>Mei</option>
                        <option value=6>Juni</option>
                        <option value=7>Juli</option>
                        <option value=8>Agustus</option>
                        <option value=9>September</option>
                        <option value=10>Oktober</option>
                        <option value=11>November</option>
                        <option value=12>Desember</option>
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
                      <button data-toggle="tooltip" data-placement="top" type="submit" name="cari" title="cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                      <?php if (isset($_POST['cari'])) { ?>
                        <a href="prediksi_cetak_kurang.php?bulan=<?= $_POST['bulan'] ?>&tahun=<?= $_POST['tahun'] ?>" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                      <?php } else { ?>
                        <a href="prediksi_cetak_kurang.php" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                      <?php } ?>
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
                $bulan = getBulan($_POST['bulan']);
                $tahun = $_POST['tahun'];
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
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Nama Barang</th>
                      <th>Ukuran</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Stok Terjual</th>
                      <th>Jumlah Sisa Stok</th>
                      <th>Jumlah Restock</th>
                      <th>Harga yang Disiapkan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no  = 1;
                    if (isset($_POST['cari'])) {
                      if ($_POST['bulan'] != 0 && !empty($_POST['tahun'])) {
                        $whereBulan = "AND MONTH(b.tanggal_update) = '$_POST[bulan]' AND YEAR(b.tanggal_update) = '$_POST[tahun]'";
                        $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_hasil c WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang $whereBulan AND c.hasil_prediksi = 'kurang' ORDER BY c.id_hasil DESC");
                      } else {
                        $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_hasil c WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND c.hasil_prediksi = 'kurang' ORDER BY c.id_hasil DESC");
                      }
                    } else {
                      $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_hasil c WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND c.hasil_prediksi = 'kurang' ORDER BY c.id_hasil DESC");
                    }
                    $restocks = 0;
                    $jumlah_harga_siapkan = 0;

                    while ($data = mysqli_fetch_array($query)) {
                      $restock = $data['selisih_stok'] > 3 ? 6 : 12;
                      $restocks += $data['selisih_stok'];
                      $jumlah_harga_siapkan += $data['jumlah_harga_siapkan'];
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['kategori'] ?></td>
                        <td><?= $data['nama_barang'] ?></td>
                        <td><?= $data['ukuran'] ?></td>
                        <td><?= $data['harga'] ?></td>
                        <td><?= $data['stok'] ?></td>
                        <td><?= $data['terjual'] ?></td>
                        <td><?= $data['selisih_stok'] ?></td>
                        <td><?= $restock ?></td>
                        <td><?= number_format($data['jumlah_harga_siapkan'], 0, ',', '.') ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <<td colspan="8">Jumlah</td>
                    <td><?= $restocks ?></td>
                    <td><?= number_format($jumlah_harga_siapkan, 0, ',', '.') ?></td>
                    <td></td>
                    <td></td>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>