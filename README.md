# Booking System

This is a Laravel-based booking system designed to manage user bookings and availability schedules efficiently. The project leverages Laravel's robust ecosystem, including Eloquent ORM, migrations, and GraphQL integration for API development.

## Features

- User management with authentication.
- Booking and availability management.
- GraphQL API for flexible data querying.
- Database migrations and seeding for easy setup.

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- A database system (e.g., MySQL, SQLite)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/aslammaududy/booking-system.git
   cd booking-system
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Set up the environment:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Configure database and other environment variables in the `.env` file.

5. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Build frontend assets:
   ```bash
   npm run build
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000/graphiql`.

<!-- ## Testing

Run the test suite using PHPUnit:
```bash
php artisan test
``` -->

## Contributing

Contributions are welcome! Please follow the [Laravel contribution guide](https://laravel.com/docs/contributions).
