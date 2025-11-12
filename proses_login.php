<?php
session_start();
require_once __DIR__ . '/koneksi.php';

// Pastikan lewat POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['login_error'] = 'Metode tidak diperbolehkan.';
    header('Location: login.php');
    exit;
}

// Ambil input
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi sederhana
if ($email === '' || $password === '') {
    $_SESSION['login_error'] = 'Email dan password harus diisi.';
    header('Location: login.php');
    exit;
}

// Prepare query
$sql = "SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    $_SESSION['login_error'] = 'Kesalahan server (prepare).';
    header('Location: login.php');
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    $_SESSION['login_error'] = 'Email tidak ditemukan.';
    header('Location: login.php');
    exit;
}

// Karena kamu minta tanpa hash, bandingkan langsung.
// (Reminder: ini insecure — sebaiknya pakai password_hash + password_verify)
if ($password !== $user['password']) {
    $_SESSION['login_error'] = 'Password salah.';
    header('Location: login.php');
    exit;
}

// Login berhasil: simpan session
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_role'] = $user['role'];

// Redirect berdasarkan role
if ($user['role'] === 'admin') {
    header('Location: admin/dashboard.php');
} else {
    // kalau mau buat halaman peserta nanti
    header('Location: login.php'); // sementara balik ke login atau halaman peserta
}
exit;