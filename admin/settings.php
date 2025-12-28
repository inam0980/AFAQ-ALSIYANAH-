<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
Auth::requireAdmin();
require_once __DIR__ . '/../includes/database.php';

$db = Database::getInstance();
$message = '';
$messageType = '';

// Handle settings update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'csrf_token' && $key !== 'submit') {
            $db->query(
                "UPDATE settings SET setting_value = ?, updated_at = NOW() WHERE setting_key = ?",
                [$value, $key]
            );
        }
    }
    $message = 'Settings updated successfully!';
    $messageType = 'success';
}

// Get all settings
$settingsResult = $db->fetchAll("SELECT * FROM settings");
$settings = [];
foreach ($settingsResult as $setting) {
    $settings[$setting['setting_key']] = $setting['setting_value'];
}

require_once __DIR__ . '/includes/header.php';
?>

</main>

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-xl font-bold text-gray-900">Site Settings</h1>
                <div class="flex items-center space-x-4">
                    <a href="<?= SITE_URL ?>/admin/dashboard.php" class="text-gray-700 hover:text-primary-600">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
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

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">General Settings</h2>
            
            <form method="POST" class="space-y-6">
                <?= csrf_field() ?>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-input" 
                               value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Site Email</label>
                        <input type="email" name="site_email" class="form-input" 
                               value="<?= htmlspecialchars($settings['site_email'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Site Phone</label>
                        <input type="text" name="site_phone" class="form-input" 
                               value="<?= htmlspecialchars($settings['site_phone'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" class="form-input" 
                               value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '') ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Site Address</label>
                    <textarea name="site_address" rows="2" class="form-input"><?= htmlspecialchars($settings['site_address'] ?? '') ?></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Working Hours</label>
                    <textarea name="working_hours" rows="2" class="form-input"><?= htmlspecialchars($settings['working_hours'] ?? '') ?></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">About Us</label>
                    <textarea name="about_us" rows="4" class="form-input"><?= htmlspecialchars($settings['about_us'] ?? '') ?></textarea>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-input" 
                               value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" name="twitter_url" class="form-input" 
                               value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-input" 
                               value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
                    </div>
                </div>
                
                <div class="pt-6 border-t">
                    <button type="submit" name="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
