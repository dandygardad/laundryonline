<?php
session_start();
require_once "database.php";

if(!isset($_SESSION['email']) == 0 ){
    header('Location: dashboard.php');
}

if (isset($_POST['submit'])){

    //Mencegah ada e-mail yang sama dalam database
    $email = $_POST['email'];
    $result = $pdo -> prepare("SELECT email FROM users WHERE email = :email");
    $result -> bindParam(':email', $email);
    $result -> execute();

    //Mencegah data kosong masuk database
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nomorTelepon'])) {
        echo '<div class="box"><div class="square">';
        echo("Field tidak boleh kosong!");
        echo '</div></div>';
    }

    //Pesan yang muncul jika sudah ada e-mail dalam database
    else if($result->rowCount() > 0){
        echo '<div class="box"><div class="square">';
        echo("E-mail sudah ada, silahkan gunakan e-mail yang berbeda!");
        echo '</div></div>';
    }

    //Input Data
    else{
        $_SESSION['message'] = 'Data sudah masuk, silahkan kembali <a href="/login.php">Login</a> ';
        echo '<div class="box"><div class="square">';
        echo $_SESSION['message'];
        echo '</div></div>';
        unset($_SESSION['message']);
        $sql = "INSERT INTO users (name, email, password, nomor_telepon) 
        VALUES (:name, :email, :password, :nomor_telepon)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':name' => $_POST['name'],
          ':email' => $_POST['email'],
          ':password' => password_hash($_POST['password'],PASSWORD_DEFAULT),
          ':nomor_telepon' => $_POST['nomorTelepon']));
        $_SESSION['message'] = 'Data sudah masuk, silahkan kembali <a href="/login.php">Login</a> ';
    }
} 
?>

<!DOCTYPE html>
<head>
    <title>Signup - Laundry OnLine</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link rel="stylesheet" type="text/css" href="signup_2.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <h1>Signup</h1>   
            <br>     
            <form method="POST">
                <p>Nama :</p>
                <input type="text" name="name" placeholder="Masukkan nama">
                <p>E-Mail :</p>
                <input type="email" name="email" placeholder="Masukkan e-mail">
                <p>Nomor Telepon :</p>
                <input type="tel" name="nomorTelepon" placeholder="081234567890" pattern=".{10,14}" required>
                <p>Password :</p>
                <input type="password" name="password" id="password" pattern=".{8,}" required title="Minimum 8 karakter" placeholder="Masukkan password">
                <input type="checkbox" onclick="myFunction()"> Show Password
                <br><br>
                <p>
                    <button name="submit">Signup</button>
                </p>
                <br>
                <p>
                    <a href="/login.php">
                        Sudah mendaftar? Silahkan login</a>
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