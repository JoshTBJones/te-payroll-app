# Laravel Project

This is a Laravel project set up to run using Docker and [Laravel Sail](https://laravel.com/docs/11.x/sail).

## Prerequisites

- [Docker](https://www.docker.com/get-started) installed on your machine.

## Setup

1. **Clone the repository:**

   ```bash
   git clone https://github.com/JoshTBJones/te-payroll-app.git
   cd te-payroll-app
   ```

1. **Copy the `.env.example` file to `.env`:**

   ```bash
   cp .env.example .env
   ```

1. **Start the development environment:**

   Use Sail to start the Docker containers:

   ```bash
   ./vendor/bin/sail up
   ```

   This command will start the application using Docker containers defined in the `docker-compose.yml` file.

1. **Install dependencies:**

   Laravel Sail provides a simple command-line interface for interacting with Laravel's default Docker configuration. To install the dependencies, run:

   ```bash
   ./vendor/bin/sail composer install
   ```

1. **Generate an application key:**

   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

1. **Create a new database:**

   ```bash
   ./vendor/bin/sail artisan migrate:fresh --seed
   ```

1. ** Build Frontend:**

   ```bash
   ./vendor/bin/sail npm run build
   ```
   Alternatively, you can use the following command to build the frontend in dev mode to see changes in real time:
   ```bash
   ./vendor/bin/sail npm run dev
   ```

1. **Access the application:**

   Once the containers are up and running, you can access the application at [http://payroll-app.test](http://payroll-app.test).

## Running Tests

To run the tests, use the following command:

```bash
./vendor/bin/sail artisan test
```

## Using The Application

When you first access the application, you will be redirected to the login page. You will need to use the following credentials to login:

- Email: `test@example.com`
- Password: `password`

Once you have logged in, you will be redirected to the dashboard. Where you can view the Payroll Date Calculator.
