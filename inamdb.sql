-- AFAQ Maintenance Company Database Schema
-- Created: December 2025

CREATE DATABASE IF NOT EXISTS afaq_maintenance CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE afaq_maintenance;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    role ENUM('admin', 'user', 'technician') DEFAULT 'user',
    avatar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Services Table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    title_ar VARCHAR(255),
    description TEXT NOT NULL,
    description_ar TEXT,
    image VARCHAR(255),
    icon VARCHAR(100),
    category VARCHAR(100),
    price DECIMAL(10, 2) DEFAULT 0.00,
    duration VARCHAR(50),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bookings Table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(100),
    service_id INT NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    notes TEXT,
    status ENUM('pending', 'confirmed', 'in-progress', 'completed', 'cancelled') DEFAULT 'pending',
    assigned_to INT,
    total_amount DECIMAL(10, 2) DEFAULT 0.00,
    payment_status ENUM('unpaid', 'paid', 'refunded') DEFAULT 'unpaid',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_service (service_id),
    INDEX idx_status (status),
    INDEX idx_date (booking_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Testimonials Table
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    name_ar VARCHAR(255),
    position VARCHAR(255),
    message TEXT NOT NULL,
    message_ar TEXT,
    rating INT DEFAULT 5 CHECK (rating >= 1 AND rating <= 5),
    image VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Gallery Table
CREATE TABLE IF NOT EXISTS gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    caption VARCHAR(255),
    caption_ar VARCHAR(255),
    category VARCHAR(100),
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings Table
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type VARCHAR(50) DEFAULT 'text',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Logs Table
CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    details TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Default Admin User
-- Username: admin, Password: admin123 (Change this after first login!)
INSERT INTO users (name, email, password, role) VALUES 
('Admin', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert Default Settings
INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'AFAQ Maintenance Company'),
('site_email', 'info@afaq.com'),
('site_phone', '+966 50 123 4567'),
('site_address', 'Riyadh, Saudi Arabia'),
('whatsapp_number', '+966501234567'),
('facebook_url', 'https://facebook.com/afaq'),
('twitter_url', 'https://twitter.com/afaq'),
('instagram_url', 'https://instagram.com/afaq'),
('working_hours', 'Sunday - Thursday: 8:00 AM - 6:00 PM'),
('about_us', 'AFAQ Maintenance Company provides comprehensive maintenance solutions for residential and commercial properties.'),
('mission', 'To deliver excellence in maintenance services while ensuring customer satisfaction.'),
('vision', 'To be the leading maintenance company in the region.');

-- Insert Sample Services
INSERT INTO services (title, title_ar, description, description_ar, category, price, icon) VALUES
('AC Maintenance', 'صيانة المكيفات', 'Professional air conditioning maintenance and repair services', 'خدمات احترافية لصيانة وإصلاح المكيفات', 'HVAC', 200.00, 'fas fa-fan'),
('Plumbing Services', 'خدمات السباكة', 'Expert plumbing solutions for all your needs', 'حلول سباكة متخصصة لجميع احتياجاتك', 'Plumbing', 150.00, 'fas fa-wrench'),
('Electrical Work', 'الأعمال الكهربائية', 'Licensed electricians for safe and reliable service', 'كهربائيون مرخصون لخدمة آمنة وموثوقة', 'Electrical', 180.00, 'fas fa-bolt'),
('Painting Services', 'خدمات الدهان', 'Professional painting services for interior and exterior', 'خدمات دهان احترافية للداخل والخارج', 'Painting', 300.00, 'fas fa-paint-roller'),
('Carpentry', 'النجارة', 'Custom carpentry and woodwork services', 'خدمات نجارة وأعمال خشبية مخصصة', 'Carpentry', 250.00, 'fas fa-hammer'),
('Cleaning Services', 'خدمات التنظيف', 'Deep cleaning services for homes and offices', 'خدمات تنظيف عميقة للمنازل والمكاتب', 'Cleaning', 120.00, 'fas fa-broom');

-- Insert Sample Testimonials
INSERT INTO testimonials (name, name_ar, message, message_ar, rating, status) VALUES
('Mohammed Al-Ahmed', 'محمد الأحمد', 'Excellent service! The technicians were professional and completed the work on time.', 'خدمة ممتازة! كان الفنيون محترفين وأكملوا العمل في الوقت المحدد.', 5, 'active'),
('Sara Abdullah', 'سارة عبدالله', 'Very satisfied with the AC maintenance service. Highly recommended!', 'راضية جداً عن خدمة صيانة المكيفات. أوصي بها بشدة!', 5, 'active'),
('Ahmed Hassan', 'أحمد حسن', 'Quick response and fair pricing. Will use their services again.', 'استجابة سريعة وأسعار عادلة. سأستخدم خدماتهم مرة أخرى.', 4, 'active');
