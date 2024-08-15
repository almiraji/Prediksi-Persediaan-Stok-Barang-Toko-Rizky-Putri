<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
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

  $querybarang  = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang = '$id_barang'");
  $databarang   = mysqli_fetch_array($querybarang);
  $stokupdate   = $databarang['stok_barang'] - $jumlah_jual;
  $updatestok   = mysqli_query($koneksi, "UPDATE data_barang SET stok_barang = '$stokupdate', tanggal_update = '$tanggal_jual' WHERE id_barang = '$id_barang'");

  $querycek = mysqli_query($koneksi, "SELECT * FROM data_rekap WHERE id_barang = '$id_barang'");
  $datacek  = mysqli_num_rows($querycek);

  if ($datacek > 0) {
    $queryrekap = mysqli_query($koneksi, "SELECT * FROM data_rekap WHERE id_barang = '$id_barang'");
    $datarekap  = mysqli_fetch_array($queryrekap);
    $uptotal    = $datarekap['stok_terjual'] + $jumlah_jual;

    $update     = mysqli_query($koneksi, "UPDATE data_rekap SET stok_terjual = '$uptotal' WHERE id_barang = '$id_barang'");
  }

  $simpan1 = mysqli_query($koneksi, "INSERT INTO data_penjualan (id_penjualan,id_barang,tanggal_jual,harga_jual,jumlah_jual,total_harga,stok,pengisi) VALUES(NULL,'$id_barang','$tanggal_jual','$harga_jual','$jumlah_jual','$total_harga',$stok,'$pengisi')");
  $last_id = mysqli_insert_id($koneksi);
  $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$last_id'");
  $query  = mysqli_fetch_array($query);
  if ($query['jumlah_jual'] <= $query['stok']) {
    $hasil = 'cukup';
  } else {
    $hasil = 'kurang';
  }
  $update     = mysqli_query($koneksi, "INSERT INTO data_rekap (id_rekap,id_barang,harga,stok,stok_terjual,hasil,id_penjualan,pengisi) VALUES (NULL,'$query[id_barang]','$query[harga_jual]','$query[stok]','$query[jumlah_jual]','$hasil',$last_id,'$pengisi')");

  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_penjualan.php'</script>";
}
?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>TAMBAH DATA PENJUALAN</h2>
        </div>
      </div>

      <div class="full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <div class="table-responsive-sm">
                <form action="" method="POST">
                  <div class="form-group">
                    <label class="form-control-label" for="id_barang">Nama Barang</label>
                    <select class="form-control" name="id_barang" required>
                      <option value="">-- Pilih Nama Barang --</option>
                      <?php
                      $querybarang = mysqli_query($koneksi, "SELECT * FROM data_barang a, data_kategori b WHERE a.id_kategori = b.id_kategori");
                      while ($databarang = mysqli_fetch_array($querybarang)) {
                      ?>
                        <option value="<?= $databarang['id_barang'] ?>"><?= $databarang['kategori'] . " - " . $databarang['nama_barang'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="tanggal_jual">Tanggal Penjualan</label>
                    <input type="date" class="form-control" name="tanggal_jual" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="harga_jual">Harga</label>
                    <input type="number" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="stok">Stok</label>
                    <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="jumlah_jual">Jumlah Penjualan</label>
                    <input type="number" class="form-control" name="jumlah_jual" onkeyup="perkalian();" id="jumlah_jual" placeholder="Jumlah Penjualan" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="total_harga">Total Harga</label>
                    <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Harga" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Simpan</button>
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