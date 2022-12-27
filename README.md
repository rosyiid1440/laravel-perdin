
# PERDIN
Aplikasi Perjalanan Dinas Laravel

## Cara Install

### Ekstrak File dan Buka Terminal di dalam Forder Project

Download file project, ekstrak terlebih dahulu kemudian masuk ke dalam folder project dan buka terminal / cmd / git ataupun software sejenis. Pastikan terminal sudah mengarah ke folder project.

### Install Semua Dependensi yang Dibutuhkan

```bash
composer install
```

### Buat Database Baru

Buat database sebagai tempat penyimpanan aplikasi ini

### Copy .env.example to .env

Copy file .env.example ke .env

```bash
cp .env.example .env
```

### Setting Database di File .env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### Migrasi Database

Migrasi semua table dan data yang sudah disediakan

```bash
php artisan migrate:fresh --seed
```

Jika proses migrasi gagal, silakan import manual file database dengan nama task2.sql yang berada di folder db

### Generate Key Aplikasi

```bash
php artisan key:generate
```

### Jalankan Aplikasi

```bash
php artisan serve
```

## Informasi Login Pengguna

| Username          | Password |
| ----------------- | -------- |
| admin             | admin    |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
