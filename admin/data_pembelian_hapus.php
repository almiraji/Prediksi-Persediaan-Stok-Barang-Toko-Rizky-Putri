<?php
include '../koneksi.php';

$id_pembelian = $_GET['id_pembelian'];
$tanggalup    = date("Y-m-d"); 

$querybeli    = mysqli_query($koneksi, "SELECT * FROM data_pembelian WHERE id_pembelian = '$id_pembelian'");
$databeli     = mysqli_fetch_array($querybeli);

$querybarang  = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang = '$databeli[id_barang]'");
$databarang   = mysqli_fetch_array($querybarang);

$stokkembali  = $databarang['stok_barang'] - $databeli['jumlah_beli'];

$updatestok   = mysqli_query($koneksi, "UPDATE data_barang SET stok_barang = '$stokkembali', tanggal_update = '$tanggalup' WHERE id_barang = '$databeli[id_barang]'");

$delete1 = mysqli_query($koneksi, "DELETE FROM data_pembelian WHERE id_pembelian = '$_GET[id_pembelian]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_pembelian.php'</script>";

?>