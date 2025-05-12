# Booking System

This is a Laravel-based booking system designed to manage user bookings and availability schedules efficiently. The project leverages Laravel's robust ecosystem, including Eloquent ORM, migrations, and GraphQL integration for API development.

## Features

- User management with authentication using Laravel Sanctum.
- Booking and availability management.
- GraphQL API for flexible data querying, with a built-in GraphiQL interface for testing queries.
- Custom password reset URL logic for seamless user experience.
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

   Recent migrations include:
   - `bookings` table for managing user bookings.
   - `availabilities` table for managing availability schedules.

6. Build frontend assets:
   ```bash
   npm run build
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

- Access the application at `http://localhost:8000/graphiql` to explore the GraphQL API using the GraphiQL interface.
- Use the API for booking and availability management with authentication via Laravel Sanctum.

## Authentication for GraphQL API

To interact with the GraphQL API, you need to authenticate using a token. Follow these steps to register, log in, and obtain the token:

1. **Register a new user**:
   Send a POST request to the `api/register` endpoint with the following payload:
   ```json
   {
       "name": "John Doe",
       "email": "johndoe@example.com",
       "password": "password",
       "password_confirmation": "password"
   }
   ```

2. **Log in with the registered user**:
   Send a POST request to the `api/login` endpoint with the following payload:
   ```json
   {
       "email": "johndoe@example.com",
       "password": "password"
   }
   ```

   The response will include an authentication token:
   ```json
   {
       "token": "your-authentication-token"
   }
   ```

3. **Use the token in GraphQL requests**:
   Include the token in the `Authorization` header when making GraphQL API requests:
   ```http
   Authorization: Bearer your-authentication-token
   ```

### Example GraphQL Query

Here is an example of a GraphQL query to fetch bookings:

```graphql
query {
  bookings {
    id
    user {
      name
      email
    }
    start_time
    end_time
  }
}
```

Use a tool like Postman or the GraphiQL interface to test the API with the token included in the headers.

## Testing

Run the test suite using PHPUnit:
```bash
php artisan test
```

## Contributing

Contributions are welcome! Please follow the [Laravel contribution guide](https://laravel.com/docs/contributions).
