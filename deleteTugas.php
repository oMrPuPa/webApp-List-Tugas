<?php
include 'koneksi.php';

$idTugas = $_POST['idTugas'] ?? null;

if (empty($idTugas)) {
    echo "Error: ID Tugas tidak valid.";
    exit;
}

$query = "DELETE FROM tugas WHERE id = '$idTugas'";

if (mysqli_query($koneksi, $query)) {
    echo "Tugas ID: $idTugas berhasil dihapus.";
} else {
    echo "Error saat delete: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>