# Maxi-Care — Pharmacy Inventory Management

A Laravel 10 pharmacy management system for small pharmacies. Two roles:

- **Administrator** — manage staff accounts, view sales reports.
- **Staff** — record point-of-sale, receive stock, manage products, suppliers, categories, and expiries.

Runs on **MySQL or PostgreSQL** from the same codebase. One command bootstraps a fully working demo with seeded accounts.

## Requirements

- PHP **^8.1** with `pdo_mysql` and/or `pdo_pgsql` enabled
- Composer
- Either MySQL **5.7+** / MariaDB **10.3+**, or PostgreSQL **12+**

A web server / `php artisan serve` is sufficient for local evaluation.

## Quick start

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Pick **one** of the two database setups below, then:

```bash
php artisan migrate:fresh --seed
php artisan serve
```

Open `http://localhost:8000` — the login page shows the demo credentials with one-click sign-in buttons.

### Option A — MySQL

Create an empty database (e.g. `maxicare_db`), then in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=maxicare_db
DB_USERNAME=root
DB_PASSWORD=
```

### Option B — PostgreSQL

Create an empty database:

```bash
createdb maxicare_db
```

Then in `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=maxicare_db
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

Run `php artisan config:clear` after changing `.env`, then `php artisan migrate:fresh --seed`.

## Demo credentials

The seeder creates two accounts on every fresh install. They are also shown on the login page (one-click fill).

| Role | Email | Password |
|---|---|---|
| Administrator | `admin@gmail.com` | `admin123` |
| Staff | `staff@gmail.com` | `staff123` |

The canonical list lives in `config/demo.php` — edit the array there to add or rename demo accounts. The seeder reads the same config, so changes apply on the next `php artisan db:seed`.

### Disabling demo mode for production

Set `DEMO_MODE=false` in `.env` to hide the "Try the demo" card on the login page. Seeded accounts still exist in the database — rotate their passwords from the admin dashboard (or remove them entirely) before going live.

## Layout

- `app/Http/Controllers/AdminController.php` — admin pages, guarded by `checkAdminRole` middleware.
- `app/Http/Controllers/StaffController.php` — staff pages, guarded by `checkStaffRole` middleware. Inventory rules (receive ↔ stock pairing, sales transactions, expiry sweep) live here.
- `database/migrations/` — schema. Numeric columns use `integer` / `decimal` so aggregates like `Sales::sum('amount')` work on both engines.
- `database/seeders/DatabaseSeeder.php` — reads `config('demo.accounts')` and seeds users.
- `config/demo.php` — single source of truth for demo accounts (used by seeder and login view).
- `resources/views/{admin,staff}/*.blade.php` — per-page Blade templates. CSS lives in `public/css/`; no build step.
- `routes/web.php` — flat routes, prefixed `admin/` and `staff/`.

## License

MIT (Laravel framework license retained).
