<?php
class database{
    public function __construct()
    {
        try{
            $serverName = 'localhost';
            $userName = 'root';
            $password = '';
            $dbName = 'laundry';
            $this-> pdo = new PDO("mysql:host=$serverName;port=3306;dbname=$dbName",$userName, $password); 
        }
        catch(PDOException $e){
            echo 'Error, dikarenakan ' . $e ->getMessage();
        }
    
    }
    public function tambah_data($nama, $email, $password, $nomor_telepon){
        $sql = "INSERT INTO users (name, email, password, nomor_telepon) 
        VALUES (:name, :email, :password, :nomor_telepon)";
        $stmt = $this-> pdo-> prepare($sql);
        $stmt->execute(array(
          ':name' => $nama,
          ':email' => $email,
          ':password' => password_hash($password, PASSWORD_DEFAULT),
          ':nomor_telepon' => $nomor_telepon));
        return $stmt;
    }

    public function check_data($email){
        $result = $this -> pdo -> prepare("SELECT email FROM users WHERE email = :email");
        $result -> bindParam(':email', $email);
        $result -> execute();
        return $result -> rowCount();
    }

    public function login($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt =$this -> pdo -> prepare($sql);
        $stmt -> bindParam(':email', $email);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }
}

?>