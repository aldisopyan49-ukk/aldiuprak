<?php
session_start();
include '../config/koneksi.php';

// ================== PROSES KEMBALI ==================
if(isset($_GET['kembali'])){
    $id = $_GET['kembali'];

    // ambil data sesuai id
    $ambil = mysqli_query($conn,"SELECT * FROM peminjaman WHERE id='$id'");
    $data = mysqli_fetch_assoc($ambil);

    $tgl_pinjam = strtotime($data['tanggal_pinjam']);
    $sekarang = strtotime(date('Y-m-d'));

    $hari = ($sekarang - $tgl_pinjam) / 86400;

    $denda = 0;
    if($hari > 3){
        $denda = ($hari-3) * 5000;
    }

    mysqli_query($conn,"UPDATE peminjaman 
        SET status='dikembalikan',
        tanggal_kembali=CURDATE(),
        denda='$denda'
        WHERE id='$id'");

    header("Location: peminjaman.php");
    exit;
}

include '../templates/header.php';
include '../templates/sidebar.php';
?>

<div class="content">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="fw-bold text-primary">📄 Validasi Peminjaman</h2>
        <p class="text-muted">Kelola pengembalian alat</p>
    </div>

    <!-- TABLE -->
    <div class="card p-4 shadow-sm">

        <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Alat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $no = 1;
            $data = mysqli_query($conn,"
                SELECT p.*, u.nama, a.nama_alat 
                FROM peminjaman p
                JOIN users u ON p.user_id=u.id
                JOIN alat a ON p.alat_id=a.id
                ORDER BY p.id DESC
            ");

            while($d = mysqli_fetch_assoc($data)){

                // cek terlambat
                $telat = (strtotime($d['tanggal_pinjam']) < strtotime('-3 days'));

                if($d['status']=='dikembalikan'){
                    $status = '<span class="badge bg-success">Selesai</span>';
                }elseif($telat){
                    $status = '<span class="badge bg-danger">Terlambat</span>';
                }else{
                    $status = '<span class="badge bg-warning text-dark">Dipinjam</span>';
                }
            ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['nama_alat'] ?></td>
                    <td><?= $d['tanggal_pinjam'] ?></td>
                    <td><?= $status ?></td>

                    <td class="fw-bold text-danger">
                        Rp <?= number_format($d['denda']) ?>
                    </td>

                    <td>
                        <?php if($d['status'] == 'dipinjam'){ ?>
                            <a href="?kembali=<?= $d['id'] ?>" 
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Yakin mau mengembalikan alat ini?')">
                               ✔ Kembalikan
                            </a>
                        <?php }else{ ?>
                            <span class="text-muted">-</span>
                        <?php } ?>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
        </div>

    </div>

</div>