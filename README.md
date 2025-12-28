# AFAQ Maintenance Company Website

A complete, production-ready maintenance company website built with PHP, MySQL, HTML, Tailwind CSS, and JavaScript.

![AFAQ Logo](assets/images/logo.png)

## 🚀 Features

### ✨ **Frontend Features**
- ✅ Modern, responsive design with Tailwind CSS
- ✅ Professional dark-blue + gold theme
- ✅ Hero section with call-to-action
- ✅ Services showcase with categories
- ✅ Service details pages
- ✅ Online booking system
- ✅ Contact form with Google Maps
- ✅ FAQ page
- ✅ Customer testimonials
- ✅ Statistics counters
- ✅ WhatsApp floating button
- ✅ Smooth scrolling and animations
- ✅ Mobile-first responsive design
- ✅ Multilingual ready (EN/AR structure)

### 🔐 **Authentication & Security**
- ✅ Secure user registration and login
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection on all forms
- ✅ SQL injection prevention
- ✅ Input sanitization and validation
- ✅ Session-based authentication
- ✅ Role-based access control (Admin/User)

### 👤 **User Dashboard**
- ✅ View all bookings
- ✅ Track booking status
- ✅ Profile management
- ✅ Password change
- ✅ Booking history
- ✅ Quick re-booking

### 🛠️ **Admin Panel**
- ✅ Complete dashboard with statistics
- ✅ Manage bookings (view, update status)
- ✅ Manage services (CRUD operations)
- ✅ Manage users
- ✅ View testimonials
- ✅ Gallery management
- ✅ Site settings
- ✅ Activity logs
- ✅ Revenue tracking

### 📊 **Booking System**
- ✅ AJAX-powered form submission
- ✅ Real-time validation
- ✅ Service selection
- ✅ Date and time picker
- ✅ Multiple status levels
- ✅ Email notifications (ready)
- ✅ PDF invoice generation (ready)

### 🎨 **Modern UI Components**
- ✅ Custom cards and buttons
- ✅ Interactive forms
- ✅ Loading states
- ✅ Success/error messages
- ✅ Badges and tags
- ✅ Tables with pagination
- ✅ Modal dialogs
- ✅ Smooth transitions

---

## 📁 Project Structure

```
/afaq
├── /admin              # Admin panel
│   ├── dashboard.php   # Main admin dashboard
│   ├── bookings.php    # Manage bookings
│   ├── services.php    # Manage services
│   ├── users.php       # Manage users
│   ├── testimonials.php
│   ├── gallery.php
│   ├── settings.php
│   ├── login.php       # Admin login
│   └── logout.php
├── /user               # User dashboard
│   ├── dashboard.php   # User dashboard
│   ├── bookings.php    # User bookings
│   ├── profile.php     # Profile management
│   └── logout.php
├── /includes           # Shared files
│   ├── config.php      # Configuration
│   ├── database.php    # Database class
│   ├── auth.php        # Authentication class
│   ├── header.php      # Header template
│   └── footer.php      # Footer template
├── /assets             # Static assets
│   ├── /css
│   │   └── style.css   # Custom styles
│   ├── /js
│   │   └── main.js     # JavaScript functions
│   ├── /images         # Images
│   └── /uploads        # User uploads
├── index.php           # Homepage
├── about.php           # About page
├── services.php        # Services list
├── service.php         # Single service
├── booking.php         # Booking form
├── contact.php         # Contact page
├── faq.php             # FAQ page
├── login.php           # User login
├── register.php        # User registration
└── database.sql        # Database schema
```

---

## 🔧 Installation Instructions

### **Prerequisites**
- XAMPP/WAMP/MAMP (Apache + MySQL + PHP 7.4+)
- Web browser
- Text editor (optional)

### **Step 1: Install XAMPP**
1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Install XAMPP
3. Start Apache and MySQL from XAMPP Control Panel

### **Step 2: Copy Project Files**
1. Copy the entire `afaq` folder to:
   - **Windows**: `C:\xampp\htdocs\afaq`
   - **Mac**: `/Applications/XAMPP/xamppfiles/htdocs/afaq`
   - **Linux**: `/opt/lampp/htdocs/afaq`

### **Step 3: Create Database**
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click "New" to create a new database
3. Name it: `afaq_maintenance`
4. Click "Import" tab
5. Choose file: `database.sql` from the project folder
6. Click "Go" to import

### **Step 4: Configure Database**
Open `includes/config.php` and verify these settings:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');           // Leave empty for XAMPP default
define('DB_NAME', 'afaq_maintenance');
```

### **Step 5: Create Uploads Directory**
Create folder: `assets/uploads/` and set permissions to 755 (or 777 if needed)

### **Step 6: Access the Website**
Open your browser and go to:
- **Homepage**: `http://localhost/afaq/`
- **Admin Panel**: `http://localhost/afaq/admin/login.php`
- **User Login**: `http://localhost/afaq/login.php`

---

## 🔑 Default Login Credentials

### **Admin Account**
- **Email**: admin@afaq.com
- **Password**: admin123
- **Access**: Full admin panel access

### **Test User Account**
Register a new user or use the registration form at:
`http://localhost/afaq/register.php`

---

## 🌐 cPanel Deployment

### **Step 1: Upload Files**
1. Compress the `afaq` folder to `afaq.zip`
2. Login to cPanel
3. Go to File Manager
4. Navigate to `public_html`
5. Upload `afaq.zip`
6. Extract the archive
7. Move contents of `afaq` folder to `public_html`

### **Step 2: Create Database**
1. In cPanel, go to MySQL® Databases
2. Create database: `username_afaq`
3. Create user: `username_afaquser`
4. Set password (strong password)
5. Add user to database with ALL PRIVILEGES

### **Step 3: Import Database**
1. Go to phpMyAdmin in cPanel
2. Select your database
3. Click "Import"
4. Upload `database.sql`
5. Click "Go"

### **Step 4: Update Config**
Edit `includes/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'username_afaquser');
define('DB_PASS', 'your_password');
define('DB_NAME', 'username_afaq');
define('SITE_URL', 'https://yourdomain.com');
```

### **Step 5: Set Permissions**
Set folder permissions:
- `assets/uploads/` → 755
- `includes/` → 644 (files)

---

## 📱 Key Pages & URLs

| Page | URL | Description |
|------|-----|-------------|
| Homepage | `/index.php` | Main landing page |
| About | `/about.php` | Company information |
| Services | `/services.php` | All services |
| Service Detail | `/service.php?id=1` | Single service |
| Booking | `/booking.php` | Service booking form |
| Contact | `/contact.php` | Contact form |
| FAQ | `/faq.php` | Frequently asked questions |
| Login | `/login.php` | User login |
| Register | `/register.php` | User registration |
| User Dashboard | `/user/dashboard.php` | User panel |
| Admin Login | `/admin/login.php` | Admin login |
| Admin Dashboard | `/admin/dashboard.php` | Admin panel |

---

## 🎨 Customization

### **Change Colors**
Edit `includes/header.php` and update Tailwind config:

```javascript
colors: {
    primary: {
        600: '#006fc7',  // Change this
    },
    gold: {
        500: '#efbb00',  // Change this
    }
}
```

### **Change Site Name**
Edit `includes/config.php`:

```php
define('SITE_NAME', 'Your Company Name');
define('SITE_EMAIL', 'your@email.com');
define('SITE_PHONE', '+966 50 XXX XXXX');
```

### **Add New Service**
1. Login to Admin Panel
2. Go to Services
3. Click "Add Service"
4. Fill in details and save

### **Modify Services**
Edit services directly in phpMyAdmin or through admin panel

---

## 🔒 Security Features

✅ **Password Hashing**: All passwords encrypted with bcrypt  
✅ **CSRF Protection**: Token-based form protection  
✅ **SQL Injection**: Prepared statements used  
✅ **XSS Prevention**: Input sanitization  
✅ **Session Security**: Secure session handling  
✅ **Role-Based Access**: Admin/User separation  

---

## 📧 Email Configuration (Optional)

To enable email notifications, update `includes/config.php`:

```php
// SMTP Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your@email.com');
define('SMTP_PASS', 'your_password');
```

---

## 🐛 Troubleshooting

### **Problem: White screen or errors**
**Solution**: Check PHP error log or enable error display:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### **Problem: Database connection failed**
**Solution**: Verify database credentials in `includes/config.php`

### **Problem: CSS not loading**
**Solution**: Check SITE_URL in config.php matches your actual URL

### **Problem: Can't upload images**
**Solution**: Create `assets/uploads/` folder and set permissions to 755

### **Problem: Session errors**
**Solution**: Ensure session cookies are enabled in php.ini

---

## 🎯 Features Roadmap

- [ ] Email notifications (PHPMailer integration)
- [ ] PDF invoice generation
- [ ] Multi-language support (Arabic)
- [ ] Advanced search and filters
- [ ] Rating and reviews system
- [ ] SMS notifications
- [ ] Payment gateway integration
- [ ] Mobile app API

---

## 📝 Database Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts (admin/user) |
| `services` | Available services |
| `bookings` | Service bookings |
| `testimonials` | Customer reviews |
| `gallery` | Image gallery |
| `settings` | Site settings |
| `logs` | Activity logs |
| `contact_messages` | Contact form submissions |

---

## 💡 Support

For support or questions:
- 📧 Email: admin@afaq.com
- 📱 Phone: +966 50 123 4567
- 🌐 Website: Contact form at `/contact.php`

---

## 📄 License

This project is created for AFAQ Maintenance Company.  
All rights reserved © 2025

---

## 🙏 Credits

- **Framework**: PHP 7.4+
- **Database**: MySQL 5.7+
- **CSS Framework**: Tailwind CSS 3.x
- **Icons**: Font Awesome 6.x
- **Fonts**: Google Fonts (Inter)

---

## ✅ Testing Checklist

- [ ] Homepage loads correctly
- [ ] All navigation links work
- [ ] Services page displays services
- [ ] Booking form submits successfully
- [ ] User registration works
- [ ] User login works
- [ ] User dashboard accessible
- [ ] Admin login works
- [ ] Admin can view bookings
- [ ] Admin can update booking status
- [ ] Contact form submits
- [ ] Responsive on mobile devices
- [ ] All images load properly
- [ ] No console errors

---

## 🚀 Quick Start

```bash
# 1. Start XAMPP
# 2. Import database.sql to MySQL
# 3. Open browser
http://localhost/afaq/

# Admin access
http://localhost/afaq/admin/login.php
Email: admin@afaq.com
Password: admin123

# Done! 🎉
```

---

**Built with ❤️ for AFAQ Maintenance Company**
# AFAQ-ALSIYANAH-
