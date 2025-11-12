<?php
session_start();
require_once __DIR__ . '/../koneksi.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['login_error'] = 'Anda harus login sebagai admin.';
    header('Location: ../login.php');
    exit;
}

// ambil semua user
$sql = "SELECT id, name, email, role, created_at FROM users ORDER BY id DESC";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kelola Pengguna</title>
</head>

<body>
    <h2>Kelola Pengguna</h2>
    <?php
    if (isset($_SESSION['manage_msg'])) {
        echo '<div>' . htmlspecialchars($_SESSION['manage_msg']) . '</div>';
        unset($_SESSION['manage_msg']);
    }
    ?>
    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td>
                    <?php if ($row['role'] !== 'admin'): ?>
                        <form method="POST" action="proses_hapus_user.php" style="display:inline">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                            <button onclick="return confirm('Hapus user ini?')" type="submit">Hapus</button>
                        </form>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="dashboard.php">Kembali</a></p>
</body>

</html>