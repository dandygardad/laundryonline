<?php

require_once "database.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wizard-v3</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- datepicker -->
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
	<div class="page-content" style="background-image: url('pictures/login.jpg')">
		<div class="wizard-v3-content">
			<div class="wizard-form">
				<div class="wizard-header">
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
                                    <input type="radio" name="jenis_laundry" value="kiloan" checked class="radio-1"> Kiloan
                                      <input type="radio" name="jenis_launry" value="satuan"> Satuan
                                </div>
			                	<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
                                            <div class="title">Pilih Waktu Pengambilan</div>
                                            <div class="form-group mb-4 p-1">
                                                <label for="dateInput">Tanggal Pengambilan</label>
                                                <datepicker :disabled="datepicker.disabled" v-model="jobDatePicker" format="yyyy-MM-dd"
                                                name="projectData[dateInput]" input-class="form-control input_text" id="dateInput"
                                                placeholder="Click here to select a date" required></datepicker>
                                                <input type="text" class="input_text form-control" v-bind:value="deliveryDate"
                                                id="dateInputOther" name="projectData[dateInputOther]"
                                                placeholder="Tanggal Pengantaran" readonly>
                                                <span v-show="errors.has('step1.projectData[hourInputOther]')" class="help is-danger">Kolom harus diisi</span>
                                            </div>
										</label>
									</div>
                                </div>
                                <div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
                                            <div class="title">Pilih Waktu Pengantaran</div>
                                            <div class="form-group mb-4 p-1">
                                                <label for="dateInputOther">Tanggal Pengantaran</label>
                                                <input type="text" class="input_text form-control" v-bind:value="deliveryDate"
                                                    id="dateInputOther" name="projectData[dateInputOther]"
                                                    placeholder="Tanggal Pengantaran" readonly>
                                                    <span v-show="errors.has('step1.projectData[hourInputOther]')" class="help is-danger">Kolom harus diisi</span>
                                            </div>
										</label>
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
											<span class="label">Holder Name*</span>
					  						<span class="border"></span>
										</label>
									</div>
								</div>
			                	<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="card" name="card" required>
											<span class="label">Card Number*</span>
											<span class="border"></span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" id="cvc" name="cvc" required>
											<span class="label">CVC*</span>
											<span class="border"></span>
										</label>
									</div>
								</div>
			                	<div class="form-row form-row-date form-row-date-1">
									<div class="form-holder form-holder-2">
										<label for="date" class="special-label">Expiry Date*:</label>
										<select name="month_1" id="month_1">
											<option value="Month" disabled selected>Month</option>
											<option value="Feb">Feb</option>
											<option value="Mar">Mar</option>
											<option value="Apr">Apr</option>
											<option value="May">May</option>
										</select>
										<select name="year_1" id="year_1">
											<option value="Year" disabled selected>Year</option>
											<option value="2017">2017</option>
											<option value="2016">2016</option>
											<option value="2015">2015</option>
											<option value="2014">2014</option>
											<option value="2013">2013</option>
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
	<script src="js/main.js"></script>
</body>
</html>