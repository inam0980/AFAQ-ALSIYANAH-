<?php 
require_once 'includes/header.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: ' . SITE_URL . '/user/dashboard.php');
    exit;
}

// Handle registration
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid security token';
        $messageType = 'error';
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Validation
        $errors = [];
        
        if (empty($name)) $errors[] = 'Name is required';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }
        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match';
        }
        
        if (empty($errors)) {
            $result = Auth::register($name, $email, $password);
            
            if ($result['success']) {
                // Auto-login after registration
                Auth::login($email, $password);
                header('Location: ' . SITE_URL . '/user/dashboard.php');
                exit;
            } else {
                $message = $result['message'];
                $messageType = 'error';
            }
        } else {
            $message = implode('<br>', $errors);
            $messageType = 'error';
        }
    }
}
?>

<!-- Register Page -->
<section class="py-20 bg-gray-50">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl border-2 border-[#F89E1B] shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-[#006699] p-8 text-white text-center">
                    <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-plus text-4xl text-[#F89E1B]"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Create Account</h1>
                    <p class="text-gray-200">Join AFAQ Maintenance today</p>
                </div>

                <!-- Form -->
                <div class="p-8">
                    <?php if ($message): ?>
                    <div class="alert alert-<?= $messageType ?> mb-6">
                        <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?> mr-2"></i>
                        <div><?= $message ?></div>
                    </div>
                    <?php endif; ?>

                    <form method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="name" name="name" required 
                                       class="form-input pl-10" placeholder="Enter your full name"
                                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>
                        </div>

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
                                       class="form-input pl-10" placeholder="Minimum 6 characters">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Password must be at least 6 characters long</p>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="confirm_password" name="confirm_password" required 
                                       class="form-input pl-10" placeholder="Re-enter your password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="flex items-start">
                                <input type="checkbox" required class="mt-1 mr-3 w-4 h-4 text-[#F89E1B] border-gray-300 rounded focus:ring-[#F89E1B]">
                                <span class="text-sm text-gray-600">
                                    I agree to the <a href="#" class="text-[#F89E1B] hover:underline">Terms & Conditions</a> 
                                    and <a href="#" class="text-[#F89E1B] hover:underline">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-user-plus mr-2"></i> Create Account
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-sm">
                            Already have an account?
                            <a href="<?= SITE_URL ?>/login.php" class="text-[#F89E1B] hover:text-[#006699] font-bold">
                                Sign In
                            </a>
                        </p>
                    </div>

                    <!-- Benefits -->
                    <div class="mt-8 pt-8 border-t">
                        <p class="text-sm font-bold text-gray-900 mb-3">Why create an account?</p>
                        <ul class="space-y-2">
                            <li class="flex items-start text-sm text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Track your bookings in real-time</span>
                            </li>
                            <li class="flex items-start text-sm text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Quick re-booking for regular services</span>
                            </li>
                            <li class="flex items-start text-sm text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Exclusive offers and discounts</span>
                            </li>
                            <li class="flex items-start text-sm text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                <span>Priority customer support</span>
                            </li>
                        </ul>
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
