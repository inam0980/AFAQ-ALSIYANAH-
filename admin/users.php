<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
Auth::requireAdmin();
require_once __DIR__ . '/../includes/database.php';

$db = Database::getInstance();

// Get all users
$users = $db->fetchAll("SELECT * FROM users ORDER BY created_at DESC");

require_once __DIR__ . '/includes/header.php';
?>

</main>

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-xl font-bold text-gray-900">Manage Users</h1>
                <div class="flex items-center space-x-4">
                    <a href="<?= SITE_URL ?>/admin/dashboard.php" class="text-gray-700 hover:text-primary-600">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
                    </a>
                    <a href="<?= SITE_URL ?>/admin/logout.php" class="text-red-600 hover:text-red-700">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">All Users (<?= count($users) ?>)</h2>
            
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                            <td>#<?= $u['id'] ?></td>
                            <td><?= htmlspecialchars($u['name']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['phone'] ?? 'N/A') ?></td>
                            <td>
                                <span class="badge badge-<?= $u['role'] === 'admin' ? 'cancelled' : 'confirmed' ?>">
                                    <?= ucfirst($u['role']) ?>
                                </span>
                            </td>
                            <td><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-700 mr-2" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if ($u['role'] !== 'admin'): ?>
                                <button class="text-red-600 hover:text-red-700" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
