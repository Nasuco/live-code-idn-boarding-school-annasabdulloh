# Petunjuk Penggunaan

### 1. Clone Repository
```bash
git clone https://github.com/Nasuco/live-code-idn-boarding-school-annasabdulloh.git
```
### 2. Install Dependency Laravel
```bash
composer install
```
### 3. Install Dependency NPM
```bash
npm install
```
### 4. Jalankan kompilasi aset NPM
```bash
npm run build
```
### 3. Salin Environment File
```bash
cp .env.example .env
```
### 3. Generate Application Key
```bash
php artisan key:generate
```
### 4. Konfigurasi Database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama-database
DB_USERNAME=root
DB_PASSWORD=
```
### 7. Migrasi Database
```bash
php artisan migrate
```
### 9. Jalankan Server dan NPM
```bash
php artisan serve
```
```bash
npm run dev
```