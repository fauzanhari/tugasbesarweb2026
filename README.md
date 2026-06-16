<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🏆 SIPRES (Sistem Peningkatan Prestasi) Fakultas

SIPRES adalah platform digital inovatif berbasis **Laravel 11** yang dirancang untuk memfasilitasi, membina, dan mendata capaian prestasi lomba mahasiswa di tingkat Fakultas.

## ✨ Fitur Utama
1. **Halaman Publik:** Informasi berita prestasi dan pengumuman lomba terkini tanpa perlu login.
2. **Dashboard Mahasiswa:** Mengajukan proposal lomba, melacak progress bimbingan, dan melihat daftar dosen.
3. **Dashboard Dosen:** Menerima pengajuan proposal dari mahasiswa, memberikan revisi (ACC/Tolak), dan memantau progress bimbingan lanjutan.
4. **Dashboard Admin:** Mengelola berita, info lomba, daftar pengguna (Dosen/Mahasiswa), serta melihat statistik prestasi fakultas secara langsung.

## 🛠️ Teknologi yang Digunakan
* **Backend:** Laravel 11 (PHP)
* **Frontend:** Laravel Blade, Bootstrap 5, FontAwesome 6, Google Fonts (Inter)
* **Database:** SQLite

---

## 🚀 Panduan Instalasi (Untuk Rekan Kelompok)

Jika Anda baru saja melakukan *clone* repositori ini, ikuti langkah-langkah wajib di bawah ini secara berurutan agar sistem dapat menyala di laptop Anda.

### 1. Prasyarat Sistem
Pastikan laptop Anda sudah terinstal:
* PHP (minimal versi 8.2)
* Composer
* Node.js & NPM (Opsional)

### 2. Langkah-Langkah Instalasi

Buka **Terminal / CMD** di dalam folder hasil *clone* Anda, lalu jalankan perintah berikut satu per satu:

```bash
# 1. Unduh semua library/dependensi Laravel (Wajib)
composer install

# 2. Gandakan file environment
copy .env.example .env

# 3. Hasilkan kunci keamanan (App Key)
php artisan key:generate

# 4. Buat tabel database dan masukkan Data Dummy (Seeder)
php artisan migrate:fresh --seed

# 5. Jalankan server lokal
php artisan serve
```

### 3. Konfigurasi Database (Catatan Penting)
Proyek ini secara *default* menggunakan **SQLite**. 
Jika Anda membuka file `.env`, pastikan baris koneksinya terlihat seperti ini:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```
*(Anda tidak perlu repot menyalakan MySQL/XAMPP/Laragon. Cukup jalankan perintah migrate di atas).*

---

## 🔑 Akun Uji Coba (Demo)
Gunakan akun di bawah ini untuk menguji fitur-fitur yang ada. Semua akun menggunakan password: **`password`**

| Role | Email | Keterangan |
|------|-------|------------|
| **Admin** | `admin@prestasi.com` | Akses penuh (Berita, Lomba, User) |
| **Dosen** | `dosen1@prestasi.com` | Keahlian: AI & Data Mining |
| **Dosen** | `dosen2@prestasi.com` | Keahlian: Web & Mobile |
| **Dosen** | `dosen3@prestasi.com` | Keahlian: IoT & Robotika |
| **Mahasiswa** | `mahasiswa1@prestasi.com` | Mahasiswa 1 |
| **Mahasiswa** | `mahasiswa2@prestasi.com` | Mahasiswa 2 |

---
*Dibuat untuk memenuhi Tugas Besar Pemrograman Web 2026*
