<?php
require_once 'database.php';

class Auth {
    
    // Register new user
    public static function register($name, $email, $password, $role = 'user') {
        $db = db();
        
        // Check if email already exists
        $existingUser = $db->fetchOne(
            "SELECT id FROM users WHERE email = ?",
            [$email]
        );
        
        if ($existingUser) {
            return ['success' => false, 'message' => 'Email already registered'];
        }
        
        // Hash password
        $hashedPassword = password_hash($password, HASH_ALGO);
        
        // Insert user
        $userId = $db->insert(
            "INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())",
            [$name, $email, $hashedPassword, $role]
        );
        
        if ($userId) {
            self::logAction($userId, 'User registered');
            return ['success' => true, 'message' => 'Registration successful', 'user_id' => $userId];
        }
        
        return ['success' => false, 'message' => 'Registration failed'];
    }
    
    // Login user
    public static function login($email, $password) {
        $db = db();
        
        $user = $db->fetchOne(
            "SELECT * FROM users WHERE email = ?",
            [$email]
        );
        
        if (!$user) {
            return ['success' => false, 'message' => 'Invalid email or password'];
        }
        
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid email or password'];
        }
        
        // Regenerate session ID for security
        session_regenerate_id(true);
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['login_time'] = time();
        
        self::logAction($user['id'], 'User logged in');
        
        return ['success' => true, 'message' => 'Login successful', 'user' => $user];
    }
    
    // Logout
    public static function logout() {
        // Unset all session variables
        $_SESSION = [];
        
        // Delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Destroy the session
        session_destroy();
        
        // Start a new session for CSRF token
        session_start();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }
    
    // Check if user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']) && 
               isset($_SESSION['user_role']) && 
               isset($_SESSION['is_logged_in']) && 
               $_SESSION['is_logged_in'] === true;
    }
    
    // Check if user is admin
    public static function isAdmin() {
        return self::isLoggedIn() && 
               isset($_SESSION['user_role']) && 
               $_SESSION['user_role'] === 'admin';
    }
    
    // Require login
    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: ' . SITE_URL . '/login.php');
            exit;
        }
    }
    
    // Require admin
    public static function requireAdmin() {
        if (!self::isAdmin()) {
            header('Location: ' . SITE_URL . '/index.php');
            exit;
        }
    }
    
    // Get current user
    public static function getUser() {
        if (!self::isLoggedIn()) {
            return null;
        }
        
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role']
        ];
    }
    
    // Verify CSRF token
    public static function verifyCsrf($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    // Log user actions
    private static function logAction($userId, $action) {
        try {
            $db = db();
            $db->query(
                "INSERT INTO logs (user_id, action, ip_address, created_at) VALUES (?, ?, ?, NOW())",
                [$userId, $action, $_SERVER['REMOTE_ADDR'] ?? 'Unknown']
            );
        } catch (Exception $e) {
            // Silently fail if logs table doesn't exist yet
        }
    }
}

// Helper functions
function isLoggedIn() {
    return Auth::isLoggedIn();
}

function isAdmin() {
    return Auth::isAdmin();
}

function requireLogin() {
    Auth::requireLogin();
}

function requireAdmin() {
    Auth::requireAdmin();
}

function getUser() {
    return Auth::getUser();
}

function csrf_token() {
    return $_SESSION['csrf_token'] ?? '';
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}
?>
