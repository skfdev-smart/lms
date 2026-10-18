# 🚀 PANDUAN DEPLOYMENT PRODUKSI — SMART-LMS (STANDARISASI RESMI)
**Enterprise Learning Management System & Employee Training PT SPINDO Tbk**

---

## 📋 1. SPESIFIKASI INFRASTRUKTUR & RESOURCE
* **Nama Resource Coolify**: `smart-lms-app`
* **UUID Aplikasi**: `95fuoqsyjptja47svlyqrdfv`
* **Domain Produksi**: `https://smart-lms.spindo.my.id`
* **Port Internal Container**: `80`
* **Repositori GitHub**: `git@github.com:skfdev-smart/lms.git` (Private)
* **Cabang (Branch)**: `main`
* **Database Target**: PostgreSQL 16 (Tersedia via Docker Compose internal service `db` / Persistent Storage `pg_data`)
* **Stack**: Laravel 11/12, PHP 8.4-FPM Alpine, Vue 3, Inertia.js, Tailwind CSS, PostgreSQL 16

---

## ⚙️ 2. VARIABEL LINGKUNGAN (ENVIRONMENT VARIABLES)
Konfigurasikan variabel berikut pada Coolify (**Production Environment Variables**):

| Nama Variabel | Nilai / Contoh | Keterangan |
| :--- | :--- | :--- |
| `APP_NAME` | `SMART-LMS` | Nama aplikasi |
| `APP_ENV` | `production` | Lingkungan produksi |
| `APP_DEBUG` | `false` | Nonaktifkan debug |
| `APP_KEY` | `base64:...` | Enkripsi Laravel Key (Wajib) |
| `APP_URL` | `https://smart-lms.spindo.my.id` | URL publik resmi |
| `DB_CONNECTION` | `pgsql` | Driver database PostgreSQL |
| `DB_HOST` | `db` | Host service internal Docker Compose |
| `DB_PORT` | `5432` | Port internal PostgreSQL |
| `DB_DATABASE` | `lms_db` | Nama database |
| `DB_USERNAME` | `lms_user` | User database |
| `DB_PASSWORD` | `<SPINDO_LMS_DB_SECRET>` | Password database |
| `SESSION_DRIVER` | `database` | Driver session |
| `CACHE_STORE` | `database` | Driver cache |
| `QUEUE_CONNECTION` | `database` | Driver queue background job |

---

## 🛠️ 3. KONFIGURASI BUILD & PIPELINE COOLIFY
* **Build Strategy**: `Docker Compose`
* **Docker Compose Location**: `/docker-compose.coolify.yml`
* **Base Directory**: `/`
* **Custom Build Command**: `docker compose -f docker-compose.coolify.yml build`
* **Custom Start Command**: `docker compose -f docker-compose.coolify.yml up -d`
* **Pre-deployment Command**: *(Otomatis ditangani oleh `docker-entrypoint.sh`)*
* **Post-deployment Command**: `php artisan optimize`

> [!IMPORTANT]
> **Standarisasi Eksekusi Container (`docker-entrypoint.sh`)**:
> Container image SMART-LMS telah dibekali entrypoint otomatis yang secara aman menjalankan:
> 1. Deteksi kesiapan koneksi PostgreSQL via `pg_isready` sebelum booting.
> 2. Pengecekan dan pembuatan direktori upload video/sertifikat (`/storage/app/public/courses`).
> 3. Symlink storage otomatis (`php artisan storage:link --force`).
> 4. Migrasi skema database otomatis (`php artisan migrate --force`).
> 5. Optimasi cache produksi (`config:cache`, `route:cache`, `view:cache`).

---

## 🤖 4. INSTRUKSI AUTONOMOUS AI AGENT (RUNBOOK)
Bila AI Agent diminta melakukan update atau deploy:

### Langkah 1: Build Aset Frontend Vue/Inertia Lokal
```bash
cd C:\laragon\www\LMS
npm run build
```
*Pastikan folder `public/build/assets/` terkompilasi sebelum commit.*

### Langkah 2: Commit dan Push ke GitHub
```bash
git add .
git commit -m "feat/fix: <keterangan update>"
git push origin main
```

### Langkah 3: Eksekusi Deploy di Coolify Panel
1. Buka URL: `https://panel.spindo.my.id/project/yqexf2f1ot2esaz6k9hm3hkv/environment/qv4ysqlnfxogqzku50apufbx/application/95fuoqsyjptja47svlyqrdfv`
2. Klik tombol **Deploy**.
3. Coolify akan membangun image berbasis Docker Compose dan me-restart container secara graceful (*Zero Downtime*).

### Langkah 4: Verifikasi Layanan
```bash
curl -I -s -k https://smart-lms.spindo.my.id
```
*Pastikan mengembalikan status `HTTP 200 OK`.*
