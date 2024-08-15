<?php
include "koneksi.php";

if (isset($_POST['login'])) {
	session_start();
	$username    = $_POST['username'];
	$password    = $_POST['password'];

	$login = mysqli_query($koneksi, "SELECT * FROM data_user WHERE username = '$username' AND password = '$password'");
	$cek   = mysqli_num_rows($login);

	if ($cek > 0) {
		$data  = mysqli_fetch_assoc($login);
		$_SESSION['login']   = "Login";
		$_SESSION['id']      = $data['id_user'];
		$_SESSION['nama']    = $data['nama_user'];
		$_SESSION['level']   = $data['level'];
		echo "<script>alert('Login Berhasil! Selamat Datang $data[nama_user]');window.location='admin/index.php'</script>";
	} else {
		echo "<script>alert('Login Gagal! Silahkan Cek Username dan Password Anda');window.location='index.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sistem Prediksi Persediaan Stok Barang Toko Rizky Putri</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">

</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-26">
						<h4>Sistem Prediksi persediaan Stok Barang Toko Rizky Putri</h4>
					</span>
					<span class="login100-form-title p-b-20">
						<img src="logo.png" width="30%">
					</span>

					<div class="wrap-input100 validate-input" data-validate="Masukkan Username">
						<input class="input100" type="text" name="username" placeholder="Username" required autocomplete="off" autofocus>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" placeholder="Password" required autocomplete="off">
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="login">
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>
	<script src="assets/js/main.js"></script>

</body>

</html>