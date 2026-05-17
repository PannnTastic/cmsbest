# Deployment Guide - BEST Adminside (CMS)

Deploy ke cPanel melalui GitHub.

## 1. Setup Repository di GitHub

Pastikan repo sudah di-push ke GitHub:
```bash
git add .
git commit -m "chore: prepare production deploy"
git push origin main
```

## 2. Setup cPanel

### A. Git Clone / Git Version Control (cPanel)
1. Login cPanel → **Git Version Control**
2. Klik **Create** → Masukkan URL repo GitHub (`https://github.com/username/cmsbest.git`)
3. Pilih branch `main`
4. Clone ke folder (contoh: `~/cmsbest` atau `~/public_html/cmsbest`)

### B. Atur Document Root ke `public/`
1. cPanel → **Domains** / **Addon Domains** atau **Subdomains**
2. Buat subdomain misal `admin.domain-anda.com`
3. Document root arahkan ke `~/cmsbest/public`

### C. Copy Environment File
```bash
cd ~/cmsbest
cp .env.example .env
nano .env
```
Ubah konfigurasi penting:
- `APP_URL=https://admin.domain-anda.com`
- `DB_DATABASE=best`  (sama dengan clientside — shared database)
- `DB_USERNAME=...`
- `DB_PASSWORD=...`
- `APP_KEY=` → generate dengan: `php artisan key:generate`

### D. Jalankan Deploy Script
```bash
cd ~/cmsbest
bash deploy.sh
```

## 3. Build Assets

CMS (Filament) tidak memerlukan build Vite frontend, tapi Filament punya asset sendiri yang otomatis di-publish via `filament:upgrade` di `post-autoload-dump`.

Jika asset Filament bermasalah, jalankan:
```bash
php artisan filament:assets
```

## 4. Jalankan Deploy Manual (jika tidak pakai deploy.sh)
```bash
cd ~/cmsbest
php /usr/local/bin/composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
php artisan filament:upgrade
```

## 5. Fix Permission (jika diperlukan)
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 755 public
```

## 6. Shared Database & Storage

CMS dan Clientside menggunakan database yang sama (`best`). Pastikan:
- `DB_DATABASE=best` di kedua `.env`
- `DB_USERNAME` dan `DB_PASSWORD` sama (atau punya akses ke database yang sama)
- Storage CMS (`storage/app/public`) di-link ke clientside agar gambar bisa diakses dari frontend
