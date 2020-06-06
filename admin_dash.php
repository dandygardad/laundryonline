<?php
session_start();
require_once "database.php";
//Memanggil kelas database
$pdo = new database();
$edit_form = false;
$view_order = false;

//Init
$garisLintang = "";
$garisBujur = "";

//Jika user belum login dan membuka ini, maka langsung diarahkan ke halaman login
if(isset($_SESSION['email']) == 0){
    exit("<h1>Access Denied</h1>");
}

//Akses selain e-mail admin akan ditolak
//Ubah e-mailnya jika ingin mengganti akun admin
if($_SESSION['email'] != 'dandygarda@gmail.com'){
    exit("<h1>Access Denied</h1>");
}

//Memunculkan data customers
$rows = $pdo -> showData();

//Memunculkan data order
$orders = $pdo -> showPesanan();

//Menghapus data
if (isset($_POST['delete'])){
    //Jika tekan hapus admin
    //Ubah nomor jika id admin berubah
    if($_POST['id'] == 49){
        echo('<div class="alert alert-danger" role="alert">');
        echo('Tidak bisa hapus administrator');
        echo('</div>');
    }
    else{
        $pdo -> deleteData($_POST['id']);
        header("Location: admin_dash.php#customers");
    }
}

//Mengambil data dan menaruh di kotak edit customer
if(isset($_GET['edit'])){
    $data = $pdo -> getData($_GET['edit']);
    $edit_form = true;
    $name = $data['name'];
    $email = $data['email'];
    $nomor_telepon = $data['nomor_telepon'];
    $id = $data['id'];
}

//Mengambil data dan menaruh di kotak view order
if(isset($_GET['view'])){
    $pemesanan = $pdo -> getOrder($_GET['view']);
    $view_order = true;
    $userId = $pemesanan['id_user'];
    $jenisLaundry = $pemesanan['jenis_laundry'];
    $massaBarang = $pemesanan['massa_barang'];
    $jumlahBarang = $pemesanan['jumlah_barang'];
    $waktuPengambilan = $pemesanan['waktu_pengambilan'];
    $waktuPengantaran = $pemesanan['waktu_pengantaran'];
    $alamat = $pemesanan['alamat'];
    $catatan = $pemesanan['catatan'];
    $garisLintang = "".$pemesanan['garis_lintang'].", ";
    $garisBujur = $pemesanan['garis_bujur'];
    $hargaTotal = $pemesanan['harga_total'];
    $statusPemesanan = $pemesanan['status_pemesanan'];
    $orderId = $pemesanan['id'];
    $listSatuan = $pemesanan['list_satuan'];
}

//Mengupdate data customers
if(isset($_POST['update'])){
    $update = $pdo -> updateData($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['nomor_telepon'], $id);
    header("Location: admin_dash.php#customers");
}

//Mengupdate data order
if(isset($_POST['update_order'])){
    $radio_status = $_POST['status'];
    $update = $pdo -> updateStatus($radio_status, $orderId);
    header("Location: admin_dash.php#pesanan");
}

//Untuk tombol membatalkan edit
if(isset($_POST['cancel'])){
    header("Location: admin_dash.php#customers");
}

//Untuk tombol membatalkan edit
if(isset($_POST['cancel_update'])){
    header("Location: admin_dash.php#pesanan");
}

//Mengambil jumlah data customers
$banyakdata = $pdo -> banyak_data();

//Mengambil jumlah data pesanan
$banyakpesanan = $pdo -> banyak_pesanan();
?>

<!DOCTYPE html>
<head>
    <title>Dashboard Admin - Laundry OnLine</title>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKtmUDqFDJ8-D3F0nJM4bpiD4hAR-fzeo"></script>
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
            <p class="lead">Anda berada di ruang admin, cek pesanan dan profil customers disini.</p>
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
                <div class="col-6"><div class="tengah"><img src="images/pesanan.png" width="100px"></div></div>
                <div class="col-6"><div class="tengah"><img src="images/users.png" width="100px"></div></div>
            </div>
            <br>
            <div class="row">
                <div class="col-6"><div class="tengah"><h5><?php echo $banyakpesanan ?> pesanan</h5></div></div>
                <div class="col-6"><div class="tengah"><h5><?php echo $banyakdata; ?> customers</h5></div></div>
            </div>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <h1 class="tengah" id ="pesanan">Pesanan</h1>
            <p class="tengah">Daftar pesanan dari customers.
            </p>
            <br>
            <table id="pagination" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID User</th>
                        <th scope="col">Jenis Laundry</th>
                        <th scope="col">List Satuan</th>
                        <th scope="col">Massa Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Harga Total</th>
                        <th scope="col">Status Pemesanan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach( $orders as $order){
                    ?>
                    <tr>
                        <th scope="row"><?=$order['id_user'] ?></th>
                        <td><?=$order['jenis_laundry'] ?></td>
                        <td><?=$order['list_satuan'] ?></td>
                        <td><?=$order['massa_barang'] ?></td>
                        <td><?=$order['jumlah_barang'] ?></td>
                        <td><?=$order['harga_total'] ?></td>
                        <td><?=$order['status_pemesanan'] ?></td>
                        <td>
                            <form action="admin_dash.php?view=<?php echo $order['id']; ?>#pesanan" method="post">
                                <input type="hidden" name="id" value="<?=$order['id']?>">
                                <input type="submit" value="View" name="view">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <br><br>
            <?php 
                if ($view_order == false){
                    // Kosong
                }
                else{
            ?>
                    <h4 class="tengah">View Data</h4>
                    <ul>
                        <li>ID User : <?php echo $userId; ?></li><br>
                        <li>Jenis Laundry : <?php echo $jenisLaundry; ?></li><br>
                        <li>List Satuan : <?php echo $listSatuan; ?></li><br>
                        <li>Massa Barang : <?php echo $massaBarang; ?></li><br>
                        <li>Jumlah Barang : <?php echo $jumlahBarang; ?></li><br>
                        <li>Waktu Pengambilan : <?php echo $waktuPengambilan; ?></li><br>
                        <li>Waktu Pengantaran : <?php echo $waktuPengantaran; ?></li><br>
                        <li>Alamat : <?php echo $alamat; ?></li><br>
                        <li>Catatan : <?php echo $catatan; ?></li><br>
                        <li>Harga Total : <?php echo $hargaTotal; ?></li><br>
                        <li>Lokasi : </li><br>
                        <div id="googleMaps" style="width:50%; height:440px; border:solid black 1px;"></div>
                        <br>
                        <form method="post">
                        <li>Status Pemesanan :</li><br>
                        <input type="radio" id="tunggu_konfirmasi" name="status" value="Tunggu Konfirmasi" checked>
                        <label for="tunggu_konfirmasi">Tunggu Konfirmasi</label><br>
                        <input type="radio" id="diambil_kurir" name="status" value="Kurir mengambil laundry">
                        <label for="diambil_kurir">Kurir mengambil laundry</label><br>
                        <input type="radio" id="dicuci" name="status" value="Sementara dicuci">
                        <label for="dicuci">Sementara dicuci</label><br>
                        <input type="radio" id="diantar_kurir" name="status" value="Kurir mengantar laundry">
                        <label for="diantar_kurir">Kurir mengantar laundry</label><br>
                        <input type="radio" id="selesai" name="status" value="Selesai">
                        <label for="selesai">Selesai</label>
                    </ul>
                    <?php
                }
                    ?>
                <?php 
                    if($view_order == false){
                        //Kosong
                    } 
                    else{ ?>
                        <p class="tengah">
                            <input type="submit" name="update_order" value="Update"/>
                            <input type="submit" name="cancel_update" value="Cancel"/>
                        </p>
                    </form>
                <?php
                    } 
                ?>
        </div>
    </div>
    
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <h1 class="tengah" id ="customers">Profil Customers</h1>
            <p class="tengah">Daftar customers yang terdaftar.
            </p>
            <br>
            <table id="pagination2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID User</th>
                        <th scope="col">Nama</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ( $rows as $row ) {
                    ?>
                    <tr>
                        <th><?=$row['id']?></th>
                        <th><?=$row['name'] ?></th>
                        <td><?=$row['email'] ?></td>
                        <td><?=$row['nomor_telepon']?></td>
                        <td>
                            <form action="admin_dash.php?edit=<?php echo $row['id']; ?>#customers" method="post">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <input type="submit" value="Edit" name="edit">
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                <input type="submit" value="Delete" name="delete">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <?php 
    if($edit_form == false){
    // Kosong
    } 
    else{ ?>
        <!-- Untuk memunculkan edit customer -->
        <h4 class="tengah">Edit customer</h4>
        <form method="post">
            <p class="tengah">Nama : </p>
            <p class="tengah"><input type="text" class = "tengah" name="nama" value="<?php echo $name; ?>"></p>
        <p class="tengah">E-mail : </p>
            <p class="tengah"><input type="email" class = "tengah" name="email" value="<?php echo $email; ?>"></p>
        <p class="tengah">Password : </p>
            <p class="tengah"><input type="password" class = "tengah" name="password" id="password"></p>
            <p class="tengah"><input type="checkbox" onclick="myFunction()"> Show Password</p>
        <p class="tengah">Nomor Telepon : </p>
            <p class="tengah"><input type="text" class="tengah" name="nomor_telepon" value="<?php echo $nomor_telepon; ?>"></p>
        
    <?php
    } ?>
    <br>
<?php 
    if($edit_form == false){ ?>
    <?php
    } 
    else{ ?>
        <p class="tengah"><input type="submit" name="update" value="Update"/>
        <input type="submit" name="cancel" value="Cancel"/>
        </p>
        </form>
    <?php
    } ?>
    </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3 bg-dark text-white">© 2020 Copyright:
    <a href="https://laundryonlinemks.com/"> Laundry OnLine</a>
  </div>
</footer>

</div>
</div>
</body>

<script>
    //Menggunakan library DataTables
    $(document).ready(function() {
        $('#pagination').DataTable();
    } );

    $(document).ready(function() {
        $('#pagination2').DataTable();
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

// fungsi initialize untuk mempersiapkan peta
function initMap() {

        // Menentukan koordinat awal peta, perbesaran, serta jenis peta
        var propertiPeta = {
            center:new google.maps.LatLng(<?php echo $garisLintang; ?> <?php echo $garisBujur; ?>),
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        // Inisiasi peta sesuai dengan Id yang telah ditentukan
        var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);
        
        // Menambahkan penanda pada peta
        var marker=new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $garisLintang; ?> <?php echo $garisBujur; ?>),
            map: peta,
            animation: google.maps.Animation.BOUNCE
        });
    }
    // event jendela dimuat  
    google.maps.event.addDomListener(window, 'load', initMap);
</script>