# adolbarang
KP TEGAL 2020 


panduan singkat instalasi e commerce adolbarang

1. copy folder adolbarang
2. pastekan folder adolbarang di folder htdoc pada server
3. ubah konfigurasi base_ur di folder admin/aplication/config/config.php
dengan url anda 
contoh
$config['base_url'] = 'http://localhost/di isi url anda/admin'
4 import database backend.sql ke database server anda

5 sesuaikan konfigurasi koneksi database yang berada pada file config.php pada direktori adolbarang

6 ubah dan sesuaikan semua url api cek ongkir yang ada di file checkout.php

setingan awal url : 'http://localhost/adolbarang/ongkir_proses/cek_kabupaten.php',
jika alamat url bukan adolbarang maka di seting url : 'http://localhost/di isi url anda/ongkir_proses/cek_kabupaten.php',


