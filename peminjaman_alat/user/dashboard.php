<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'user'){
    header("Location: ../auth/login.php");
    exit;
}

$id = $_SESSION['id'];

// statistik
$dipinjam = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman WHERE user_id='$id' AND status='dipinjam'"));
$selesai = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman WHERE user_id='$id' AND status='dikembalikan'"));
$terlambat = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman WHERE user_id='$id' AND status='dipinjam' AND tanggal_pinjam < DATE_SUB(CURDATE(), INTERVAL 3 DAY)"));

include '../templates/header.php';
include '../templates/sidebar.php';
?>

<!-- FONT & ICON -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

/* CARD GLASS */
.card-glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(14px);
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
}

/* STAT CARD */
.stat-card {
    border-radius: 18px;
    transition: 0.3s;
}
.stat-card:hover {
    transform: translateY(-5px);
}

/* TOOL CARD */
.tool-card {
    background:#1e293b;
    border-radius: 14px;
    overflow: hidden;
    transition: 0.3s;
}
.tool-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

/* TABLE */
.table-modern thead {
    background: rgba(255,255,255,0.05);
}
.table-modern tbody tr:hover {
    background: rgba(255,255,255,0.05);
}
.table td, .table th {
    padding: 14px;
}

/* ANIMASI */
.card {
    animation: fadeIn 0.4s ease;
}
@keyframes fadeIn {
    from { opacity:0; transform:translateY(10px);}
    to { opacity:1; transform:translateY(0);}
}
</style>

<div class="content">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold text-white">👋 Selamat datang</h3>
        <small class="text-secondary">Kelola peminjaman alat dengan mudah & cepat</small>
    </div>

    <!-- STAT -->
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card stat-card p-4 text-white border-0" style="background: linear-gradient(135deg,#38bdf8,#0ea5e9);">
                <div class="d-flex justify-content-between">
                    <div>
                        <small>Sedang Dipinjam</small>
                        <h2 class="fw-bold"><?= $dipinjam ?></h2>
                    </div>
                    <i class="bi bi-box-seam fs-2 opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-4 text-white border-0" style="background: linear-gradient(135deg,#22c55e,#16a34a);">
                <div class="d-flex justify-content-between">
                    <div>
                        <small>Selesai</small>
                        <h2 class="fw-bold"><?= $selesai ?></h2>
                    </div>
                    <i class="bi bi-check-circle fs-2 opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-4 border-0" style="background: linear-gradient(135deg,#facc15,#eab308);">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-dark">Terlambat</small>
                        <h2 class="fw-bold text-dark"><?= $terlambat ?></h2>
                    </div>
                    <i class="bi bi-exclamation-triangle fs-2 text-dark opacity-75"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- ALAT -->
    <div class="card card-glass p-4 mb-4">
        <h5 class="fw-bold text-white mb-4">📦 Alat Tersedia</h5>

        <div class="row">
        <?php
        $alat = mysqli_query($conn,"SELECT * FROM alat ORDER BY id DESC LIMIT 6");

        if(mysqli_num_rows($alat) == 0){
            echo "<div class='text-center text-secondary'>Tidak ada alat</div>";
        }

        while($a = mysqli_fetch_assoc($alat)){
        ?>
            <div class="col-md-4 mb-3">
                <div class="tool-card h-100">

                    <img src="../uploads/<?= $a['gambar'] ?>" 
                         style="height:160px; width:100%; object-fit:cover;">

                    <div class="p-3">
                        <h6 class="fw-bold text-white"><?= $a['nama_alat'] ?></h6>
                        <p class="mb-2 text-secondary">Stok: <?= $a['stok'] ?></p>

                        <a href="pinjam.php?id=<?= $a['id'] ?>" class="btn btn-info btn-sm w-100">
                            Pinjam Sekarang
                        </a>
                    </div>

                </div>
            </div>
        <?php } ?>
        </div>
    </div>

    <!-- RIWAYAT -->
    <div class="card card-glass p-4">
        <h5 class="fw-bold text-white mb-4">📄 Riwayat Peminjaman</h5>

        <div class="table-responsive">
        <table class="table table-borderless table-modern text-white align-middle">
            <thead>
                <tr>
                    <th>Alat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $data = mysqli_query($conn,"
                SELECT p.*, a.nama_alat 
                FROM peminjaman p 
                JOIN alat a ON p.alat_id=a.id 
                WHERE p.user_id='$id'
                ORDER BY p.id DESC LIMIT 5
            ");

            if(mysqli_num_rows($data) == 0){
                echo "
                <tr>
                    <td colspan='4' class='text-center py-5'>
                        <i class='bi bi-inbox fs-1 text-secondary'></i>
                        <div class='text-secondary'>Belum ada riwayat</div>
                    </td>
                </tr>";
            }

            while($d = mysqli_fetch_assoc($data)){

                if($d['status']=='dipinjam'){
                    $badge = 'bg-warning text-dark';
                }else{
                    $badge = 'bg-success';
                }
            ?>
                <tr>
                    <td><?= $d['nama_alat'] ?></td>
                    <td><?= date('d M Y', strtotime($d['tanggal_pinjam'])) ?></td>
                    <td><span class="badge <?= $badge ?>"><?= $d['status'] ?></span></td>
                    <td class="fw-bold text-danger">
                        Rp <?= number_format($d['denda']) ?>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
        </div>

        <a href="riwayat.php" class="btn btn-outline-light btn-sm mt-3">
            Lihat Semua →
        </a>
    </div>

</div>