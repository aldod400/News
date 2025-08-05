# About Us System Documentation

## Overview
Dynamic About Us system with multilingual support (Arabic/English) that includes:
- Company description and story
- Editorial Board with photos and positions
- Office locations with contact information
- Full admin panel management

## Features
- ✅ Multilingual content (Arabic/English)
- ✅ Rich text editor (CKEditor) for content
- ✅ Image upload for Editorial Board and Offices
- ✅ Drag & drop ordering
- ✅ Active/Inactive status management
- ✅ Responsive design
- ✅ Admin panel integration
- ✅ Quick Links navigation

## Setup Instructions

### 1. Database Setup
If tables don't exist, run one of these options:

**Option A: Laravel Command (Recommended)**
```bash
php artisan setup:about-us
```

**Option B: Manual Migration**
```bash
php artisan migrate
php artisan db:seed --class=AboutUsSeeder
```

**Option C: Direct SQL**
Import the file `about_us_setup.sql` into your database.

### 2. File Structure
```
app/
├── Models/
│   ├── AboutUs.php           # Company description model
│   ├── EditorialBoard.php    # Editorial board members
│   └── Office.php           # Office locations
├── Http/Controllers/
│   └── AboutUsController.php # Main controller
└── Console/Commands/
    └── SetupAboutUs.php     # Setup command

resources/views/
├── about-us.blade.php        # Public About Us page
└── admin/about-us/          # Admin management views
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php

database/
├── migrations/              # Database schema
└── seeders/
    └── AboutUsSeeder.php   # Sample data
```

## Usage

### Public Access
- **About Us Page**: `/about-us`
- Accessible from Quick Links in header
- Displays company description, editorial board, and offices
- Automatic language switching

### Admin Management
- **Admin Panel**: `/admin/about-us`
- Requires Super Admin role
- Manage company description
- Add/edit/delete editorial board members
- Add/edit/delete office locations
- Upload images for team members and offices

## Database Schema

### about_us Table
- `id` - Primary key
- `description` - JSON field with multilingual content
- `created_at`, `updated_at` - Timestamps

### editorial_board Table
- `id` - Primary key
- `name` - JSON field (en/ar)
- `position` - JSON field (en/ar)
- `image` - Profile photo path
- `order` - Display order
- `is_active` - Status flag
- `created_at`, `updated_at` - Timestamps

### offices Table
- `id` - Primary key
- `name` - JSON field (en/ar)
- `address` - JSON field (en/ar)
- `phone` - Contact phone
- `email` - Contact email
- `image` - Office photo path
- `order` - Display order
- `is_active` - Status flag
- `created_at`, `updated_at` - Timestamps

## Customization

### Adding New Fields
1. Create migration: `php artisan make:migration add_field_to_table`
2. Update model with new fillable fields
3. Update admin forms and views
4. Update public display template

### Styling
- Edit `resources/views/about-us.blade.php` for public page styling
- Admin styles are inherited from existing admin theme

### Translations
- Add new translations to `lang/en/general.php` and `lang/ar/general.php`
- Use `__('general.key')` in views

## Troubleshooting

### Tables Don't Exist Error
Run the setup command: `php artisan setup:about-us`

### Images Not Uploading
1. Check storage permissions: `php artisan storage:link`
2. Verify upload directory exists: `storage/app/public/uploads/`

### Permission Denied
Ensure your user role is set to 'super_admin' in the users table.

### Migration Issues
If migrations fail, use the SQL file directly or check database connection settings.

## Files Created/Modified
- ✅ Models: AboutUs, EditorialBoard, Office
- ✅ Controller: AboutUsController
- ✅ Views: Public and admin templates
- ✅ Routes: Web routes for public and admin
- ✅ Migrations: Database schema
- ✅ Seeder: Sample data
- ✅ Translations: English and Arabic
- ✅ Navigation: Quick Links and admin menu
- ✅ Command: Setup automation

## Support
For any issues or questions, refer to this documentation or check the Laravel logs in `storage/logs/`.
