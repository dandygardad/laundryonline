<?php
session_start();
require_once "database.php";
//Memanggil dari kelas database
$pdo = new database();

//Jika user sudah pernah login maka akan diarahkan ke halaman profile
if(!isset($_SESSION['email']) == 0 ){
    header('Location: dashboard.php');
}

if(isset($_POST['submit'])){
    //Init
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Mengecek apakah loginnya cocok dengan database
    $login = $pdo -> login($email);

    //Mengecek apakah password cocok
    if (password_verify($password, $login['password'])){
        //Memasukkan data ke session
        $id = $login['id'];
        $_SESSION['name'] = $login['name'];
        $_SESSION['email'] = $email;
        $_SESSION['nomortelepon'] = $login['nomor_telepon'];
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
                <input type="email" name="email" required placeholder="Masukkan e-mail">
                <p>Password :</p>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
                <input type="checkbox" onclick="myFunction()"> Show Password
                <br><br>
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
<script type="application/javascript">
    //Untuk memunculkan password di form
    function myFunction(){
        var x = document.getElementById("password");
        if (x.type === "password"){
            x.type = "text";
        } 
        else{
            x.type = "password";
        }
    }
</script>