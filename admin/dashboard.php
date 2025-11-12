<?php
session_start();
if (isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== 'admin'){
    $_SESSION['login_eror'] = 'anda harus login sebagi admin.';
    header('location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard admin</title>
</head>
<body>
    <h2>halo,<?=htmlspecialchars($_SESSION['user_name'])?> </h2>
    <ul>
        <li><a href="tambah_user.php">tambah peserta</a></li>
        <li><a href="kelola_user.php">kelola pengguna</a></li>
        <li><a href="../logout.php">logout</a></li>
    </ul>
</body>
</html>