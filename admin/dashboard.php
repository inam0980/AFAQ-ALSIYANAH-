<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';

// Check admin access BEFORE any output
Auth::requireAdmin();

require_once __DIR__ . '/includes/header.php';

$db = Database::getInstance();

// Get statistics with error handling
try {
    $stats = [
        'total_bookings' => $db->fetchOne("SELECT COUNT(*) as count FROM bookings")['count'] ?? 0,
        'pending_bookings' => $db->fetchOne("SELECT COUNT(*) as count FROM bookings WHERE status = 'pending'")['count'] ?? 0,
        'total_services' => $db->fetchOne("SELECT COUNT(*) as count FROM services WHERE status = 'active'")['count'] ?? 0,
        'total_users' => $db->fetchOne("SELECT COUNT(*) as count FROM users WHERE role = 'user'")['count'] ?? 0,
        'completed_bookings' => $db->fetchOne("SELECT COUNT(*) as count FROM bookings WHERE status = 'completed'")['count'] ?? 0,
        'total_revenue' => $db->fetchOne("SELECT SUM(total_amount) as total FROM bookings WHERE status = 'completed' AND payment_status = 'paid'")['total'] ?? 0,
    ];
} catch (Exception $e) {
    $stats = [
        'total_bookings' => 0,
        'pending_bookings' => 0,
        'total_services' => 0,
        'total_users' => 0,
        'completed_bookings' => 0,
        'total_revenue' => 0,
    ];
}

// Recent bookings with error handling
try {
    $recentBookings = $db->fetchAll(
        "SELECT b.*, s.title as service_title, u.name as user_name 
         FROM bookings b 
         LEFT JOIN services s ON b.service_id = s.id 
         LEFT JOIN users u ON b.user_id = u.id 
         ORDER BY b.created_at DESC 
         LIMIT 5"
    );
} catch (Exception $e) {
    $recentBookings = [];
}

// Recent users with error handling
try {
    $recentUsers = $db->fetchAll(
        "SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC LIMIT 5"
    );
} catch (Exception $e) {
    $recentUsers = [];
}
?>

</main>

<!-- Admin Dashboard -->
<div class="min-h-screen bg-gray-100">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-gold-500 to-gold-600 p-2 rounded-lg">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">AFAQ Admin Panel</h1>
                        <p class="text-xs text-gray-600">Maintenance Management System</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">Welcome, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></span>
                    <a href="<?= SITE_URL ?>/index.php" target="_blank" class="text-primary-600 hover:text-primary-700">
                        <i class="fas fa-external-link-alt mr-1"></i> View Site
                    </a>
                    <a href="<?= SITE_URL ?>/admin/logout.php" class="text-red-600 hover:text-red-700">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-5 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-4 sticky top-4">
                    <nav class="space-y-1">
                        <a href="<?= SITE_URL ?>/admin/dashboard.php" class="flex items-center px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-medium">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                        <a href="<?= SITE_URL ?>/admin/bookings.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-calendar-check mr-3"></i> Bookings
                        </a>
                        <a href="<?= SITE_URL ?>/admin/services.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-tools mr-3"></i> Services
                        </a>
                        <a href="<?= SITE_URL ?>/admin/users.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-users mr-3"></i> Users
                        </a>
                        <a href="<?= SITE_URL ?>/admin/companies.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-building mr-3"></i> Companies
                        </a>
                        <a href="<?= SITE_URL ?>/admin/testimonials.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-star mr-3"></i> Testimonials
                        </a>
                        <a href="<?= SITE_URL ?>/admin/gallery.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-images mr-3"></i> Gallery
                        </a>
                        <a href="<?= SITE_URL ?>/admin/settings.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-cog mr-3"></i> Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-4">
                <!-- Stats Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Bookings</p>
                                <p class="text-3xl font-bold text-gray-900"><?= $stats['total_bookings'] ?></p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-lg">
                                <i class="fas fa-calendar-alt text-3xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pending Bookings</p>
                                <p class="text-3xl font-bold text-gray-900"><?= $stats['pending_bookings'] ?></p>
                            </div>
                            <div class="bg-yellow-100 p-4 rounded-lg">
                                <i class="fas fa-clock text-3xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Active Services</p>
                                <p class="text-3xl font-bold text-gray-900"><?= $stats['total_services'] ?></p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg">
                                <i class="fas fa-tools text-3xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900"><?= $stats['total_users'] ?></p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg">
                                <i class="fas fa-users text-3xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Completed</p>
                                <p class="text-3xl font-bold text-gray-900"><?= $stats['completed_bookings'] ?></p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg">
                                <i class="fas fa-check-circle text-3xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Revenue</p>
                                <p class="text-3xl font-bold text-gray-900">SAR <?= number_format($stats['total_revenue'], 0) ?></p>
                            </div>
                            <div class="bg-gold-100 p-4 rounded-lg">
                                <i class="fas fa-dollar-sign text-3xl text-gold-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recent Bookings</h2>
                        <a href="<?= SITE_URL ?>/admin/bookings.php" class="text-primary-600 hover:text-primary-700 font-medium">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentBookings as $booking): ?>
                                <tr>
                                    <td>#<?= str_pad($booking['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td><?= htmlspecialchars($booking['user_name'] ?? $booking['name']) ?></td>
                                    <td><?= htmlspecialchars($booking['service_title']) ?></td>
                                    <td><?= date('M d, Y', strtotime($booking['booking_date'])) ?></td>
                                    <td><span class="badge badge-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span></td>
                                    <td class="font-bold text-gold-600">SAR <?= number_format($booking['total_amount'], 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recent Users</h2>
                        <a href="<?= SITE_URL ?>/admin/users.php" class="text-primary-600 hover:text-primary-700 font-medium">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentUsers as $u): ?>
                                <tr>
                                    <td>#<?= $u['id'] ?></td>
                                    <td><?= htmlspecialchars($u['name']) ?></td>
                                    <td><?= htmlspecialchars($u['email']) ?></td>
                                    <td><span class="badge badge-confirmed"><?= ucfirst($u['role']) ?></span></td>
                                    <td><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
