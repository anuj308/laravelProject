# OmniTrek Premium - Laravel Tourism Management Platform

OmniTrek Premium is a Laravel MVC web application for travel planning and tourism service management. It helps users explore destinations, hotels, travel packages, local guides, and transport options from one place. Users can also book hotels/packages, write reviews, view booking history, and create a combined trip plan using the smart trip planner.

The project includes a normal user area and an admin area. Admin users can manage destinations, hotels, packages, guides, transport records, users, bookings, and trip information.

## Project Report

A complete college submission report has been generated in:

```text
OmniTrek_Project_Report.md
```

It includes the abstract, SRS format sections, project objective, scope, technology stack, MVC architecture, database design, module descriptions, working process, screenshot placeholders, conclusion, future scope, and references.

## Main Features

- User registration, login, logout, and session-based authentication
- Admin login with `admin` and `user` role checking
- Destination listing, search/filter, detail page, reviews, and admin CRUD
- Hotel listing, search/filter, room availability, hotel booking, and booking history
- Travel package listing, package detail page, booking, and admin CRUD
- Smart trip planner for bundling destination, hotel, package, and local guide
- Local guide directory with contact details, language, fee, rating, and admin CRUD
- Transport listing with route, provider, departure time, seats, price, and admin CRUD
- Review and rating system for destinations and hotels
- Admin dashboard with users, bookings, trips, and recent activity
- Responsive Blade frontend using Tailwind CSS, Bootstrap Icons, Google Fonts, and Vite
- Seeded demo data for academic presentation and testing

## Technology Stack

| Technology | Purpose |
|---|---|
| Laravel 13 | Backend framework and MVC structure |
| PHP 8.3 | Server-side programming language |
| Blade | Dynamic view templates |
| SQLite | Current local database connection |
| MySQL | Compatible database option for deployment |
| Tailwind CSS 4 | Frontend styling |
| Bootstrap Icons | Icons used in the UI |
| Vite | CSS/JavaScript asset bundling |
| Composer | PHP dependency management |
| npm | Frontend dependency management |

## Database Schema

- `users`: stores tourist/admin accounts with a `role`
- `destinations`: stores tourism places, images, descriptions, locations, and ratings
- `hotels`: belongs to a destination and stores room availability and price
- `hotel_bookings`: belongs to a user and hotel
- `travel_packages`: belongs to a destination and stores package details
- `package_bookings`: belongs to a user and travel package
- `local_guides`: belongs to a destination and stores guide contact/fee details
- `transports`: stores travel route, provider, seats, time, and price
- `reviews`: belongs to a user and can connect to a hotel or destination
- `trips`: stores planned user trips with destination, optional hotel/package/guide, dates, people, total price, and status

## Setup Steps

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Create the environment file:

```bash
cp .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Create the SQLite database file if you are using SQLite:

```bash
touch database/database.sqlite
```

6. Update `.env` database settings if needed. For SQLite, use:

```env
DB_CONNECTION=sqlite
```

For MySQL, update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

7. Run migrations and seed demo data:

```bash
php artisan migrate --seed
```

8. Build frontend assets:

```bash
npm run build
```

For development with hot reload, run this in a separate terminal:

```bash
npm run dev
```

9. Start the Laravel server:

```bash
php artisan serve
```

10. Open the project:

```text
http://127.0.0.1:8000
```

## Demo Login

Seeded demo users:

| Role | Login URL | Email | Password |
|---|---|---|---|
| Admin | `/admin/login` | `admin@omnitrek.test` | `password` |
| User | `/login` | `user@omnitrek.test` | `password` |

## Useful Routes

- `/` home page
- `/register` user registration
- `/login` user login
- `/admin/login` admin login
- `/destinations` destination search and listing
- `/hotels` hotel search and booking
- `/packages` travel packages
- `/guides` local guides
- `/transports` transport options
- `/plan-trip` smart trip planner
- `/my-trips` saved user trips
- `/booking-history` user booking history
- `/admin/dashboard` admin panel

## Useful Commands

```bash
php artisan route:list
php artisan migrate:fresh --seed
npm run build
php artisan test
```

## Notes

- The current local `.env` is configured for SQLite.
- The project can be switched to MySQL by updating `.env` and running migrations.
- If Laravel shows a Vite manifest error, run `npm run build` or keep `npm run dev` running during development.
