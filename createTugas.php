<?php
include 'koneksi.php';
$namaTugas = $_POST['namaTugas'];
$deskripsi = $_POST['deskripsiTugas'];
$tanggalDeadline = $_POST['tanggalDeadline'];
$query = "INSERT INTO tugas (nama_tugas, deskripsi, tanggal_deadline) VALUES ('$namaTugas', '$deskripsi', '$tanggalDeadline')";

if (mysqli_query(mysql: $koneksi, query: $query)) {
    echo "Tugas berhasil ditambahkan.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
mysqli_close(mysql: $koneksi);
?>
