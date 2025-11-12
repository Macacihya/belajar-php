<?php
session_start();
require_once __DIR__ ."/koneksi.php";

//untuk cek beneran menggunakan post?
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION['login_eror'] = 'metode ini tidak diperbohlekan';
    header('location: login.php');
    exit;
}

//ambil data email dan pasword pada database
$email = trim($_POST['email'] ?? '');
$password = ($_POST['password'] ??'');

//cek apakah kosong atau tidak
if($email === '' || $password === '' ){
    $_SESSION['login_eror'] = 'email dan password harus diisi';
    exit;
}


//proses atau persiapan untuk megirim ke database
$sql = 'SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1';
$stmt =$mysqli->prepare($sql);
if(!$sql){
    $_SESSION['login_eror'] = 'kesalahan server (prepare)';
    header('location: login.php');
    exit;
}

$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$final = $result->fetch_assoc();

//cek apakah emailnya beneran ada
if(!$final){
    $_SESSION['login_eror'] = 'email tidak ditemukan';
    header('location: login.php');
    exit;
}
//cek password apakah benar
if(!$password){
    $_SESSION['login_eror'] = 'password salah';
    header('location: login.php');
    exit;
}
//kalau benar akan disimpan disini
$_SESSION['user_id']=$final['id'];
$_SESSION['user_name']=$final['name'];
$_SESSION['user_role']=$final['role'];

//cek rolenya
if($final['role'] === 'admin'){
    header('location: login.php');
}else{
    header('location: login.php');
}
exit;

?>