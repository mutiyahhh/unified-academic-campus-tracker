# Sistem Informasi Penelusuran Data (SIPD)

A web-based knowledge storage and tracking system with integrated API support for mobile applications, designed to centralize and manage institutional data for students, alumni, and staff in campuss. This system prevents data from becoming scattered, lost, or unmanaged by providing a unified platform for tracking academic progress, employment status, and institutional records.

## Project Overview

SIPD serves as a comprehensive data management solution for educational institutions, focusing on three core entities:

• **Mahasiswa (Students)**: Complete student lifecycle management from enrollment to graduation
• **Alumni**: Post-graduation tracking including employment status and career alignment
• **Pegawai (Employees)**: Staff and faculty data management

The system emphasizes data integrity, role-based access control, and automated workflows to ensure accurate, up-to-date institutional records.

## System Flow

### Mahasiswa Lifecycle

The system tracks students through their entire academic journey with automatic status transitions:

1. **Student Registration** → Status: `Aktif`
   - Academic progress tracking begins
   - Sequential workflow: Prakerin → Seminar → Sidang
   - Each step must be completed before the next becomes available

2. **Academic Progress Tracking** (Status: `Aktif`)
   - **Prakerin Status**: Belum Terlaksana → Sedang Terlaksana → Sudah Terlaksana
   - **Seminar Status**: Only appears when Prakerin = "Sudah Terlaksana"
   - **Sidang Status**: Only appears when Seminar = "Sudah Terlaksana"
   - **Work Information**: Only appears when Sidang = "Sudah Terlaksana"

3. **Graduation** → Status: `Lulus`
   - Automatically sets all academic statuses to "Sudah Terlaksana"
   - **Automatic Alumni Creation**: System automatically creates an Alumni record
   - Work status information becomes mandatory

4. **Other Statuses**
   - **Cuti**: Leave of absence (defaults all academic statuses to "Belum Terlaksana")
   - **Mengundurkan Diri**: Withdrawal (defaults all academic statuses to "Belum Terlaksana")

### Alumni Tracking

Alumni records are **automatically generated** from Mahasiswa data when:
• Student status changes to `Lulus`, OR
• Student status is `Aktif` with `meeting_status` = "Sudah Terlaksana"

**Alumni data includes:**
• Employment status (Bekerja / Belum Bekerja / Tidak Bekerja)
• Institution name (if employed)
• Job alignment with major (Yes / No)
• Work waiting time

Alumni records are read-only by default but can be edited to update employment information.

### Data Flow Summary

```
Mahasiswa (Aktif)
    ↓
[Academic Progress: Prakerin → Seminar → Sidang]
    ↓
Mahasiswa (Lulus) → Automatic → Alumni Record Created
    ↓
Alumni Tracking (Employment Status Updates)
```

## Tech Stack

### Backend
• **Laravel**: 10.10
• **PHP**: 8.2.0 (platform requirement)
• **Database**: MySQL (default Laravel configuration)

### Frontend
• **UI Framework**: Metronic Admin Template
• **CSS Framework**: Tailwind CSS 3.1.0
• **Build Tool**: Vite 4.0.0
• **JavaScript**: Alpine.js 3.4.2
• **Data Tables**: DataTables (Bootstrap 4 integration)

### Key Packages

**Backend Dependencies:**
• `spatie/laravel-permission` (^6.2): Role-based access control
• `tymon/jwt-auth` (^2.0): JWT authentication for API
• `laravel/sanctum` (^3.2): API token authentication
• `doctrine/dbal` (^3.10): Database abstraction layer for migrations
• `guzzlehttp/guzzle` (^7.2): HTTP client

**Frontend Dependencies:**
• `@tailwindcss/forms` (^0.5.2): Form styling utilities
• `axios` (^1.1.2): HTTP client for API requests
• `laravel-vite-plugin` (^0.7.5): Vite integration for Laravel

## Database Structure

The system uses the following main tables:

• **users**: System users with role-based access
• **mahasiswas**: Student records with academic progress tracking
• **alumnis**: Alumni records (auto-generated from mahasiswas)
• **employees**: Staff and faculty records
• **pmbs**: New student admission records (Penerimaan Mahasiswa Baru)
• **akreditas**: Accreditation records
• **roles & permissions**: Spatie permission system tables

### Key Data Types

• **NIM**: String (student identification number)
• **NIK**: VARCHAR(16) (national identification number, exactly 16 digits)
• **GPA (IPK)**: DECIMAL (range: 1.00 - 4.00)
• **Generation/Entry Year**: INTEGER (year format, e.g., 2020)
• **Graduation Year**: INTEGER (year format)

## Installation & Setup

### Prerequisites

• PHP >= 8.2.0
• Composer
• Node.js & npm
• MySQL database
• Laravel development server

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd "sistem informasi penelusuran data"
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database in `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed roles (optional)**
   ```bash
   php artisan db:seed --class=RoleSeeder
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   # Or for development:
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## Environment Configuration

### Required Environment Variables

```env
APP_NAME="Sistem Informasi Penelusuran Data"
APP_ENV=local
APP_KEY=base64:... (generated by artisan key:generate)
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipd
DB_USERNAME=root
DB_PASSWORD=
```

### Important Notes

• Set `APP_ENV=production` and `APP_DEBUG=false` for production deployments
• Ensure `APP_URL` matches your actual domain in production
• Generate a secure `JWT_SECRET` for API authentication

## Folder Structure

```
app/
├── Http/
│   ├── Controllers/          # Main application controllers
│   │   ├── API/             # API-specific controllers (JWT auth)
│   │   └── Auth/            # Authentication controllers
│   └── Requests/            # Form request validation classes
├── Models/                  # Eloquent models
├── Traits/                  # Reusable traits (e.g., ResponseAPI)
└── Providers/              # Service providers

database/
├── migrations/              # Database schema migrations
└── seeders/                 # Database seeders (e.g., RoleSeeder)

resources/
├── views/
│   ├── pages/              # Main application views
│   │   ├── mahasiswa/      # Student management views
│   │   ├── alumni/         # Alumni management views
│   │   ├── pegawai/       # Employee management views
│   │   └── ...
│   ├── partials/           # Reusable Blade components
│   └── auth/               # Authentication views
└── js/                     # JavaScript files
    └── app.js              # Main application JS

routes/
├── web.php                 # Web routes (session-based auth)
├── api.php                 # API routes (JWT auth)
└── auth.php                # Authentication routes
```

## Role-Based Access Control

The system uses Spatie Laravel Permission with three primary roles:

### Roles

1. **admin**
   - Full system access
   - Can view and manage all data across all programs (prodi)
   - User management capabilities

2. **manajemen**
   - Management-level access
   - Can view and manage data across all programs
   - Limited user management

3. **kaprodi** (Program Head)
   - Program-specific access
   - Can only view and manage data for their assigned program (prodi)
   - Filtered data views based on `prodi` field

### Access Control Logic

• **Admin & Manajemen**: See all records regardless of `prodi`
• **Kaprodi**: Automatically filtered by `auth()->user()->prodi`
• Role checks implemented in controllers using `hasRole()` method

## Features

### Student Management (Mahasiswa)

• Complete student profile management
• Academic progress tracking (Prakerin, Seminar, Sidang)
• Dynamic form fields based on student status
• Real-time input validation (GPA, NIK, Generation)
• Automatic alumni record creation upon graduation
• Program-based data filtering

### Alumni Management

• Automatic record generation from student data
• Employment status tracking
• Job alignment with major tracking
• Institution name tracking
• Read-only by default, editable for updates

### Employee Management (Pegawai)

• Staff and faculty record management
• Program assignment
• Employment status tracking
• Educational background tracking

### Dashboard

• Key metrics visualization
• Academic progress overview (Prakerin, Seminar, Sidang percentages)
• Alumni employment statistics
• Job vs. major alignment comparison
• Program-specific filtering based on user role

### Additional Modules

• **PMB (Penerimaan Mahasiswa Baru)**: New student admission tracking
• **Akreditas**: Accreditation record management
• **User Management**: System user administration with role assignment

## Multi-Platform Integration

While this repository focuses on the Web Dashboard, the system is architected to support mobile integration:
* **RESTful API**: Built-in API endpoints for seamless data exchange with mobile or third-party applications.
* **JWT Authentication**: Secure token-based authentication (tymon/jwt-auth) ready for Android/iOS integration.
* **Consistent Data Logic**: The same business rules applied to the Web interface are enforced at the API level.

## Data Integrity & Validation

### Input Validation

**GPA (IPK)**
• Format: Decimal (4,2) - e.g., 3.75, 4.00
• Range: 1.00 - 4.00
• Client-side and server-side validation
• Real-time format enforcement

**NIK**
• Exactly 16 digits
• Numeric only
• Server-side validation

**Generation/Entry Year**
• 4-digit year format (e.g., 2020)
• Numeric only
• Range: 1900 - 2099

### Data Migration Safety

The system includes migration files that safely convert data types:
• `2026_01_19_110645_fix_column_types_for_ipk_nik_and_years.php`: Converts GPA to decimal, NIK to varchar(16)
• Data cleaning and normalization performed before type conversion
• Invalid values are clamped to valid ranges

## API Endpoints

The system provides both web and API interfaces:

### Web Routes (Session-based)
• `/dashboard` - Main dashboard
• `/mahasiswa` - Student management
• `/alumni` - Alumni management
• `/pegawai` - Employee management
• `/user` - User management
• `/pmb` - PMB management
• `/akreditas` - Accreditation management

### API Routes (JWT-based)
• `POST /api/login` - Authentication
• `GET /api/mahasiswa` - Student data (requires JWT)
• `GET /api/alumni` - Alumni data (requires JWT)
• `GET /api/pegawai` - Employee data (requires JWT)
• Additional CRUD endpoints for all resources

## Notes & Best Practices

### Coding Practices

1. **Request Validation**: All form submissions use Form Request classes (`MahasiswaRequest`, `AlumniRequest`, etc.)
2. **Response API Trait**: Consistent API responses using `ResponseAPI` trait
3. **Role Checks**: Always check user roles before data access
4. **Program Filtering**: Implement `prodi` filtering for kaprodi users

### Data Integrity Principles

1. **Automatic Alumni Creation**: Never create alumni records manually; they are auto-generated
2. **Status Dependencies**: Academic progress follows strict sequential rules
3. **Data Type Consistency**: Use proper data types (decimal for GPA, integer for years)
4. **Validation**: Always validate on both client and server side

### Maintenance Considerations

1. **Migration Safety**: Never edit old migrations; create new ones for schema changes
2. **Data Preservation**: Always preserve existing data when altering column types
3. **Role Management**: Use Spatie permission system for all access control
4. **Environment Variables**: Keep sensitive data in `.env`, never commit to repository

### Mobile Responsiveness

• Sidebar navigation is the primary navigation on mobile
• Top navigation menu is hidden on mobile breakpoints
• Dashboard and forms are fully responsive
• Mobile-first design approach

## Development

### Running in Development Mode

```bash
# Start Laravel development server
php artisan serve

# Start Vite dev server (in separate terminal)
npm run dev
```

### Code Style

The project uses Laravel Pint for code formatting:
```bash
./vendor/bin/pint
```

## License

This project is proprietary developed for institutional use.

## Support

For issues, questions, or contributions, please contact the development or create an issue in the project repository.
