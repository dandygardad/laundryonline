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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/dataTables.bootstrap4.min.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="bootstrap/jquery.dataTables.min.js"></script>
    <script src="bootstrap/dataTables.bootstrap4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKtmUDqFDJ8-D3F0nJM4bpiD4hAR-fzeo"></script>
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
                <img class="d-block w-100" src="images/laundry1.jpg">
            </div>
            <div class="carousel-caption">
                <h6><img src="images/img1.png" width="350px"> </h6>
                    <h1><a class="display-4 text-light bg-dark"><b>Selamat Datang di Laundry OnLine</b></a></h1>
                    <br>
                    <h1><a class="text-light bg-dark">Solusi cuci setiap hari</a></h1>
                <br>
                <h6><a class="btn btn-primary btn-lg" href="/signup.php" role="button">Daftar Sekarang</a></h6>
                <br><br><br><br><br>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/laundry.jpg">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/laundry2.jpg">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/laundry3.jpg">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/laundry5.jpg">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/laundry6.jpg">
            </div>
        </div>
    </div>

    <!-- Isi -->
    <hr id="how-to-order">
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <div class="tengah">
            <h1 class="display-4">Tutorial Order</h1>
            <br>
            <p style="text-align:left;" class="lead">Pengen Order? yuk simak cara dibawah ini.</p>
            <hr class="my-4">

            <!-- Di row ini isinya merupakan tutorial beserta gambar dengan bentuk kotak ya -->
            <div class="row">
                <div class="col-sm">
                <h6><img src="images/img3.png" width="135px"> </h6>
                <h5>Daftar</h5>
                <p>Pelanggan mendaftarkan dirinya pada website, dan melakukan pemesanan </p> 
                    
                </div>
                <div class="col-sm">
                <h6><img src="images/img4.png" width="100px"> </h6>
                <h5>Pengambilan </h5>
                <p>pihak kami akan mengambil barang yang akan di laundry</p> 
                </div>
                <div class="col-sm">
                <h6><img src="images/img5.png" width="108px"> </h6>
                <h5>Pencucian</h5>
                <p>pencucian baju sesuai pemesanan</p>  
                </div>
                <div class="col-sm">
                <h6><img src="images/img6.png" width="100px"> </h6>
                <h5>Pengantaran </h5>
                <p> pihak kami akan mengantarkan barang yang telah di laundry di rumah anda</p>
               
                </div>
                <div class="col-sm">
                <h6><img src="images/img7.png" width="160px"> </h6><br>
                <h5>Pembayaran</h5>
                <p>pembayaran pemesanan bisa dilakukan secara Cash on delivery</p> 
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
            <br>
            <p style="text-align:left;" class="lead">Berikut ini merupakan daftar harga yang tersedia, murah!</p>
            <hr class="my-4">
            <br>
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
          
            <h1 class="display-4">Frequently Asked Questions</h1>
            <br>
            <p style="text-align:left;" class="lead">Yang sering ditanyakan pelanggan</p>
            <hr class="my-4">
            <h3>Bagaimana saya dapat menggunakan layanan Laundry Online?</h3>
            <p> Dapat digunakan melalui website resmi Laundry Online yang dapat akses di www.LaundryOnlineMks.com</p>
                <br>
            <h3> Bagaimana Cara Order Laundry Online?</h3>
            <p>Melalui website Laundry Online, Kamu dapat membuat order dengan memilih lokasi Kamu untuk
             penjemputan dan pengembalian. Setelah itu, kamu pilih layanan yang kamu inginkan, buat order, dan menyelesaikan transaksi pembayaran. kemudian laundry akan di antarkan di alamatmu</p>
                <br>
            <h3> Apa saja layanan yang disediakan oleh Laundry Online ?</h3>
            <p>Jenis layanannya dua jenis Laundry, yaitu cuci kiloan dan satuan.</p>
         
            </div>
        </div>
    </div>
    </div>

    <hr id="hubungi-kami">
    <div class="jumbotron jumbotron-fluid bg-dark text-white">
        <div class="container">
            <div class="tengah">
            <h1 class="display-4">Hubungi Kami!</h1>
            <br>
            <p style="text-align:left;" class="lead">Jika ada keraguan, kami akan selalu tersedia untuk anda.</p>
            <hr class="my-4 bg-white">

            <!-- Di row ini isinya merupakan tutorial beserta gambar dengan bentuk kotak ya -->
            <div class="row">
                <div class="col-sm">
                    <br>
                    <h4>
                        <b>Alamat kami :</b>
                    </h4>
                    <p>Jl. Malino No 70, Mawang, Kec. Somba Opu, Kabupaten Gowa, Sulawesi Selatan 92119</p>
                    <br>
                    <h4>
                        <b>Nomor Telepon :</b>
                    </h4>
                    <p>(0411) 227 1XX XX</p>
                    <br>
                    <h4>
                        <b>Follow Us! :</b>
                    </h4>
                    <p><img src="images/img11.png" width="40px"><a style="color: white; " href="https://instagram.com/laundryonlinemks">LaundryOnlineGowa</a></p>
                    <p><img src="images/img8.png" width="55px">Laundry Online Gowa</p>   
                    <p><img src="images/img9.png" width="63px">@laundryonlineGowa</p>   
               

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
        <div class="footer-copyright text-center py-3">Copyright © 2020
            <a href="https://laundryonlinemks.com/"> Laundry OnLine</a>
        </div>
    </footer>
    <script>
    // fungsi initialize untuk mempersiapkan peta
    function initialize() {
        var propertiPeta = {
            center:new google.maps.LatLng(-5.2266391, 119.4978739),
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);

        // membuat Marker untuk lokasi laundry
        var marker=new google.maps.Marker({
            position: new google.maps.LatLng(-5.2266391, 119.4978739),
            map: peta,
            animation: google.maps.Animation.BOUNCE
        });
    }
    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);

    //Menggunakan DataTables
    $(document).ready(function() {
        $('#pagination').DataTable();
    });
</script>
</body>
</html>
