# About Us Setup Script
# This script will create the About Us tables and insert sample data

# Method 1: Using Laravel Artisan (if migration works)
echo "Trying Laravel Migration..."
php artisan migrate

echo "Running seeder..."
php artisan db:seed --class=AboutUsSeeder

# Method 2: Direct SQL execution (if migration fails)
echo ""
echo "If migration failed, you can run the SQL file directly:"
echo "1. Open your MySQL/MariaDB client (phpMyAdmin, MySQL Workbench, etc.)"
echo "2. Select your database"
echo "3. Import or run the file: about_us_setup.sql"
echo ""
echo "Or use command line:"
echo "mysql -u your_username -p your_database_name < about_us_setup.sql"
echo ""
echo "Setup complete! You can now access the About Us page."
