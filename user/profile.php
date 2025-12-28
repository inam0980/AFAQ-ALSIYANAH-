<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/database.php';
requireLogin();

$db = Database::getInstance();
$user = getUser();

// Get user details
$userDetails = $db->fetchOne("SELECT * FROM users WHERE id = ?", [$user['id']]);

// Handle profile update
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid security token';
        $messageType = 'error';
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        $errors = [];
        
        if (empty($name)) $errors[] = 'Name is required';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }
        
        // Check if email is already taken by another user
        $existingUser = $db->fetchOne(
            "SELECT id FROM users WHERE email = ? AND id != ?",
            [$email, $user['id']]
        );
        
        if ($existingUser) {
            $errors[] = 'Email is already taken by another user';
        }
        
        // Password change validation
        if (!empty($newPassword)) {
            if (empty($currentPassword)) {
                $errors[] = 'Current password is required to change password';
            } elseif (!password_verify($currentPassword, $userDetails['password'])) {
                $errors[] = 'Current password is incorrect';
            } elseif (strlen($newPassword) < 6) {
                $errors[] = 'New password must be at least 6 characters';
            } elseif ($newPassword !== $confirmPassword) {
                $errors[] = 'New passwords do not match';
            }
        }
        
        if (empty($errors)) {
            try {
                if (!empty($newPassword)) {
                    // Update with new password
                    $hashedPassword = password_hash($newPassword, HASH_ALGO);
                    $db->query(
                        "UPDATE users SET name = ?, email = ?, phone = ?, password = ?, updated_at = NOW() WHERE id = ?",
                        [$name, $email, $phone, $hashedPassword, $user['id']]
                    );
                } else {
                    // Update without password change
                    $db->query(
                        "UPDATE users SET name = ?, email = ?, phone = ?, updated_at = NOW() WHERE id = ?",
                        [$name, $email, $phone, $user['id']]
                    );
                }
                
                // Update session
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                
                $message = 'Profile updated successfully!';
                $messageType = 'success';
                
                // Refresh user details
                $userDetails = $db->fetchOne("SELECT * FROM users WHERE id = ?", [$user['id']]);
            } catch (Exception $e) {
                $message = 'Failed to update profile. Please try again.';
                $messageType = 'error';
            }
        } else {
            $message = implode('<br>', $errors);
            $messageType = 'error';
        }
    }
}
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-primary-800 to-primary-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">My Profile</h1>
        <p class="text-gray-200">Manage your personal information and password</p>
    </div>
</section>

<!-- Profile Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-4xl font-bold"><?= substr($user['name'], 0, 1) ?></span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg"><?= htmlspecialchars($user['name']) ?></h3>
                        <p class="text-sm text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
                    </div>

                    <nav class="space-y-2">
                        <a href="<?= SITE_URL ?>/user/dashboard.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                        <a href="<?= SITE_URL ?>/user/bookings.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-calendar-check mr-3"></i> My Bookings
                        </a>
                        <a href="<?= SITE_URL ?>/user/profile.php" class="flex items-center px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-medium">
                            <i class="fas fa-user mr-3"></i> Profile
                        </a>
                        <a href="<?= SITE_URL ?>/booking.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-plus mr-3"></i> New Booking
                        </a>
                        <a href="<?= SITE_URL ?>/user/logout.php" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?> mb-6">
                    <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?> mr-3 text-xl"></i>
                    <div><?= $message ?></div>
                </div>
                <?php endif; ?>

                <!-- Profile Information -->
                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-8 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Profile Information</h2>
                    
                    <form method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" id="name" name="name" required 
                                       class="form-input" 
                                       value="<?= htmlspecialchars($userDetails['name']) ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" id="email" name="email" required 
                                       class="form-input" 
                                       value="<?= htmlspecialchars($userDetails['email']) ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" name="phone" 
                                   class="form-input" 
                                   placeholder="+966 50 123 4567"
                                   value="<?= htmlspecialchars($userDetails['phone'] ?? '') ?>">
                        </div>
                        
                        <div class="pt-6 border-t">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Change Password</h3>
                            <p class="text-sm text-gray-600 mb-4">Leave blank if you don't want to change your password</p>
                            
                            <div class="space-y-4">
                                <div class="form-group">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" 
                                           class="form-input" 
                                           placeholder="Enter current password">
                                </div>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" id="new_password" name="new_password" 
                                               class="form-input" 
                                               placeholder="Minimum 6 characters">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <input type="password" id="confirm_password" name="confirm_password" 
                                               class="form-input" 
                                               placeholder="Re-enter new password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex gap-4">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                            <button type="reset" class="btn-outline">
                                <i class="fas fa-undo mr-2"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Account Info -->
                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Account Information</h2>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Account Type</p>
                            <p class="font-bold text-gray-900 capitalize"><?= htmlspecialchars($userDetails['role']) ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Member Since</p>
                            <p class="font-bold text-gray-900">
                                <?= date('F d, Y', strtotime($userDetails['created_at'])) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Last Updated</p>
                            <p class="font-bold text-gray-900">
                                <?= date('F d, Y', strtotime($userDetails['updated_at'])) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Account Status</p>
                            <span class="badge badge-confirmed">Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
