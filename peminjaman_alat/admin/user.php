<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

// TAMBAH USER
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    mysqli_query($conn,"INSERT INTO users VALUES(NULL,'$nama','$username','$password','$role')");
}
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/sidebar.php'; ?>

<!-- STYLE -->
<style>
body {
    background: #f1f5f9;
    font-family: 'Inter', sans-serif;
}

.content {
    padding: 20px;
}

/* CARD */
.card {
    border-radius: 14px;
    border: none;
}

/* TABLE */
.table th {
    font-size: 14px;
}
.table td {
    vertical-align: middle;
}

/* BUTTON */
.btn {
    border-radius: 8px;
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

    /* FORM STACK */
    .row.form-row > div {
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* BUTTON FULL */
    .btn {
        width: 100%;
        margin-bottom: 5px;
    }

    /* TABLE FONT */
    .table {
        font-size: 13px;
    }

    /* HEADER FLEX */
    .content .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 10px;
    }
}

/* HP kecil */
@media (max-width: 480px){

    h2 {
        font-size: 18px;
    }

    .table {
        font-size: 12px;
    }
}
</style>

<div class="content">

    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="fw-bold text-primary">👤 Kelola User</h2>
        <p class="text-muted">Tambah dan manajemen pengguna sistem</p>
    </div>

    <!-- FORM TAMBAH -->
    <div class="card p-4 mb-4 shadow-sm">
        <h5 class="fw-bold mb-3">➕ Tambah User</h5>

        <form method="POST">
            <div class="row form-row">

                <div class="col-md-3 mb-3">
                    <input name="nama" class="form-control" placeholder="Nama lengkap" required>
                </div>

                <div class="col-md-3 mb-3">
                    <input name="username" class="form-control" placeholder="Username" required>
                </div>

                <div class="col-md-2 mb-3">
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="col-md-2 mb-3">
                    <select name="role" class="form-select" required>
                        <option value="">Role</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <button name="tambah" class="btn btn-primary">
                        Tambah
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- TABLE USER -->
    <div class="card p-4 shadow-sm">
        <h5 class="fw-bold mb-3">📋 Daftar User</h5>

        <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $no = 1;
            $data = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");

            while($d = mysqli_fetch_assoc($data)){
                if($d['role']=='admin'){
                    $badge = 'danger';
                }elseif($d['role']=='petugas'){
                    $badge = 'warning';
                }else{
                    $badge = 'primary';
                }
            ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama'] ?></td>
                <td><?= $d['username'] ?></td>
                <td>
                    <span class="badge bg-<?= $badge ?>">
                        <?= $d['role'] ?>
                    </span>
                </td>

                <td>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="edit_user.php?id=<?= $d['id'] ?>" 
                           class="btn btn-sm btn-warning">
                           ✏ Edit
                        </a>

                        <a href="hapus_user.php?id=<?= $d['id'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin hapus user?')">
                           🗑 Hapus
                        </a>
                    </div>
                </td>
            </tr>

            <?php } ?>

            </tbody>
        </table>
        </div>

    </div>

</div>