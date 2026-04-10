CREATE DATABASE peminjaman_alat;
USE peminjaman_alat;

-- TABEL USER
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(255),
    role ENUM('admin','petugas','user')
);

-- TABEL ALAT
CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100),
    stok INT,
    kondisi VARCHAR(50)
);

-- TABEL PEMINJAMAN
CREATE TABLE peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    alat_id INT,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    status ENUM('dipinjam','dikembalikan'),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (alat_id) REFERENCES alat(id)
);

-- USER DEFAULT
INSERT INTO users VALUES
(1,'Admin','admin',MD5('admin123'),'admin'),
(2,'Petugas','petugas',MD5('petugas123'),'petugas'),
(3,'User','user',MD5('user123'),'user');