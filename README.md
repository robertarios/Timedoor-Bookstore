# Timedoor Backend Programming Exam - Bookstore Project

## Project Overview

Proyek ini dibuat menggunakan **Laravel 10** dan **PHP 8.1** sesuai dengan ketentuan ujian backend programming.  
Aplikasi ini mensimulasikan sistem sederhana untuk mengelola buku, penulis, kategori, dan rating dari pelanggan.

Terdapat tiga halaman utama sesuai scope ujian:

1. **Book List with Filter**

    - Menampilkan daftar buku dengan filter jumlah item per halaman dan fitur pencarian.
    - Data diurutkan berdasarkan rata-rata rating tertinggi.

2. **Top 10 Most Famous Authors**

    - Menampilkan daftar 10 penulis dengan jumlah voter terbanyak.
    - Hanya menghitung voter dengan rating lebih dari 5.

3. **Input Rating**
    - Form untuk memberikan rating terhadap buku.
    - Validasi: buku yang dipilih harus sesuai dengan penulis yang dipilih.
    - Rating antara 1 hingga 10.

---

## Requirements

-   PHP >= 8.1
-   Composer >= 2.x
-   Laravel >= 10.x
-   MySQL / MariaDB
-   Node.js & npm (opsional, jika ingin meng-compile asset frontend dengan Vite)

---

## Installation Steps

1. **Clone repository**

    ```bash
    git clone https://github.com/username/bookstore.git
    cd bookstore

    ```

2. **Install dependencies**
   ``bash
   composer install

3. **Configure .env**
   Adjust DB_DATABASE, DB_USERNAME, and DB_PASSWORD according to your local database.
4. **Run migration and seed data**
   The seeder will generate:
   1000 authors (faker)
   3000 categories (faker)
   100,000 books (faker)
   500,000 ratings (faker)
   This process may take **15–30 minutes**, depending on your server specifications.  
   ``bash
   php artisan migrate --seed

5. **Run the application**
   ``bash
   php artisan serve
