<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
Auth::requireAdmin();
require_once __DIR__ . '/../includes/database.php';

$db = Database::getInstance();
$message = '';
$messageType = '';

// Handle status update
if (isset($_POST['update_status']) && isset($_POST['booking_id'])) {
    if (Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $bookingId = intval($_POST['booking_id']);
        $newStatus = $_POST['status'];
        
        $db->query(
            "UPDATE bookings SET status = ?, updated_at = NOW() WHERE id = ?",
            [$newStatus, $bookingId]
        );
        
        $message = 'Booking status updated successfully!';
        $messageType = 'success';
    }
}

// Get all bookings with pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = RECORDS_PER_PAGE;
$offset = ($page - 1) * $perPage;

$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
$whereClause = $statusFilter !== 'all' ? "WHERE status = '$statusFilter'" : '';

$totalBookings = $db->fetchOne("SELECT COUNT(*) as count FROM bookings $whereClause")['count'];
$totalPages = ceil($totalBookings / $perPage);

$bookings = $db->fetchAll(
    "SELECT b.*, s.title as service_title, u.name as user_name 
     FROM bookings b 
     LEFT JOIN services s ON b.service_id = s.id 
     LEFT JOIN users u ON b.user_id = u.id 
     $whereClause 
     ORDER BY b.created_at DESC 
     LIMIT $perPage OFFSET $offset"
);

require_once __DIR__ . '/includes/header.php';
?>

</main>

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-gold-500 to-gold-600 p-2 rounded-lg">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <h1 class="text-xl font-bold text-gray-900">Manage Bookings</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?= SITE_URL ?>/admin/dashboard.php" class="text-gray-700 hover:text-primary-600">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
                    </a>
                    <a href="<?= SITE_URL ?>/admin/logout.php" class="text-red-600 hover:text-red-700">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <?php if ($message): ?>
        <div class="alert alert-<?= $messageType ?> mb-6">
            <i class="fas fa-check-circle mr-2"></i> <?= $message ?>
        </div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex flex-wrap gap-3">
                <a href="?status=all" class="px-4 py-2 rounded-lg <?= $statusFilter === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100' ?>">All</a>
                <a href="?status=pending" class="px-4 py-2 rounded-lg <?= $statusFilter === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100' ?>">Pending</a>
                <a href="?status=confirmed" class="px-4 py-2 rounded-lg <?= $statusFilter === 'confirmed' ? 'bg-blue-500 text-white' : 'bg-gray-100' ?>">Confirmed</a>
                <a href="?status=in-progress" class="px-4 py-2 rounded-lg <?= $statusFilter === 'in-progress' ? 'bg-purple-500 text-white' : 'bg-gray-100' ?>">In Progress</a>
                <a href="?status=completed" class="px-4 py-2 rounded-lg <?= $statusFilter === 'completed' ? 'bg-green-500 text-white' : 'bg-gray-100' ?>">Completed</a>
                <a href="?status=cancelled" class="px-4 py-2 rounded-lg <?= $statusFilter === 'cancelled' ? 'bg-red-500 text-white' : 'bg-gray-100' ?>">Cancelled</a>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">All Bookings (<?= $totalBookings ?>)</h2>
            
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td>#<?= str_pad($booking['id'], 4, '0', STR_PAD_LEFT) ?></td>
                            <td><?= htmlspecialchars($booking['user_name'] ?? $booking['name']) ?></td>
                            <td><?= htmlspecialchars($booking['service_title']) ?></td>
                            <td>
                                <?= date('M d, Y', strtotime($booking['booking_date'])) ?><br>
                                <small><?= date('h:i A', strtotime($booking['booking_time'])) ?></small>
                            </td>
                            <td><?= htmlspecialchars($booking['phone']) ?></td>
                            <td>
                                <form method="POST" class="inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                    <select name="status" onchange="this.form.submit()" class="badge badge-<?= $booking['status'] ?> border-0">
                                        <option value="pending" <?= $booking['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="confirmed" <?= $booking['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                        <option value="in-progress" <?= $booking['status'] === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                                        <option value="completed" <?= $booking['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="cancelled" <?= $booking['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                            <td class="font-bold text-gold-600">SAR <?= number_format($booking['total_amount'], 2) ?></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-700 mr-2" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-700" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($totalPages > 1): ?>
            <div class="pagination mt-6">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&status=<?= $statusFilter ?>" class="pagination-btn <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
