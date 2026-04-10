<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Peminjaman Alat</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#0f172a;
    color:white;
}
.card{
    background:#1e293b;
    border:none;
    border-radius:15px;
}
.sidebar{
    width:220px;
    height:100vh;
    position:fixed;
    background:#020617;
    padding:20px;
}
.sidebar a{
    display:block;
    padding:10px;
    margin:5px 0;
    color:white;
    border-radius:10px;
    text-decoration:none;
}
.sidebar a:hover{
    background:#38bdf8;
}
.content{
    margin-left:240px;
    padding:20px;
}
body {
    background: #0f172a;
}

.card {
    border-radius: 15px;
}

.table {
    color: white;
}

.table thead {
    border-bottom: 1px solid #334155;
}

.table tbody tr:hover {
    background: #1e293b;
}
body {
    background: #0f172a;
}

.card {
    border-radius: 15px;
}

.table {
    color: white;
}

.table tbody tr:hover {
    background: #1e293b;
    transition: 0.3s;
}

.btn-success {
    border-radius: 10px;
}

.btn-success:hover {
    transform: scale(1.05);
}
body {
    background: #f1f5f9;
}

/* CARD */
.card {
    border-radius: 15px;
    background: white;
}

/* HOVER CARD */
.alat-card {
    transition: 0.3s;
}

.alat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* INPUT */
.form-control {
    border-radius: 10px;
}

/* BUTTON */
.btn-primary {
    background: #3b82f6;
    border: none;
    border-radius: 10px;
}

.btn-primary:hover {
    background: #1d4ed8;
}
.table thead {
    background: #e0f2fe;
}

.table tbody tr:hover {
    background: #f0f9ff;
    transition: 0.3s;
}

img {
    transition: 0.3s;
}

img:hover {
    transform: scale(1.2);
}   
</style>
</head>
<body>