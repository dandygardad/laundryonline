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
            $this-> pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    public function banyak_pesanan(){
        $result = $this -> pdo -> query("SELECT COUNT(*) FROM `Order`");
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

    public function tambah_pesanan($jenis_laundry, $massa_barang, $jumlah_barang, $waktu_pengambilan, $waktu_pengantaran, $alamat, $catatan, $garis_lintang, $garis_bujur, $harga_total, $status, $id, $list_satuan){
        $sql = "INSERT INTO `Order` (jenis_laundry, massa_barang, jumlah_barang, waktu_pengambilan, waktu_pengantaran, alamat, catatan, garis_lintang, garis_bujur, harga_total, status_pemesanan, id_user, list_satuan)
        VALUES (:jenis_laundry, :massa_barang, :jumlah_barang, :waktu_pengambilan, :waktu_pengantaran, :alamat, :catatan, :garis_lintang, :garis_bujur, :harga_total, :status_pemesanan, :id_user, :list_satuan)";
        $stmt = $this-> pdo-> prepare($sql);
        $stmt->execute(array(
          ':jenis_laundry' => $jenis_laundry,
          ':massa_barang' => $massa_barang,
          ':jumlah_barang' => $jumlah_barang,
          ':waktu_pengambilan' => $waktu_pengambilan,
          ':waktu_pengantaran' => $waktu_pengantaran,
          ':alamat' => $alamat,
          ':catatan' => $catatan,
          ':garis_lintang' => $garis_lintang,
          ':garis_bujur' => $garis_bujur,
          ':harga_total' => $harga_total,
          ':status_pemesanan' => $status,
          ':id_user' => $id,
          ':list_satuan' => $list_satuan));
        return $stmt;
    }

    public function getHarga(){
        $sql = "SELECT * FROM harga";
        $stmt = $this -> pdo ->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showPesanan(){
        $sql = "SELECT id, jenis_laundry, massa_barang, jumlah_barang, waktu_pengambilan, waktu_pengantaran, alamat, catatan, garis_lintang, garis_bujur, harga_total, status_pemesanan, id_user, list_satuan FROM `Order`";
        $stmt = $this -> pdo -> query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPesanan($name_filter){
        $sql = "SELECT jenis_laundry, massa_barang, jumlah_barang, waktu_pengambilan, waktu_pengantaran, alamat, catatan, harga_total, status_pemesanan, id_user FROM `Order` WHERE id_user = :zip";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute(array(':zip' => $name_filter));
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEditPesanan($edit){
        $sql = "SELECT * FROM users WHERE id = :zip";
        $stmt = $this -> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $edit));
        return $stmt -> fetch();
    }

    public function getOrder($edit){
        $sql = "SELECT * FROM `Order` WHERE id = :zip";
        $stmt = $this -> pdo ->prepare($sql);
        $stmt->execute(array(':zip' => $edit));
        return $stmt -> fetch();
    }

    public function updateStatus($status, $id){
        $sql = "UPDATE `Order` SET status_pemesanan=:status_pemesanan WHERE id=:id";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt->execute(array(
            ':status_pemesanan' => $status,
            ':id' => $id));
        return $stmt;
    }
}
?>