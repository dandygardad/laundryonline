<?php
session_start();
require_once "database.php";

//Jika user belum login dan membuka ini, maka langsung diarahkan ke halaman login
if(isset($_SESSION['email']) == 0){
    header('Location: login.php');
}

//Jika admin login, maka langsung diarahkan ke halaman dashboard admin
//Ubah e-mailnya jika ingin mengganti akun admin
if($_SESSION['email'] == 'dandygarda@gmail.com'){
    header('Location: admin_dash.php');
}

?>

<!DOCTYPE html>
<head>
    <title>Dashboard User - Laundry OnLine</title>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
</head>

<body>
    <!-- Navbar -->
<nav id="navbar-admin" class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/admin_dash.php"><b>Laundry OnLine</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#beranda">Beranda</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/order.php">Order</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#status-order">Status Order</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#profil">Profil</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>

    <!-- Isi -->
<div data-spy="scroll" data-target="#navbar-admin" data-offset="0">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 id ="beranda" class="display-4">Selamat datang, <?php echo $_SESSION['name']; ?>!</h1>
            <br>
            <p class="lead">Silahkan order laundry atau cek status laundry disini.</p>
            <br>
            <a class="btn btn-outline-success active" href="/order.php"><b>ORDER DISINI</b></a>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <h1 class="tengah" id ="status-order">Status Order</h1>
            <p class="tengah">Cek status laundry anda disini.</p>
            <br>
            <table id="pagination" class="table">
                <thead>
                    <tr>
                        <th scope="col">Jenis Laundry</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Waktu Pengambilan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Status Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <h1 class="tengah" id ="customers">Informasi Profil</h1>
            <p class="tengah">Informasi tentang nama, e-mail, nomor telepon yang dipakai.</p>
            <br>
            <ul>
                <li>Nama : </li>
                <br>
                <li>E-mail : </li>
                <br>
                <li>Nomor Telepon : </li>
            </ul>
    <br>
    </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 Copyright:
    <a href="#"> Laundry OnLine</a>
  </div>
</footer>

</div>
</div>
</body>
<script>
    $(document).ready(function() {
    $('#pagination').DataTable();
} );

//Memunculkan password
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