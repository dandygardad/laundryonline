<?php
session_start();
require_once "database.php";

$pdo = new database();

if (isset($_POST['submit'])){

    //Mencegah data pesanan kosong
    if(empty($_POST['jenis_laundry']) || empty($_POST['jumlahBarang']) || empty($_POST['tanggalPengambilan']) || empty($_POST['tanggalPengantaran']) || empty($_POST['alamat']) || empty($_POST['catatan'])) {
        echo '<div class="box"><div class="square">';
        echo("Field tidak boleh kosong!");
        echo '</div></div>';
    }

    //Memasukkan Data Pesanan
    else{
        $_SESSION['message'] = 'Pesanan telah ditambahkan, Silahkan kembali <a href="/index.html">Home</a> ';
        echo '<div class="box"><div class="square">';
        echo $_SESSION['message'];
        echo '</div></div>';
        unset($_SESSION['message']);
        
        //Masukkan data pesanan ke database
        $pdo->tambah_pesanan($_POST['jenis_laundry'], $_POST['jumlahBarang'], $_POST['tanggalPengambilan'], $_POST['tanggalPengantaran'], $_POST['alamat'], $_POST['catatan']);
    }
} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pemesanan Laundry</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/order.css"/>
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
</head>
<body>
	<div class="page-content" style="background-image: url('pictures/login.jpg')">
		<div class="pemesanan">
			<div class="order-form">
				<div class="order-header">
					<h3 class="heading">Laundry onLine</h3>
					<p>Harap Mengisi Semua Data Yang Dibutuhkan</p>
				</div>
		        <form class="form-register" action="#" method="post">
		        	<div id="form-total">
		        		<!-- Pilihan 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-shopping-cart"></i></span>
			            	<span class="step-text">Pemesanan</span>
			            </h2>
			            <section>
			                <div class="inner">
                                <h3>Silahkan Isi Form Pemesanan Anda</h3>
                                <div id="radio">
                                    <label>Pilih Jenis Laundry :</label>
                                    <input type="radio" name="jenis_laundry" value="kiloan"> Kiloan
                                    <input type="radio" name="jenis_launry" value="satuan"> Satuan
								</div>
								<div class="service-desc-box">
                            		<span class="service-desc-box-text">
                                        <strong> Deskripsi Jasa:</strong> <br> <ol><li>Perhitungan biaya berdasarkan timbangan yang di laundry</li><li>Minimum order 5 kg</li></ol>
                                    </span>
                        		</div>
								<div class="form-row">
									<div class="form-holder form-holder-1">
										<label class="form-row-inner">
											<input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang" min="1" max="50" required>
											<span class="label">Jumlah Barang</span>
					  						<span class="border"></span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner" for="tanggalPengambilan">Pilih Tanggal Pengambilan</label>
										<div class="form-holder">
											<input type="date" id="tanggalPengambilan" name="tanggalPengambilan">
										</div>
									</div>
	                    		</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner" for="tanggalPengantaran">Pilih Tanggal Pengantaran</label>
										<div class="form-holder">
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
                                <div class="price">
                                        Harga Total
                                </div>
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
									<div class="form-holder form-holder-1">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="alamat" name="alamat" required>
											<span class="label">Alamat Lengkap</span>
					  						<span class="border"></span>
										</label>
									</div>
								</div>
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
			                			<label class="pay-1-label" for="pay-1"><img src="pictures/creditcard_icon.png" alt="pay-1">Credit Card</label>
										<input type="radio" name="radio1" id="pay-2" value="pay-2">
										<label class="pay-2-label" for="pay-2"><img src="pictures/paypal_icon.png" alt="pay-2">Paypal</label>
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
			                	<div class="form-row form-row-date form-row-date-1">
									<div class="form-holder form-holder-2">
										<label for="date" class="special-label">Tanggal Kadaluarsa:</label>
										<select name="month_1" id="month_1">
											<option value="Month" disabled selected>Bulan</option>
											<option value="Feb">Jan</option>
											<option value="Mar">Feb</option>
											<option value="Apr">Mar</option>
											<option value="May">Apr</option>
											<option value="Feb">Mei</option>
											<option value="Mar">Jun</option>
											<option value="Apr">Jun</option>
											<option value="May">Agt</option>
											<option value="May">Sep</option>
											<option value="May">Okt</option>
											<option value="May">Nov</option>
											<option value="May">Des</option>
										</select>
										<select name="year_1" id="year_1">
											<option value="Year" disabled selected>Tahun</option>
											<option value="2017">2024</option>
											<option value="2016">2023</option>
											<option value="2015">2022</option>
											<option value="2014">2021</option>
											<option value="2013">2020</option>
										</select>
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
                                                <th>Jenis Laundry</th>
												<td id="jenis_laundry-val"></td>
											</tr>
											<tr class="space-row">
												<th>Jumlah Barang:</th>
												<td id="jumlah_barang-val"></td>
											</tr>
											<tr class="space-row">
												<th>Waktu Pengambilan:</th>
												<td id="waktu_pengambilan-val"></td>
											</tr>
											<tr class="space-row">
                                                <th>Waktu Pengantaran:</th>
                                                <td id="waktu_pengantaran-val"></td>
											</tr>
											<tr class="space-row">
												<th>Alamat:</th>
												<td id="alamat-val"></td>
                                            </tr>
                                            <tr class="space-row">
												<th>Catatan Tambahan:</th>
												<td id="catatan-val"></td>
                                            </tr>
                                            <tr class="space-row">
												<th>Harga:</th>
												<td id="harga-val"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.steps.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/order.js"></script>
</body>
</html>