<?php 
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';

// Static Admin Credentials
define('ADMIN_USERNAME', 'admin001');
define('ADMIN_PASSWORD', 'admininam123');

// Handle login with static credentials
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid security token';
        $messageType = 'error';
    } else {
        $username = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $message = 'Please enter both username and password';
            $messageType = 'error';
        } else {
            // Check static credentials
            if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
                // Regenerate session ID for security
                session_regenerate_id(true);
                
                // Set admin session
                $_SESSION['user_id'] = 1;
                $_SESSION['user_name'] = 'Admin';
                $_SESSION['user_email'] = 'admin001';
                $_SESSION['user_role'] = 'admin';
                $_SESSION['is_logged_in'] = true;
                $_SESSION['login_time'] = time();
                
                // Redirect to admin dashboard
                header('Location: ' . SITE_URL . '/admin/dashboard.php');
                exit;
            } else {
                $message = 'Invalid username or password';
                $messageType = 'error';
            }
        }
    }
}

// Redirect if already logged in as admin
if (Auth::isAdmin()) {
    header('Location: ' . SITE_URL . '/admin/dashboard.php');
    exit;
}

// Redirect non-admins
if (Auth::isLoggedIn() && !Auth::isAdmin()) {
    header('Location: ' . SITE_URL . '/user/dashboard.php');
    exit;
}

require_once __DIR__ . '/includes/header.php';
?>

</main>

<!-- Admin Login Page -->
<section class="py-20 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-700 min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-gold-500 to-gold-600 p-8 text-white text-center">
                    <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-4xl text-gold-600"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Admin Panel</h1>
                    <p class="text-gold-100">AFAQ ALSIYANAH ALDAWLIYAH EST</p>
                </div>

                <!-- Form -->
                <div class="p-8">
                    <?php if ($message): ?>
                    <div class="alert alert-<?= $messageType ?> mb-6">
                        <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?> mr-2"></i>
                        <?= $message ?>
                    </div>
                    <?php endif; ?>

                    <form method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-shield text-gray-400"></i>
                                </div>
                                <input type="text" id="email" name="email" required 
                                       class="form-input pl-10" placeholder="admin"
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password" required 
                                       class="form-input pl-10" placeholder="Enter admin password">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-gold-500 to-gold-600 text-white font-bold py-4 rounded-lg hover:from-gold-600 hover:to-gold-700 transition shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In to Admin Panel
                        </button>
                    </form>

                    <!-- Demo Info -->
                    <div class="mt-8 pt-8 border-t">
                        <div class="bg-gray-50 p-4 rounded-lg text-xs">
                            <p class="text-gray-600 mb-2"><strong>Demo Credentials:</strong></p>
                            <p class="text-gray-600">Username: admin001</p>
                            <p class="text-gray-600">Password: admininam123</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Site -->
            <div class="text-center mt-6">
                <a href="<?= SITE_URL ?>/index.php" class="text-white hover:text-gold-400 text-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Website
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
