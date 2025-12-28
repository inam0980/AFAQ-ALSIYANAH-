<?php 
require_once 'includes/header.php';
require_once 'includes/database.php';
$db = Database::getInstance();

// Get service ID from URL
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($serviceId === 0) {
    header('Location: ' . SITE_URL . '/services.php');
    exit;
}

// Get service details
$service = $db->fetchOne("SELECT * FROM services WHERE id = ? AND status = 'active'", [$serviceId]);

if (!$service) {
    header('Location: ' . SITE_URL . '/services.php');
    exit;
}

// Get related services
$relatedServices = $db->fetchAll(
    "SELECT * FROM services WHERE category = ? AND id != ? AND status = 'active' LIMIT 3",
    [$service['category'], $serviceId]
);
?>

<!-- Page Header -->
<section class="relative bg-[#006699] text-white py-16 overflow-hidden">
    <!-- Geometric Orange Stripes Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64">
            <svg class="w-full h-full" viewBox="0 0 400 400" fill="none">
                <path d="M0 80 L120 0 L200 0 L0 200 Z" fill="#F89E1B"/>
                <path d="M0 140 L180 0 L260 0 L0 260 Z" fill="#F89E1B" opacity="0.7"/>
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 w-64 h-64">
            <svg class="w-full h-full" viewBox="0 0 400 400" fill="none">
                <path d="M400 320 L280 400 L200 400 L400 200 Z" fill="#F89E1B"/>
                <path d="M400 260 L220 400 L140 400 L400 140 Z" fill="#F89E1B" opacity="0.7"/>
            </svg>
        </div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <nav class="text-sm mb-4">
            <a href="<?= SITE_URL ?>/index.php" class="hover:text-[#F89E1B]">Home</a>
            <span class="mx-2">/</span>
            <a href="<?= SITE_URL ?>/services.php" class="hover:text-[#F89E1B]">Services</a>
            <span class="mx-2">/</span>
            <span class="text-[#F89E1B]"><?= htmlspecialchars($service['title']) ?></span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?= htmlspecialchars($service['title']) ?></h1>
        <?php if ($service['category']): ?>
        <span class="px-4 py-2 bg-[#F89E1B] text-white rounded-full text-sm font-medium">
            <?= htmlspecialchars($service['category']) ?>
        </span>
        <?php endif; ?>
    </div>
</section>

<!-- Service Details -->
<section class="py-20 bg-white">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <?php if ($service['image']): ?>
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                    <img src="<?= SITE_URL ?>/assets/uploads/<?= htmlspecialchars($service['image']) ?>" 
                         alt="<?= htmlspecialchars($service['title']) ?>" 
                         class="w-full h-96 object-cover"
                         onerror="this.parentElement.style.display='none'">
                </div>
                <?php endif; ?>

                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="text-6xl text-orange-600 mr-4">
                            <i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-wrench') ?>"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($service['title']) ?></h2>
                            <p class="text-2xl font-bold text-gold-600 mt-2">Starting from SAR <?= number_format($service['price'], 2) ?></p>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Service Description</h3>
                        <p class="text-gray-700 leading-relaxed mb-6"><?= nl2br(htmlspecialchars($service['description'])) ?></p>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4">What's Included</h3>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span class="text-gray-700">Professional assessment and consultation</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span class="text-gray-700">Licensed and experienced technicians</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span class="text-gray-700">Quality materials and equipment</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span class="text-gray-700">Comprehensive warranty coverage</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-3 mt-1"></i>
                                <span class="text-gray-700">Post-service support and maintenance tips</span>
                            </li>
                        </ul>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Why Choose Our Service?</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-star text-gold-500 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Expert Technicians</h4>
                                    <p class="text-sm text-gray-600">Certified professionals with years of experience</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-gold-500 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Quick Response</h4>
                                    <p class="text-sm text-gray-600">Fast booking and service delivery</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-dollar-sign text-gold-500 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Fair Pricing</h4>
                                    <p class="text-sm text-gray-600">Competitive rates with no hidden fees</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-shield-alt text-gold-500 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Satisfaction Guarantee</h4>
                                    <p class="text-sm text-gray-600">100% satisfaction or money back</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Booking Card -->
                <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl shadow-xl p-8 text-white mb-6 sticky top-24">
                    <h3 class="text-2xl font-bold mb-4">Book This Service</h3>
                    <p class="text-gray-200 mb-6">Get professional service delivered to your doorstep</p>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-tag mr-3 text-gold-400"></i>
                            <div>
                                <p class="text-sm text-gray-300">Starting Price</p>
                                <p class="text-xl font-bold">SAR <?= number_format($service['price'], 2) ?></p>
                            </div>
                        </div>
                        <?php if ($service['duration']): ?>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-3 text-gold-400"></i>
                            <div>
                                <p class="text-sm text-gray-300">Duration</p>
                                <p class="font-bold"><?= htmlspecialchars($service['duration']) ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <a href="<?= SITE_URL ?>/booking.php?service=<?= $service['id'] ?>" class="block w-full bg-gold-500 hover:bg-gold-600 text-white font-bold py-4 rounded-lg transition text-center shadow-lg">
                        <i class="fas fa-calendar-check mr-2"></i> Book Now
                    </a>
                    
                    <div class="mt-6 pt-6 border-t border-primary-500">
                        <p class="text-sm text-gray-300 mb-3">Need help or have questions?</p>
                        <a href="tel:+966501234567" class="flex items-center text-gold-400 hover:text-gold-300 transition">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+966 50 123 4567</span>
                        </a>
                    </div>
                </div>

                <!-- Service Features -->
                <div class="bg-white rounded-xl border-2 border-blue-300 shadow-lg p-6">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Service Features</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm">
                            <i class="fas fa-certificate text-orange-600 mr-3"></i>
                            <span class="text-gray-700">Licensed & Insured</span>
                        </li>
                        <li class="flex items-center text-sm">
                            <i class="fas fa-clock text-orange-600 mr-3"></i>
                            <span class="text-gray-700">24/7 Emergency Service</span>
                        </li>
                        <li class="flex items-center text-sm">
                            <i class="fas fa-thumbs-up text-orange-600 mr-3"></i>
                            <span class="text-gray-700">100% Satisfaction</span>
                        </li>
                        <li class="flex items-center text-sm">
                            <i class="fas fa-award text-orange-600 mr-3"></i>
                            <span class="text-gray-700">15+ Years Experience</span>
                        </li>
                        <li class="flex items-center text-sm">
                            <i class="fas fa-tools text-orange-600 mr-3"></i>
                            <span class="text-gray-700">Modern Equipment</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Services -->
<?php if (count($relatedServices) > 0): ?>
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-orange-900 mb-8 text-center">Related Services</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach ($relatedServices as $related): ?>
            <div class="service-card" onclick="window.location.href='<?= SITE_URL ?>/service.php?id=<?= $related['id'] ?>'">
                <div class="p-6">
                    <div class="text-4xl text-orange-600 mb-4">
                        <i class="<?= htmlspecialchars($related['icon'] ?? 'fas fa-wrench') ?>"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($related['title']) ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars(substr($related['description'], 0, 80)) ?>...</p>
                    <p class="text-xl font-bold text-gold-600">SAR <?= number_format($related['price'], 2) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
