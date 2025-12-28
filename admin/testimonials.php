<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
Auth::requireAdmin();
require_once __DIR__ . '/../includes/database.php';

$db = Database::getInstance();
$testimonials = $db->fetchAll("SELECT * FROM testimonials ORDER BY created_at DESC");

require_once __DIR__ . '/includes/header.php';
?>

</main>

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-xl font-bold text-gray-900">Manage Testimonials</h1>
                <div class="flex items-center space-x-4">
                    <a href="<?= SITE_URL ?>/admin/dashboard.php" class="text-gray-700 hover:text-primary-600">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Testimonials (<?= count($testimonials) ?>)</h2>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($testimonials as $test): ?>
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex text-gold-500">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="fas fa-star <?= $i < $test['rating'] ? '' : 'text-gray-300' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="badge badge-<?= $test['status'] ?>">
                            <?= ucfirst($test['status']) ?>
                        </span>
                    </div>
                    <p class="text-gray-700 italic mb-4">"<?= htmlspecialchars($test['message']) ?>"</p>
                    <h4 class="font-bold text-gray-900"><?= htmlspecialchars($test['name']) ?></h4>
                    <p class="text-sm text-gray-600"><?= date('M d, Y', strtotime($test['created_at'])) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
