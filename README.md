<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png">
<hr>
<img src="https://i.ibb.co/tQMZgyX/1203-compressed.gif">

# Flow Script
Seperti paymant gateway pada umum nya alur/flow nya sangat sederhana
<ul>
    <li>User melakukan checkout</li>
    <li>Sistem melakukan direct ke link payment yang di hasilkan reponse Api</li>
    <li>Sistem mengecek pembayaran</li>
</ul>

# Persiapan 
Untuk menggunakan api paypal anda memerlukan 2 credential yaitu <code>PAYPAL_CLIENT_ID & PAYPAL_CLIENT_SECRET</code>.
akun sandbox user & client, dan untuk mendapatkan semuanya nya silahkan buat akun paypal bisnis (gratis & mudah) silahkan buat.

# Konfigurasi 
<img src="https://i.ibb.co/M5dmHbz/conf.png">
Masukan credential di file .env
