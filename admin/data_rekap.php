<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>DATA REKAP PENJUALAN</h2>
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
                        <option value="">-- Pilih Kategori Penjualan --</option>
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
                      <button data-toggle="tooltip" data-placement="top" type="submit" name="cari" title="Cari Data" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                      <?php if ($_SESSION['level'] == 'admin2') : ?>
                        <?php if (isset($_POST['cari'])) { ?>
                          <a href="data_rekap_cetak.php?id_kategori=<?= $_POST['id_kategori'] ?>&bulan=<?= $_POST['bulan'] ?>&tahun=<?= $_POST['tahun'] ?>" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                        <?php } else { ?>
                          <a href="data_rekap_cetak.php" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
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
                $querykategori = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE id_kategori = '$_POST[id_kategori]' ORDER BY id_kategori DESC");
                $datakategori  = mysqli_fetch_array($querykategori);
                $bulan = getBulan($_POST['bulan']);
                $tahun = $_POST['tahun'];
                echo "<b> Hasil pencarian : Kategori $datakategori[kategori]</b>";
                echo "<br/>";
                echo "<b> Hasil pencarian : Bulan $bulan </b>";
                echo "<br/>";
                echo "<b> Hasil pencarian : Tahun $tahun </b>";
                echo "<hr>";
              }
              ?>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel-data">
                  <thead>
                    <tr>
                      <th class="text-dark">No</th>
                      <th class="text-dark">Kategori</th>
                      <th class="text-dark">Nama Barang</th>
                      <th class="text-dark">Ukuran</th>
                      <th class="text-dark">Harga</th>
                      <th class="text-dark">Stok</th>
                      <th class="text-dark">Stok Terjual</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    if (isset($_POST['cari'])) {
                      $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_rekap c, data_penjualan d WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND b.id_kategori = '$_POST[id_kategori]' AND c.id_penjualan = d.id_penjualan AND MONTH(d.tanggal_jual) = '$_POST[bulan]' AND YEAR(d.tanggal_jual) = '$_POST[tahun]' ORDER BY c.id_rekap DESC");
                    } else {
                      $query = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_rekap c, data_penjualan d WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND c.id_penjualan = d.id_penjualan ORDER BY c.id_rekap DESC");
                    }

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td class="text-dark"><?= $no++ ?></td>
                        <td class="text-dark"><?= $data['kategori'] ?></td>
                        <td class="text-dark"><?= $data['nama_barang'] ?></td>
                        <td class="text-dark"><?= $data['ukuran'] ?></td>
                        <td class="text-dark"><?= $data['harga'] ?></td>
                        <td class="text-dark"><?= $data['stok'] ?></td>
                        <td class="text-dark"><?= $data['stok_terjual'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
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