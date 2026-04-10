<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
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
}else{
    echo "Login gagal";
}