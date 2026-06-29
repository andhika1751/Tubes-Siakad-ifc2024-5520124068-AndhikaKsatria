# SIAKAD Sederhana — Tugas Besar Web II (IF53413)

Aplikasi web Sistem Informasi Akademik (SIAKAD) sederhana berbasis **Laravel**, dibuat untuk memenuhi Tugas Besar Mata Kuliah Web II. Aplikasi ini digunakan untuk mengelola data Dosen, Mahasiswa, Mata Kuliah, Jadwal Perkuliahan, dan Kartu Rencana Studi (KRS), dengan dua peran pengguna: **Admin** dan **Mahasiswa**.

## 📋 Deskripsi Aplikasi

SIAKAD ini mensimulasikan proses akademik kampus secara sederhana:
- **Admin** mengelola seluruh data master (Dosen, Mahasiswa, Mata Kuliah, Jadwal) dan dapat memantau seluruh KRS mahasiswa.
- **Mahasiswa** dapat melihat jadwal kuliah dan mengelola KRS miliknya sendiri (mengambil & drop mata kuliah).

Setiap data mahasiswa yang dibuat oleh Admin otomatis akan memiliki akun login tersendiri untuk mengakses sistem.

## 🛠️ Teknologi yang Digunakan

- **Laravel 12** (PHP Framework)
- **Laravel Breeze** (Authentication scaffolding)
- **Blade Templating Engine**
- **MySQL** (Database)
- **Tailwind CSS** & CSS custom (untuk halaman CRUD)
- **Eloquent ORM** & **Eloquent Relationship**
- **Middleware** custom untuk Role-Based Access Control

## 👥 Role & Hak Akses

| Role | Hak Akses |
|---|---|
| **Admin** | Kelola penuh data Dosen, Mahasiswa, Mata Kuliah, dan Jadwal (CRUD). Dapat melihat seluruh data KRS mahasiswa. |
| **Mahasiswa** | Hanya dapat melihat Jadwal Perkuliahan dan mengelola KRS miliknya sendiri (tambah/drop mata kuliah). Tidak dapat mengakses halaman kelola Dosen, Mahasiswa, dan Mata Kuliah. |

> Pendaftaran akun dilakukan **oleh Admin**, bukan registrasi mandiri. Saat Admin menambahkan data mahasiswa baru, sistem otomatis membuatkan akun login untuk mahasiswa tersebut (password default = NPM mahasiswa, dapat diganti kemudian oleh mahasiswa).

## 🗂️ Penjelasan Fungsi Halaman

### Halaman Autentikasi
| Halaman | Fungsi |
|---|---|
| `Login` | Halaman masuk untuk Admin & Mahasiswa menggunakan email dan password. |
| `Logout` | Mengakhiri sesi login pengguna. |

### Halaman Admin
| Halaman | Fungsi |
|---|---|
| `Data Dosen` | Menampilkan, menambah, mengubah, dan menghapus data dosen. |
| `Data Mahasiswa` | Menampilkan, menambah, mengubah, dan menghapus data mahasiswa, termasuk pengaturan email login dan dosen wali. Menambah data mahasiswa otomatis membuat akun login mahasiswa. |
| `Data Mata Kuliah` | Menampilkan, menambah, mengubah, dan menghapus data mata kuliah beserta jumlah SKS. |
| `Data Jadwal` | Menampilkan, menambah, mengubah, dan menghapus jadwal perkuliahan (dosen pengajar, hari, jam, dan kelas). |
| `Data KRS` | Menampilkan seluruh KRS yang diambil oleh mahasiswa (mode lihat saja, dilengkapi fitur pencarian). |

### Halaman Mahasiswa
| Halaman | Fungsi |
|---|---|
| `Jadwal Perkuliahan` | Melihat daftar jadwal kuliah yang tersedia. |
| `KRS Saya` | Melihat daftar mata kuliah yang sudah diambil, mengambil mata kuliah baru, dan men-drop mata kuliah yang sudah diambil. Dilengkapi fitur pencarian & pagination. |

## 🔗 Relasi Antar Tabel (Eloquent Relationship)

- `Dosen` **hasMany** `Mahasiswa` (sebagai dosen wali) & `Jadwal`
- `Mahasiswa` **belongsTo** `Dosen`, **hasMany** `Krs`, **hasOne** `User` (akun login)
- `Matakuliah` **hasMany** `Jadwal` & `Krs`
- `Jadwal` **belongsTo** `Dosen` & `Matakuliah`
- `Krs` **belongsTo** `Mahasiswa` & `Matakuliah`
- `User` **belongsTo** `Mahasiswa` (melalui kolom `npm`)

## ⚙️ Instalasi & Menjalankan Aplikasi

```bash
# 1. Clone repository
git clone <url-repo-ini>
cd <nama-folder-project>

# 2. Install dependency PHP & JS
composer install
npm install && npm run build

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate
# sesuaikan koneksi database di file .env

# 4. Jalankan migration & seeder
php artisan migrate --seed

# 5. Jalankan server
php artisan serve
```

Aplikasi dapat diakses di `http://127.0.0.1:8000`.

## 🔑 Akun Default (dari Seeder)

| Role | Email | Password |
|---|---|---|
| Admin | `admin@siakad.test` | `password` |
| Mahasiswa (contoh) | `{npm}@siakad.test` | `{npm}` |

## 🖼️ Screenshots

Seluruh tangkapan layar (screenshot) setiap halaman aplikasi tersedia di folder [`screenshots/`](./screenshots).

## ✨ Fitur Tambahan (Bonus)

- ✅ Pencarian & filter data pada halaman KRS
- ⬜ Export KRS ke PDF/Excel
- ⬜ Dashboard statistik