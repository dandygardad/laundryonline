<?php
require_once "database.php";

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

    if (password_verify($password, $row['password'])){
        echo '<div class="box"><div class="square">';
        echo("Login berhasil");
        echo '</div></div>';
    }
    else{
        echo '<div class="box"><div class="square">';
        echo("E-mail atau password salah, silahkan ulangi kembali");
        echo '</div></div>';
    }
}


?>

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