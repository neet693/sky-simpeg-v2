# Sky SIMPEG v2

**Sky SIMPEG v2** adalah aplikasi Sistem Informasi Kepegawaian (SIMPEG) yang dibangun menggunakan **Laravel**. Aplikasi ini dirancang untuk mempermudah pengelolaan data kepegawaian dalam organisasi dengan berbagai fitur modern seperti Kanban Board, autentikasi yang aman, dan antarmuka yang responsif.

---

## 🎯 Fitur Utama

- **Manajemen Pegawai**:
  - Tambah, edit, hapus, dan lihat data pegawai.
  - Pengelolaan unit kerja dan detail pegawai melalui tabel `employment_detail`.

- **Kanban Board**:
  - Tugas dapat dikelola dengan fitur drag-and-drop.
  - Kanban board dapat disaring berdasarkan unit pengguna.

- **Sistem Autentikasi**:
  - Login dan registrasi menggunakan **Laravel Jetstream**.
  - Manajemen sesi pengguna yang aman.

- **Desain Responsif**:
  - Dibangun menggunakan **Tailwind CSS** untuk tampilan modern.
  - Mendukung perangkat desktop dan mobile.

- **Realtime Interactivity**:
  - Menggunakan **Livewire** untuk pengalaman pengguna yang dinamis tanpa perlu JavaScript tambahan.

---

## 🛠️ Teknologi yang Digunakan

- **Laravel**: Framework PHP untuk pengembangan backend.
- **Laravel Jetstream**: Untuk autentikasi pengguna dan manajemen sesi.
- **Livewire**: Untuk komponen dinamis tanpa JavaScript.
- **Tailwind CSS**: Library CSS untuk desain antarmuka.
- **MySQL**: Database untuk penyimpanan data.

---

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk mengatur proyek secara lokal:

### 1. Clone Repository
Clone repositori ini menggunakan Git dan navigasikan ke direktori proyek.
```bash
git clone https://github.com/neet693/sky-simpeg-v2.git
cd sky-simpeg-v2
```

### 2. Instal Dependensi
Pastikan Composer dan Node.js telah terinstal di sistem Anda.

```bash
composer install
npm install
npm run build
```

### 3. Konfigurasi File .env
- Duplikasikan file .env.example menjadi .env:

```bash
cp .env.example .env
```
- Edit file .env untuk menyesuaikan konfigurasi berikut:
```bash
Database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sky_simpeg_v2
DB_USERNAME=root
DB_PASSWORD=yourpassword
```
- Kunci Aplikasi: Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
```bash
php artisan key:generate
```

### 4. Migrasi dan Seeding Database
Jalankan perintah berikut untuk membuat struktur database dan mengisi data awal:

```bash
php artisan migrate --seed
```

### 5. Jalankan Server
Aktifkan server pengembangan lokal:

```bash
php artisan serve
```
Aplikasi akan tersedia di http://localhost:8000.

## 📚 Panduan Penggunaan
#### 1. Login: Masuk menggunakan kredensial admin bawaan:
- Email: admin@example.com
- Password: password
#### 2. Kelola Data Pegawai:
- Tambahkan atau perbarui data pegawai melalui menu dashboard.
#### 3. Gunakan Kanban Board:
- Lihat dan kelola tugas per unit menggunakan fitur drag-and-drop.
- Filter tugas berdasarkan unit pengguna untuk pengalaman yang lebih fokus.

## 🤝 Kontribusi
Saya menyambut kontribusi untuk pengembangan proyek ini! Ikuti langkah berikut untuk berkontribusi:

#### 1. Fork repositori ini.
#### 2. Buat branch baru untuk fitur Anda:
```bash
git checkout -b fitur-anda
```
#### 3. Commit perubahan:
```bash
git commit -m "Menambahkan fitur baru"
```
#### 4. Push branch ke fork Anda:
```bash
git push origin fitur-anda
```
#### 5. Kirim Pull Request ke repositori utama.

## 📄 Lisensi
Proyek ini dilisensikan di bawah MIT License. Anda bebas menggunakan, memodifikasi, dan mendistribusikan ulang proyek ini selama mengikuti ketentuan lisensi.

## 💬 Dukungan
Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan buka Issues di repositori ini. Kami dengan senang hati akan membantu Anda!

## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-red?style=for-the-badge&logo=ko-fi&logoColor=white)](https://davegpakpahan.netlify.app/)

You can connect with me here:
 [![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/dave-guardyan-pakpahan/)

Follow my Tiktok Account here:
[![tiktok](https://img.shields.io/badge/tiktok-black?style=for-the-badge&logo=tiktok&logoColor=white)](https://www.tiktok.com/@dg.unlimited)

## 🌟 Terima Kasih!
Jika Anda merasa proyek ini bermanfaat, silakan beri ⭐ pada repositori ini!
---
