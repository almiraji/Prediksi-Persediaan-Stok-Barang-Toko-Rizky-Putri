<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
   $id_kategori     = $_POST['id_kategori'];
   $nama_barang     = $_POST['nama_barang'];
   $ukuran          = $_POST['ukuran'];
   $stok_barang     = $_POST['stok_barang'];
   $pengisi         = $_SESSION['nama'];
   $tanggal_update  = date("Y-m-d");

   $qry = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE nama_barang = '$nama_barang' AND ukuran = '$ukuran'");
   $qry = mysqli_num_rows($qry);

   if ($qry > 0) {
      echo "<script>alert('Data Sudah Ada, Mohon Input Data yang Lain');window.location='data_barang.php'</script>";
   } else {
      $simpan = mysqli_query($koneksi, "INSERT INTO data_barang VALUES('','$id_kategori','$nama_barang','$ukuran','$stok_barang','$tanggal_update','$pengisi')");
      echo "<script>alert('Data Berhasil Di Simpan');window.location='data_barang.php'</script>";
   }
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>TAMBAH DATA BARANG</h2>
            </div>
         </div>

         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                              <label class="form-control-label" for="id_kategori">Kategori Barang</label>
                              <select class="form-control" name="id_kategori" required>
                                 <option value="">-- Pilih Kategori Barang --</option>
                                 <?php
                                 $querybarang = mysqli_query($koneksi, "SELECT * FROM data_kategori");
                                 while ($databarang = mysqli_fetch_array($querybarang)) {
                                 ?>
                                    <option value="<?= $databarang['id_kategori'] ?>"><?= $databarang['kategori'] ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="nama_barang">Nama Barang</label>
                              <input type="text" class="form-control" name="nama_barang" autocomplete="off" placeholder="Nama Barang" required>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="ukuran">Ukuran</label>
                              <input type="text" class="form-control" name="ukuran" autocomplete="off" placeholder="Ukuran" required>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="stok_barang">Stok Barang</label>
                              <input type="number" class="form-control" name="stok_barang" autocomplete="off" placeholder="Stok Barang" required>
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

<?php include 'src/footer.php'; ?>