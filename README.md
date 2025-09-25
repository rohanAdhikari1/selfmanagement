# Self Management System

A Laravel-based application for managing users, cleaners, companies, sites, inspections, and reports.

## Requirements

-   PHP 8.1 or higher
-   Composer
-   [Laravel Herd](https://herd.laravel.com/) (recommended for local development)
-   Node.js & npm (for frontend assets)
-   MySQL or compatible database

## Installation

1. **Clone the repository**

    ```sh
    git clone https://github.com/your-username/selfmanagement.git
    cd selfmanagement
    ```

2. **Install PHP dependencies**

    ```sh
    composer install
    ```

3. **Install Node dependencies**

    ```sh
    npm install
    ```

4. **Copy and configure environment file**

    ```sh
    cp .env.example .env
    ```

    Edit the `.env` file and set your database and mail credentials.

5. **Generate application key**

    ```sh
    php artisan key:generate
    ```

6. **Run migrations and seeders**

    ```sh
    php artisan migrate --seed
    ```

7. **Run the application with Herd**

    If you have [Laravel Herd](https://herd.laravel.com/) installed, simply run:

    ```sh
    herd open
    ```

    This will serve your application at `http://localhost`.

8. **Build frontend assets**

    For production:

    ```sh
    npm run build
    ```

    For development (auto-reloads on changes):

    ```sh
    npm run dev
    ```

## Default Admin Login

After seeding, you can log in with:

-   **Username:** `rohan`
-   **Email:** `app@rohan.info.np`
-   **Password:** `Rohan@567`

## Features

-   User, Cleaner, Company, and Site management
-   Task and Inspection management
-   Attendance and reporting
-   Role-based access control

php -d allow_url_fopen=On ~/bin/composer update --no-dev
