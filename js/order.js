$(function(){
    $("#form-total").steps({
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
            $("#form").submit();
            alert("Pesanan Berhasil Ditambahkan!");
            location.href="index.html"
        },

        onStepChanging: function (event, currentIndex, newIndex) { 
            var jenisLaundry = $('form input[type=radio]:checked').val();
            var jumlahBarang = $('#jumlahBarang').val();
            var waktuPengambilan = $('#tanggalPengambilan').val();
            var waktuPengantaran = $('#tanggalPengantaran').val();
            var catatan = $('#catatan').val();
            var alamat = $('#alamat').val();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var harga;

            for(jumlahBarang=1; jumlahBarang>=50; ){
                
            }
            

            if(jumlahBarang > 5 ){
                harga = 50000
            } else {
                harga = 0
            }

            // Memasukkan Nilai pada Section Konfirmasi

            $('#jenis_laundry-val').text(jenisLaundry);
            $('#jumlah_barang-val').text(jumlahBarang);
            $('#waktu_pengambilan-val').text(waktuPengambilan);
            $('#waktu_pengantaran-val').text(waktuPengantaran);
            $('#alamat-val').text(alamat);
            $('#lat-val').text(lat);
            $('#lng-val').text(lng);
            $('#catatan-val').text(catatan);
            $('#harga-val').text(harga);

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
        document.getElementById("lat").value = posisiTitik.lat();
        document.getElementById("lng").value = posisiTitik.lng();
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
        
        // // membuat Marker untuk halaman konfirmasi
        // var marker=new google.maps.Marker({
        // 	position: new google.maps.LatLng(posisi),
        // 	map: peta,
        // 	animation: google.maps.Animation.BOUNCE
        // });
    }
    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);
});
