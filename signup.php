<!DOCTYPE html>
<?php
require_once "database.php";

if (isset($_POST['submit'])){
    if(empty($_POST['name']) && empty($_POST['email']) && empty($_POST['password']) && empty($_POST['nomorTelepon'])) {
        exit('Field kosong');
    }
    $sql = "INSERT INTO users (name, email, password, nomor_telepon) 
              VALUES (:name, :email, :password, :nomor_telepon)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':nomor_telepon' => $_POST['nomorTelepon']));
}
?>

<head>
    <title>Signup - Laundry OnLine</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <h1>Signup</h1>        
            <form method="POST">
                <p>Nama :</p>
                <input type="text" name="name">
                <p>E-Mail :</p>
                <input type="text" name="email">
                <p>Password :</p>
                <input type="password" name="password">
                <p>Nomor Telepon :</p>
                <input type="text" name="nomorTelepon">
                <p>
                    <button name="submit">Signup</button>
                </p>
                <br>
                <p>
                    <a href="/index.php">
                        <-- Back to Home</a>
                </p>
            </form>
        </div>
    </div>
</body>