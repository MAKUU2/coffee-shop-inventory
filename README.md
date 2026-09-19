# Coffee Shop Inventory Management System

A Laravel-based inventory management system for a coffee shop: products, ingredients, stock-in/stock-out transactions, low-stock alerts, and a dashboard with inventory statistics.

## Features

- Admin authentication (single-admin design)
- Dashboard with inventory statistics
- Category management (CRUD)
- Product management (CRUD)
- Ingredient management (CRUD)
- Stock In management (CRUD + automatic stock increase)
- Stock Out management (CRUD + automatic stock decrease with availability check)
- Low Stock monitoring (`stock <= minimum_stock`)
- Inventory transaction protection (database transactions + row locking)
- Database foreign-key protection (RESTRICT + application-level delete guards)
- Automated feature tests (39 tests / 140 assertions)

## Technology Stack

| Technology | Version / Notes |
| ---------- | --------------- |
| PHP | 8.2+ |
| Laravel | 12 |
| MySQL | Local development database |
| Blade | Server-rendered templates |
| Tailwind CSS | Loaded through CDN in Blade views |
| Vite | Files exist in the default Laravel scaffold, but the current Blade views use Tailwind CDN, so a Vite production build is not required to run the app |
| PHPUnit | Feature/unit testing as configured in `phpunit.xml` |
| Laravel Pint | PHP code style |

## System Highlights

- Stock changes happen only through Stock In and Stock Out transactions; the ingredient form does not accept direct stock edits.
- Stock operations run inside database transactions and lock inventory rows with `lockForUpdate()` where needed.
- Stock Out rejects quantities that exceed available stock, including exact-boundary handling (`stock == quantity` succeeds).
- Updates account for current ledger values before recalculating stock.
- Categories with products cannot be deleted; ingredients with stock history cannot be deleted.

## Database Overview

Main application tables:

- `admins`
- `categories`
- `products`
- `ingredients`
- `stock_ins`
- `stock_outs`

Foreign keys use `RESTRICT` behavior so history cannot be silently cascade-deleted. Controllers additionally block deletes that would orphan products or erase stock history.

## Authentication

- Single-admin design: registration is available only while no admin account exists.
- Once the first admin exists, registration is closed by the application (requests redirect to login).
- Login uses username and password; passwords are hashed before storage.
- `POST /login` and `POST /register` are throttled (`throttle:5,1`).
- Protected routes use the `admin.auth` middleware.
- Logout uses `POST /logout` with session invalidation.

## Inventory Safety

- New ingredients always start with `stock = 0`; initial quantity is added through Stock In.
- Editing an ingredient never changes its stock; metadata (name, unit, minimum stock, cost) remains editable.
- Every stock change is a ledger record (`stock_ins` / `stock_outs`) plus an atomic stock adjustment.
- Negative inventory is rejected on create, update, and delete paths.
- Deleting a Stock In that would drive stock negative is rejected; deleting a Stock Out restores stock.

## Installation

1. Clone/download the project:
   ```bash
   git clone https://github.com/MAKUU2/coffee-shop-inventory.git
   ```
2. Enter the project directory:
   ```bash
   cd coffee-shop-inventory
   ```
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Create `.env` from `.env.example`:
   ```bash
   copy .env.example .env
   ```
   macOS/Linux:
   ```bash
   cp .env.example .env
   ```
5. Configure the MySQL database in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=coffee_shop
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Adjust `DB_USERNAME` and `DB_PASSWORD` to match the local MySQL setup.
6. Generate the application key:
   ```bash
   php artisan key:generate
   ```
7. Run migrations:
   ```bash
   php artisan migrate
   ```
8. Start Laravel:
   ```bash
   php artisan serve
   ```
9. Open the application at `http://127.0.0.1:8000` and register the first (and only) admin account.

No frontend build step is required: Blade views load Tailwind through the CDN.

## Testing

Run the test suite:
```bash
php artisan test
```

Check code style without changing files:
```bash
vendor/bin/pint --test
```

Current state: 39 passing tests / 140 assertions, covering business rules such as inventory calculations, stock guards, boundary cases, fresh ledger values on update, delete protection, foreign-key restrictions, blocked direct stock manipulation, and missing-category display handling.

Most feature tests run against an isolated SQLite test database. MySQL-specific concurrency behavior (real `lockForUpdate()` contention) is therefore not fully proven by the SQLite suite; the tests verify calculation-from-fresh-row logic and rollback behavior.

## Project Structure

```text
app/
  Http/
  Models/

database/
  migrations/

resources/
  views/

routes/
  web.php

tests/
  Feature/
```

## Current Scope / Limitations

- Portfolio-scale Laravel inventory system following a single-admin model.
- Blade views currently use Tailwind CSS through the CDN; the Vite scaffold is present but unused.
- Dashboard logic lives in a route closure with an additional query in the dashboard view; extracting a `DashboardController` is a possible later cleanup.
- Additional authentication and dashboard-assertion tests can be added as the project grows.

These are scope notes, not defects.

## Future Improvements

- Shared Blade layout/components to remove duplicated page markup
- `FormRequest` classes if validation grows
- `DashboardController` extraction
- Compiled frontend assets with Vite
- Additional authentication/dashboard tests
- Documentation expansion (screenshots, demo credentials for reviewers)

## Developer

**Mark Joseph Ladot**

GitHub: https://github.com/MAKUU2

## License

Created for educational and portfolio purposes.
