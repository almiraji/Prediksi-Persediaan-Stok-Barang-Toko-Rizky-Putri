<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
   $nama_user  = $_POST['nama_user'];
   $username   = $_POST['username'];
   $password   = $_POST['password'];
   $level   = $_POST['level'];

   $simpan = mysqli_query($koneksi, "UPDATE data_user SET nama_user = '$nama_user', username = '$username', password = '$password', level = '$level' WHERE id_user = '$_GET[id_user]'");
   echo "<script>alert('Data Berhasil Di Simpan');window.location='data_user.php'</script>";
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
         $id_user     = $_GET['id_user'];
         $query       = mysqli_query($koneksi, "SELECT * FROM data_user WHERE id_user = '$id_user'");
         $data        = mysqli_fetch_array($query);
         ?>
         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="" method="POST">
                           <div class="form-group">
                              <label class="form-control-label" for="nama_user">Nama Lengkap</label>
                              <input type="text" class="form-control" name="nama_user" value="<?= $data['nama_user'] ?>" autocomplete="off" placeholder="Nama Lengkap" required autofocus>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="username">Username</label>
                              <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" autocomplete="off" placeholder="Username" required>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="password">Password</label>
                              <input type="text" class="form-control" name="password" value="<?= $data['password'] ?>" autocomplete="off" placeholder="Password" required>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="level">Level</label>
                              <select class="form-control" name="level" required>
                                 <?php
                                 ?>
                                 <option value="<?= $data['level'] ?>" <?php if ($data['level'] == 'admin') {
                                                                           echo "selected";
                                                                        } else {
                                                                           echo "selected";
                                                                        } ?>><?= $data['level'] ?></option>
                                 <?php
                                 ?>
                              </select>
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