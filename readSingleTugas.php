<?php
header('Content-Type: application/json');
include 'koneksi.php';

$idTugas = $_GET['id'] ?? null;

if (empty($idTugas) || !is_numeric($idTugas)) {
    http_response_code(400); 
    echo json_encode(['success' => false, 'pesan' => 'ID Tugas tidak valid.']);
    exit;
}

$query = "SELECT id, nama_tugas, deskripsi, tanggal_deadline, tugas_stts 
          FROM tugas WHERE id = $idTugas"; 

if ($hasil = mysqli_query($koneksi, $query)) {
    $tugas = mysqli_fetch_assoc($hasil);
    if ($tugas) {
        echo json_encode(['success' => true, 'data' => $tugas]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'pesan' => 'Tugas tidak ditemukan.']);
    }
    mysqli_free_result($hasil);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'pesan' => 'Gagal mengambil data: ' . mysqli_error($koneksi)]); 
}
mysqli_close($koneksi);