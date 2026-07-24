# Sistem Informasi Reservasi Meja Restoran Berbasis Web

Aplikasi web untuk mengelola reservasi meja restoran secara online. Pelanggan dapat memesan meja dengan memilih tanggal, jam, dan jumlah tamu, sementara admin dapat mengelola data meja, menu, serta mengonfirmasi/menolak reservasi yang masuk. Aplikasi dilengkapi dashboard statistik dan sistem pencegahan bentrok jadwal, sehingga satu meja dapat dipesan oleh banyak pelanggan pada jam yang berbeda di hari yang sama.

Dibuat sebagai pemenuhan tugas **Ujian Akhir Semester (UAS) Pemrograman Web Lanjut**.

## Identitas

- **Nama:** Tommi Ridwan
- **NIM:** 230170151

## Fitur

- Autentikasi pengguna dengan verifikasi email (Laravel Breeze)
- Role pengguna: Admin dan User (Pelanggan) dengan hak akses berbeda
- CRUD lengkap untuk data Meja dan Menu (Admin)
- Reservasi meja dengan validasi anti-bentrok jadwal (satu meja bisa dipesan berkali-kali selama jam tidak tumpang tindih)
- Alur konfirmasi reservasi: Pending → Confirmed/Cancelled → Completed
- Dashboard admin dengan statistik ringkas dan grafik reservasi 7 hari terakhir
- Desain responsif (desktop & mobile)
- *REST API dan export laporan PDF/Excel: lihat catatan di bagian Status Fitur di bawah*

## Tech Stack

- Laravel 11
- Laravel Breeze (autentikasi + verifikasi email)
- Blade Templating
- Tailwind CSS
- Chart.js (grafik dashboard)
- MySQL / SQLite

## Cara Instalasi dan Menjalankan Aplikasi

1. Clone repository:
   ```
   git clone <url-repository-ini>
   cd <nama-folder-project>
   ```

2. Install dependency PHP:
   ```
   composer install
   ```

3. Salin file environment dan generate application key:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. Atur koneksi database di file `.env` (sesuaikan dengan MySQL/SQLite lokal):
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=reservasi_restoran
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Jalankan migration:
   ```
   php artisan migrate
   ```

6. Install dependency frontend dan build asset:
   ```
   npm install
   npm run build
   ```

7. Jalankan server:
   ```
   php artisan serve
   ```

8. Buka aplikasi di browser: `http://localhost:8000`

### Membuat Akun Admin

Setelah registrasi akun baru lewat halaman `/register`, jadikan akun tersebut admin lewat Tinker:
```
php artisan tinker
```
```php
$user = \App\Models\User::where('email', 'email-akun-anda@contoh.com')->first();
$user->role = 'admin';
$user->save();
```

## Akun Demo

| Role | Email | Password |
|---|---|---|
| Admin | adminresto@gmail.com | resto123456 |
| User | Pelanggan1@gmail.com | password123 |

*(Sesuaikan tabel ini dengan akun demo yang benar-benar Anda buat di database sebelum submit.)*

## Status Fitur (Transparansi)

Beberapa fitur pada rubrik penilaian UAS masih dalam pengerjaan pada saat README ini ditulis:

- [ ] **REST API + pengujian Postman** — belum diimplementasikan
- [ ] **Export laporan PDF/Excel** — belum diimplementasikan

Bagian ini akan diperbarui begitu kedua fitur selesai dibangun.

## Dokumentasi Screenshot

### 1. Halaman Login / Autentikasi
   ![Halaman Login ](docs/screenshoots/login.png)

### 2. Verifikasi Email
(Mulai dari Tampilan Regitrasi dulu)
![Halaman Login ](docs/screenshoots/register.png)

(Resend Verify nya agar bisa login) 
![Halamanverify](docs/screenshoots/resendverify.png)

*(Hasil verify email nya agar bisa login dan setelah itu click tombol verify agar bisa langsung ke tampilan Dashboard nya)*
![halamanverify](docs/screenshoots/hasilverify.png)


### 3. Dashboard
*Data diagram Reservasi*
   ![Halaman Dashboard](docs/screenshoots/admindata.png)

### 4. CRUD
**Kelola Meja**
![Kelola Meja](docs/screenshoots/meja.png)

**Kelola Menu**
![Kelola Menu](docs/screenshoots/menu.png)

**Reservasi**
![Kelola reservasi](docs/screenshoots/reservasi1.png)
![Kelola reservasi](docs/screenshoots/reservasi2.png)

### 5. REST API (Postman)

**Login — mendapatkan token akses**
![Login API](docs/screenshoots/login-api.png)

**GET /api/menus — data publik tanpa perlu autentikasi**
![Menus API](docs/screenshoots/menu-api.png)

**GET /api/reservations — dengan Bearer Token (berhasil)**
![Reservations dengan token](docs/screenshoots/reservasi+token.png)

**GET /api/reservations — tanpa token (ditolak, 401 Unauthenticated)**
![Reservations tanpa token](docs/screenshoots/reservasi-token.png)


### 6. Pemisahan Hak Akses Admin dan User
**Admin bisa mengakses dan mengontrol reservasi nya**
![Halaman Admin](docs/screenshoots/admin.png)
![Halaman Admin](docs/screenshoots/hakaksesadminkeolareservasi.png)

**User hanya bisa melakukan reservasi**
**Hak akses User**
![Halaman user](docs/screenshoots/user.png)
![Halaman user](docs/screenshoots/hakaksespelangganreservasi.png)

### 7. Tampilan Responsive (Desktop & Mobile)
**Desktop**
![Halaman Dekstop](docs/screenshoots/admindata.png)


**Mobile**
![Halaman mobile](docs/screenshoots/dashboardmobile.png)

**tampilan dashboard meja mobile**
![Halaman mobile](docs/screenshoots/mejamobile.png)

**tampilan dashboard menu mobile**
![Halaman mobile](docs/screenshoots/menumobile.png)

**tampilan dashboard reservasi mobile**
![Halaman mobile](docs/screenshoots/reservasimobile.png)

### 8. Hasil Export PDF/Excel

**Tombol export di halaman Kelola Reservasi**
![Tombol Export](docs/screenshoots/export_excel.png)


*(Hasil export Excel)*
![asil Export Excel](docs/screenshoots/Hasil_export_excel.png)