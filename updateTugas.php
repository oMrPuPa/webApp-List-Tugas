<?php
include 'koneksi.php';

$idTugas = $_POST['idTugas'] ?? null;

if (empty($idTugas)) {
    echo "Error: ID Tugas tidak valid.";
    exit;
}

if (isset($_POST['status'])) { 
    $newStatus = $_POST['status'];
    $query = "UPDATE tugas SET tugas_stts = '$newStatus' WHERE id = '$idTugas'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "Status tugas ID: $idTugas berhasil diperbarui.";
    } else {
        echo "Error saat update status: " . mysqli_error($koneksi);
    }
    
} else { 
    $namaTugas = $_POST['namaTugas'] ?? null;
    $deskripsi = $_POST['deskripsiTugas'] ?? null;
    $tanggalDeadline = $_POST['tanggalDeadline'] ?? null;

    if (empty($namaTugas) || empty($tanggalDeadline)) {
        echo "Error: Field Nama dan Deadline harus diisi.";
        exit;
    }

    $query = "UPDATE tugas SET 
                nama_tugas = '$namaTugas', 
                deskripsi = '$deskripsi', 
                tanggal_deadline = '$tanggalDeadline'
              WHERE id = '$idTugas'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data tugas ID: $idTugas berhasil diperbarui secara penuh.";
    } else {
        echo "Error saat update penuh: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);