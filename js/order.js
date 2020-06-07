$(function(){
    // Jquery steps untuk menghandle pergantian form yang terbagi-bagi
    $(".form-order").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Sebelumnya',
            next : 'Selanjutnya',
            finish :'Selesai',
            current : ''
        },

        onFinished: function (event, currentIndex) {
            var form = $(this);
            // submit form input
            form.submit();
        },

        onStepChanging: function (event, currentIndex, newIndex) { 
            // Mengambil nilai dari elemen masukan
            var jenisLaundry = $("input[name='jenis_laundry']:checked").val();
            var massaBarang = $('#beratBarang').val();
            var jumlahBarang = parseFloat($('#jumlahBarang').val());
            var waktuPengambilan = $('#tanggalPengambilan').val();
            var waktuPengantaran = $('#tanggalPengantaran').val();
            var catatan = $('#catatan').val();
            var alamat = $('#alamat').val();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var koordinat;
            var hargaPerKg = 5000;
            var hargaTotalKiloan = massaBarang * hargaPerKg;
            var hargaTotalSatuan = parseFloat($('#harga-sementara').val());
            var hargaTotalK;
            var metodePembayaran = $("input[name='pay']:checked").val();

            // Menutup peta jika berpindah section
            $("input[name='tampilkanPeta']").prop('checked', false);
            $('#googleMapsK').hide();
            
            // Menghitung harga total jika kiloan berdasarkan berat barang dan jika satuan maka berdasarkan jenis material yang di laundry,
            // serta mengatur ulang nilai beratBarang dan jumlahBarang
            if($("input[name='jenis_laundry']:checked").val() == 'Kiloan'){
                hargaTotalK = "Rp. " + hargaTotalKiloan;
            } else {
                hargaTotalK = "Rp. " + hargaTotalSatuan;
            }

            // Memeriksa apakah titik lokasi di Peta telah ditentukan
            if(lat == 0){
                koordinat = '';
            } else {
                koordinat = (lat+", "+lng);
            }

            // Memasukkan Nilai pada Pilihan Konfirmasi
            $('#jenis_laundry-val').text(jenisLaundry);
            $('#berat_barang-val').text(massaBarang);
            $('#jumlah_barang-val').text(jumlahBarang);
            $('#waktu_pengambilan-val').text(waktuPengambilan);
            $('#waktu_pengantaran-val').text(waktuPengantaran);
            $('#alamat-val').text(alamat);
            $('#coor-val').text(koordinat);
            $('#catatan-val').text(catatan);
            $('#harga-val').text(hargaTotalK);
            $('#pay-val').text(metodePembayaran);

            return true;
        }
    });
    
    // Memeriksa tombol radio mana yang dipilih dan menampilkan form dan tabel
    $(":radio.jenis_laundry").click(function() {
        if($("input[name='jenis_laundry']:checked").val() == 'Kiloan'){
            $('#kiloan_checked').show();
            $('#satuan_checked').hide();
            $('#beratBarangText').show();
            $('#berat_barang-val').show();
            $('#jumlahBarangText').hide();
            $('#jumlah_barang-val').hide();
            $('input:checkbox').prop('checked', false);
            $('#jumlahBarang').val(0);
            $('#hargaTotal').val(0);
        } else {
            $('#kiloan_checked').hide();
            $('#satuan_checked').show();
            $('#beratBarangText').hide();
            $('#berat_barang-val').hide();
            $('#jumlahBarangText').show();
            $('#jumlah_barang-val').show();
            $('#beratBarang').val(0);
            $('#hargaTotal').val(0);
        }
    });

    // Menghitung harga total kiloan
    $(document).ready(function() {
        $("input[name='beratBarang']").change(function(e) {
            var hargaPerKg = 5000;
            var massaBarang = parseInt($("#beratBarang").val());
            var hasil = hargaPerKg * massaBarang;
            $('#hargaTotal').val(hasil);
        });
    });

    // Mendapatkan id checkbox yang dicek dan menyimpannya dalam array sebelum dikirim
    $("input:checkbox").change(function() {
        var items = [];
    
        $("input:checkbox").each(function() {
            if ($(this).is(":checked")) {
                items.push($(this).attr("id"));
            } 
        });
        document.getElementById('list_satuan').value = items;
    });

    //Menampilkan peta untuk menentukan titik lokasi
    $(document).ready(function () {

        // Menentukan koordinat awal peta, perbesaran, dan jenis peta
        var propertiPeta = {
            center: new google.maps.LatLng(-5.147842, 119.432448),
            zoom: 14,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        // Inisiasi peta
        var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);

        // Menentukan penanda pada peta
        var penanda;
        function taruhPenanda(peta, posisiTitik){
            if(penanda){
                // Jika penanda pindah posisi
                penanda.setPosition(posisiTitik);
            } else {
                // Buat penanda baru
                penanda = new google.maps.Marker({
                    position: posisiTitik,
                    map: peta
                });
            }

            // Mengambil nilai garis lintang dan bujur dari penanda pada peta
            var lat = posisiTitik.lat();
            var lng = posisiTitik.lng();

            // Membatasi nilai belakang koma yang ingin diambil
            $('#lat').val(lat.toFixed(6));
            $('#lng').val(lng.toFixed(6));
        }

        // Event listener ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhPenanda(this, event.latLng);
        });
    });

    //Menampilkan peta untuk menampilkan titik lokasi yang telah ditentukan
    $(document).ready(function () {

        //Menampilkan peta jika diinginkan
        $("input[name='tampilkanPeta']").change(function(){
            if ($(this).is(":checked")) {
                $('#googleMapsK').show();    
                initialize();
            } else {
                $('#googleMapsK').hide();
            }
        });

        $('input:checkbox').prop('checked', false);

        function initialize()  {

            // Mengambil nilai koordinat yang telah ditentukan
            var lat = $('#lat').val();
            var lng = $('#lng').val();

            // Menentukan koordinat peta, perbesaran, dan jenis peta
            var propertiPeta = {
                center: new google.maps.LatLng(lat,lng),
                zoom: 13,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            }
    
            // Inisiasi peta
            var peta = new google.maps.Map(document.getElementById("googleMapsK"), propertiPeta);

            // membuat Marker untuk halaman konfirmasi
            marker =new google.maps.Marker({
                    position: new google.maps.LatLng(lat,lng),
                    map: peta
            });
        }
    });

    // Menghitung harga total satuan berdasarkan jenis material barang yang dicek serta kotak yang dicek
    function menghitungCheckbox() {
        // Mendapatkan refrensi grup checkbox
        var el = document.getElementById('checkbox');
      
        // Mendapatkan elemen masukan dari chechkbox
        var barang = el.getElementsByTagName('input');
      
        // Mendapatkan panjang barang
        var len = barang.length;

        // memeanggil fungsi updateHarga() setiap kotak dicek
        for (var i = 0; i < len; i++) {
          if (barang[i].type === 'checkbox') {
            barang[i].onclick = updateHarga;
          }
        }
    }

    // Dipanggil saat kotak barang dicek
    function updateHarga(e) {
    
        // Memasukkan nilai saat ini yang tersimpan di harga-sementara, menggunakan parseFloat method untuk mengkonversi string ke number
        var val = parseFloat(document.getElementById("harga-sementara").value);
        var jml = parseFloat(document.getElementById("jumlahBarang").value);
        
        // Menambahkan nilai dari checkbox jika dicek dengan nilai saat ini begitu juga menghitunga kotak yang dicek
        if (this.checked) {
            val += parseFloat(this.value);
            jml += 1;
        } else {
            val -= parseFloat(this.value);
            jml -= 1;
        }
        
        // Memperbarui nilai dari harga-sementara dengan nilai terbaru sesuai dengan checkbox yang dicek serta memperbaruai jumlah barang yang dicek
        document.getElementById("harga-sementara").value = val;
        document.getElementById("jumlahBarang").value = jml;
        document.getElementById("hargaTotal").value = val;
    }

    // Memanggil method menghitungCheckbox()
    menghitungCheckbox();
});