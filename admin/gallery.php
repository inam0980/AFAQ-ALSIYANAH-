<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
Auth::requireAdmin();
require_once __DIR__ . '/../includes/database.php';

$db = Database::getInstance();
$gallery = $db->fetchAll("SELECT * FROM gallery ORDER BY created_at DESC");

require_once __DIR__ . '/includes/header.php';
?>

</main>

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-xl font-bold text-gray-900">Gallery Management</h1>
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
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Gallery Images (<?= count($gallery) ?>)</h2>
                <button class="btn-primary">
                    <i class="fas fa-upload mr-2"></i> Upload Images
                </button>
            </div>
            
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($gallery as $img): ?>
                <div class="gallery-item">
                    <img src="<?= SITE_URL ?>/assets/uploads/<?= htmlspecialchars($img['image']) ?>" 
                         alt="<?= htmlspecialchars($img['caption'] ?? '') ?>" 
                         class="w-full h-48 object-cover rounded-lg">
                    <div class="gallery-overlay">
                        <button class="text-white mr-2"><i class="fas fa-eye text-xl"></i></button>
                        <button class="text-white"><i class="fas fa-trash text-xl"></i></button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($gallery)): ?>
            <div class="text-center py-12">
                <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-600">No images in gallery yet</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
