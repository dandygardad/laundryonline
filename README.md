# Laundry OnLine

### Dibuat oleh :
1. Nur Hasana Abunawas
2. Ichsanul Alifwan
3. Dandy Garda Dirgantara


### Manual dan Fitur 
Manual :
- Untuk pengguna yang baru pertama kali menggunakan Laundry OnLine, harus mendaftar dengan menekan tombol "Daftar Sekarang" di halaman awal website.
  
- Setelah mendaftar dengan nama, e-mail, password dan nomor telepon. Selanjutnya, masuk ke bagian login untuk bisa masuk ke dashboard.
  
- Jika loginnya sudah benar, maka pengguna bisa langsung memesan laundry dengan cara menekan tombol hijau tertulis "ORDER DISINI". Dan mengisi form pemesanan berupa memilih jenis laundry kiloan atau satuan, mengisi tanggal pengambilan dan pengantaran, alamat dan titik rumah di Google Maps dan pembayaran. Jika sudah isi, maka akan menuju di bagian konfirmasi apakah pemesanannya sudah benar. Jika sudah benar maka tekan "Selesai"

- Pengguna bisa memantau status ordernya di bagian "Status Order".

Fitur-fitur :
- Antar Jemput menggunakan Google Maps sebagai titik rumah customer.
  
- Profil untuk user.
  
- Cek status laundry sudah selesai atau belum.
  
- Daftar harga.

- Detail pemesanan.

### Instalasi dan setting
Untuk bisa menggunakan website ini, harus menyiapkan db dan table. Db dan tablenya sudah disediakan di file "laundry.sql", Load file "laundry.sql" ke server (phpmyadmin/HeidiSQL). Jika sudah, untuk login admin Laundry OnLine, bisa langsung masuk login.php dan mengisi E-mail dan password dibawah ini :

- E-mail : admin@laundryonlinemks.com
- Password : kucing123

Setelah selesai login, akan langsung diarahkan ke Dashboard Admin untuk mengatur pesanan dan pengguna.


### Framework dan Library (opsional)
1. Library jQuery digunakan untuk membuat form step order bekerja
2. Framework Bootstrap digunakan untuk mempercantik tampilan website


### API (opsional)
1. [Google Maps](https://maps.googleapis.com/maps/api/js)