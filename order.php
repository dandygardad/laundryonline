<?php
session_start();
require_once "database.php";
// membuat objek
$pdo = new database();

// // Mengalihkan pengguna jika belum melakukan login
// if(!isset($_SESSION['name']) || ($_SESSION['email']) || ($_SESSION['nomortelepon'])){
// 	$_SESSION['msg'] = 'Anda Harus Melakukan Login Terlebih Dahulu Untuk Dapat Melakukan Pemesanan';
// 	header('Location: login.php');
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Mencegah data pesanan kosong
	if(empty($_POST['jenis_laundry']) || empty($_POST['jumlahBeratBarang']) || empty($_POST['tanggalPengambilan']) || 
	empty($_POST['tanggalPengantaran']) || empty($_POST['alamat']) || empty($_POST['catatan']) || empty($_POST['lat']) || empty($_POST['lng'])) {
        echo '<div class="box"><div class="square">';
        echo("Field tidak boleh kosong!");
        echo '</div></div>';
    }

    //Memasukkan Data Pesanan
    else{
        $_SESSION['message'] = 'Pesanan Berhasil Ditambahkan!, Silahkan Kembali <a href="/index.php">Home</a> ';
        echo '<div class="box"><div class="square">';
        echo $_SESSION['message'];
        echo '</div></div>';
		unset($_SESSION['message']);
		
        //Masukkan data pesanan ke database
		$pdo->tambah_pesanan($_POST['jenis_laundry'], $_POST['jumlahBeratBarang'], $_POST['tanggalPengambilan'], $_POST['tanggalPengantaran'], $_POST['alamat'], 
		$_POST['catatan'], $_POST['lat'], $_POST['lng'], $_POST['hargaTotal']);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<title>Pemesanan Laundry</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="css/order.css"/>
		<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
		<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	</head>
	<body>
		<div class="page-content" style="background-image: url('images/laundry2.jpg')">
			<div class="pemesanan">
				<div class="order-form">
					<div class="order-header">
						<h3 class="heading">Laundry onLine</h3>
						<p>Harap Mengisi Semua Data Yang Dibutuhkan</p>
					</div>
					<form class="form-order" action="" method="post" name="form-order" id="form-order" role="form">
							<h2>
								<span class="step-icon"><i class="zmdi zmdi-shopping-cart"></i></span>
								<span class="step-text">Pemesanan</span>
							</h2>
							<section>
								<div class="inner">
									<h3>Silahkan Isi Form Pemesanan Anda</h3>
									<div class="form-group" id="radio">
										<label>Pilih Jenis Laundry :</label>
                                        <label>
                                            <input type="radio" class="jenis_laundry" name="jenis_laundry" id="kiloanCheck" value="kiloan" checked>
                                        </label> Kiloan
                                        <label>
                                            <input type="radio" class="jenis_laundry" name="jenis_laundry" id="satuanCheck" value="satuan" >
                                        </label> Satuan
									</div>
									<div class="form-row" id="kiloan_checked" name="kiloan_checked">
										<div class="form-holder form-holder-1">
											<h5> Deskripsi Jasa:</h5> 
											<ol>
												<li>Perhitungan biaya berdasarkan 1 Kg = Rp. 5,000</li>
												<li>Minimum Order 4 Kg & Maksimum Order 20 Kg</li>
											</ol>
											<label class="form-row-inner">
												<input type="number" class="form-control" id="beratBarang" name="beratBarang" min="4" max="20" required>
												<span class="label">Berat Barang (Kg)</span>
												<span class="border"></span>
											</label>
										</div>
									</div>
									<div class="form-row" id="satuan_checked" name="satuan_checked" style="display:none">
										<div class="form-holder form-holder-2">
											<h5> Deskripsi Jasa:</h5> 
											<ol>
												<li>Perhitungan biaya berdasarkan satuan material yang di laundry</li>
												<li>Minimum Order Rp. 20,000</li>
											</ol>
										</div>
										<div class="form-group" id="checkbox">
											<input type="checkbox" id="handuk_mandi" name="handuk_mandi" value="10000">
											<label for="checkbox">Handuk Mandi</label><br>
											<input type="checkbox" id="sarung_bantal" name="sarung_bantal" value="20000">
											<label for="checkbox">Sarung Bantal</label><br>
											<input type="checkbox" id="sarung_guling" name="sarung_guling" value="30000">
											<label for="checkbox">Sarung Guling</label><br>
											<input type="checkbox" id="sarung_bantalKursi" name="sarung_bantalKursi" value="40000">
											<label for="checkbox">Sarung Bantal Kursi</label><br>
											<input type="checkbox" id="sprei" name="sprei" value="50000">
											<label for="checkbox">Sprei (160 x 200 cm)</label><br>
											<input type="checkbox" id="selimut" name="selimut" value="60000">
											<label for="checkbox">Selimut (200 x 200 cm)</label><br>
											<input type="checkbox" id="bed_cover" name="bed_cover" value="70000">
											<label for="checkbox">Bed Cover (200 x 200 cm)</label><br>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-1">
											<label class="form-row-inner" for="tanggalPengambilan">Pilih Tanggal Pengambilan :</label>
											<div class="form-holder form-holder-1">
												<input type="date" id="tanggalPengambilan" name="tanggalPengambilan">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-1">
											<label class="form-row-inner" for="tanggalPengantaran">Pilih Tanggal Pengantaran :</label>
											<div class="form-holder form-holder-1">
												<input type="date" id="tanggalPengantaran" name="tanggalPengantaran">
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<label class="form-row-inner">
												<input type="text" class="form-control" id="catatan" name="catatan" required>
												<span class="label">Tambahkan Catatan</span>
												<span class="border"></span>
											</label>
										</div>
									</div>
									<input type="hidden" id="jumlahBeratBarang" name="jumlahBeratBarang" value="">
									<input type="hidden" id="hargaTotal" name="hargaTotal" value="">
									<input type="hidden" id="harga-sementara" name="harga-sementara" value="0">
								</div>
							</section>
							<!-- Pilihan 2 -->
							<h2>
								<span class="step-icon"><i class="zmdi zmdi-home"></i></span>
								<span class="step-text">Alamat</span>
							</h2>
							<section>
								<div class="inner">
									<h3>Harap Masukkan Alamat Anda</h3>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<label class="form-row-inner">
												<input type="text" class="form-control" id="alamat" name="alamat" required>
												<span class="label">Alamat Lengkap</span>
												<span class="border"></span>
											</label>
										</div>
									</div>
									<div id="googleMaps" style="width:100%; height:380px;"></div>
									<input type="hidden" id="lat" name="lat" value="">
									<input type="hidden" id="lng" name="lng" value="">
								</div>
							</section>
							<!-- Pilihan 3 -->
							<h2>
								<span class="step-icon"><i class="zmdi zmdi-card"></i></span>
								<span class="step-text">Pembayaran</span>
							</h2>
							<section>
								<div class="inner">
									<h3>Payment Information:</h3>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<input type="radio" name="radio1" id="pay-1" value="pay-1" checked>
											<label class="pay-1-label" for="pay-1"><img src="images/creditcard_icon.png" alt="pay-1">Credit Card</label>
											<input type="radio" name="radio1" id="pay-2" value="pay-2">
											<label class="pay-2-label" for="pay-2"><img src="images/paypal_icon.png" alt="pay-2">Paypal</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<label class="form-row-inner">
												<input type="text" class="form-control" id="holder" name="holder" required>
												<span class="label">Nama Pemegang</span>
												<span class="border"></span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" id="card" name="card" required>
												<span class="label">Nomor Kartu</span>
												<span class="border"></span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" id="cvc" name="cvc" required>
												<span class="label">CVC</span>
												<span class="border"></span>
											</label>
										</div>
									</div>
								</div>
							</section>
							<!-- Pilihan 4 -->
							<h2>
								<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
								<span class="step-text">Konfirmasi</span>
							</h2>
							<section>
								<div class="inner">
									<h3>Detail Konfirmasi :</h3>
									<div class="form-row table-responsive">
										<table class="table">
											<tbody>
												<tr class="space-row">
													<th>Jenis Laundry </th>
													<td id="jenis_laundry-val"></td>
												</tr>
												<tr class="space-row">
													<th id="beratBarangText">Berat Barang </th>
													<td id="berat_barang-val"></td>
												</tr>
												<tr class="space-row">
													<th id="jumlahBarangText" style="display:none">Jumlah Barang </th>
													<td id="jumlah_barang-val" style="display:none"></td>
												</tr>
												<tr class="space-row">
													<th>Catatan Tambahan </th>
													<td id="catatan-val"></td>
												</tr>
												<tr class="space-row">
													<th>Waktu Pengambilan </th>
													<td id="waktu_pengambilan-val"></td>
												</tr>
												<tr class="space-row">
													<th>Waktu Pengantaran </th>
													<td id="waktu_pengantaran-val"></td>
												</tr>
												<tr class="space-row">
													<th>Alamat </th>
													<td id="alamat-val"></td>
												</tr>
												<tr class="space-row">
													<th>Garis Lintang </th>
													<td id="lat-val"></td>
												</tr>
												<tr class="space-row">
													<th>Garis Bujur </th>
													<td id="lng-val"></td>
												</tr>
												<tr class="space-row">
													<th>Harga Total </th>
													<td id="harga-val"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</section>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/jquery.steps.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/order.js"></script>
		<script src="https://maps.google.com/maps/api/js?"></script> 
	</body>
</html>