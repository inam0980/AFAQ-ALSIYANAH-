<?php
// AFAQ ALSIYANAH ALDAWLIYAH EST Configuration
define('SITE_NAME', 'AFAQ ALSIYANAH ALDAWLIYAH EST');
define('SITE_URL', 'http://localhost/afaq');
define('ADMIN_EMAIL', 'admin@afaq.com');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'afaq_maintenance');

// Upload Configuration
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB

// Security
define('HASH_ALGO', PASSWORD_BCRYPT);
define('SESSION_LIFETIME', 7200); // 2 hours

// Pagination
define('RECORDS_PER_PAGE', 10);

// Timezone
date_default_timezone_set('Asia/Riyadh');

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Lax');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => SESSION_LIFETIME,
        'cookie_secure' => false, // Set to true if using HTTPS
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true
    ]);
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Helper function to regenerate session ID for security
function regenerate_session() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}
?>
