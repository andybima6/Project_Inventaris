<?php
// isi nama host, username mysql, dan password mysql anda
$servername = "LAPTOP-3F2K575I\SQL2017ANDY";

$connectionInfo = array("Database" => "inventory");
$koneksi = sqlsrv_connect($servername, $connectionInfo);

if ($koneksi === false) {
    die("Koneksi Database Gagal: " . print_r(sqlsrv_errors(), true));
}
?>
