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

    public function banyak_data(){
        $result = $this -> pdo -> query("SELECT COUNT(*) FROM users");
        //$result -> execute();
        return $result -> fetchColumn();
    }

    public function login($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> bindParam(':email', $email);
        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public function showData(){
        $sql = "SELECT id, name, email, password, nomor_telepon FROM users";
        $stmt = $this -> pdo ->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteData($id){
        $sql = "DELETE FROM users WHERE id = :zip";
        $stmt = $this-> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $id));
        return $stmt;
    }

    public function getData($edit){
        $sql = "SELECT * FROM users WHERE id = :zip";
        $stmt = $this -> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $edit));
        return $stmt -> fetch();
    }

    public function updateData($nama, $email, $password, $nomor_telepon, $id){
        $sql = "UPDATE users SET name=:name, email=:email, password=:password, nomor_telepon=:nomor_telepon WHERE id=:id";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute(array(
            ':name' => $nama,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':nomor_telepon' => $nomor_telepon,
            ':id' => $id));
        return $stmt;
    }

    public function tambah_pesanan($jenis_laundry, $jumlah_barang, $waktu_pengambilan, $waktu_pengantaran, $alamat, $catatan, $garis_lintang, $garis_bujur){
        $sql = "INSERT INTO order (jenis_laundry, jumlah_barang, waktu_pengambilan, waktu_pengantaran, alamat, catatan, garis_lintang, garis_bujur) 
        VALUES (:jenis_laundry, :jumlah_barang, :waktu_pengambilan, :waktu_pengantaran, :alamat, :catatan, :garis_lintang, :garis_bujur)";
        $stmt = $this-> pdo-> prepare($sql);
        $stmt->execute(array(
          ':jenis_laundry' => $jenis_laundry,
          ':jumlah_barang' => $jumlah_barang,
          ':waktu_pengambilan' => $waktu_pengambilan,
          ':waktu_pengantaran' => $waktu_pengantaran,
          ':alamat' => $alamat,
          ':catatan' => $catatan,
          ':garis_lintang' => $garis_lintang,
          ':garis_bujur' => $garis_bujur));
        return $stmt;
    }

    public function tampilkan_pesanan(){
        $sql = "SELECT * FROM order";
        $stmt = $this -> pdo ->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>