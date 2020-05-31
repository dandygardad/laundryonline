<?php
session_start();
require_once "database.php";

//Jika user belum login dan membuka ini, maka langsung diarahkan ke halaman login
if(isset($_SESSION['email']) == 0){
    exit("<h1>Access Denied</h1>");
}

//Akses selain e-mail admin akan ditolak
//Ubah e-mailnya jika ingin mengganti akun admin
if($_SESSION['email'] != 'dandygarda@gmail.com'){
    exit("<h1>Access Denied</h1>");
}

?>

<!DOCTYPE html>
<head>
    <title>Administrator</title>
</head>
<body>
    <h1>Selamat datang <?php echo $_SESSION['name']; ?></h1>

    <br>
    <a href="logout.php">Logout</a>
</body>