<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
Auth::requireAdmin();
require_once __DIR__ . '/../includes/database.php';

$db = Database::getInstance();
$message = '';
$messageType = '';

// Handle add/edit/delete operations
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === 'add' || $action === 'edit') {
            $title = trim($_POST['title']);
            $title_ar = trim($_POST['title_ar'] ?? '');
            $description = trim($_POST['description']);
            $description_ar = trim($_POST['description_ar'] ?? '');
            $short_description = trim($_POST['short_description'] ?? '');
            $category = trim($_POST['category']);
            $price = floatval($_POST['price']);
            $price_unit = trim($_POST['price_unit'] ?? 'SAR');
            $icon = trim($_POST['icon']);
            $status = $_POST['status'];
            $features = trim($_POST['features'] ?? '');
            $duration = trim($_POST['duration'] ?? '');
            
            // Handle image upload
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../assets/uploads/services/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                if (in_array($fileExtension, $allowedExtensions)) {
                    $fileName = 'service_' . time() . '_' . uniqid() . '.' . $fileExtension;
                    $uploadPath = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                        $image = 'assets/uploads/services/' . $fileName;
                        
                        // Delete old image if editing
                        if ($action === 'edit' && isset($_POST['id']) && !empty($_POST['id'])) {
                            try {
                                $oldService = $db->fetchOne("SELECT image FROM services WHERE id = ?", [intval($_POST['id'])]);
                                if (!empty($oldService['image']) && file_exists(__DIR__ . '/../' . $oldService['image'])) {
                                    @unlink(__DIR__ . '/../' . $oldService['image']);
                                }
                            } catch (Exception $e) {
                                // Ignore error, just continue
                            }
                        }
                    }
                }
            } elseif ($action === 'edit' && isset($_POST['id']) && !empty($_POST['id'])) {
                // Keep existing image if no new upload
                try {
                    $oldService = $db->fetchOne("SELECT image FROM services WHERE id = ?", [intval($_POST['id'])]);
                    $image = $oldService['image'] ?? null;
                } catch (Exception $e) {
                    $image = null;
                }
            }
            
            if ($action === 'add') {
                $db->query(
                    "INSERT INTO services (title, title_ar, description, description_ar, short_description, category, price, price_unit, icon, image, status, features, duration, created_at) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())",
                    [$title, $title_ar, $description, $description_ar, $short_description, $category, $price, $price_unit, $icon, $image, $status, $features, $duration]
                );
                $message = 'Service added successfully!';
            } else {
                $id = intval($_POST['id']);
                $db->query(
                    "UPDATE services SET title = ?, title_ar = ?, description = ?, description_ar = ?, short_description = ?, category = ?, price = ?, price_unit = ?, icon = ?, image = ?, status = ?, features = ?, duration = ?, updated_at = NOW() 
                     WHERE id = ?",
                    [$title, $title_ar, $description, $description_ar, $short_description, $category, $price, $price_unit, $icon, $image, $status, $features, $duration, $id]
                );
                $message = 'Service updated successfully!';
            }
            $messageType = 'success';
        } elseif ($action === 'delete') {
            $id = intval($_POST['id']);
            $db->query("DELETE FROM services WHERE id = ?", [$id]);
            $message = 'Service deleted successfully!';
            $messageType = 'success';
        } elseif ($action === 'toggle_status') {
            $id = intval($_POST['id']);
            $newStatus = $_POST['new_status'];
            $db->query("UPDATE services SET status = ? WHERE id = ?", [$newStatus, $id]);
            $message = 'Service status updated!';
            $messageType = 'success';
        }
    }
}

// Get all services
$services = $db->fetchAll("SELECT * FROM services ORDER BY created_at DESC");

require_once __DIR__ . '/includes/header.php';
?>

</main>

<div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-xl font-bold text-gray-900">Manage Services</h1>
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
        <?php if ($message): ?>
        <div class="alert alert-<?= $messageType ?> mb-6">
            <i class="fas fa-check-circle mr-2"></i> <?= $message ?>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">All Services (<?= count($services) ?>)</h2>
                <button onclick="showAddModal()" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Add New Service
                </button>
            </div>

            <!-- Services Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($services as $service): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16 flex items-center justify-center rounded-lg overflow-hidden bg-gray-100">
                                        <?php if (!empty($service['image'])): ?>
                                            <img src="<?= SITE_URL ?>/<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['title']) ?>" class="h-full w-full object-cover">
                                        <?php else: ?>
                                            <i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-wrench') ?> text-2xl text-primary-600"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900"><?= htmlspecialchars($service['title']) ?></div>
                                        <div class="text-xs text-gray-500"><?= htmlspecialchars(substr($service['short_description'] ?? $service['description'], 0, 60)) ?>...</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    <?= htmlspecialchars($service['category'] ?? 'General') ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gold-600"><?= number_format($service['price'], 2) ?> <?= htmlspecialchars($service['price_unit'] ?? 'SAR') ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    <i class="far fa-clock mr-1"></i>
                                    <?= htmlspecialchars($service['duration'] ?? 'N/A') ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" class="inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="toggle_status">
                                    <input type="hidden" name="id" value="<?= $service['id'] ?>">
                                    <input type="hidden" name="new_status" value="<?= $service['status'] === 'active' ? 'inactive' : 'active' ?>">
                                    <button type="submit" class="px-3 py-1 text-xs font-medium rounded-full <?= $service['status'] === 'active' ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' ?>">
                                        <i class="fas fa-circle text-xs mr-1"></i>
                                        <?= ucfirst($service['status']) ?>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button onclick='editService(<?= json_encode($service) ?>)' class="text-primary-600 hover:text-primary-800" title="Edit">
                                        <i class="fas fa-edit text-lg"></i>
                                    </button>
                                    <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $service['id'] ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="serviceModal" class="hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[95vh] overflow-hidden animate-fade-in">
        <!-- Header -->
        <div class="relative bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm p-3 rounded-xl">
                        <i class="fas fa-tools text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white" id="modalTitle">Add New Service</h3>
                        <p class="text-sm text-primary-100">Fill in the details below</p>
                    </div>
                </div>
                <button onclick="closeModal()" class="text-white hover:bg-white hover:bg-opacity-10 p-2 rounded-lg transition">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Form Content -->
        <div class="overflow-y-auto max-h-[calc(95vh-120px)] p-6">
            <form method="POST" id="serviceForm" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="serviceId">
                <input type="hidden" name="title_ar" id="serviceTitleAr" value="">
                <input type="hidden" name="description_ar" id="serviceDescriptionAr" value="">
                
                <!-- Basic Information Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600 p-2 rounded-lg">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 ml-3">Basic Information</h4>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <span class="text-red-500 mr-1">*</span> Service Title
                            </label>
                            <input type="text" name="title" id="serviceTitle" required class="form-input text-lg font-medium" placeholder="e.g., Air Conditioning Maintenance">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <span class="text-red-500 mr-1">*</span> Short Description
                            </label>
                            <input type="text" name="short_description" id="serviceShortDesc" required class="form-input" placeholder="Brief tagline for service cards (60-80 characters)" maxlength="100">
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-lightbulb mr-1"></i> This appears in service listings and cards
                            </p>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <span class="text-red-500 mr-1">*</span> Full Description
                            </label>
                            <textarea name="description" id="serviceDescription" required rows="5" class="form-input" placeholder="Detailed description of the service, what's included, and benefits..."></textarea>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i> Provide comprehensive details customers need to know
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Pricing & Category Card -->
                <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-6 mb-6 border border-emerald-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-emerald-600 p-2 rounded-lg">
                            <i class="fas fa-tag text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 ml-3">Pricing & Category</h4>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <span class="text-red-500 mr-1">*</span> Category
                            </label>
                            <select name="category" id="serviceCategory" required class="form-input">
                                <option value="">Select Category</option>
                                <option value="AC Maintenance">🌡️ AC Maintenance</option>
                                <option value="Plumbing">🚰 Plumbing</option>
                                <option value="Electrical">⚡ Electrical</option>
                                <option value="Painting">🎨 Painting</option>
                                <option value="Carpentry">🔨 Carpentry</option>
                                <option value="Cleaning">🧹 Cleaning</option>
                                <option value="General">🔧 General Maintenance</option>
                                <option value="Other">📦 Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <span class="text-red-500 mr-1">*</span> Price
                            </label>
                            <div class="relative">
                                <input type="number" name="price" id="servicePrice" required step="0.01" min="0" class="form-input pl-8 font-bold text-lg" placeholder="299.00">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">💰</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Price Unit</label>
                            <select name="price_unit" id="servicePriceUnit" class="form-input">
                                <option value="SAR">SAR (Fixed)</option>
                                <option value="SAR/hr">SAR/hour</option>
                                <option value="SAR/visit">SAR/visit</option>
                                <option value="Starting from">Starting from</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">⏱️ Duration</label>
                            <input type="text" name="duration" id="serviceDuration" class="form-input" placeholder="e.g., 1-2 hours">
                        </div>
                    </div>
                </div>
                
                <!-- Visual Settings Card -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 mb-6 border border-purple-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-600 p-2 rounded-lg">
                            <i class="fas fa-palette text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 ml-3">Visual & Status</h4>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Service Image Upload -->
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <i class="fas fa-image mr-2 text-purple-600"></i> Service Image
                            </label>
                            <div class="border-2 border-dashed border-purple-300 rounded-xl p-4 bg-white hover:bg-purple-50 transition">
                                <input type="file" name="image" id="serviceImage" accept="image/*" class="form-input" onchange="previewImage(event)">
                                <div id="imagePreviewContainer" class="mt-3 hidden">
                                    <img id="imagePreviewImg" class="max-h-48 rounded-lg shadow-lg" alt="Preview">
                                    <button type="button" onclick="clearImagePreview()" class="mt-2 text-xs text-red-600 hover:text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Remove
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    <i class="fas fa-info-circle mr-1"></i> Recommended: 800x600px, JPG/PNG/WEBP, max 5MB
                                </p>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label flex items-center">
                                    <span class="text-red-500 mr-1">*</span> Icon (Font Awesome)
                                </label>
                                <div class="relative">
                                    <input type="text" name="icon" id="serviceIcon" required class="form-input pl-16 font-mono" placeholder="fas fa-wrench" value="fas fa-wrench">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-4xl text-primary-600" id="iconPreview">
                                        <i class="fas fa-wrench"></i>
                                    </div>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-xs text-primary-600 hover:text-primary-700 font-medium">
                                    <i class="fas fa-external-link-alt mr-1"></i> Browse Font Awesome Icons
                                </a>
                                <div class="flex gap-2">
                                    <button type="button" onclick="document.getElementById('serviceIcon').value='fas fa-fan'" class="text-xs px-2 py-1 bg-gray-100 rounded hover:bg-gray-200">fas fa-fan</button>
                                    <button type="button" onclick="document.getElementById('serviceIcon').value='fas fa-wrench'" class="text-xs px-2 py-1 bg-gray-100 rounded hover:bg-gray-200">fas fa-wrench</button>
                                    <button type="button" onclick="document.getElementById('serviceIcon').value='fas fa-bolt'" class="text-xs px-2 py-1 bg-gray-100 rounded hover:bg-gray-200">fas fa-bolt</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label flex items-center">
                                <span class="text-red-500 mr-1">*</span> Visibility Status
                            </label>
                            <select name="status" id="serviceStatus" required class="form-input text-base">
                                <option value="active">✅ Active - Visible to customers</option>
                                <option value="inactive">🚫 Inactive - Hidden from website</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Features Card -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-amber-600 p-2 rounded-lg">
                            <i class="fas fa-check-double text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 ml-3">What's Included</h4>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Service Features</label>
                        <textarea name="features" id="serviceFeatures" rows="5" class="form-input font-mono text-sm" placeholder="• Professional certified technician
• All necessary tools and equipment
• Quality parts and materials
• 30-day service guarantee
• Free follow-up consultation"></textarea>
                        <p class="text-xs text-gray-500 mt-2 flex items-start">
                            <i class="fas fa-info-circle mr-2 mt-0.5"></i>
                            <span>List key features customers get with this service. Start each line with • or - for bullet points.</span>
                        </p>
                    </div>
                </div>
                
            </form>
        </div>

        <!-- Footer Actions -->
        <div class="border-t bg-gray-50 px-6 py-4 flex gap-3">
            <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-100 transition">
                <i class="fas fa-times mr-2"></i> Cancel
            </button>
            <button type="submit" form="serviceForm" class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg font-semibold hover:from-primary-700 hover:to-primary-800 shadow-lg hover:shadow-xl transition">
                <i class="fas fa-save mr-2"></i> Save Service
            </button>
        </div>
    </div>
</div>

<script>
function showAddModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle mr-2"></i> Add New Service';
    document.getElementById('formAction').value = 'add';
    document.getElementById('serviceForm').reset();
    document.getElementById('serviceId').value = '';
    updateIconPreview('fas fa-wrench');
    clearImagePreview();
    document.getElementById('serviceModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function editService(service) {
    document.getElementById('modalTitle').textContent = 'Edit Service';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('serviceId').value = service.id;
    document.getElementById('serviceTitle').value = service.title;
    document.getElementById('serviceTitleAr').value = service.title_ar || '';
    document.getElementById('serviceDescription').value = service.description;
    document.getElementById('serviceDescriptionAr').value = service.description_ar || '';
    document.getElementById('serviceShortDesc').value = service.short_description || '';
    document.getElementById('serviceCategory').value = service.category || '';
    document.getElementById('servicePrice').value = service.price;
    document.getElementById('servicePriceUnit').value = service.price_unit || 'SAR';
    document.getElementById('serviceDuration').value = service.duration || '';
    document.getElementById('serviceIcon').value = service.icon || 'fas fa-wrench';
    document.getElementById('serviceStatus').value = service.status;
    document.getElementById('serviceFeatures').value = service.features || '';
    updateIconPreview(service.icon || 'fas fa-wrench');
    
    // Show existing image if available
    if (service.image) {
        document.getElementById('imagePreviewImg').src = '<?= SITE_URL ?>/' + service.image;
        document.getElementById('imagePreviewContainer').classList.remove('hidden');
    } else {
        document.getElementById('imagePreviewContainer').classList.add('hidden');
    }
    
    document.getElementById('serviceModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('serviceModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function updateIconPreview(iconClass) {
    const preview = document.getElementById('iconPreview');
    preview.innerHTML = `<i class="${iconClass}"></i>`;
}

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreviewImg').src = e.target.result;
            document.getElementById('imagePreviewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function clearImagePreview() {
    document.getElementById('serviceImage').value = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
    document.getElementById('imagePreviewImg').src = '';
}

// Live icon preview
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('serviceIcon');
    if (iconInput) {
        iconInput.addEventListener('input', function() {
            updateIconPreview(this.value || 'fas fa-wrench');
        });
    }
    
    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    
    // Close modal on backdrop click
    document.getElementById('serviceModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
