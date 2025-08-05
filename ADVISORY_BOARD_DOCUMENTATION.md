# Advisory Board System Documentation

## Overview
Complete Advisory Board management system with multilingual support (Arabic/English) featuring:
- Advisory board member profiles with photos
- Job titles and positions
- Admin panel for full management
- Public display page
- Order management and status control

## Features Implemented
- ✅ Multilingual content (Arabic/English)
- ✅ Profile image upload for members
- ✅ Admin panel with full CRUD operations
- ✅ Display order management
- ✅ Active/Inactive status control
- ✅ Responsive design for all devices
- ✅ Quick Links navigation integration
- ✅ Admin menu integration
- ✅ Fallback handling for missing data

## Setup Instructions

### Quick Setup
```bash
php artisan setup:advisory-board
```

### Manual Setup
```bash
php artisan migrate
php artisan db:seed --class=AdvisoryBoardSeeder
```

### Direct SQL Setup
Import the SQL file if Laravel commands don't work:
```sql
-- See advisory_board_setup.sql for manual installation
```

## File Structure

### Backend Files
```
app/
├── Models/
│   └── AdvisoryBoard.php              # Main model with multilingual support
├── Http/Controllers/
│   └── AdvisoryBoardController.php    # Controller with public & admin methods
└── Console/Commands/
    └── SetupAdvisoryBoard.php         # Setup automation command

database/
├── migrations/
│   └── 2024_01_01_000007_create_advisory_board_table.php
└── seeders/
    └── AdvisoryBoardSeeder.php        # Sample data seeder
```

### Frontend Files
```
resources/views/
├── advisory-board.blade.php           # Public Advisory Board page
└── admin/advisory-board/              # Admin management views
    ├── index.blade.php               # List all members
    ├── create.blade.php              # Add new member
    └── edit.blade.php                # Edit existing member
```

### Routes
```
routes/web.php
├── /advisory-board                    # Public page
└── /admin/advisory-board/*            # Admin management routes
```

## Database Schema

### advisory_board Table
| Field      | Type                | Description                    |
|------------|---------------------|--------------------------------|
| id         | bigint unsigned     | Primary key                    |
| name       | JSON                | Member name (en/ar)            |
| job_title  | JSON                | Job title/position (en/ar)     |
| image      | varchar(255)        | Profile image filename         |
| order      | int                 | Display order (0 = first)     |
| is_active  | boolean             | Active status (true/false)     |
| created_at | timestamp           | Creation timestamp             |
| updated_at | timestamp           | Last update timestamp          |

## Usage Guide

### Public Access
- **Page URL**: `/advisory-board`
- **Navigation**: Available in Footer → Quick Links
- **Features**: 
  - Responsive grid layout
  - Member photos (with fallback icons)
  - Multilingual names and job titles
  - Professional card design with hover effects

### Admin Management
- **Admin URL**: `/admin/advisory-board`
- **Access**: Super Admin role required
- **Features**:
  - List all members with photos
  - Add new members with image upload
  - Edit existing members
  - Delete members (with confirmation)
  - Set display order
  - Toggle active/inactive status

### Adding New Members
1. Login as Super Admin
2. Go to Advisory Board in admin menu
3. Click "Add New Member"
4. Fill in:
   - Name (English & Arabic)
   - Job Title (English & Arabic)
   - Upload profile image (optional)
   - Set display order
   - Set active status
5. Save

### Managing Existing Members
- **Edit**: Click edit button to modify details
- **Delete**: Click delete button (with confirmation)
- **Status**: Toggle active/inactive in edit form
- **Order**: Change display order in edit form

## Customization Options

### Styling
The public page includes custom CSS with:
- Card hover effects
- Responsive image handling
- RTL support for Arabic
- Professional color scheme
- Mobile-optimized layout

### Adding New Fields
1. Create migration to add database column
2. Update model's `$fillable` array
3. Add field to create/edit forms
4. Update display templates
5. Add translations if needed

### Image Management
- **Upload Path**: `storage/app/public/uploads/`
- **Supported Formats**: JPEG, PNG, JPG, GIF
- **Max Size**: 2MB
- **Automatic Resize**: No (upload original size)
- **Fallback**: Default avatar icon if no image

## Translation Support

### English (lang/en/general.php)
```php
'advisory_board' => 'Advisory Board',
'advisory_board_description' => 'Meet our distinguished advisory board members...',
// ... more translations
```

### Arabic (lang/ar/general.php)
```php
'advisory_board' => 'المجلس الاستشاري',
'advisory_board_description' => 'تعرف على أعضاء مجلسنا الاستشاري المتميزين...',
// ... more translations
```

## Integration Points

### Navigation Integration
- **Footer Quick Links**: Auto-added to footer navigation
- **Admin Menu**: Added to admin sidebar with icon
- **Breadcrumbs**: Automatic breadcrumb generation

### Permission Integration
- **Role Check**: Super Admin access only for management
- **Route Protection**: All admin routes protected
- **Graceful Fallbacks**: Public page works even without data

## Troubleshooting

### Common Issues

#### Table Doesn't Exist
```bash
# Run setup command
php artisan setup:advisory-board

# Or manual migration
php artisan migrate
```

#### Images Not Displaying
1. Check storage link: `php artisan storage:link`
2. Verify upload directory exists: `storage/app/public/uploads/`
3. Check file permissions

#### Permission Denied
- Ensure user role is 'super_admin' in users table
- Check route middleware configuration

#### Translation Missing
- Add new keys to both `lang/en/general.php` and `lang/ar/general.php`
- Clear cache if needed: `php artisan config:clear`

### Debug Mode
Check Laravel logs in `storage/logs/` for detailed error information.

## Sample Data
The system includes 6 sample advisory board members:
- Dr. Ahmed Mahmoud (Chairman)
- Prof. Sarah Johnson (Media Advisor)
- Dr. Mohamed Al-Rashid (Technology Advisor)
- Ms. Fatima Al-Zahra (Legal Advisor)
- Dr. Omar Hassan (Strategic Planning)
- Prof. Layla Abdel Rahman (R&D Advisor)

## Performance Notes
- Images are stored locally (not CDN)
- JSON fields for multilingual content
- Efficient database queries with proper indexing
- Lazy loading for better performance

## Security Features
- File upload validation
- Image type verification
- SQL injection protection via Eloquent
- CSRF protection on all forms
- Role-based access control

---

**Status**: ✅ Fully Implemented and Ready for Use
**Version**: 1.0
**Last Updated**: {{ now()->format('Y-m-d') }}
