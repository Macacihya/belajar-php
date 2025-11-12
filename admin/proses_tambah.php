<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['login_error'] = 'Anda harus login sebagai admin.';
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['form_error'] = 'Metode tidak diperbolehkan.';
    header('Location: tambah_user.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$role = $_POST['role'] === 'admin' ? 'admin' : 'peserta';

if ($name === '' || $email === '' || $password === '') {
    $_SESSION['form_error'] = 'Semua field harus diisi.';
    header('Location: tambah_user.php');
    exit;
}

// cek apakah email sudah ada
$sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows > 0) {
    $_SESSION['form_error'] = 'Email sudah terdaftar.';
    header('Location: tambah_user.php');
    exit;
}

// insert user
$sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    $_SESSION['form_error'] = 'Kesalahan server (prepare insert).';
    header('Location: tambah_user.php');
    exit;
}
$stmt->bind_param("ssss", $name, $email, $password, $role);
$ok = $stmt->execute();
if ($ok) {
    $_SESSION['form_success'] = 'Pengguna berhasil ditambahkan.';
    header('Location: tambah_user.php');
} else {
    $_SESSION['form_error'] = 'Gagal menambahkan pengguna.';
    header('Location: tambah_user.php');
}
exit;
