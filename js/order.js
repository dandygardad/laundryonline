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
});
