$(function(){
    $(".form-order").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Previous',
            next : 'Next Step',
            finish :'Submit',
            current : ''
        },

        onFinished: function (event, currentIndex) {
            var form = $(this);
            // submit form input
            form.submit();
        },

        onStepChanging: function (event, currentIndex, newIndex) { 
            var jenisLaundry = $('form input[type=radio]:checked').val();
            var massaBarang = $('#beratBarang').val();
            var waktuPengambilan = $('#tanggalPengambilan').val();
            var waktuPengantaran = $('#tanggalPengantaran').val();
            var catatan = $('#catatan').val();
            var alamat = $('#alamat').val();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var hargaPerKg = 5000;

            // Menghitung harga total berdasarkan Berat barang
            var hargaTotal = "Rp. " + massaBarang * hargaPerKg;
            document.getElementById("hargaTotal").value = massaBarang * hargaPerKg;


            // Memasukkan Nilai pada Section Konfirmasi
            $('#jenis_laundry-val').text(jenisLaundry);
            $('#berat_barang-val').text(massaBarang);
            $('#waktu_pengambilan-val').text(waktuPengambilan);
            $('#waktu_pengantaran-val').text(waktuPengantaran);
            $('#alamat-val').text(alamat);
            $('#lat-val').text(lat);
            $('#lng-val').text(lng);
            $('#catatan-val').text(catatan);
            $('#harga-val').text(hargaTotal);

            return true;
        }
    });
    $("#date").datepicker({
        
        dateFormat: "MM - DD - yy",
        showOn: "both",
        buttonText : '<i class="zmdi zmdi-chevron-down"></i>',
    });

    // Menentukan marker pada maps
    var marker;
    function taruhMarker(peta, posisiTitik){
        if(marker){
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta
            });
        }
        // isi nilai koordinat ke form
        var lat = posisiTitik.lat();
        var lng = posisiTitik.lng();

        document.getElementById("lat").value = lat.toFixed(6);
        document.getElementById("lng").value = lng.toFixed(6);
    }

    // fungsi initialize untuk mempersiapkan peta
    function initialize() {

        var propertiPeta = {
            center:new google.maps.LatLng(-5.147842,119.432448),
            zoom:13,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);

        // even listener ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });
        
    }
    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);
});
