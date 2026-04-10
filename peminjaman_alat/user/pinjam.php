<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'user'){
    header("Location: ../auth/login.php");
    exit;
}

if(isset($_POST['pinjam'])){
    $alat = $_POST['alat'];
    $user = $_SESSION['id'];

    $bukti = $_FILES['bukti']['name'];
    move_uploaded_file($_FILES['bukti']['tmp_name'], "../uploads/".$bukti);

    mysqli_query($conn,"INSERT INTO peminjaman 
    VALUES(NULL,'$user','$alat',CURDATE(),NULL,'dipinjam','$bukti',0)");

    mysqli_query($conn,"UPDATE alat SET stok = stok-1 WHERE id='$alat'");

    echo "<script>alert('Berhasil meminjam alat!'); window.location='dashboard.php';</script>";
}

include '../templates/header.php';
include '../templates/sidebar.php';
?>

<div class="content">

    <h3 class="mb-4">📦 Pinjam Alat</h3>

    <div class="card p-4 shadow-lg">

        <form method="POST" enctype="multipart/form-data">

            <!-- PILIH ALAT -->
            <div class="mb-3">
                <label class="form-label">Pilih Alat</label>
                <select name="alat" class="form-select bg-dark text-white" required>
                    <option value="">-- Pilih Alat --</option>
                    <?php
                    $alat = mysqli_query($conn,"SELECT * FROM alat WHERE stok > 0");
                    while($a = mysqli_fetch_assoc($alat)){
                        echo "<option value='$a[id]'>$a[nama_alat] (Stok: $a[stok])</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- UPLOAD BUKTI -->
            <div class="mb-3">
                <label class="form-label">Upload Bukti</label>
                <input type="file" name="bukti" class="form-control bg-dark text-white" id="previewInput" required>
            </div>

            <!-- PREVIEW GAMBAR -->
            <div class="mb-3">
                <img id="previewImg" src="" style="max-width:200px; display:none; border-radius:10px;">
            </div>

            <!-- BUTTON -->
            <button name="pinjam" class="btn btn-info w-100">
                🚀 Pinjam Sekarang
            </button>

        </form>

    </div>

    <!-- LIST ALAT (BONUS BIAR KEREN) -->
    <div class="card p-4 mt-4">
        <h5 class="mb-3">🔥 Alat Tersedia</h5>

        <div class="row">
        <?php
        $alat = mysqli_query($conn,"SELECT * FROM alat WHERE stok > 0 LIMIT 6");
        while($a = mysqli_fetch_assoc($alat)){
        ?>
            <div class="col-md-4 mb-3">
                <div class="card p-2 h-100">
                    <img src="../uploads/<?= $a['gambar'] ?>" 
                         style="height:150px; object-fit:cover; border-radius:10px;">
                    
                    <h6 class="mt-2"><?= $a['nama_alat'] ?></h6>
                    <small>Stok: <?= $a['stok'] ?></small>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>

</div>

<!-- SCRIPT PREVIEW -->
<script>
document.getElementById('previewInput').onchange = evt => {
    const [file] = evt.target.files
    if (file) {
        const img = document.getElementById('previewImg')
        img.src = URL.createObjectURL(file)
        img.style.display = 'block'
    }
}
</script>