CREATE DATABASE ujian_pweb;

USE ujian_pweb;
CREATE TABLE tugas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tugas VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    tanggal_deadline DATE,
    status ENUM('Belum', 'Sudah') DEFAULT 'Belum'
);

INSERT INTO tugas (nama_tugas, deskripsi, tanggal_deadline, status) VALUES
('Praktikum Pweb', 'Ujian_Projek_Akhir', '2025-12-14', 'Belum');