<?php
include 'koneksi.php';

$namaTugas = $_POST['namaTugas'] ?? null;
$deskripsi = $_POST['deskripsiTugas'] ?? null;
$tanggalDeadline = $_POST['tanggalDeadline'] ?? null;

if (empty($namaTugas)) {
    echo "Error: Nama tugas tidak boleh kosong.";
    exit;
}

$query = "INSERT INTO tugas (nama_tugas, deskripsi, tanggal_deadline, tugas_stts) 
          VALUES ('$namaTugas', '$deskripsi', '$tanggalDeadline', 0)"; 

if (mysqli_query($koneksi, $query)) {
    echo "Tugas baru berhasil ditambahkan.";
} else {
    echo "Error saat create: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);