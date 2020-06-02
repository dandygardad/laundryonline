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
            var alamat = $('#alamat').val();
            var catatan = $('#catatan').val();

            if(jumlahBarang > 5 ){
                var harga = 50000
            }

            $('#harga').text(harga);

            $('#jenis_laundry-val').text(jenisLaundry);
            $('#jumlah_barang-val').text(jumlahBarang);
            $('#waktu_pengambilan-val').text(waktuPengambilan);
            $('#waktu_pengantaran-val').text(waktuPengantaran);
            $('#alamat-val').text(alamat);
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
