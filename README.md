# Solutech Interview Test

Laravel 12 application with Vue 3, Inertia.js, and Tailwind CSS 4.

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL (or use SQLite for development)

## Installation

### 1. Clone and Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Database Configuration

**Option A: MySQL (Recommended for Production)**

Edit `.env` and configure your MySQL database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=interviewtest
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database:
```bash
mysql -u root -p -e "CREATE DATABASE interviewtest;"
```

**Option B: SQLite (Quick Development)**

Edit `.env`:
```env
DB_CONNECTION=sqlite
# Comment out or remove other DB_* variables
```

The SQLite database file already exists at `database/database.sqlite`.

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Build Frontend Assets

```bash
# For production
npm run build

# For development with hot reload
npm run dev
```

## Running the Application

### Development

Open two terminal windows:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server:**
```bash
npm run dev
```

Visit: http://localhost:8000

### Production

```bash
# Build assets
npm run build

# Start server
php artisan serve
```

## Quick Setup (Alternative)

Use the built-in setup script:

```bash
composer setup
```

This automatically runs:
- `composer install`
- Copies `.env.example` to `.env`
- Generates app key
- Runs migrations
- Installs npm packages
- Builds assets

## Testing

```bash
# Run all tests
php artisan test

# Or using Pest directly
./vendor/bin/pest
```

## Features

- **Authentication**: Laravel Fortify with two-factor authentication
- **Frontend**: Vue 3 with TypeScript
- **Routing**: Inertia.js for SPA-like experience
- **UI**: Tailwind CSS 4 with custom components
- **Testing**: Pest PHP testing framework

## Project Structure

```
app/              # Laravel application code
resources/js/     # Vue components and TypeScript code
routes/           # Application routes (web, api, auth, settings)
database/         # Migrations and seeders
tests/            # Pest tests
```

## Troubleshooting

**Port already in use:**
```bash
php artisan serve --port=8001
```

**Node modules issues:**
```bash
rm -rf node_modules package-lock.json
npm install
```

**Cache issues:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

**Permission errors (Linux/Mac):**
```bash
chmod -R 775 storage bootstrap/cache
```

