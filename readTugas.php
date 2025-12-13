<?php
header('Content-Type: application/json');
include 'koneksi.php';

$searchKeyword = $_GET['search'] ?? '';

$response = [
    'belum' => [], 
    'sudah' => []  
];

$query = "SELECT id, nama_tugas, deskripsi, tanggal_deadline, tugas_stts FROM tugas";

if (!empty($searchKeyword)) {
    $safeKeyword = mysqli_real_escape_string($koneksi, '%' . $searchKeyword . '%');
    $query .= " WHERE nama_tugas LIKE '$safeKeyword' OR deskripsi LIKE '$safeKeyword'";
}

$query .= " ORDER BY tanggal_deadline ASC";

if ($hasil = mysqli_query($koneksi, $query)) {
    while ($kolom = mysqli_fetch_assoc($hasil)) {
        if ($kolom['tugas_stts'] == 0) {
            $response['belum'][] = $kolom;
        } else {
            $response['sudah'][] = $kolom;
        }
    }
    mysqli_free_result($hasil); 
    echo json_encode(['success' => true, 'data' => $response]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'pesan' => 'Gagal mengambil data: ' . mysqli_error($koneksi)]); 
}
mysqli_close($koneksi);