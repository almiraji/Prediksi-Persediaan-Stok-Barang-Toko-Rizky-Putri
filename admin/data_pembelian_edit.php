<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
  $id_pembelian = $_GET['id_pembelian'];
  $id_barang    = $_POST['id_barang'];
  $tanggal_beli = $_POST['tanggal_beli'];
  $harga_beli   = $_POST['harga_beli'];
  $jumlah_beli  = $_POST['jumlah_beli'];
  $total_harga  = $_POST['total_harga'];
  $pengisi      = $_SESSION['nama'];

  $querybeli    = mysqli_query($koneksi, "SELECT * FROM data_pembelian WHERE id_pembelian = '$id_pembelian'");
  $databeli     = mysqli_fetch_array($querybeli);

  $querybarang  = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang = '$databeli[id_barang]'");
  $databarang   = mysqli_fetch_array($querybarang);

  $stokkembali  = $databarang['stok_barang'] - $databeli['jumlah_beli'];
  $stokupdate   = $stokkembali + $jumlah_beli;

  $updatestok   = mysqli_query($koneksi, "UPDATE data_barang SET stok_barang = '$stokupdate', tanggal_update = '$tanggal_beli' WHERE id_barang = '$id_barang'");

  $simpan = mysqli_query($koneksi, "UPDATE data_pembelian SET id_barang = '$id_barang', tanggal_beli = '$tanggal_beli', harga_beli = '$harga_beli', jumlah_beli = '$jumlah_beli', total_harga = '$total_harga', pengisi = '$pengisi' WHERE id_pembelian = '$id_pembelian'");

  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_pembelian.php'</script>";
}
?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>EDIT DATA PEMBELIAN</h2>
        </div>
      </div>

      <?php
      $id_pembelian = $_GET['id_pembelian'];
      $query        = mysqli_query($koneksi, "SELECT * FROM data_pembelian WHERE id_pembelian = '$id_pembelian'");
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
                    <label class="form-control-label" for="tanggal_beli">Tanggal Pembelian</label>
                    <input type="date" class="form-control" name="tanggal_beli" value="<?= $data['tanggal_beli'] ?>" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="harga_beli">Harga</label>
                    <input type="number" class="form-control" name="harga_beli" id="harga_beli" value="<?= $data['harga_beli'] ?>" placeholder="Harga" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="jumlah_beli">Jumlah Pembelian</label>
                    <input type="number" class="form-control" name="jumlah_beli" value="<?= $data['jumlah_beli'] ?>" onkeyup="perkalian();" id="jumlah_beli" placeholder="Jumlah Pembelian" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="total_harga">Total Harga</label>
                    <input type="number" class="form-control" name="total_harga" id="total_harga" value="<?= $data['total_harga'] ?>" placeholder="Harga" autocomplete="off" readonly>
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
    var number3 = document.getElementById('jumlah_beli').value;
    var number4 = document.getElementById('harga_beli').value;
    var hasil2 = parseInt(number3) * parseInt(number4);
    if (!isNaN(hasil2)) {
      document.getElementById('total_harga').value = hasil2;
    }
  }
</script>

<?php include 'src/footer.php'; ?>