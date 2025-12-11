<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$namadb = 'ujian_pweb';
$koneksi = mysqli_connect($host, $user, $pass, $namadb);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>