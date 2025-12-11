<?php
include 'koneksi.php';

parse_str(file_get_contents("php://input"), $data);
$idTugas = $data['idTugas'] ?? null;
$namaTugas = $data['namaTugas'] ?? null;
$deskripsi = $data['deskripsiTugas'] ?? null;
$tanggalDeadline = $data['tanggalDeadline'] ?? null;

if (empty($idTugas)) {
    echo "Error: ID Tugas tidak ditemukan.";
    exit;
}
$query = "UPDATE tugas SET nama_tugas = '$namaTugas', deskripsi = '$deskripsi', tanggal_deadline = '$tanggalDeadline' WHERE id = $idTugas";
if (mysqli_query(mysql: $koneksi, query: $query)) {
    echo "Data tugas ID: $idTugas berhasil di edit.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
mysqli_close(mysql: $koneksi);
?> 