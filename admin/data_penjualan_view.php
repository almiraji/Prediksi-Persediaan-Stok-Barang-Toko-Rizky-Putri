<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>VIEW DATA PENJUALAN</h2>
        </div>
      </div>

      <?php
      $id_penjualan = $_GET['id_penjualan'];
      $query        = mysqli_query($koneksi, "SELECT * FROM data_kategori a, data_barang b, data_penjualan c WHERE b.id_kategori = a.id_kategori AND c.id_barang = b.id_barang AND c.id_penjualan = '$id_penjualan'");
      $data         = mysqli_fetch_array($query);
      ?>

      <div class="full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <div class="table-responsive-sm">
                <form action="data_penjualan.php" method="POST">
                  <div class="form-group">
                    <label class="form-control-label" for="id_kategori">Kategori Barang</label>
                    <input type="text" class="form-control" name="id_kategori" value="<?= $data['kategori'] ?>" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="id_barang">Nama Barang</label>
                    <input type="text" class="form-control" name="id_barang" value="<?= $data['nama_barang'] ?>" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="tanggal_jual">Tanggal Penjualan</label>
                    <input type="date" class="form-control" name="tanggal_jual" value="<?= $data['tanggal_jual'] ?>" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="harga_jual">Harga</label>
                    <input type="number" class="form-control" name="harga_jual" value="<?= $data['harga_jual'] ?>" id="harga_jual" placeholder="Harga" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="jumlah_jual">Jumlah Penjualan</label>
                    <input type="number" class="form-control" name="jumlah_jual" value="<?= $data['jumlah_jual'] ?>" onkeyup="perkalian();" id="jumlah_jual" placeholder="Jumlah Penjualan" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="total_harga">Total Harga</label>
                    <input type="number" class="form-control" name="total_harga" value="<?= $data['total_harga'] ?>" id="total_harga" placeholder="Harga" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="pengisi">Pengisi Data</label>
                    <input type="text" class="form-control" name="pengisi" value="<?= $data['pengisi'] ?>" id="pengisi" placeholder="Pengisi Data" autocomplete="off" readonly>
                  </div>
                  <div class="form-group">
                    <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Kembali</button>
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