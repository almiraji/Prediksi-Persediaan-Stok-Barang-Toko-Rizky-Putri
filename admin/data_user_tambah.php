<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
   $nama_user  = $_POST['nama_user'];
   $username   = $_POST['username'];
   $password   = $_POST['password'];
   $level   = $_POST['level'];

   $querycek = mysqli_query($koneksi, "SELECT * FROM data_user WHERE username = '$username'");
   $datacek  = mysqli_num_rows($querycek);

   if ($datacek > 0) {
      echo "<script>alert('Username Sudah Ada');window.location='data_user_tambah.php'</script>";
   } else {
      $simpan = mysqli_query($koneksi, "INSERT INTO data_user VALUES('','$nama_user','$username','$password','$level')");
      echo "<script>alert('Data Berhasil Di Simpan');window.location='data_user.php'</script>";
   }
}
?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>TAMBAH DATA USER</h2>
            </div>
         </div>

         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                              <label class="form-control-label" for="nama_user">Nama Lengkap</label>
                              <input type="text" class="form-control" name="nama_user" autocomplete="off" placeholder="Nama Lengkap" required autofocus>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="username">Username</label>
                              <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" required>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="password">Password</label>
                              <input type="text" class="form-control" name="password" autocomplete="off" placeholder="Password" required>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="level">Level</label>
                              <select class="form-control" name="level" required>
                                 <option value="">-- Pilih Level --</option>
                                 <option value="admin">Admin</option>
                                 <option value="pemilik">Pemilik</option>
                              </select>
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