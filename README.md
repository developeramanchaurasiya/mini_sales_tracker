# Mini Sales Tracker - Laravel Project

Mini Sales Tracker is a Laravel-based application designed to manage sales orders, view reports, and handle user authentication.

---

## Setup Instructions (All-in-One)

Clone the repository, install dependencies, configure the environment, run migrations and seeders, and start the server—all in one place:

```bash
git clone https://github.com/developeramanchaurasiya/mini_sales_tracker.git
cd mini_sales_tracker

composer install
npm install
npm run dev
cp .env.example .env

# Update .env with your database credentials:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_database_name
# DB_USERNAME=your_database_user
# DB_PASSWORD=your_database_password


php artisan migrate --seed
php artisan serve


Demo Login Credentials
Use these credentials to log in and test the application:

Email: test@gmail.com
Password: password123