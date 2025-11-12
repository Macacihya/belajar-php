<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mini_project'; 

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('koneksi eror'. $mysqli->connect_error);
}
?>