<?php
//format rrsepone
header('Content-Type: application/json');

include 'koneksi.php';

//Array buat nyimpen data tugas
$tugas = [];
$query = "SELECT id, nama_tugas, deskripsi, tanggal_deadline FROM tugas ORDER BY tanggal_deadline ASC";

if ($hasil = mysqli_query(mysql: $koneksi, query: $query)) {
    while ($kolom = mysqli_fetch_assoc(result: $hasil)) {
        $tugas[] = $kolom;
    }

    mysqli_free_result(result: $hasil);

    //membebaskan memori
    mysqli_free_result(result: $hasil);

    //bagian ini buat ngirim data dgn ngubah array ke format json
    echo json_encode([
        'sukses' => true,
        'data' => $tugas
    ]);
} else {
    //jika queryny ggl
    http_response_code(500);
    echo json_encode([
        'sukses' => false,
        'pesan' => 'Gagal mengambil data: ' . mysqli_error($koneksi)
    ]); 
}
//mnutup kooknesi
mysqli_close(mysql: $koneksi);
?>