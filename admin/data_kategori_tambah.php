<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
   $kategori  = $_POST['kategori'];
   $pengisi = $_SESSION['nama'];

   $querycek = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE kategori = '$kategori'");
   $datacek  = mysqli_num_rows($querycek);

   if ($datacek > 0) {
      echo "<script>alert('Kategori Sudah Ada');window.location='data_kategori_tambah.php'</script>";
   } else {
      $simpan = mysqli_query($koneksi, "INSERT INTO data_kategori VALUES('','$kategori','$pengisi')");
      echo "<script>alert('Data Berhasil Di Simpan');window.location='data_kategori.php'</script>";
   }
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>TAMBAH DATA KATEGORI</h2>
            </div>
         </div>

         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                              <label class="form-control-label" for="kategori">Kategori Barang</label>
                              <input type="text" class="form-control" name="kategori" autocomplete="off" placeholder="Kategori Barang" required autofocus>
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