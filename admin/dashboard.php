<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['login_error'] = 'Anda harus login sebagai admin.';
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Dashboard Admin</title>
</head>

<body>
    <h2>Halo, <?= htmlspecialchars($_SESSION['user_name']) ?></h2>
    <ul>
        <li><a href="tambah_user.php">Tambah Peserta</a></li>
        <li><a href="kelola.php">Kelola Pengguna</a></li>
        <li><a href="./logout.php">Logout</a></li>
    </ul>
</body>

</html>