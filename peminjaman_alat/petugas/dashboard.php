<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'petugas'){
    header("Location: ../auth/login.php");
    exit;
}

// aksi approve / tolak
if(isset($_GET['aksi']) && isset($_GET['id'])){
    $id_pinjam = $_GET['id'];
    $status_baru = ($_GET['aksi'] == 'setuju') ? 'dipinjam' : 'ditolak';
    
    mysqli_query($conn, "UPDATE peminjaman SET status='$status_baru' WHERE id='$id_pinjam'");
    header("Location: dashboard_petugas.php");
}

// statistik
$total_pending = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM peminjaman WHERE status='pending'"));
$total_pinjam = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM peminjaman WHERE status='dipinjam'"));
$terlambat = mysqli_num_rows(mysqli_query($conn,"
    SELECT id FROM peminjaman 
    WHERE status='dipinjam' 
    AND tanggal_pinjam < DATE_SUB(CURDATE(), INTERVAL 3 DAY)
"));

include '../templates/header.php';
include '../templates/sidebar.php';
?>

<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

.content {
    padding: 20px;
}

/* Glass */
.card-glass {
    background: rgba(255, 255, 255, 0.04);
    backdrop-filter: blur(14px);
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.08);
}

/* Statistik */
.stat-card {
    border-radius: 18px;
    transition: 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
}

/* Table */
.table-modern thead {
    background: rgba(255,255,255,0.05);
}
.table-modern tbody tr:hover {
    background: rgba(255,255,255,0.05);
}

/* Button */
.btn-approve {
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    border: none;
}

/* Badge */
.role-badge {
    background: linear-gradient(135deg,#3b82f6,#2563eb);
    border-radius: 999px;
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

    /* HEADER STACK */
    .content .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 10px;
    }

    /* STAT JADI 1 KOLOM */
    .row > div {
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* TABLE */
    .table {
        font-size: 13px;
    }

    /* BUTTON FULL */
    .btn {
        width: 100%;
        margin-bottom: 5px;
    }

    /* AKSI STACK */
    td.text-center {
        display: flex;
        flex-direction: column;
        gap: 5px;
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

    .table {
        font-size: 12px;
    }
}
</style>

<div class="content">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">Dashboard</h3>
            <small class="text-secondary">Monitoring & Persetujuan Peminjaman</small>
        </div>
        <div class="role-badge text-white px-3 py-2">
            <i class="bi bi-person-badge me-1"></i> Petugas
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card stat-card p-4 text-white border-0" style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                <small>Butuh Persetujuan</small>
                <h2 class="fw-bold"><?= $total_pending ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-4 text-white border-0" style="background: linear-gradient(135deg,#6366f1,#4338ca);">
                <small>Sedang Dipinjam</small>
                <h2 class="fw-bold"><?= $total_pinjam ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-4 text-white border-0" style="background: linear-gradient(135deg,#f43f5e,#e11d48);">
                <small>Terlambat</small>
                <h2 class="fw-bold"><?= $terlambat ?></h2>
            </div>
        </div>
    </div>

    <!-- PERMINTAAN -->
    <div class="card card-glass p-4 mb-4">
        <h5 class="fw-bold text-white mb-4">🔔 Permintaan Baru</h5>

        <div class="table-responsive">
            <table class="table table-modern text-white align-middle">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $pending = mysqli_query($conn,"SELECT p.*, u.nama, a.nama_alat FROM peminjaman p 
                            JOIN users u ON p.user_id=u.id 
                            JOIN alat a ON p.alat_id=a.id 
                            WHERE p.status='pending'");

                if(mysqli_num_rows($pending) == 0){
                    echo "<tr><td colspan='4' class='text-center'>Belum ada permintaan</td></tr>";
                }

                while($p = mysqli_fetch_assoc($pending)){
                ?>

                <tr>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['nama_alat'] ?></td>
                    <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                    <td class="text-center">
                        <a href="?aksi=setuju&id=<?= $p['id'] ?>" class="btn btn-approve btn-sm text-white">
                            ✓ Setujui
                        </a>
                        <a href="?aksi=tolak&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm">
                            ✕ Tolak
                        </a>
                    </td>
                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MONITORING -->
    <div class="card card-glass p-4">
        <h5 class="fw-bold text-white mb-4">🔄 Monitoring Pengembalian</h5>

        <div class="table-responsive">
            <table class="table table-modern text-white align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Alat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $aktif = mysqli_query($conn,"SELECT p.*, u.nama, a.nama_alat FROM peminjaman p 
                            JOIN users u ON p.user_id=u.id 
                            JOIN alat a ON p.alat_id=a.id 
                            WHERE p.status='dipinjam'");

                while($d = mysqli_fetch_assoc($aktif)){
                    $is_late = (strtotime($d['tanggal_pinjam']) < strtotime('-3 days'));
                ?>

                <tr>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['nama_alat'] ?></td>
                    <td>
                        <?php if($is_late): ?>
                            <span class="badge bg-danger">Terlambat</span>
                        <?php else: ?>
                            <span class="badge bg-success">Dipinjam</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="peminjaman.php?kembali=<?= $d['id'] ?>" class="btn btn-success btn-sm">
                            Kembalikan
                        </a>
                    </td>
                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>