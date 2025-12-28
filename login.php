<?php 
require_once 'includes/header.php';

// Redirect if already logged in
if (isLoggedIn()) {
    if (isAdmin()) {
        header('Location: ' . SITE_URL . '/admin/dashboard.php');
    } else {
        header('Location: ' . SITE_URL . '/index.php');
    }
    exit;
}

// Handle login
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid security token';
        $messageType = 'error';
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $message = 'Please enter both email and password';
            $messageType = 'error';
        } else {
            $result = Auth::login($email, $password);
            
            if ($result['success']) {
                // Redirect based on role
                if ($_SESSION['user_role'] === 'admin') {
                    header('Location: ' . SITE_URL . '/admin/dashboard.php');
                } else {
                    header('Location: ' . SITE_URL . '/index.php');
                }
                exit;
            } else {
                $message = $result['message'];
                $messageType = 'error';
            }
        }
    }
}
?>

<!-- Login Page -->
<section class="py-20 bg-gray-50">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl border-2 border-[#006699] shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-[#006699] p-8 text-white text-center">
                    <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-4xl text-[#F89E1B]"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Welcome Back!</h1>
                    <p class="text-gray-200">Sign in to your account</p>
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
                            <label for="email" class="form-label">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" id="email" name="email" required 
                                       class="form-input pl-10" placeholder="your@email.com"
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
                                       class="form-input pl-10" placeholder="Enter your password">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-[#F89E1B] border-gray-300 rounded focus:ring-[#F89E1B]">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                            <a href="#" class="text-sm text-[#F89E1B] hover:text-[#006699] font-medium">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-sm">
                            Don't have an account?
                            <a href="<?= SITE_URL ?>/register.php" class="text-[#F89E1B] hover:text-[#006699] font-bold">
                                Create Account
                            </a>
                        </p>
                    </div>

                    <!-- Quick Demo Access -->
                    <div class="mt-8 pt-8 border-t">
                        <p class="text-xs text-gray-500 text-center mb-3">Demo Credentials</p>
                        <div class="bg-gray-50 p-4 rounded-lg text-xs space-y-2">
                            <div>
                                <strong class="text-gray-700">Admin:</strong>
                                <p class="text-gray-600">Email: admin@afaq.com</p>
                                <p class="text-gray-600">Password: admin123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Links -->
            <div class="flex flex-col sm:flex-row gap-4 mt-6 justify-center">
                <a href="<?= SITE_URL ?>/services.php" class="group px-6 py-3 bg-[#F89E1B] text-white rounded-xl font-bold text-sm hover:bg-[#006699] transition-all duration-300 flex items-center justify-center gap-2 shadow-lg transform hover:scale-105">
                    <i class="fas fa-th-large"></i>
                    Explore Services
                </a>
                <a href="<?= SITE_URL ?>/index.php" class="text-gray-600 hover:text-[#F89E1B] text-sm flex items-center justify-center gap-2 px-6 py-3">
                    <i class="fas fa-arrow-left"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
