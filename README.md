# Sistem Buku Induk Siswa

Aplikasi Sistem Informasi Manajemen Buku Induk Siswa berbasis web (Laravel) untuk MTs Mamba'ul Ma'arif Denanyar Jombang.

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB (via OrbStack / Docker / XAMPP)

## Panduan Instalasi Lokal

1. Clone repository
```bash
git clone git@github.com:husnunn/mts-mambaul-maarif.git
cd mts-mambaul-maarif
```

2. Install dependensi PHP
```bash
composer install
```

3. Install dependensi Node.js
```bash
npm install
```

4. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Konfigurasi Database (Edit file `.env`)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_induk
DB_USERNAME=root
DB_PASSWORD=secret
```

6. Migrasi & Seeding Database
```bash
php artisan migrate --seed
```

7. Jalankan Server Development
```bash
php artisan serve
```
Akses aplikasi di: `http://localhost:8000`

## Akses Default

- **URL Login:** `http://localhost:8000/login`
- **Email:** `admin@mts-mambaulmaarif.sch.id`
- **Password:** `admin123`

## Deploy ke Vercel

Aplikasi ini disiapkan untuk deploy ke Vercel menggunakan `vercel-php`.

1. Tambahkan `vercel.json` (jika belum ada) di root project:
```json
{
  "version": 2,
  "builds": [
    {
      "src": "api/index.php",
      "use": "vercel-php"
    },
    {
      "src": "/public/**",
      "use": "@vercel/static"
    }
  ],
  "routes": [
    {
      "src": "/build/(.*)",
      "dest": "/public/build/$1"
    },
    {
      "src": "/(css|js|images|assets)/(.*)",
      "dest": "/public/$1/$2"
    },
    {
      "src": "/(.*)",
      "dest": "/api/index.php"
    }
  ],
  "env": {
    "APP_ENV": "production",
    "APP_DEBUG": "false",
    "CACHE_DRIVER": "array",
    "SESSION_DRIVER": "cookie",
    "QUEUE_DRIVER": "sync"
  }
}
```

2. Buat folder `api/` di root directory dan tambahkan file `index.php` (forwarder untuk Vercel):
```php
<?php
require __DIR__ . '/../public/index.php';
```

3. Pastikan konfigurasi Database (`DB_HOST`, `DB_USERNAME`, dll) dan `APP_KEY` sudah di-set di **Vercel Environment Variables**. Note: Gunakan database hosting eksternal (seperti PlanetScale, Supabase, atau Railway) karena Vercel bersifat serverless.
