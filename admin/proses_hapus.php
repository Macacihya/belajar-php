<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['login_error'] = 'Anda harus login sebagai admin.';
    header('Location: ../login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['manage_msg'] = 'Metode tidak diperbolehkan.';
    header('Location: kelola_user.php');
    exit;
}

$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    $_SESSION['manage_msg'] = 'ID tidak valid.';
    header('Location: kelola.php');
    exit;
}

// Jangan hapus admin lain (opsional)
$sql = "SELECT role FROM users WHERE id = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
if (!$user) {
    $_SESSION['manage_msg'] = 'Pengguna tidak ditemukan.';
    header('Location: kelola.php');
    exit;
}
if ($user['role'] === 'admin') {
    $_SESSION['manage_msg'] = 'Tidak bisa menghapus admin.';
    header('Location: kelola.php');
    exit;
}

// hapus
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$ok = $stmt->execute();
$_SESSION['manage_msg'] = $ok ? 'Pengguna dihapus.' : 'Gagal menghapus.';
header('Location: kelola.php');
exit;
