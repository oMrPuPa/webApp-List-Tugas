<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$namadb = 'ujian_pweb';
$koneksi = mysqli_connect(hostname: $host,username: $user,password: $pass,database: $namadb);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
