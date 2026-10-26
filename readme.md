# learnphp

## Local setup

1. Start the MariaDB service with `docker compose up -d`.
2. Install Composer dependencies with `composer install`.
3. Create the application tables using `database/schema.sql` in the `learnphp` database.
4. Start the PHP development server with `php -S localhost:8000 -t public public/index.php`.
5. Open `http://localhost:8000`.

The admin post and user pages are available at `/admin/posts` and `/admin/users`.