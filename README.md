# TourEase - Laravel Tourism Management Platform

TourEase is a simple Laravel MVC project for tourism industry support. It helps tourists discover destinations, book hotels, choose travel packages, contact local guides, check transport options, and write reviews.

## Main Features

- User register/login with `admin` and `user` roles
- Destination CRUD with image, location, description, and rating
- Hotel listing, search/filter, room availability, booking form, and booking history
- Travel package listing, admin package CRUD, and package booking
- Local guide directory with phone and email contact
- Review and rating system for hotels and destinations
- Admin dashboard for users, hotel bookings, package bookings, destinations, and hotels
- Simple responsive frontend using Blade templates and Bootstrap
- Seeded demo data for college presentation/testing

## Database Schema

- `users`: stores tourist/admin accounts with a `role`
- `destinations`: stores tourism places
- `hotels`: belongs to a destination and stores room availability
- `hotel_bookings`: belongs to a user and hotel
- `travel_packages`: belongs to a destination
- `package_bookings`: belongs to a user and travel package
- `local_guides`: belongs to a destination
- `transports`: stores travel availability information
- `reviews`: belongs to a user and can connect to a hotel or destination

## Setup Steps

1. Install PHP dependencies:

```bash
composer install
```

2. Create the environment file:

```bash
cp .env.example .env
```

3. Generate app key:

```bash
php artisan key:generate
```

4. Create SQLite database file if you are using SQLite:

```bash
touch database/database.sqlite
```

5. Update `.env` database settings if needed. For SQLite, use:

```env
DB_CONNECTION=sqlite
```

6. Run migrations and seed demo data:

```bash
php artisan migrate --seed
```

7. Start the Laravel server:

```bash
php artisan serve
```

8. Open the project:

```text
http://127.0.0.1:8000
```

## Demo Login

- Admin: `admin`
- User: `user@tourease.test`
- Admin password: `admin`
- User password: `password`

## Useful Routes

- `/` home page
- `/destinations` destination search and listing
- `/hotels` hotel search and booking
- `/packages` travel packages
- `/guides` local guides
- `/booking-history` user booking history
- `/admin/dashboard` admin panel

## Example Student Commit Messages

- created basic laravel project setup
- added user login and register pages
- added destination management module
- added hotel booking feature
- created travel package booking system
- added local guide listing page
- added review and rating system
- created admin dashboard page
- added destination and hotel search filters
- added sample seed data for tourease
