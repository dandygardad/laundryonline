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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/dash.css">
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
        <a class="nav-link" href="#beranda">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#statistik">Statistik</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#pesanan">Pesanan</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#customers">Profil Customers</a>
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
            <p class="lead">Anda berada di ruang admin, cek pesanan dan profil user disini.</p>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <h1 class="tengah" id ="statistik">Statistik</h1>
            <p class="tengah">Melihat berapa banyak pesanan dan customers terdaftar.
            </p>
            <br>
            <div class="row">
                <div class="col-6"><div class="tengah"><h3>Pesanan</h3></div></div>
                <div class="col-6"><div class="tengah"><h3>Customers</h3></div></div>
            </div>
            <br>
            <div class="row">
                <div class="col-6"><div class="tengah"><img src="pictures/pesanan.png" width="100px"></div></div>
                <div class="col-6"><div class="tengah"><img src="pictures/users.png" width="100px"></div></div>
            </div>
            <br>
            <div class="row">
                <div class="col-6"><div class="tengah"><h5>blablabla pesanan</h5></div></div>
                <div class="col-6"><div class="tengah"><h5>blablabla customers</h5></div></div>
            </div>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <h1 class="tengah" id ="pesanan">Pesanan</h1>
            <p class="tengah">Daftar pesanan dari customers.
            </p>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <h1 class="tengah" id ="customers">Profil Customers</h1>
            <p class="tengah">Daftar customers yang terdaftar.
            </p>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
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