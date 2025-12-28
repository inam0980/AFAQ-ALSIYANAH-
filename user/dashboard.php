<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/database.php';
requireLogin();

$db = Database::getInstance();
$user = getUser();

// Get user statistics
$totalBookings = $db->fetchOne(
    "SELECT COUNT(*) as count FROM bookings WHERE user_id = ?",
    [$user['id']]
)['count'];

$pendingBookings = $db->fetchOne(
    "SELECT COUNT(*) as count FROM bookings WHERE user_id = ? AND status = 'pending'",
    [$user['id']]
)['count'];

$completedBookings = $db->fetchOne(
    "SELECT COUNT(*) as count FROM bookings WHERE user_id = ? AND status = 'completed'",
    [$user['id']]
)['count'];

// Get recent bookings
$recentBookings = $db->fetchAll(
    "SELECT b.*, s.title as service_title 
     FROM bookings b 
     LEFT JOIN services s ON b.service_id = s.id 
     WHERE b.user_id = ? 
     ORDER BY b.created_at DESC 
     LIMIT 5",
    [$user['id']]
);
?>

<!-- Dashboard Header -->
<section class="bg-gradient-to-r from-primary-800 to-primary-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Welcome back, <?= htmlspecialchars($user['name']) ?>!</h1>
        <p class="text-gray-200">Manage your bookings and profile from your dashboard</p>
    </div>
</section>

<!-- Dashboard Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-4xl font-bold">
                                <?= substr($user['name'], 0, 1) ?>
                            </span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg"><?= htmlspecialchars($user['name']) ?></h3>
                        <p class="text-sm text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
                        <span class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            <?= ucfirst($user['role']) ?>
                        </span>
                    </div>

                    <nav class="space-y-2">
                        <a href="<?= SITE_URL ?>/user/dashboard.php" class="flex items-center px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-medium">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                        <a href="<?= SITE_URL ?>/user/bookings.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-calendar-check mr-3"></i> My Bookings
                        </a>
                        <a href="<?= SITE_URL ?>/user/profile.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
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
                <!-- Stats -->
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-4 rounded-lg mr-4">
                                <i class="fas fa-calendar-alt text-3xl text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-gray-900"><?= $totalBookings ?></p>
                                <p class="text-sm text-gray-600">Total Bookings</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-4 rounded-lg mr-4">
                                <i class="fas fa-clock text-3xl text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-gray-900"><?= $pendingBookings ?></p>
                                <p class="text-sm text-gray-600">Pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-4 rounded-lg mr-4">
                                <i class="fas fa-check-circle text-3xl text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-gray-900"><?= $completedBookings ?></p>
                                <p class="text-sm text-gray-600">Completed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recent Bookings</h2>
                        <a href="<?= SITE_URL ?>/user/bookings.php" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <?php if (empty($recentBookings)): ?>
                    <div class="text-center py-12">
                        <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">No Bookings Yet</h3>
                        <p class="text-gray-600 mb-6">You haven't made any bookings yet.</p>
                        <a href="<?= SITE_URL ?>/booking.php" class="btn-primary">
                            <i class="fas fa-plus mr-2"></i> Make Your First Booking
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($recentBookings as $booking): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-bold text-gray-900"><?= htmlspecialchars($booking['service_title']) ?></h3>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-calendar mr-1"></i>
                                        <?= date('M d, Y', strtotime($booking['booking_date'])) ?> at 
                                        <?= date('h:i A', strtotime($booking['booking_time'])) ?>
                                    </p>
                                </div>
                                <span class="badge badge-<?= $booking['status'] ?>">
                                    <?= ucfirst($booking['status']) ?>
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <?= htmlspecialchars(substr($booking['address'], 0, 50)) ?>...
                                </span>
                                <span class="font-bold text-gold-600">
                                    SAR <?= number_format($booking['total_amount'], 2) ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Quick Actions -->
                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl shadow-lg p-6 text-white">
                        <i class="fas fa-calendar-plus text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Book a New Service</h3>
                        <p class="text-gray-200 text-sm mb-4">Schedule your next maintenance service easily</p>
                        <a href="<?= SITE_URL ?>/booking.php" class="btn-secondary">
                            Book Now <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <div class="bg-gradient-to-br from-gold-500 to-gold-600 rounded-xl shadow-lg p-6 text-white">
                        <i class="fas fa-headset text-4xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Need Help?</h3>
                        <p class="text-gray-100 text-sm mb-4">Our support team is available 24/7</p>
                        <a href="<?= SITE_URL ?>/contact.php" class="bg-white text-gold-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition font-medium inline-flex items-center">
                            Contact Us <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
