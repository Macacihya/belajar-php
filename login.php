<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>login</h2>

    <?php

if (isset($_SESSION["login_eror"])){
    echo'div class ="error">'.htmlentities($_SESSION["login_eror"]).'</div>';
    unset($_SESSION["login_eror"]);
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