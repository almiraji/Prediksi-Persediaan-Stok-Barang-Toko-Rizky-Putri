<?php
include '../koneksi.php';

$delete1 = mysqli_query($koneksi, "DELETE FROM data_barang WHERE id_kategori = '$_GET[id_kategori]'");
$delete2 = mysqli_query($koneksi, "DELETE FROM data_kategori WHERE id_kategori = '$_GET[id_kategori]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_kategori.php'</script>";

?>