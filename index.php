<?php
session_start();
include 'dbconnect.php';

if (isset($_SESSION['role'])) {
	header("location:stock");
}

if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "gagal") {
		echo "Username atau Password salah!";
	} else if ($_GET['pesan'] == "logout") {
		echo "Anda berhasil keluar dari sistem";
	} else if ($_GET['pesan'] == "belum_login") {
		echo "Anda harus Login";
	} else if ($_GET['pesan'] == "noaccess") {
		echo "Akses Ditutup";
	}
}

if (isset($_POST['btn-login'])) {
	$uname = $_POST['username'];
	$upass = $_POST['password'];

	// Ensure $conn is a valid database connection
	if (!$koneksi) {
		die(print_r(sqlsrv_errors(), true));
	}

	// Use prepared statement to prevent SQL injection
	$sql = "SELECT * FROM slogin WHERE username=? AND password=?";
	$params = array($uname, md5($upass));
	$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$stmt = sqlsrv_query($koneksi, $sql, $params, $options);

	// Check if the query was successful
	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}

	// Check if username and password are found in the database
	if (sqlsrv_num_rows($stmt) > 0) {
		$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

		// Set session variables
		$_SESSION['user'] = $data['nickname'];
		$_SESSION['user_login'] = $data['username'];
		$_SESSION['id'] = $data['id'];
		$_SESSION['role'] = "stock";

		// Redirect based on user role
		if ($data['role'] == "stock") {
			header("location:stock");
		} else {
			header("location:index.php?pesan=gagal");
		}
	} else {
		header("location:index.php?pesan=gagal");
	}

	sqlsrv_free_stmt($stmt);
	sqlsrv_close($koneksi);
}

if (isset($_POST['btn-register'])) {
	$uname = $_POST['username'];
	$upass = $_POST['password'];

	// Ensure $conn is a valid database connection
	if (!$koneksi) {
		die(print_r(sqlsrv_errors(), true));
	}

	// Use prepared statement to prevent SQL injection
	$sql = "INSERT INTO slogin (username, password, role) VALUES (?, ?, ?)";
	$params = array($uname, md5($upass), "stock");
	$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$stmt = sqlsrv_query($koneksi, $sql, $params, $options);

	// Check if the query was successful
	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}

	// Check if the registration was successful
	if (sqlsrv_rows_affected($stmt) > 0) {
		// Redirect to login page or any other page as needed
		header("location:index.php?pesan=registrasi_sukses");
	} else {
		header("location:index.php?pesan=registrasi_gagal");
	}

	sqlsrv_free_stmt($stmt);
	sqlsrv_close($koneksi);
}

?>



?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-144808195-1');
	</script>
	<script src="jquery.min.js"></script>
	<style>
		body {
			background-image: url("bg.jpg");
		}

		@media screen and (max-width: 600px) {
			h4 {
				font-size: 85%;
			}
		}
	</style>
	<link rel="icon" type="image/png" href="favicon.png">
</head>

<body>

	<div align="center">
		<br /><br />
		<div class="container">
			<div class="judul" style="color:white; font-size: 90px; font-family: 'Arial', sans-serif;">
				<p>Inventory Logistic</p>
			</div>

			<div style="color:white">

				<label>Username & Password </label><br \>
			</div>
			<form method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" name="username" autofocus>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password">
				</div>
				<button type="submit" class="btn btn-primary" name="btn-login">Masuk</button>


				<!-- Menggunakan elemen <button> dengan skrip JavaScript -->
				<button type="button" class="btn btn-primary" onclick="window.location.href='register.php'">Register</button>


			</form>

			<br \>
		</div>
	</div>




</body>

</html>