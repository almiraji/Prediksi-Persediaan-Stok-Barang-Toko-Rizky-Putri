<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>DATA PENJUALAN</h2>
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
                      <button data-toggle="tooltip" data-placement="top" type="submit" name="cari" title="Cari Data" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                      <?php if ($_SESSION['level'] == 'admin2') : ?>
                        <?php if (isset($_POST['cari'])) { ?>
                          <a href="data_penjualan_cetak.php?id_kategori=<?= $_POST['id_kategori'] ?>" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                        <?php } else { ?>
                          <a href="data_penjualan_cetak.php" target="_blank()"><button data-toggle="tooltip" data-placement="top" title="Cetak Data" type="button" class="btn btn-danger btn-sm"><i class="fa fa-print"></i></button></a>
                        <?php } ?>
                      <?php endif; ?>
                      <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="data_penjualan_tambah.php"><button data-toggle="tooltip" data-placement="top" title="Tambah Data" type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span class="fa fa-plus" aria-hidden="true"></span></button></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </form>
              <hr>
              <?php
              if (isset($_POST['cari'])) {
                $querykategori = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE id_kategori = '$_POST[id_kategori]'");
                $datakategori  = mysqli_fetch_array($querykategori);
                echo "<b> Hasil pencarian : Kategori $datakategori[kategori] </b>";
                echo "<hr>";
              }
              ?>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel-data">
                  <thead>
                    <tr>
                      <th class="text-dark">No</th>
                      <th class="text-dark">Tanggal</th>
                      <th class="text-dark">Nama Barang</th>
                      <th class="text-dark">Ukuran</th>
                      <th class="text-dark">Stok</th>
                      <th class="text-dark">Jumlah</th>
                      <th class="text-dark">Harga</th>
                      <th class="text-dark">Jumlah Harga</th>
                      <th class="text-dark">Pengisi Data</th>
                      <th class="text-dark">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;

                    if (isset($_POST['cari'])) {
                      $query = mysqli_query($koneksi, "SELECT * FROM data_barang b, data_penjualan c WHERE c.id_barang = b.id_barang AND b.id_kategori = '$_POST[id_kategori]' ORDER BY c.id_penjualan DESC");
                    } else {
                      $query = mysqli_query($koneksi, "SELECT * FROM data_barang b, data_penjualan c WHERE c.id_barang = b.id_barang ORDER BY c.id_penjualan DESC");
                    }

                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td class="text-dark"><?= $no++ ?></td>
                        <td class="text-dark"><?= $data['tanggal_jual'] ?></td>
                        <td class="text-dark"><?= $data['nama_barang'] ?></td>
                        <td class="text-dark"><?= $data['ukuran'] ?></td>
                        <td class="text-dark"><?= $data['stok'] ?></td>
                        <td class="text-dark"><?= $data['jumlah_jual'] ?></td>
                        <td class="text-dark">Rp. <?= number_format($data['harga_jual']) ?></td>
                        <td class="text-dark">Rp. <?= number_format($data['total_harga']) ?></td>
                        <td class="text-dark"><?= $data['pengisi'] ?></td>
                        <td>
                          <a href="data_penjualan_view.php?id_penjualan=<?= $data['id_penjualan'] ?>"><button data-toggle="tooltip" data-placement="top" title="View Data" type="button" class='d-sm-inline-block btn btn-sm btn-warning shadow-sm'><span class="fa fa-eye" aria-hidden="true"></span></button></a>
                          <?php if ($_SESSION['level'] == 'admin2') : ?>
                            <a href="data_penjualan_edit.php?id_penjualan=<?= $data['id_penjualan'] ?>"><button data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span class="fa fa-pencil" aria-hidden="true"></span></button></a>
                            <a href="data_penjualan_hapus.php?id_penjualan=<?= $data['id_penjualan'] ?>"><button data-toggle="tooltip" data-placement="top" title="Hapus Data" type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm' onclick="return confirm('Yakin Ingin Menghapus Data Ini?')"><span class="fa fa-trash" aria-hidden="true"></span></button></a>
                          <?php endif; ?>
                        </td>
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