<?php
session_start();
require_once "database.php";
// membuat objek
$pdo = new database();

//Jika user belum login dan membuka halaman order, maka langsung diarahkan ke halaman login
if(isset($_SESSION['email']) == 0){
    header('Location: login.php');
}

//Jika admin login, maka langsung diarahkan ke halaman dashboard admin
//Ubah e-mailnya jika ingin mengganti akun admin
if($_SESSION['email'] == 'admin@laundryonlinemks.com'){
    header('Location: admin_dash.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Mencegah data pesanan kosong
	if(empty($_POST['jenis_laundry']) || empty($_POST['tanggalPengambilan']) || empty($_POST['tanggalPengantaran']) || 
	empty($_POST['alamat']) || empty($_POST['lat']) || empty($_POST['lng']) || empty($_POST['hargaTotal'])) {
		$message = "Harap Mengisi Semua Data!";
		echo "<script type='text/javascript'>alert('$message');</script>";
    }

    //Memasukkan Data Pesanan
    else{
		
		// Menampilkan pesan dan kembali ke halaman dashboard pengguna
		echo "<script>alert('Pesanan Berhasil Ditambahkan!, Silahkan Kembali Ke Halaman Sebelumnya'); window.location.href='index.php'; </script>";

		$status = "Tunggu Konfirmasi";
        //Masukkan data pesanan ke database
		$pdo->tambah_pesanan($_POST['jenis_laundry'], $_POST['beratBarang'], $_POST['jumlahBarang'], $_POST['tanggalPengambilan'], $_POST['tanggalPengantaran'], 
		$_POST['alamat'], $_POST['catatan'], $_POST['lat'], $_POST['lng'], $_POST['hargaTotal'], $status, $_SESSION['id'], $_POST['list_satuan']);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Pemesanan Laundry</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="css/order.css"/>
		<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
		<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/jquery.steps.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/order.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKtmUDqFDJ8-D3F0nJM4bpiD4hAR-fzeo"></script>
	</head>
	<body>
		<div class="page-content" style="background-image: url('images/laundry2.jpg')">
			<div class="pemesanan">
				<div class="order-form">
					<div class="order-header">
						<h3 class="heading">Laundry OnLine</h3>
						<p>Harap Mengisi Semua Data Yang Dibutuhkan</p>
					</div>
					<form class="form-order" action="" method="post" name="form-order" id="form-order">
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
										<input type="radio" class="jenis_laundry" name="jenis_laundry" id="kiloanCheck" value="Kiloan" checked>
									</label> Kiloan
									<label>
										<input type="radio" class="jenis_laundry" name="jenis_laundry" id="satuanCheck" value="Satuan" >
									</label> Satuan
								</div>
								<div class="form-row" id="kiloan_checked" name="kiloan_checked">
									<div class="form-holder form-holder-1">
										<h5> Deskripsi Jasa:</h5> 
										<ol>
											<li>Perhitungan biaya berdasarkan 1 Kg = Rp. 5,000</li>
											<li>Minimum Order 4 Kg</li>
										</ol>
										<label class="form-row-inner">
											<input type="number" class="form-control" id="beratBarang" name="beratBarang" min="4" max="50">
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
										<table class="table">
											<td>
												<input type="checkbox" id="Baju Kaos" name="baju_kaos" value="10000">
												<label for="checkbox">Kaos/T-Shirt - Rp. 10,000</label><br>

												<input type="checkbox" id="Kemeja" name="kemeja" value="20000">
												<label for="checkbox">Kemeja - Rp. 20,000</label><br>

												<input type="checkbox" id="Kemeja Batik" name="kemeja_batik" value="20000">
												<label for="checkbox">Kemeja Batik - Rp. 20,000</label><br>

												<input type="checkbox" id="Baju Muslim" name="baju_muslim" value="20000">
												<label for="checkbox">Baju Muslim - Rp. 20,000</label><br>
			
												<input type="checkbox" id="Kebaya" name="kebaya" value="40000">
												<label for="checkbox">Kebaya - Rp. 40,000</label><br>

												<input type="checkbox" id="Gaun Panjang" name="gaun_panjang" value="25000">
												<label for="checkbox">Gaun Panjang - Rp. 25,000</label><br>
												
												<input type="checkbox" id="Rok" name="rok" value="15000">
												<label for="checkbox">Rok - Rp. 15,000</label><br>

												<input type="checkbox" id="Sweater" name="sweater" value="20000">
												<label for="checkbox">Baju Hangat/Sweater - Rp. 20,000</label><br>

												<input type="checkbox" id="Jaket" name="jaket" value="30000">
												<label for="checkbox">Jaket - Rp. 30,000</label><br>

												<input type="checkbox" id="Jas" name="jas" value="45000">
												<label for="checkbox">Jas/Blazer - Rp. 45,000</label><br>

												<input type="checkbox" id="Celana Pendek" name="celana_pendek" value="10000">
												<label for="checkbox">Celana Pendek - Rp. 10,000</label><br>

												<input type="checkbox" id="Celana Panjang" name="celana_panjang" value="20000">
												<label for="checkbox">Celana Panjang - Rp. 20,000</label><br>

												<input type="checkbox" id="Sarung" name="sarung" value="20000">
												<label for="checkbox">Sarung - Rp. 20,000</label><br>
											</td>

											<td>
												<input type="checkbox" id="Tas" name="tas" value="30000">
												<label for="checkbox">Tas Sekolah/Ransel - Rp. 30,000</label><br>

												<input type="checkbox" id="Kerudung" name="kerudung" value="10000">
												<label for="checkbox">Selendang/Kerudung - Rp. 10,000</label><br>

												<input type="checkbox" id="Blouse" name="blouse" value="15000">
												<label for="checkbox">Blouse - Rp. 15,000</label><br>

												<input type="checkbox" id="Mukena" name="mukena" value="25000">
												<label for="checkbox">Mukena - Rp. 25,000</label><br>

												<input type="checkbox" id="Sajadah" name="sajadah" value="20000">
												<label for="checkbox">Sajadah - Rp. 20,000</label><br>

												<input type="checkbox" id="Topi" name="topi" value="10000">
												<label for="checkbox">Topi - Rp. 10,000</label><br>
												
												<input type="checkbox" id="Handuk Mandi" name="handuk_mandi" value="25000">
												<label for="checkbox">Handuk Mandi - Rp. 25,000</label><br>

												<input type="checkbox" id="Bantal" name="bantal" value="20000">
												<label for="checkbox">Bantal - Rp. 20.000</label><br>

												<input type="checkbox" id="Sarung Bantal" name="sarung_bantal" value="5000">
												<label for="checkbox">Sarung Bantal/Guling - Rp. 5,000</label><br>

												<input type="checkbox" id="Sprei" name="sprei" value="15000">
												<label for="checkbox">Sprei Single - Rp. 15,000</label><br>

												<input type="checkbox" id="Selimut" name="selimut" value="25000">
												<label for="checkbox">Selimut - Rp. 25,000</label><br>

												<input type="checkbox" id="Bed Cover" name="bed_cover" value="60000">
												<label for="checkbox">Bed Cover - Rp. 60.000</label><br>

												<input type="checkbox" id="Keset" name="keset" value="20000">
												<label for="checkbox">Keset - Rp. 20,000</label><br>
											</td>
										</table><br>
										<label>Jumlah Barang: <input type="text" id="jumlahBarang" name="jumlahBarang" class="jumlahBarang" value="0" readonly="readonly"/></label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label class="form-row-inner" for="tanggalPengambilan">Pilih Tanggal Pengambilan :</label>
										<div class="form-holder form-holder-1">
											<input type="date" id="tanggalPengambilan" name="tanggalPengambilan" required>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label class="form-row-inner" for="tanggalPengantaran">Pilih Tanggal Pengantaran :</label>
										<div class="form-holder form-holder-1">
											<input type="date" id="tanggalPengantaran" name="tanggalPengantaran" required>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="catatan" name="catatan">
											<span class="label">Tambahkan Catatan</span>
											<span class="border"></span>
										</label>
									</div>
								</div>
								<p class="harga-total">
									<label>Harga Total: Rp. <input type="text" id="hargaTotal" name="hargaTotal" class="harga-total" value="0" readonly="readonly" /></label>
								</p>
								<input type="hidden" id="harga-sementara" name="harga-sementara" value="0">
								<input type="hidden" id="list_satuan" name="list_satuan" value="">
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
								<span>Tentukan titik lokasi anda :</span>
								<p></p>
								<div id="googleMaps" style="width:100%; height:380px; border:solid black 1px;"></div>
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
								<h3>Metode Pembayaran:</h3>
								<div class="form-row table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<input type="radio" class="pay" name="pay" id="cod" value="COD" checked>
												<span class="label">Cash On Delivery</span>
												<th class="space-row">
													<img src="images/cod192.png" alt="pay-1">
												</th>
											</tr>
											<tr class="space-row">
												<th>
													<span class="label">Pembayaran dengan metode lain masih dalam tahap pengembangan dan pembelajaran</span>
												</th>
											</tr>
										</tbody>
									</table>
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
												<th>
													<input type="checkbox" id="tampilkanPeta" name="tampilkanPeta" value="">
													<label for="checkbox">Tampilkan Peta</label>
												</th>
												<td>
													<div id="googleMapsK" style="width:100%; height:200px; display:none;"></div>
												</td>
											</tr>
											<tr class="space-row">
												<th>Harga Total </th>
												<td id="harga-val"></td>
											</tr>
											<tr class="space-row">
												<th>Metode Pembayaran </th>
												<td id="pay-val"></td>
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
	</body>
</html>