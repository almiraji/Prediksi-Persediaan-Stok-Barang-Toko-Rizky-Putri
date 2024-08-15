<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
  $id_penjualan = $_GET['id_penjualan'];
  $id_barang    = $_POST['id_barang'];
  $tanggal_jual = $_POST['tanggal_jual'];
  $harga_jual   = $_POST['harga_jual'];
  $jumlah_jual  = $_POST['jumlah_jual'];
  $total_harga  = $_POST['total_harga'];
  $stok         = $_POST['stok'];
  $pengisi      = $_SESSION['nama'];

  $bulan_jual   = date("m", strtotime($tanggal_jual));
  $tahun_jual   = date("Y", strtotime($tanggal_jual));

  include 'src/kondisi_bulan.php';

  $queryjual    = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id_penjualan'");
  $datajual     = mysqli_fetch_array($queryjual);

  $querybarang  = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang = '$datajual[id_barang]'");
  $databarang   = mysqli_fetch_array($querybarang);

  $stokkembali  = $databarang['stok_barang'] + $datajual['jumlah_jual'];
  $stokupdate   = $stokkembali - $jumlah_jual;
  $updatestok   = mysqli_query($koneksi, "UPDATE data_barang SET stok_barang = '$stokupdate', tanggal_update = '$tanggal_jual' WHERE id_barang = '$id_barang'");

  $simpan1 = mysqli_query($koneksi, "UPDATE data_penjualan SET id_barang = '$id_barang', tanggal_jual = '$tanggal_jual', harga_jual = '$harga_jual', jumlah_jual = '$jumlah_jual', total_harga = '$total_harga', stok = '$stok', pengisi = '$pengisi' WHERE id_penjualan = '$id_penjualan'");
  $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id_penjualan'");
  $query  = mysqli_fetch_array($query);
  if ($query['jumlah_jual'] <= $query['stok']) {
    $hasil = 'cukup';
  } else {
    $hasil = 'kurang';
  }
  $update = mysqli_query($koneksi, "UPDATE data_rekap SET id_barang = '$query[id_barang]', harga = '$query[harga_jual]', stok = '$query[stok]', stok_terjual = '$query[jumlah_jual]', hasil = '$hasil', pengisi = '$pengisi' WHERE id_penjualan = '$id_penjualan'");

  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_penjualan.php'</script>";
}
?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>EDIT DATA PENJUALAN</h2>
        </div>
      </div>

      <?php
      $id_penjualan = $_GET['id_penjualan'];
      $query        = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id_penjualan'");
      $data         = mysqli_fetch_array($query);
      ?>

      <div class="full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <div class="table-responsive-sm">
                <form action="" method="POST">
                  <div class="form-group">
                    <label class="form-control-label" for="id_barang">Nama Barang</label>
                    <select class="form-control" name="id_barang" required>
                      <?php
                      $querybarang = mysqli_query($koneksi, "SELECT * FROM data_barang a, data_kategori b WHERE a.id_kategori = b.id_kategori");
                      while ($databarang = mysqli_fetch_array($querybarang)) {
                      ?>
                        <option value="<?= $databarang['id_barang'] ?>" <?php if ($databarang['id_barang'] == $data['id_barang']) {
                                                                          echo "selected";
                                                                        } ?>><?= $databarang['kategori'] . " - " . $databarang['nama_barang'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="tanggal_jual">Tanggal Penjualan</label>
                    <input type="date" class="form-control" name="tanggal_jual" value="<?= $data['tanggal_jual'] ?>" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="harga_jual">Harga</label>
                    <input type="number" class="form-control" name="harga_jual" value="<?= $data['harga_jual'] ?>" id="harga_jual" placeholder="Harga" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="stok">Stok</label>
                    <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>" id="stok" placeholder="Stok" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="jumlah_jual">Jumlah Penjualan</label>
                    <input type="number" class="form-control" name="jumlah_jual" value="<?= $data['jumlah_jual'] ?>" onkeyup="perkalian();" id="jumlah_jual" placeholder="Jumlah Penjualan" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="total_harga">Total Harga</label>
                    <input type="number" class="form-control" name="total_harga" value="<?= $data['total_harga'] ?>" id="total_harga" placeholder="Harga" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function perkalian() {
    var number3 = document.getElementById('jumlah_jual').value;
    var number4 = document.getElementById('harga_jual').value;
    var hasil2 = parseInt(number3) * parseInt(number4);
    if (!isNaN(hasil2)) {
      document.getElementById('total_harga').value = hasil2;
    }
  }
</script>

<?php include 'src/footer.php'; ?>