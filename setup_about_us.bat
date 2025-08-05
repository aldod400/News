@echo off
echo Setting up About Us system...
echo.

echo Trying Laravel Migration...
php artisan migrate

echo.
echo Running seeder...
php artisan db:seed --class=AboutUsSeeder

echo.
echo If migration failed, you can:
echo 1. Open phpMyAdmin or your MySQL client
echo 2. Select your database
echo 3. Run the SQL file: about_us_setup.sql
echo.
echo Or use MySQL command line:
echo mysql -u root -p your_database_name ^< about_us_setup.sql
echo.
echo Setup complete! You can now access the About Us page.
pause
