<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## E-PARIWISATA PINRANG
Selamat datang di aplikasi E-PARIWISATA PINRANG, sebuah proyek perangkat lunak yang dibuat oleh Zulham Abidin sebagai website developer perancangan berdasarkan Sulvita selaku peneliti. Aplikasi ini merupakan bagian dari upaya untuk menyelesaikan tugas akhir dalam rangka mengejar gelar Sarjana di Jurusan Teknik Informatika dan Komputer, Universitas Negeri Makassar.


Tentang Proyek
Aplikasi E-PARIWISATA PINRANG adalah produk dari upaya kolaboratif antara Zulham Abidin sebagai pengembang utama dan Zulvite sebagai perancang proyek. Proyek ini melibatkan serangkaian tahap pengembangan yang mencakup analisis kebutuhan, perancangan sistem, pengembangan perangkat lunak, serta pengujian dan implementasi.

Tujuan dari aplikasi ini adalah:
Meningkatkan visibilitas dan promosi destinasi pariwisata di Pinrang.
Memudahkan manajemen dan pengelolaan informasi tentang obyek wisata.
Memberikan pengalaman yang lebih baik bagi wisatawan dengan akses mudah ke informasi wisata.
Menyediakan platform yang interaktif untuk wisatawan dan pengelola destinasi.
Meningkatkan pemahaman tentang pengembangan teknologi informasi di sektor pariwisata.
Kami berharap bahwa aplikasi E-PARIWISATA PINRANG akan memberikan manfaat yang signifikan bagi masyarakat, pelancong, dan pihak terkait dalam memajukan pariwisata di Pinrang.

## Prasyarat

Sebelum memulai instalasi proyek ini, pastikan Anda telah memenuhi prasyarat berikut:

- [XAMPP](https://www.apachefriends.org/index.html) atau server web lain yang mendukung PHP v8.2.
- [Composer](https://getcomposer.org/download/).
- [GitHub Desktop](https://desktop.github.com/).
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git).

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek Laravel:

1. **Clone Repository**

Buka GitHub Desktop atau terminal Git Anda, dan clone repository ini ke direktori lokal Anda, klick kanan pada dekstop open gitbash
- git clone https://github.com/ZulhamAbidin/pinrang.git

2. **Instal Dependensi Composer**

Pindah ke direktori proyek yang telah Anda clone, dan jalankan perintah berikut untuk menginstal semua dependensi PHP menggunakan Composer:
- composer install atau composer install --ignore-platform-req=ext-gd

3. **Setting .env**

Salin berkas `.env.example` menjadi `.env` dan konfigurasi pengaturan database Anda di dalam berkas `.env` denngan memasukkan perintah sebagai berikut :
- cp .env.example .env

4. **Generate Kunci Aplikasi**

Jalankan perintah berikut untuk menghasilkan kunci aplikasi denngan memasukkan perintah sebagai berikut :
- php artisan key:generate

5. **Jalankan Migrasi Database**

Jalankan migrasi database untuk membuat tabel-tabel yang diperlukan denngan memasukkan perintah sebagai berikut : 
- php artisan migrate
- php artisan migrate:fresh --seed

6. **storage link**
Untuk memastikan berkas-berkas yang disimpan dalam direktori storage dapat diakses secara publik, Anda perlu menjalankan perintah sebagai berikut :
- php artisan storage:link

7. **Jalankan Server Lokal**
Gunakan perintah berikut untuk menjalankan server pengembangan Laravel denngan memasukkan perintah sebagai berikut :
- php artisan serve
- buka browser lalu akses http://localhost:8000






