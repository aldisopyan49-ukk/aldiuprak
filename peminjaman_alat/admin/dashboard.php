<?php
session_start();
include '../config/koneksi.php';
include '../templates/header.php';
include '../templates/sidebar.php';

$total_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$total_alat = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM alat"));
$total_pinjam = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman WHERE status='dipinjam'"));
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

.content {
    padding: 20px;
}

/* GLASS */
.card-glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(14px);
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.08);
}

/* STAT */
.stat-card {
    border-radius: 18px;
    transition: 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
}

/* ICON */
.icon-box {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

/* ========================= */
/* 📱 RESPONSIVE */
/* ========================= */

/* Tablet */
@media (max-width: 992px){
    .content {
        padding: 15px;
    }

    h3 {
        font-size: 20px;
    }

    .icon-box {
        width: 42px;
        height: 42px;
        font-size: 18px;
    }
}

/* Mobile */
@media (max-width: 768px){

    .content {
        padding: 10px;
    }

    /* HEADER STACK */
    .content .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 10px;
    }

    /* BADGE */
    .badge {
        align-self: flex-start;
    }

    /* STAT FULL WIDTH */
    .row > div {
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* CARD */
    .stat-card {
        padding: 20px !important;
    }

    h2 {
        font-size: 22px;
    }

    small {
        font-size: 12px;
    }

    .icon-box {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }
}

/* HP kecil */
@media (max-width: 480px){

    h3 {
        font-size: 18px;
    }

    h2 {
        font-size: 20px;
    }

    .stat-card {
        padding: 16px !important;
    }

    .card-glass {
        padding: 16px !important;
    }
}
</style>

<div class="content">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">Dashboard Admin</h3>
            <small class="text-secondary">Monitoring sistem peminjaman alat</small>
        </div>
        <div class="badge bg-primary px-3 py-2" style="border-radius:10px;">
            Admin Panel
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="row g-4 mb-4">

        <!-- USER -->
        <div class="col-lg-4 col-md-6">
            <div class="card stat-card p-4 text-white border-0"
                style="background: linear-gradient(135deg,#3b82f6,#2563eb);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total User</small>
                        <h2 class="fw-bold"><?= $total_user ?></h2>
                    </div>
                    <div class="icon-box" style="background: rgba(255,255,255,0.2);">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ALAT -->
        <div class="col-lg-4 col-md-6">
            <div class="card stat-card p-4 text-white border-0"
                style="background: linear-gradient(135deg,#10b981,#059669);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Total Alat</small>
                        <h2 class="fw-bold"><?= $total_alat ?></h2>
                    </div>
                    <div class="icon-box" style="background: rgba(255,255,255,0.2);">
                        <i class="bi bi-tools"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- DIPINJAM -->
        <div class="col-lg-4 col-md-12">
            <div class="card stat-card p-4 text-white border-0"
                style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small>Sedang Dipinjam</small>
                        <h2 class="fw-bold"><?= $total_pinjam ?></h2>
                    </div>
                    <div class="icon-box" style="background: rgba(255,255,255,0.2);">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- INFO -->
    <div class="card card-glass p-4">
        <h5 class="fw-bold text-white mb-3">
            <i class="bi bi-info-circle me-2"></i> Ringkasan Sistem
        </h5>

        <p class="text-secondary mb-0">
            Dashboard ini digunakan untuk memonitor seluruh aktivitas dalam sistem peminjaman alat.
            Anda dapat mengelola data pengguna, alat, serta memantau proses peminjaman secara real-time.
        </p>
    </div>

</div>