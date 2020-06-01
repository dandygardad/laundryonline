<!DOCTYPE HTML>
<?php

require_once "database.php";

?>

<html lang="id">
    <head>
        <link rel="stylesheet" type="text/css" href="order.css">
        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/bootstrap/js/bootstrap.js">
    </head>
   
    <body>
        <div class="container">
            <div class="card border-0 shadow my-5">
                <div class="card-body p-5">
                    <section id="content">
                        <div class="row mt-5 row mt-3">
                            <div class="col-sm-8 col-12">
                                <div class="question_service_ttl">
                                                Jasa Laundry Antar Jemput Berbasis Online
                                </div>
                                <div class="card question_left mb-6">
                                    <form role="form" class="registration-form" id="form" action="" method="POST">
                                        <div class="card-body">
                                            <fieldset>
                                                <div class="p-1">
                                                    <div class="title">Pilih Jenis Laundry</div>
                                                    <div class="row mb-2 p-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input ac-type" type="radio" name="laundry-kiloan" id="laundry-kiloan" value="laundry-kiloan">
                                                            <label class="form-check-label">Kiloan</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input ac-type" type="radio" name="laundry-satuan" id="laundry-satuan" value="laundry-satuan">
                                                            <label class="form-check-label" for="inlineRadio2">Satuan</label>
                                                        </div>
                                                    </div>
                                                    <div class="title">Pilih Waktu Pengambilan</div>
                                                    <div class="form-group mb-4 p-1">
                                                        <label for="dateInput">Tanggal Pengambilan</label>
                                                        <datepicker :disabled="datepicker.disabled" v-model="jobDatePicker" format="yyyy-MM-dd"
                                                        name="projectData[dateInput]" input-class="form-control input_text" id="dateInput"
                                                        placeholder="Click here to select a date" required></datepicker>
                                                    </div>
                                                    <span v-show="errors.has('step1.projectData[hourInput]')" class="help is-danger">Kolom harus diisi</span>
                                                    <div class="title">Pilih Waktu Pengantaran</div>
                                                    <div class="form-group mb-4 p-1">
                                                        <label for="dateInputOther">Tanggal Pengantaran</label>
                                                        <input type="text" class="input_text form-control" v-bind:value="deliveryDate"
                                                            id="dateInputOther" name="projectData[dateInputOther]"
                                                            placeholder="Tanggal Pengantaran" readonly>
                                                            <span v-show="errors.has('step1.projectData[hourInputOther]')" class="help is-danger">Kolom harus diisi</span>
                                                    </div>
                                                    <div class="price">
                                                                                            Harga Total
                                                        <span v-if="isCalculating == false" class="sub-total" id="sub-total">{{ convertPrice }}</span>
                                                    </div>
                                                    <button type="button" class="btn btn-primary pull-right" v-on:click="currentStep2('step1')" v-show="validStep1">Lanjut</button>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; LoL</small>
        </div>
    </footer>
</html>