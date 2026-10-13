# Smart Food Waste Reduction

A Laravel web application for redistributing surplus food. Admins manage food listings and review requests; users browse available food, submit claims, and manage food-intake records. The app also provides contact replies, two-factor authentication, and a read-only food API.

## Requirements

- PHP 8.3 or newer
- Composer
- MySQL (or another Laravel-supported database configured in `.env`)
- Node.js and npm for frontend assets

This repository currently requires Laravel 13 (`composer.json`).

## Getting started

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configure the database and mailer in `.env`, then initialize the database and start the app:

```bash
php artisan migrate
php artisan serve
```

In a second terminal, run Vite while developing the frontend:

```bash
npm run dev
```

Open the URL printed by `php artisan serve` (usually `http://127.0.0.1:8000`). To build frontend assets for deployment, run `npm run build`.

### Handy commands

```bash
php artisan route:list             # List routes, handlers, and middleware
php artisan migrate:status         # Show migration status
php artisan db:seed                # Run the configured seeders
php artisan db:seed --class='Database\Seeders\FoodCatalogSeeder' # Add the 30 sample food listings
php artisan app:delete-expired-foods # Delete listings whose expiry date has passed
php artisan optimize:clear         # Clear Laravel caches
```

`composer run dev` starts the Laravel server, queue listener, log tail, and Vite together. `composer run test` runs the project test suite. `composer run setup` installs dependencies, prepares the environment, migrates, and builds assets.

The expired-food command is not scheduled by the application. Run it manually, or configure your server's scheduler/cron to invoke it at the interval you want. It deletes listings with an expiry date earlier than today; food expiring today remains available until the next day. The listing is deleted through Eloquent so its linked intake record is also cleaned up by the model event. Claims linked to the food are subject to the database foreign-key cascade.

`FoodCatalogSeeder` loads 30 sample listings for SRH Campus Munich with local food photos and visible source/license credits. The seeder can be run again safely without duplicating the catalog entries.

## Features

- User and Admin sign-in, registration, and role checks
- Optional authenticator-app two-factor authentication
- Food listing creation, updates, images, search, and category filtering
- User claims with pending, approved, and rejected states
- Admin dashboard with food, account, expiry, and claim counts
- Configurable site headings
- Contact form and admin email replies
- Food-intake records and expiring/consumed food JSON responses
- Public read-only food API

## Routes and API

The main route definitions are in `routes/web.php` and `routes/api.php`. Use `php artisan route:list` for the complete, current list.

| Method | URL | Purpose |
|---|---|---|
| GET | `/` | Home page |
| GET | `/login`, `/register` | User sign-in and registration pages |
| GET/POST | `/admin/login`, `/admin/login-submit` | Admin sign-in |
| GET/POST | `/2fa/setup`, `/2fa/verify` | Configure or verify two-factor authentication |
| GET | `/foods` | Browse available food (signed in) |
| POST | `/foods/claim/{id}` | Request a food listing (signed in) |
| GET | `/my-claims` | View the signed-in user's claims |
| GET | `/admin/dashboard` | Admin dashboard (signed in) |
| GET | `/admin/food`, `/admin/pending-food` | Manage food and pending claims (Admin) |
| GET | `/api/foods` | List non-expired food as JSON |
| GET | `/api/foods/{id}` | Get one food record as JSON |

Food-intake routes are also defined in `routes/web.php`; they return JSON. Admin pages and actions use role middleware where configured. The API routes above are public.

## Project structure

```text
app/
  Console/Commands/       Custom Artisan commands
  Http/Controllers/       Web request handlers
    Api/                  JSON API handlers
  Http/Middleware/        Authentication/role checks
  Mail/                   Mail message classes
  Models/                 Eloquent database models
  Providers/              Application service providers
  Services/               Reusable services (2FA)
bootstrap/                Laravel startup configuration
config/                   Framework and application settings
database/
  factories/              Fake model data
  migrations/             Database schema history
  seeders/                Optional initial/sample data
public/                   Web entry point and public assets
resources/
  css/                    Admin, user, and shared stylesheets
  js/                     Frontend JavaScript entry point
  views/                  Blade pages and email templates
routes/                   Web, API, and console route definitions
storage/                  Logs, cache, sessions, compiled views, uploads
tests/                    Unit and feature tests
```

### Important application files

- `app/Http/Controllers/AuthController.php` — sign-in, registration, and 2FA flow.
- `app/Http/Controllers/AdminController.php` — dashboard data, account management, and configurable headings.
- `app/Http/Controllers/FoodController.php` — food listing CRUD, browse/search/filter.
- `app/Http/Controllers/FoodClaimController.php` — create and review food claims.
- `app/Http/Controllers/FoodIntakeController.php` — JSON operations for food-intake records.
- `app/Http/Controllers/ContactController.php` — contact messages and admin email replies.
- `app/Http/Controllers/Api/FoodApiController.php` — public food JSON endpoints.
- `app/Http/Middleware/RoleMiddleware.php` — checks a user's role for protected routes.
- `app/Services/Google2faService.php` — creates and verifies authenticator codes.
- `app/Models/FoodItemSfwr.php` — food model, relationships, expiry scopes/status, and linked intake lifecycle.
- `app/Models/FoodClaimSfwr.php` — claim model and food/user relationships.
- `app/Models/FoodIntakeSfwr.php` — intake model and relationships.
- `app/Models/User.php` — authenticatable user model using the app's custom table and columns.
- `app/Models/Contact.php`, `HeaderSfwr.php`, `UserTwoFactor.php` — contact, configurable heading, and 2FA records.
- `app/Console/Commands/DeleteExpiredFoods.php` — removes food listings that expired before today.
- `bootstrap/app.php` — registers route files and the `/up` health endpoint.
- `vite.config.js` — selects frontend CSS/JS build inputs.
- `composer.json` and `package.json` — PHP/JavaScript dependencies and project scripts.

The `resources/views/Admin` and `resources/views/User` folders contain the corresponding Blade screens. `resources/views/layouts` and `resources/views/layouts/*` contain shared layouts/components; `resources/views/2fa` contains 2FA pages; `resources/views/emails` contains the contact-reply email template. Styles are grouped under `resources/css/Admin`, `resources/css/User`, and `resources/css/components`.

## Database notes

Application tables and columns use custom names such as `FoodItems_sfwr`, `foodname_sfwr`, and `id_user_sfwr`; the models declare these names explicitly. Migrations create and evolve the schema. Review `.env` before running migrations against any database containing data. `DatabaseSeeder` creates a sample user; `FoodIntakeSeeder` contains optional intake/sample data and is not automatically run by `db:seed` unless added to `DatabaseSeeder`.

## Tests

Run the existing suite with:

```bash
composer run test
```

The `tests/Unit` and `tests/Feature` directories contain the current test files.
