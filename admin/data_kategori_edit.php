<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
   $kategori  = $_POST['kategori'];
   $pengisi = $_SESSION['nama'];

   $simpan = mysqli_query($koneksi, "UPDATE data_kategori SET kategori = '$kategori', pengisi = '$pengisi' WHERE id_kategori = '$_GET[id_kategori]'");
   echo "<script>alert('Data Berhasil Di Simpan');window.location='data_kategori.php'</script>";
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>EDIT DATA USER</h2>
            </div>
         </div>
         <?php
         $id_kategori = $_GET['id_kategori'];
         $query       = mysqli_query($koneksi, "SELECT * FROM data_kategori WHERE id_kategori = '$id_kategori'");
         $data        = mysqli_fetch_array($query);
         ?>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                              <label class="form-control-label" for="kategori">Kategori Barang</label>
                              <input type="text" class="form-control" name="kategori" value="<?= $data['kategori'] ?>" autocomplete="off" placeholder="Kategori Barang" required autofocus>
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

<?php include 'src/footer.php'; ?>