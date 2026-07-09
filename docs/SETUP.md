# TRUST & JUSTICE - Development Setup Guide

## Prerequisites

### System Requirements
- Node.js 18+ (for Frontend)
- PHP 8.2+ (for Backend)
- MySQL 8.0+ (Database)
- Composer 2.0+ (PHP Dependency Manager)
- Git

### Required Services
- Cloudinary Account (for file storage)
- SMTP Email Service (Gmail, SendGrid, etc.)

---

## Frontend Setup (Next.js 15)

### 1. Install Dependencies

```bash
cd frontend
npm install
```

### 2. Environment Variables

Create `.env.local` file:

```env
# API
NEXT_PUBLIC_API_URL=http://localhost:8000/api
NEXT_PUBLIC_APP_NAME=TRUST & JUSTICE
NEXT_PUBLIC_APP_TAGLINE=Advocacy with Integrity

# Cloudinary
NEXT_PUBLIC_CLOUDINARY_CLOUD_NAME=your_cloud_name
NEXT_PUBLIC_CLOUDINARY_UPLOAD_PRESET=your_preset

# Environment
NODE_ENV=development
```

### 3. Run Development Server

```bash
npm run dev
```

Application will be available at `http://localhost:3000`

### 4. Build for Production

```bash
npm run build
npm run start
```

---

## Backend Setup (Laravel 12)

### 1. Install Dependencies

```bash
cd backend
composer install
```

### 2. Environment Variables

Create `.env` file from `.env.example`:

```bash
cp .env.example .env
```

Edit `.env`:

```env
# App
APP_NAME="TRUST & JUSTICE"
APP_ENV=local
APP_KEY=base64:YOUR_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trust_justice_law_firm
DB_USERNAME=root
DB_PASSWORD=your_password

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@trustjustice.com
MAIL_FROM_NAME="TRUST & JUSTICE"

# Cloudinary
CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name

# Sanctum
SANCTUM_STATEFUL_DOMAINS=localhost:3000,localhost:8000
SANCTUM_GUARD=api
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Setup Database

#### Create Database

```bash
mysql -u root -p
CREATE DATABASE trust_justice_law_firm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### Run Migrations

```bash
php artisan migrate
```

### 5. Seed Database

```bash
php artisan db:seed
```

### 6. Install Required Packages

```bash
# Spatie Permission
composer require spatie/laravel-permission

# CORS
composer require fruitcake/laravel-cors
```

### 7. Configure Sanctum

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 8. Storage Link

```bash
php artisan storage:link
```

### 9. Run Development Server

```bash
php artisan serve
```

API will be available at `http://localhost:8000`

---

## Database Setup

### Run Migrations

```bash
php artisan migrate:fresh --seed
```

### Rollback Migrations

```bash
php artisan migrate:rollback
```

### Reset Database

```bash
php artisan migrate:reset
php artisan migrate --seed
```

---

## Testing

### Frontend Tests

```bash
cd frontend

# Run Jest tests
npm test

# Run E2E tests
npm run test:e2e
```

### Backend Tests

```bash
cd backend

# Run PHPUnit tests
php artisan test

# Run with coverage
php artisan test --coverage
```

---

## Useful Commands

### Laravel Commands

```bash
# Make migration
php artisan make:migration create_table_name

# Make model with factory and seeder
php artisan make:model ModelName -mfs

# Make controller
php artisan make:controller ControllerName --resource

# Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
```

### Next.js Commands

```bash
# Build
npm run build

# Lint
npm run lint

# Format
npm run format
```

---

## Troubleshooting

### Frontend Issues

**Port 3000 already in use:**
```bash
npm run dev -- -p 3001
```

**Node modules issues:**
```bash
rm -rf node_modules package-lock.json
npm install
```

### Backend Issues

**Database connection error:**
```bash
# Check MySQL is running
mysql -u root -p

# Verify .env database credentials
```

**Permission denied on storage:**
```bash
chmod -R 777 storage bootstrap/cache
```

**Composer dependency conflicts:**
```bash
composer update
composer install
```

---

## Documentation Links

- [Next.js 15 Documentation](https://nextjs.org/docs)
- [Laravel 12 Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Framer Motion Documentation](https://www.framer.com/motion/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
- [Spatie Permission](https://github.com/spatie/laravel-permission)
- [Cloudinary Documentation](https://cloudinary.com/documentation)
