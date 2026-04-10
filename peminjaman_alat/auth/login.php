<?php
session_start();
include '../config/koneksi.php';

$error = "";

// PROSES LOGIN
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $data = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_assoc($data);

    if($user){
        $_SESSION['login'] = true;
        $_SESSION['role'] = $user['role'];
        $_SESSION['id'] = $user['id'];

        if($user['role'] == 'admin'){
            header("Location: ../admin/dashboard.php");
        }elseif($user['role'] == 'petugas'){
            header("Location: ../petugas/dashboard.php");
        }else{
            header("Location: ../user/dashboard.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Peminjaman Alat</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root {
    --primary: #6366f1;
    --primary-hover: #4f46e5;
}

/* BODY */
body {
    margin:0;
    min-height:100vh;
    font-family:'Inter', sans-serif;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(135deg,#0f172a,#1e293b);
    color:white;
    padding:20px;
}

/* GLOW */
.glow {
    position:absolute;
    width:300px;
    height:300px;
    filter:blur(120px);
    opacity:0.2;
    border-radius:50%;
}
.glow1 { background:#6366f1; top:-10%; left:-10%; }
.glow2 { background:#a855f7; bottom:-10%; right:-10%; }

/* CARD */
.login-card {
    width:100%;
    max-width:900px;
    display:flex;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(20px);
    border-radius:20px;
    overflow:hidden;
}

/* LEFT */
.left {
    width:45%;
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    padding:40px;
    text-align:center;
}
.left i {
    font-size:60px;
}

/* RIGHT */
.right {
    width:55%;
    padding:40px;
}

/* INPUT */
.form-control {
    background: rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    color:white;
    height:48px;
}
.form-control:focus {
    border-color:var(--primary);
    box-shadow:0 0 0 2px rgba(99,102,241,0.3);
}

/* BUTTON */
.btn-login {
    background:var(--primary);
    border:none;
    padding:14px;
    border-radius:10px;
}
.btn-login:hover {
    background:var(--primary-hover);
}

/* ================= MOBILE ================= */
@media (max-width: 768px){
    .login-card {
        flex-direction:column;
        max-width:400px;
    }
    .left { display:none; }
    .right {
        width:100%;
        padding:25px 20px;
    }
}
</style>
</head>

<body>

<div class="glow glow1"></div>
<div class="glow glow2"></div>

<div class="login-card">

    <!-- LEFT -->
    <div class="left">
        <i class="bi bi-shield-lock-fill"></i>
        <h3 class="mt-3">Inventory System</h3>
        <p>Sistem peminjaman alat modern</p>
    </div>

    <!-- RIGHT -->
    <div class="right">

        <h3>Selamat Datang</h3>
        <p class="text-secondary mb-4">Silakan login</p>

        <!-- ERROR -->
        <?php if($error): ?>
        <div class="alert alert-danger text-center" style="border-radius:10px;">
            <?= $error ?>
        </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button name="login" class="btn btn-login w-100 text-white">
                Masuk
            </button>

        </form>

    </div>

</div>

</body>
</html>