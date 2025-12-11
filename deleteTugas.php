<?php
include 'koneksi.php';

parse_str(file_get_contents("php://input"), $data);
$idTugas = $data['idTugas'] ?? null;

if (empty($idTugas)) {
    http_response_code(400);
    echo "Error: ID Tugas tidak ditemukan.";
    exit;
}

$query = "DELETE FROM tugas WHERE id = $idTugas";

if (mysqli_query(mysql: $koneksi, query: $query)) {
    http_response_code(200);
    echo "Data tugas ID: $idTugas berhasil dihapus.";
} else {
    http_response_code(500);
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}
mysqli_close(mysql: $koneksi);