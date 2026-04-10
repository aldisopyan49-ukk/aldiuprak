<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/".$gambar);

    mysqli_query($conn,"INSERT INTO alat VALUES(NULL,'$nama','$stok','baik','$gambar')");
}

include '../templates/header.php';
include '../templates/sidebar.php';
?>

<!-- STYLE -->
<style>
body {
    background: #f1f5f9;
}

/* CONTENT */
.content {
    padding: 20px;
}

/* CARD */
.card {
    border-radius: 14px;
    border: none;
}

/* ALAT CARD */
.alat-card {
    border-radius: 14px;
    overflow: hidden;
    transition: 0.3s;
}
.alat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* IMAGE */
.alat-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

/* ========================= */
/* 📱 RESPONSIVE */
/* ========================= */

/* Tablet */
@media (max-width: 992px){
    .content {
        padding: 15px;
    }
}

/* Mobile */
@media (max-width: 768px){

    .content {
        padding: 10px;
    }

    /* FORM JADI VERTICAL */
    .row.form-row > div {
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* GRID ALAT 2 KOLOM */
    .row.alat-row > div {
        flex: 0 0 50%;
        max-width: 50%;
    }

    h2 {
        font-size: 20px;
    }
}

/* HP kecil */
@media (max-width: 480px){

    /* GRID JADI 1 KOLOM */
    .row.alat-row > div {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .alat-img {
        height: 140px;
    }

    h2 {
        font-size: 18px;
    }
}
</style>

<div class="content">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="fw-bold text-primary">📦 Kelola Alat</h2>
        <p class="text-muted">Tambah dan lihat daftar alat</p>
    </div>

    <!-- FORM -->
    <div class="card p-4 mb-4 shadow-sm">
        <h5 class="fw-bold mb-3">➕ Tambah Alat</h5>

        <form method="POST" enctype="multipart/form-data">
            <div class="row form-row">

                <div class="col-md-4 mb-3">
                    <input name="nama" class="form-control" placeholder="Nama alat" required>
                </div>

                <div class="col-md-3 mb-3">
                    <input name="stok" type="number" class="form-control" placeholder="Stok" required>
                </div>

                <div class="col-md-3 mb-3">
                    <input type="file" name="gambar" class="form-control" required>
                </div>

                <div class="col-md-2 mb-3">
                    <button name="tambah" class="btn btn-primary w-100">
                        Tambah
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- LIST ALAT -->
    <div class="card p-4 shadow-sm">
        <h5 class="fw-bold mb-3">📋 Daftar Alat</h5>

        <div class="row alat-row">
        <?php
        $data = mysqli_query($conn,"SELECT * FROM alat ORDER BY id DESC");
        while($d = mysqli_fetch_assoc($data)){
        ?>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card alat-card h-100">

                    <img src="../uploads/<?= $d['gambar'] ?>" 
                         class="alat-img">

                    <div class="p-3">
                        <h6 class="fw-bold"><?= $d['nama_alat'] ?></h6>
                        <p class="text-muted mb-2">Stok: <?= $d['stok'] ?></p>

                        <span class="badge bg-success">Baik</span>
                    </div>

                </div>
            </div>
        <?php } ?>
        </div>

    </div>

</div>