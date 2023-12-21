<?php 
include '../dbconnect.php';

$nama=$_POST['nama'];
$jenis=$_POST['jenis'];
$ukuran=$_POST['ukuran'];
$merk=$_POST['merk'];
$satuan=$_POST['satuan'];
$stock=$_POST['stock'];
$lokasi=$_POST['lokasi'];
$query = sqlsrv_query($koneksi, "INSERT INTO sstock_brg (nama, jenis, merk, ukuran, stock, satuan, lokasi) VALUES ('$nama', '$jenis', '$merk', '$ukuran', $stock, '$satuan', '$lokasi')");
$updatedata1 = sqlsrv_query($koneksi, "insert into history_table (tgl,tindakan,jumlah,keterangan) values(getdate(),'tambah stock','$stock','-')");

if ($query) {
  // Berhasil
  echo "<div class='alert alert-success'>
          <strong>Success!</strong> Redirecting you back in 1 second.
        </div>";
  echo "<meta http-equiv='refresh' content='1; url= stock.php'/>";
} else {
  // Gagal
  echo "<div class='alert alert-warning'>
          <strong>Failed!</strong> Redirecting you back in 1 second.
        </div>";
  echo "<meta http-equiv='refresh' content='1; url= stock.php'/>";
  die(print_r(sqlsrv_errors(), true));
}

?>
 
  <html>
<head>
  <title>Tambah Barang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>