<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Login</h2>

    <?php
    if (isset($_SESSION['login_error'])) {
        echo '<div class="error">' . htmlentities($_SESSION['login_error']) . '</div>';
        unset($_SESSION['login_error']);
    }
    ?>

    <form method="POST" action="proses_login.php">
        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>