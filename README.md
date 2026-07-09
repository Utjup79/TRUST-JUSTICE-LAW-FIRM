# TRUST & JUSTICE - Law Office Management System

**Tagline:** Advocacy with Integrity

## Project Overview

Enterprise-grade Law Office Management System with modern corporate website for Indonesian law firm TRUST & JUSTICE.

### Features

#### Public Website
- Home
- About Us
- Practice Areas
- Lawyers Directory
- Articles & Blog
- Online Consultation Booking
- Contact
- SEO Optimized

#### Dashboard Modules
1. Dashboard Analytics
2. Client Management (Full CRUD)
3. Case Management
4. Hearing Calendar
5. Power of Attorney Generation
6. Invoices & Billing
7. Documents Management
8. Reports & Analytics
9. Settings

#### Multi-User Roles
- Super Admin
- Managing Partner
- Lawyer
- Paralegal
- Finance
- Administration
- Client

## Technology Stack

### Frontend
- **Framework:** Next.js 15
- **UI Library:** React
- **Language:** TypeScript
- **Styling:** Tailwind CSS
- **Animation:** Framer Motion
- **Deployment:** Vercel

### Backend
- **Framework:** Laravel 12
- **API:** REST API
- **Authentication:** Laravel Sanctum
- **Authorization:** Spatie Laravel Permission
- **Database:** MySQL
- **Storage:** Cloudinary
- **Deployment:** Hostinger VPS

## Color Theme

- **Primary:** Black (#111111)
- **Secondary:** Dark Red (#A81F24)
- **Accent:** Gold (#D4AF37)
- **Design:** Luxury Corporate, Dark Mode, Responsive

## Project Structure

```
TRUST-JUSTICE-LAW-FIRM/
├── frontend/                 # Next.js 15 Application
│   ├── src/
│   │   ├── app/             # Next.js App Router
│   │   ├── components/      # Reusable Components
│   │   ├── pages/           # Page Components
│   │   ├── layouts/         # Layout Components
│   │   ├── hooks/           # Custom Hooks
│   │   ├── services/        # API Services
│   │   ├── utils/           # Utility Functions
│   │   ├── types/           # TypeScript Types
│   │   ├── styles/          # Global Styles
│   │   └── constants/       # Constants
│   ├── public/              # Static Assets
│   ├── package.json
│   ├── tailwind.config.ts
│   ├── tsconfig.json
│   └── next.config.js
├── backend/                 # Laravel 12 Application
│   ├── app/
│   │   ├── Models/          # Eloquent Models
│   │   ├── Http/Controllers/ # API Controllers
│   │   ├── Services/        # Business Logic
│   │   ├── Jobs/            # Queue Jobs
│   │   └── Events/          # Events
│   ├── database/
│   │   ├── migrations/      # Database Migrations
│   │   ├── seeders/         # Database Seeders
│   │   └── factories/       # Model Factories
│   ├── routes/
│   │   └── api.php          # API Routes
│   ├── config/              # Configuration Files
│   ├── .env.example
│   ├── composer.json
│   └── artisan
├── docs/                    # Documentation
│   ├── ERD.md              # Entity Relationship Diagram
│   ├── API.md              # API Documentation
│   ├── DATABASE.md         # Database Schema
│   └── SETUP.md            # Setup Instructions
└── .gitignore
```

## Database Schema

### Core Entities
- Users (with roles & permissions)
- Clients
- Cases
- Hearings
- Lawyers
- Power of Attorney
- Invoices
- Documents
- Reports

## Getting Started

### Frontend Setup
```bash
cd frontend
npm install
npm run dev
```

### Backend Setup
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan seed:run
php artisan serve
```

## API Documentation

See `docs/API.md` for complete REST API documentation.

## Database Architecture

See `docs/ERD.md` for Entity Relationship Diagram.

## Security

- JWT Authentication
- 2FA Support
- Audit Logging
- Permission-based Access Control
- Rate Limiting
- CORS Protection

## License

Private Project - TRUST & JUSTICE Law Firm

## Author

Developed by Senior Full Stack Software Engineer
