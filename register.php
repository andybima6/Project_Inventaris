<!doctype html>
<html class="no-js" lang="en">

<?php
include 'dbconnect.php';

if (isset($_POST['btn-register'])) {
	$uname = $_POST['username'];
	$upass = $_POST['password'];
	$nickname = $_POST['nickname'];

	// Ensuring $conn is a valid database connection
	if (!$koneksi) {
		die(print_r(sqlsrv_errors(), true));
	}

	// Gunakan prepared statement untuk mencegah SQL injection
	$sql = "INSERT INTO slogin (username, password, nickname, role) VALUES (?, ?, ?, 'stock')";
	$params = array($uname, md5($upass), $nickname);
	$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$stmt = sqlsrv_query($koneksi, $sql, $params, $options);

	// Periksa apakah query berhasil
	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}

	// Redirect ke halaman setelah registrasi
	header("location:index.php");
}

sqlsrv_close($koneksi);
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System Register</title>
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
				<label>Register</label><br \>
			</div>
			<form method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Username" name="username" autofocus>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Nickname" name="nickname">
				</div>
				<button type="submit" class="btn btn-primary" name="btn-register">Register</button>
			</form>

			<br \>
		</div>
	</div>

</body>

</html>