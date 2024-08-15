<?php
include '../koneksi.php';

$delete2 = mysqli_query($koneksi, "DELETE FROM data_user WHERE id_user = '$_GET[id_user]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_user.php'</script>";

?>