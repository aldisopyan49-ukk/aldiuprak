<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: linear-gradient(180deg, #1e293b, #0f172a);
    padding: 20px;
    color: white;
    display: flex;
    flex-direction: column;
    z-index: 1000;
}

/* LOGO */
.sidebar h4 {
    font-weight: 700;
    font-size: 22px;
    margin-bottom: 30px;
    text-align: center;
    background: linear-gradient(90deg,#6366f1,#a855f7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* MENU */
.sidebar a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    margin-bottom: 10px;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 10px;
    transition: 0.3s;
    font-size: 14px;
}

/* ICON */
.sidebar a i {
    font-size: 18px;
}

/* HOVER */
.sidebar a:hover {
    background: rgba(99,102,241,0.2);
    color: #fff;
    transform: translateX(5px);
}

/* LOGOUT */
.sidebar a.logout {
    margin-top: auto;
    background: rgba(239,68,68,0.2);
    color: #f87171;
}
.sidebar a.logout:hover {
    background: rgba(239,68,68,0.4);
    color: #fff;
}

/* CONTENT SHIFT */
.content {
    margin-left: 250px;
    padding: 20px;
}

/* ========================= */
/* 📱 MOBILE */
/* ========================= */
@media (max-width: 768px){

    .sidebar {
        width: 100%;
        height: 60px;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        bottom: 0;
        top: auto;
        padding: 10px;
    }

    .sidebar h4 {
        display: none;
    }

    .sidebar a {
        flex-direction: column;
        font-size: 10px;
        margin: 0;
        padding: 5px;
    }

    .sidebar a i {
        font-size: 20px;
    }

    .sidebar a.logout {
        margin-top: 0;
    }

    .content {
        margin-left: 0;
        margin-bottom: 70px;
    }
}
</style>

<div class="sidebar">
    <h4>✨ Pinjam Yukk</h4>

    <?php if($_SESSION['role']=='admin'): ?>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="alat.php"><i class="bi bi-box-seam"></i> Alat</a>
        <a href="user.php"><i class="bi bi-people"></i> User</a>
        <a href="peminjaman.php"><i class="bi bi-file-earmark-text"></i> Peminjaman</a>
    <?php elseif($_SESSION['role']=='petugas'): ?>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="alat.php"><i class="bi bi-tools"></i> Alat</a>
        <a href="peminjaman.php"><i class="bi bi-check2-square"></i> Validasi</a>
    <?php else: ?>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="pinjam.php"><i class="bi bi-cart-plus"></i> Pinjam</a>
        <a href="riwayat.php"><i class="bi bi-clock-history"></i> Riwayat</a>
    <?php endif; ?>

    <a href="../auth/logout.php" class="logout">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>