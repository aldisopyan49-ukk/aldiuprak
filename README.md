
---
# 📦 Aplikasi Peminjaman Alat

Aplikasi **Peminjaman Alat** adalah sistem berbasis web yang digunakan untuk mengelola proses peminjaman dan pengembalian alat secara digital. Aplikasi ini dibuat untuk mempermudah pencatatan data, mengurangi kesalahan manual, serta meningkatkan efisiensi pengelolaan inventaris.

Sistem seperti ini umumnya dikembangkan untuk menggantikan proses manual yang sering menyebabkan kesalahan pencatatan dan sulitnya monitoring data ([Repositori Universitas Dinamika][1]).

---

## 🚀 Fitur Utama

* 🔐 Login & Logout User
* 👤 Manajemen Data User
* 📦 Manajemen Data Alat
* 📋 Peminjaman Alat
* 🔄 Pengembalian Alat
* 📊 Laporan Peminjaman
* 🔎 Pencarian & Filter Data

---

## 🛠️ Teknologi yang Digunakan

* **Backend**: PHP / Laravel *(sesuaikan dengan project kamu)*
* **Frontend**: HTML, CSS, JavaScript
* **Database**: MySQL
* **Web Server**: Apache / XAMPP

---

## 📂 Struktur Folder (Contoh)

```
peminjaman_alat/
│── app/
│── database/
│── public/
│── resources/
│── routes/
│── storage/
│── .env
│── composer.json
│── README.md
```

---

## ⚙️ Cara Instalasi

1. **Clone repository**

   ```bash
   git clone https://github.com/aldisopyan49-ukk/aldiuprak.git
   ```

2. Masuk ke folder project

   ```bash
   cd peminjaman_alat
   ```

3. Install dependency

   ```bash
   composer install
   ```

4. Copy file environment

   ```bash
   cp .env.example .env
   ```

5. Atur konfigurasi database di `.env`

6. Generate key

   ```bash
   php artisan key:generate
   ```

7. Migrasi database

   ```bash
   php artisan migrate
   ```

8. Jalankan server

   ```bash
   php artisan serve
   ```

9. Buka di browser

   ```
   http://localhost:8000
   ```

---

## 🧑‍💻 Role User

* **Admin**

  * Mengelola data alat
  * Mengelola user
  * Melihat laporan

* **User**

  * Melakukan peminjaman alat
  * Mengembalikan alat

---

## 📸 Screenshot

*(Tambahkan screenshot aplikasi di sini kalau ada)*

---

## 📌 Tujuan Project

* Mempermudah pengelolaan inventaris alat
* Mengurangi kesalahan pencatatan manual
* Mempercepat proses peminjaman dan pengembalian

---

## 🤝 Kontribusi

Kontribusi sangat terbuka!
Silakan fork repository ini dan buat pull request.

---

## 📄 Lisensi

Project ini menggunakan lisensi **MIT** *(atau sesuaikan)*

