<?php
include '../koneksi.php';

$id_penjualan = $_GET['id_penjualan'];
$tanggalup    = date("Y-m-d");

$queryjual    = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id_penjualan'");
$datajual     = mysqli_fetch_array($queryjual);
$bulan_jual   = date("m", strtotime($datajual['tanggal_jual']));
$tahun_jual   = date("Y", strtotime($datajual['tanggal_jual']));

include 'src/kondisi_bulan.php';

$queryrekap   = mysqli_query($koneksi, "SELECT * FROM data_rekap WHERE id_barang = '$datajual[id_barang]'");
$datarekap  = mysqli_fetch_array($queryrekap);
$upkembali  = $datarekap['stok_terjual'] - $datajual['jumlah_jual'];

$update     = mysqli_query($koneksi, "UPDATE data_rekap SET stok_terjual = '$upkembali' WHERE id_barang = '$datajual[id_barang]'");

$querybarang  = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang = '$datajual[id_barang]'");
$databarang   = mysqli_fetch_array($querybarang);

$stokkembali  = $databarang['stok_barang'] + $datajual['jumlah_jual'];

$updatestok   = mysqli_query($koneksi, "UPDATE data_barang SET stok_barang = '$stokkembali', tanggal_update = '$tanggalup' WHERE id_barang = '$datajual[id_barang]'");

$delete1 = mysqli_query($koneksi, "DELETE FROM data_penjualan WHERE id_penjualan = '$_GET[id_penjualan]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_penjualan.php'</script>";
