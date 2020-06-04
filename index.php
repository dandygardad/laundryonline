<?php
session_start();
require_once "database.php";
//Memanggil kelas database
$pdo = new database();

    //Jika user sudah login, maka akan langsung terpindah ke dashboard user/admin
    if(isset($_SESSION['email']) == 0){
    
    }
    else{
        header("Location: dashboard.php");    
    }

    //Memunculkan daftar harga
    $rows = $pdo -> getHarga();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUNDRY ONLINE</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="/index.php"><p style="font-size:30px;"><b>Laundry OnLine</b></p></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active nav-pills nav-fill" href="#how-to-order">Tutorial Order</a>
                <a class="nav-item nav-link active" href="#daftar-harga">Daftar Harga</a>
                <a class="nav-item nav-link active" href="#faq">FAQ</a>
                <a class="nav-item nav-link active" href="#hubungi-kami">Hubungi Kami</a>
                <a class="btn btn-outline-success active" href="/login.php"><b>Login</b></a>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <img class="d-block w-100" src="pictures/login2.jpg" alt="First slide">
            </div>
            <div class="carousel-caption">
                <img src="pictures/img1.png" width="500px" alt=""> 
                <h1 class="display-4 bg-dark"><b>WELCOME TO LAUNDRY ONLINE</b></h1>
                <br><br><br><br><br><br><br><br><br><br>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="pictures/login.jpg" alt="Second slide">
            <div class="vcenter text-center">
        </div>
    </div>
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </div>

    <!-- Isi -->
    <hr id="how-to-order">
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <div class="tengah">
            <h1 class="display-4">Tutorial Order</h1>
            <p class="lead">Ini merupakan tata cara order laundry di website ini, mudah dan friendly.</p>
            <hr class="my-4">

            <!-- Di row ini isinya merupakan tutorial beserta gambar dengan bentuk kotak ya -->
            <div class="row">
                <div class="col-sm">
                    One of three columns
                </div>
                <div class="col-sm">
                    One of three columns
                </div>
                <div class="col-sm">
                    One of three columns
                </div>
            </div>
            </div>
        </div>
    </div>

    <hr id="daftar-harga">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="tengah">
            <h1 class="display-4">Daftar Harga</h1>
            <p class="lead">Berikut ini merupakan daftar harga yang tersedia, murah!</p>
            <hr class="my-4">
            <table id="pagination" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ( $rows as $row ) {
                    ?>
                    <tr>
                        <th><?=$row['id'] ?></th>
                        <td><?=$row['nama_barang'] ?></td>
                        <td><?=$row['harga']?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <hr id="faq">
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <div class="tengah">
            <h1 class="display-4">FAQ</h1>
            <p class="lead">Pertanyaan yang sering muncul.</p>
            <hr class="my-4">
            <h3>What is online laundry?</h3>
            <p> online laundry help you with your laundry. powered by web application, 
                we partnered with professional laundry and offer pick up and delivery service right to your house, office or other places.</p>
                <br>
            <h3> How to order online laundry?</h3>
            <p>You can order via our website application.</p>
                <br>
            <h3> Why use online laundry ?</h3>
            <p>Free pick up and delivery, track your order, fast services, best quality with competitve price and service guarantee.</p>
            </div>
        </div>
    </div>
    </div>

    <hr>
    <div class="jumbotron">
        <div class="tengah">
        <h1 class="display-4"><b>Tunggu Apalagi?</b></h1><br>
        <p class="lead">Ayo pesan sekarang, kami akan jemput langsung laundry anda!</p>
        <hr class="my-4">
        <p>Klik link dibawah ini untuk mendaftar!</p>
        <a class="btn btn-primary btn-lg" href="/signup.php" role="button">Daftar Sekarang</a>
        </div>
    </div>
    <hr id="hubungi-kami">
    <div class="jumbotron jumbotron-fluid bg-dark text-white">
        <div class="container">
            <div class="tengah">
            <h1 class="display-4">Hubungi Kami!</h1>
            <p class="lead">Jika ada keraguan, kami akan selalu tersedia untuk anda.</p>
            <hr class="my-4 bg-white">

            <!-- Di row ini isinya merupakan tutorial beserta gambar dengan bentuk kotak ya -->
            <div class="row">
                <div class="col-sm">
                    <br>
                    <h4>
                        <b>Alamat kami :</b>
                    </h4>
                    <p>Jl. abc No. 40B, Sulawesi Selatan 12560</p>
                    <br>
                    <h4>
                        <b>Nomor Telepon :</b>
                    </h4>
                    <p>(021) 227 1XX XX</p>
                    <br>
                    <h4>
                        <b>Follow Us! :</b>
                    </h4>
                    <p><a style="color: white; text-decoration:underline;" href="https://instagram.com/laundryonlinemks">Instagram</a></p>
                </div>
                <br>
                <br>
                <div class="col-sm">
                    <div id="googleMaps" style="width:100%;height:380px;"></div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small bg-white">

    <div class="footer-copyright text-center py-3">© 2020
        <a href="https://laundryonlinemks.com/"> Laundry OnLine</a>
    </div>

    </footer>

</body>
</html>
<script>
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
            var propertiPeta = {
                center:new google.maps.LatLng(-5.2304254160715065, 119.50257641283645),
                zoom:15,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);



            // even listener ketika peta diklik

            google.maps.event.addListener(peta, 'click', function(event) {

                taruhMarker(this, event.latLng);

            });



            // membuat Marker untuk halaman konfirmasi

            var marker=new google.maps.Marker({
                position: new google.maps.LatLng(-5.2304254160715065, 119.50257641283645),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });
        }
        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);

        //Menggunakan DataTables
        $(document).ready(function() {
            $('#pagination').DataTable();
        } );
    </script>