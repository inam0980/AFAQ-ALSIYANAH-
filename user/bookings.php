<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/database.php';
requireLogin();

$db = Database::getInstance();
$user = getUser();

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = RECORDS_PER_PAGE;
$offset = ($page - 1) * $perPage;

// Filter
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Build query
$whereClause = "WHERE user_id = ?";
$params = [$user['id']];

if ($statusFilter !== 'all') {
    $whereClause .= " AND status = ?";
    $params[] = $statusFilter;
}

// Get total count
$totalBookings = $db->fetchOne(
    "SELECT COUNT(*) as count FROM bookings $whereClause",
    $params
)['count'];

$totalPages = ceil($totalBookings / $perPage);

// Get bookings
$bookings = $db->fetchAll(
    "SELECT b.*, s.title as service_title, s.icon 
     FROM bookings b 
     LEFT JOIN services s ON b.service_id = s.id 
     $whereClause 
     ORDER BY b.created_at DESC 
     LIMIT $perPage OFFSET $offset",
    $params
);
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-primary-800 to-primary-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">My Bookings</h1>
        <p class="text-gray-200">View and manage all your service bookings</p>
    </div>
</section>

<!-- Bookings Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Sidebar (Same as dashboard) -->
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
                        <a href="<?= SITE_URL ?>/user/bookings.php" class="flex items-center px-4 py-3 bg-primary-50 text-primary-700 rounded-lg font-medium">
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
                <!-- Filters -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h3 class="font-bold text-gray-900 mb-4">Filter Bookings</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="?status=all" class="px-4 py-2 rounded-lg <?= $statusFilter === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?> transition">
                            All
                        </a>
                        <a href="?status=pending" class="px-4 py-2 rounded-lg <?= $statusFilter === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?> transition">
                            Pending
                        </a>
                        <a href="?status=confirmed" class="px-4 py-2 rounded-lg <?= $statusFilter === 'confirmed' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?> transition">
                            Confirmed
                        </a>
                        <a href="?status=in-progress" class="px-4 py-2 rounded-lg <?= $statusFilter === 'in-progress' ? 'bg-purple-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?> transition">
                            In Progress
                        </a>
                        <a href="?status=completed" class="px-4 py-2 rounded-lg <?= $statusFilter === 'completed' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?> transition">
                            Completed
                        </a>
                        <a href="?status=cancelled" class="px-4 py-2 rounded-lg <?= $statusFilter === 'cancelled' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?> transition">
                            Cancelled
                        </a>
                    </div>
                </div>

                <!-- Bookings List -->
                <div class="space-y-4">
                    <?php if (empty($bookings)): ?>
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-700 mb-2">No Bookings Found</h3>
                        <p class="text-gray-600 mb-6">You don't have any bookings with this status.</p>
                        <a href="<?= SITE_URL ?>/booking.php" class="btn-primary">
                            <i class="fas fa-plus mr-2"></i> Create New Booking
                        </a>
                    </div>
                    <?php else: ?>
                        <?php foreach ($bookings as $booking): ?>
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                    <div class="bg-primary-100 p-4 rounded-lg">
                                        <i class="<?= htmlspecialchars($booking['icon'] ?? 'fas fa-wrench') ?> text-3xl text-primary-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($booking['service_title']) ?></h3>
                                        <p class="text-sm text-gray-600">Booking ID: #<?= str_pad($booking['id'], 6, '0', STR_PAD_LEFT) ?></p>
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-calendar mr-1"></i>
                                            <?= date('F d, Y', strtotime($booking['booking_date'])) ?> at 
                                            <?= date('h:i A', strtotime($booking['booking_time'])) ?>
                                        </p>
                                    </div>
                                </div>
                                <span class="badge badge-<?= $booking['status'] ?> text-sm">
                                    <?= ucfirst(str_replace('-', ' ', $booking['status'])) ?>
                                </span>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1"><strong>Address:</strong></p>
                                    <p class="text-gray-700"><?= htmlspecialchars($booking['address']) ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1"><strong>Contact:</strong></p>
                                    <p class="text-gray-700"><?= htmlspecialchars($booking['phone']) ?></p>
                                </div>
                            </div>

                            <?php if ($booking['notes']): ?>
                            <div class="mb-4 bg-gray-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1"><strong>Notes:</strong></p>
                                <p class="text-gray-700"><?= htmlspecialchars($booking['notes']) ?></p>
                            </div>
                            <?php endif; ?>

                            <div class="flex items-center justify-between pt-4 border-t">
                                <span class="text-2xl font-bold text-gold-600">SAR <?= number_format($booking['total_amount'], 2) ?></span>
                                <div class="flex gap-2">
                                    <?php if ($booking['status'] === 'pending'): ?>
                                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                        Cancel Booking
                                    </button>
                                    <?php endif; ?>
                                    <?php if ($booking['status'] === 'completed'): ?>
                                    <button class="px-4 py-2 bg-gold-500 text-white rounded-lg hover:bg-gold-600 transition text-sm">
                                        <i class="fas fa-star mr-1"></i> Rate Service
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Pagination -->
                        <?php if ($totalPages > 1): ?>
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?= $i ?>&status=<?= $statusFilter ?>" 
                               class="pagination-btn <?= $i === $page ? 'active' : '' ?>">
                                <?= $i ?>
                            </a>
                            <?php endfor; ?>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
