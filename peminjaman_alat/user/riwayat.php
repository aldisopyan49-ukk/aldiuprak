<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'user'){
    header("Location: ../auth/login.php");
    exit;
}

$id = $_SESSION['id'];

include '../templates/header.php';
include '../templates/sidebar.php';
?>

<div class="content">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="fw-bold text-primary">📄 Riwayat Peminjaman</h2>
        <p class="text-muted">Semua aktivitas peminjaman kamu</p>
    </div>

    <!-- TABLE -->
    <div class="card p-4 shadow-sm">

        <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alat</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $no = 1;
            $data = mysqli_query($conn,"
                SELECT p.*, a.nama_alat 
                FROM peminjaman p
                JOIN alat a ON p.alat_id = a.id
                WHERE p.user_id='$id'
                ORDER BY p.id DESC
            ");

            while($d = mysqli_fetch_assoc($data)){

                // status warna
                if($d['status'] == 'dipinjam'){
                    $status = '<span class="badge bg-warning text-dark">Dipinjam</span>';
                }else{
                    $status = '<span class="badge bg-success">Dikembalikan</span>';
                }
            ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama_alat'] ?></td>
                    <td><?= $d['tanggal_pinjam'] ?></td>
                    <td><?= $d['tanggal_kembali'] ? $d['tanggal_kembali'] : '-' ?></td>
                    <td><?= $status ?></td>
                    <td class="fw-bold text-danger">
                        Rp <?= number_format($d['denda']) ?>
                    </td>

                    <td>
                        <?php if($d['bukti']){ ?>
                            <img src="../uploads/<?= $d['bukti'] ?>" width="50" style="border-radius:8px;">
                        <?php } ?>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
        </div>

    </div>

</div>