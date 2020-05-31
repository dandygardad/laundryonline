<?php
session_start();
require_once "database.php";

//Jika user sudah pernah login maka akan diarahkan ke halaman profile
if(!isset($_SESSION['email']) == 0 ){
    header('Location: dashboard.php');
}

if(isset($_POST['submit'])){
    //Init
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Mengecek apakah loginnya cocok dengan database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo -> prepare($sql);
    $stmt -> bindParam(':email', $email);
    $stmt -> execute();
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);

    //Mengecek apakah password cocok
    if (password_verify($password, $row['password'])){
        //Memasukkan data ke session
        $id = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $email;
        $_SESSION['nomortelepon'] = $row['nomor_telepon'];
        setcookie('user_id', $id, time()+(7 * 24 * 60 * 60), '/');
        header("Location: dashboard.php");
    }
    //Pesan error jika e-mail atau password salah
    else{
        echo '<div class="box"><div class="square">';
        echo("E-mail atau password salah, silahkan ulangi kembali");
        echo '</div></div>';
    }
}
?>

<!DOCTYPE HTML>
<head>
    <title>Login - Laundry OnLine</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="login_2.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <h1>Login</h1>   
            <br>     
            <form method="POST">
                <p>E-Mail :</p>
                <input type="email" name="email" required>
                <p>Password :</p>
                <input type="password" name="password" required>
                <p>
                    <button name="submit">Login</button>
                </p>
                <br>
                <p>
                    <a href="/signup.php">
                        Belum mendaftar? Daftar Sekarang!</a>
                </p>
                <p>
                    <a href="/index.php">
                        <-- Back to Home</a>
                </p>
            </form>
        </div>
    </div>
</body>