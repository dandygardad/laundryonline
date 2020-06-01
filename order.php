<!DOCTYPE HTML>
<?php

require_once "database.php";

?>

<html lang="id">
    <head>
        <link rel="stylesheet" type="text/css" href="order.css">
        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    </head>
   
    <body>
        <div class="container">
            <div class="card border-0 shadow my-5">
                <div class="card-body p-5">
                    <section id="content">
                        <div class="container">
                            <div id="banner-mobile" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active ">
                                        <img src="https://s3-ap-southeast-1.amazonaws.com/apic-asset/services-banner/18_serviceBannerPhoto7863.jpg" onError="this.onerror=null;this.src='http://via.placeholder.com/500x350'" class="d-block d-sm-none w-100">
                                    </div>
                                    <div class="carousel-item  ">
                                        <img src="https://s3-ap-southeast-1.amazonaws.com/apic-asset/services-banner/19_serviceBannerPhoto7596.jpg" onError="this.onerror=null;this.src='http://via.placeholder.com/500x350'" class="d-block d-sm-none w-100">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5 row mt-3">
                                <div class="col-sm-8 col-12">
                                    <div class="question_service_ttl">
                                                    Jasa Laundry Antar Jemput Berbasis Online
                                    </div>
                                    <div class="card question_left mb-6">
                                        <form role="form" class="registration-form" id="form" action="" method="POST">
                                            <div class="card-body">
                                                <fieldset>
                                                    <div class="p-2">
                                                        <div class="title">Pilih Jenis Laundry</div>
                                                        <div class="row mb-3 p-2">
                                                            <div class="form-check px-2 col-sm-6">
                                                                <label class="form-check-label font-weight-normal">
                                                                    <input class="form-check-input ac-type" type="radio" name="laundry-weight" 
                                                                    id="laundry-weight" value="laundry-weight"
                                                                    onclick="changeService(550)"
                                                                    checked
                                                                    required> Kiloan
                                                                </label>
                                                            </div>
                                                            <div class="form-check px-2 col-sm-6">
                                                                <label class="form-check-label font-weight-normal">
                                                                    <input class="form-check-input ac-type" type="radio" name="laundry-perPiece"
                                                                    id="laundry-perPiece" value="laundry-perPiece"
                                                                    onclick="changeService(555)"
                                                                    required> Satuan
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="title">Pilih Waktu Pengambilan</div>
                                                        <div class="form-group mb-4 p-1">
                                                            <label for="dateInput">Tanggal</label>
                                                            <datepicker :disabled="datepicker.disabled" v-model="jobDatePicker" format="yyyy-MM-dd"
                                                            name="projectData[dateInput]" input-class="form-control input_text" id="dateInput"
                                                            placeholder="Click here to select a date" required></datepicker>
                                                        </div>
                                                        <div class="form-group" id="datetimehoursdisplay">
                                                            <label>Waktu</label>
                                                            <select
                                                            v-validate="'required'"
                                                            data-vv-scope="step1"
                                                            name="projectData[hourInput]"
                                                            :class="{'input': true, 'is-danger': errors.has('step1.projectData[hourInput]') }"
                                                            v-model="jobHour" id="hourInput" class="form-control">
                                                                <option value=''>Waktu Pengambilan</option>
                                                                <option value="8:00" data-value="8">8:00</option>
                                                                <option value="9:00" data-value="9">9:00</option>
                                                                <option value="10:00" data-value="10">10:00</option>
                                                                <option value="11:00" data-value="11">11:00</option>
                                                                <option value="12:00" data-value="12">12:00</option>
                                                                <option value="13:00" data-value="13">13:00</option>
                                                                <option value="14:00" data-value="14">14:00</option>
                                                                <option value="15:00" data-value="15">15:00</option>
                                                                <option value="16:00" data-value="16">16:00</option>
                                                                <option value="17:00" data-value="17">17:00</option>
                                                                <option value="18:00" data-value="18">18:00</option>
                                                            </select>
                                                            <select
                                                            v-validate="'required'"
                                                            data-vv-scope="step1"
                                                            name="projectData[hourInput]"
                                                            :class="{'input': true, 'is-danger': errors.has('step1.projectData[hourInput]') }"
                                                            v-model="jobHour" id="hourInputWeekend" class="form-control" style="display: none;">
                                                                <option value=''>Kapan anda membutuhkan pengerjaan</option>
                                                                <option value="8:00" data-value="8">8:00</option>
                                                                <option value="9:00" data-value="9">9:00</option>
                                                                <option value="10:00" data-value="10">10:00</option>
                                                                <option value="11:00" data-value="11">11:00</option>
                                                                <option value="12:00" data-value="12">12:00</option>
                                                                <option value="13:00" data-value="13">13:00</option>
                                                                <option value="14:00" data-value="14">14:00</option>
                                                                <option value="15:00" data-value="15">15:00</option>
                                                                <option value="16:00" data-value="16">16:00</option>
                                                                <option value="17:00" data-value="17">17:00</option>
                                                                <option value="18:00" data-value="18">18:00</option>
                                                            </select>
                                                            <span v-show="errors.has('step1.projectData[hourInput]')" class="help is-danger">Kolom harus diisi</span>
                                                        </div>
                                                        <div class="title">Pilih Waktu Pengantaran</div>
                                                        <div class="form-group mb-4 p-1">
                                                            <label for="dateInputOther">Tanggal Pengantaran</label>
                                                            <input type="text" class="input_text form-control" v-bind:value="deliveryDate"
                                                                id="dateInputOther" name="projectData[dateInputOther]"
                                                                placeholder="Tanggal Pengantaran" readonly>
                                                        </div>
                                                        <div class="form-group mb-4 p-1" id="datetimehoursdisplay">
                                                            <label>Waktu Pengantaran</label>
                                                            <select
                                                            v-validate="'required'"
                                                            data-vv-scope="step1"
                                                            name="projectData[hourInputOther]"
                                                            :class="{'input': true, 'is-danger': errors.has('step1.projectData[hourInputOther]') }"
                                                            class="form-control" id="hourInputOther">
                                                                <option value=''>Waktu Pengantaran</option>
                                                                <option value="8:00" data-value="8:00" >8:00</option>
                                                                <option value="9:00" data-value="9:00" >9:00</option>
                                                                <option value="10:00" data-value="10:00" >10:00</option>
                                                                <option value="11:00" data-value="11:00" >11:00</option>
                                                                <option value="12:00" data-value="12:00" >12:00</option>
                                                                <option value="13:00" data-value="13:00" >13:00</option>
                                                                <option value="14:00" data-value="14:00" >14:00</option>
                                                                <option value="15:00" data-value="15:00" >15:00</option>
                                                                <option value="16:00" data-value="16:00" >16:00</option>
                                                                <option value="17:00" data-value="17:00" >17:00</option>
                                                                <option value="18:00" data-value="18:00" >18:00</option>
                                                            </select>
                                                            <span v-show="errors.has('step1.projectData[hourInputOther]')" class="help is-danger">Kolom harus diisi</span>
                                                        </div>
                                                        <div class="price">
                                                            <div class="service_description my-4" id="ac-installation-note" style="display: none">
                                                                <div class="notes">
                                                                    Untuk pemindahan AC ke bangunan berbeda, biaya akan ditanggung oleh Pelanggan
                                                                </div>
                                                            </div>
                                                                                                Harga Total
                                                            <span v-if="isCalculating == false" class="sub-total" id="sub-total">{{ convertPrice }}</span>
                                                        </div>
                                                        <button class="continue" type="button" v-on:click="currentStep2('step1')" v-show="validStep1">
                                                            Lanjut<i class="fa fa-arrow-right ml-2"></i>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
                    <div class="container text-center">
                        <small>Copyright &copy; LoL</small>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>