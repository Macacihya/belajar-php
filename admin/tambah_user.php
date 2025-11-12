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
    <title>Tambah Peserta</title>
</head>

<body>
    <h2>Tambah Peserta</h2>
    <?php
    if (isset($_SESSION['form_success'])) {
        echo '<div class="success">' . $_SESSION['form_success'] . '</div>';
        unset($_SESSION['form_success']);
    }
    if (isset($_SESSION['form_error'])) {
        echo '<div class="error">' . $_SESSION['form_error'] . '</div>';
        unset($_SESSION['form_error']);
    }
    ?>
    <form method="POST" action="proses_tambah.php">
        <label>Nama</label><br><input type="text" name="name" required><br><br>
        <label>Email</label><br><input type="email" name="email" required><br><br>
        <label>Password</label><br><input type="text" name="password" required><br><br>
        <label>Role</label><br>
        <select name="role">
            <option value="peserta">Peserta</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Tambah</button>
    </form>
    <p><a href="dashboard.php">Kembali</a></p>
</body>

</html>