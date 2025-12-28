-- ============================================
-- COMPLETE DATABASE UPDATE FOR AFAQ SYSTEM
-- Run this in phpMyAdmin after importing inamdb.sql
-- ============================================

USE afaq_maintenance;

-- Add missing columns to services table
ALTER TABLE services 
ADD COLUMN IF NOT EXISTS short_description VARCHAR(255) AFTER description_ar,
ADD COLUMN IF NOT EXISTS price_unit VARCHAR(50) DEFAULT 'SAR' AFTER price,
ADD COLUMN IF NOT EXISTS features TEXT AFTER status;

-- Update existing records to have default values
UPDATE services SET short_description = SUBSTRING(description, 1, 100) WHERE short_description IS NULL OR short_description = '';
UPDATE services SET price_unit = 'SAR' WHERE price_unit IS NULL OR price_unit = '';

-- Create sister_companies table if not exists
CREATE TABLE IF NOT EXISTS sister_companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    name_ar VARCHAR(255),
    type ENUM('parent', 'subsidiary') DEFAULT 'subsidiary',
    description TEXT,
    phone VARCHAR(50),
    email VARCHAR(255),
    address TEXT,
    website VARCHAR(255),
    logo VARCHAR(255),
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_type (type),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default sister companies (optional)
INSERT IGNORE INTO sister_companies (id, name, name_ar, type, description, phone, email, display_order, status) VALUES
(1, 'AFAQ Maintenance Company', 'شركة آفاق للصيانة', 'parent', 'Leading maintenance and facility management company in Saudi Arabia', '+966 50 123 4567', 'info@afaq.com', 1, 'active'),
(2, 'Al Nebras Air Conditioning', 'النبراس للتكييف', 'subsidiary', 'Specialized in AC installation, maintenance and repair services', '+966 50 234 5678', 'ac@alnebras.com', 2, 'active'),
(3, 'Al Nebras Plumbing Services', 'النبراس للسباكة', 'subsidiary', 'Professional plumbing solutions for residential and commercial properties', '+966 50 345 6789', 'plumbing@alnebras.com', 3, 'active'),
(4, 'Al Nebras Electrical Solutions', 'النبراس للكهرباء', 'subsidiary', 'Expert electrical installation and maintenance services', '+966 50 456 7890', 'electric@alnebras.com', 4, 'active'),
(5, 'Al Nebras Painting & Décor', 'النبراس للدهانات', 'subsidiary', 'Premium painting and interior decoration services', '+966 50 567 8901', 'paint@alnebras.com', 5, 'active'),
(6, 'Al Nebras Facility Management', 'النبراس لإدارة المرافق', 'subsidiary', 'Comprehensive facility management and maintenance solutions', '+966 50 678 9012', 'facility@alnebras.com', 6, 'active');

-- Create uploads directories (make sure to set permissions)
-- chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/afaq/assets/uploads

-- Verification queries
SELECT 'Services table structure:' as Status;
SHOW COLUMNS FROM services;

SELECT 'Sister Companies table:' as Status;
SELECT COUNT(*) as total_companies FROM sister_companies;

SELECT 'Done! Database updated successfully.' as Status;
