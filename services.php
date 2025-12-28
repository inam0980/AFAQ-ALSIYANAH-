<?php 
require_once 'includes/header.php';
require_once 'includes/database.php';
$db = Database::getInstance();

// Get all active services
$services = $db->fetchAll("SELECT * FROM services WHERE status = 'active' ORDER BY title ASC");

// Get unique categories
$categories = $db->fetchAll("SELECT DISTINCT category FROM services WHERE status = 'active' AND category IS NOT NULL ORDER BY category");
?>

<!-- Page Header -->
<section class="relative py-8 sm:py-12 md:py-16 bg-[#006699] overflow-hidden">
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
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl border border-[#006699]/20 shadow-2xl overflow-hidden">
                <div class="relative h-24 sm:h-32 bg-[#006699] flex items-center justify-center">
                    <div class="absolute top-2 right-2 px-2 sm:px-3 py-1 sm:py-1.5 bg-white/90 backdrop-blur-sm rounded-full text-[#F89E1B] text-xs sm:text-sm font-bold shadow-lg">
                        <i class="fas fa-tools mr-1"></i> SERVICES
                    </div>
                    <i class="fas fa-tools text-4xl sm:text-6xl text-white opacity-20"></i>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-[#F89E1B] rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-wrench text-lg sm:text-xl text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 mb-1">Our Services</h1>
                            <p class="text-xs sm:text-sm md:text-base text-gray-600">Comprehensive Maintenance Solutions for Every Need</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-12 sm:py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <!-- Category Filter -->
        <?php if (count($categories) > 0): ?>
        <div class="mb-8 sm:mb-12 flex flex-wrap gap-2 sm:gap-3 justify-center">
            <button onclick="filterServices('all')" class="filter-btn active px-4 py-2 sm:px-6 sm:py-2 rounded-lg border-2 border-[#006699] text-[#006699] hover:bg-[#006699] hover:text-white transition font-medium text-xs sm:text-sm">
                All Services
            </button>
            <?php foreach ($categories as $category): ?>
            <button onclick="filterServices('<?= htmlspecialchars($category['category']) ?>')" class="filter-btn px-4 py-2 sm:px-6 sm:py-2 rounded-lg border-2 border-gray-300 text-gray-700 hover:border-[#F89E1B] hover:text-[#F89E1B] transition font-medium text-xs sm:text-sm">
                <?= htmlspecialchars($category['category']) ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Services Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 max-w-6xl mx-auto">
            <?php foreach ($services as $service): ?>
            <div class="service-item bg-white rounded-2xl border border-[#006699]/20 shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" data-category="<?= htmlspecialchars($service['category'] ?? 'Other') ?>" onclick="window.location.href='<?= SITE_URL ?>/service.php?id=<?= $service['id'] ?>'">
                <!-- Service Image -->
                <div class="relative h-32 md:h-56 overflow-hidden bg-[#006699]/5">
                    <?php if (!empty($service['image'])): ?>
                        <img src="<?= SITE_URL ?>/<?= htmlspecialchars($service['image']) ?>" 
                             alt="<?= htmlspecialchars($service['title']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-wrench') ?> text-4xl md:text-7xl text-[#F89E1B] opacity-30"></i>
                        </div>
                    <?php endif; ?>
                    <!-- Category Badge -->
                    <?php if ($service['category']): ?>
                    <div class="absolute top-2 right-2 md:top-4 md:right-4">
                        <span class="px-2 py-1 md:px-4 md:py-2 bg-white bg-opacity-95 backdrop-blur-sm text-[#F89E1B] text-[10px] md:text-xs font-bold rounded-full shadow-lg">
                            <?= htmlspecialchars($service['category']) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Service Content -->
                <div class="p-4 md:p-6">
                    <!-- Icon and Title -->
                    <div class="flex items-start gap-2 md:gap-4 mb-3 md:mb-4">
                        <div class="flex-shrink-0 w-10 h-10 md:w-14 md:h-14 bg-[#006699] rounded-xl flex items-center justify-center shadow-lg">
                            <i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-wrench') ?> text-sm md:text-2xl text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm md:text-xl font-bold text-gray-900 mb-1 group-hover:text-[#F89E1B] transition line-clamp-2"><?= htmlspecialchars($service['title']) ?></h3>
                            <p class="hidden md:block text-sm text-gray-500">Professional Service</p>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-4 line-clamp-2 md:line-clamp-3">
                        <?= htmlspecialchars($service['short_description'] ?? substr($service['description'], 0, 100)) ?>...
                    </p>
                    
                    <!-- Price and Action -->
                    <div class="flex items-center justify-between pt-3 md:pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-[10px] md:text-xs text-gray-500 mb-0.5 md:mb-1">From</p>
                            <p class="text-lg md:text-2xl font-bold text-gold-600">
                                <?= number_format($service['price'], 0) ?> 
                                <span class="text-xs md:text-sm font-normal text-gray-500"><?= htmlspecialchars($service['price_unit'] ?? 'SAR') ?></span>
                            </p>
                        </div>
                        <button class="px-3 py-2 md:px-6 md:py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium text-xs md:text-sm shadow-md hover:shadow-lg">
                            <span class="hidden md:inline">View Details</span>
                            <span class="md:hidden">View</span>
                            <i class="fas fa-arrow-right ml-1 md:ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($services)): ?>
        <div class="text-center py-20">
            <i class="fas fa-tools text-6xl text-gray-400 mb-6"></i>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">No Services Available</h3>
            <p class="text-gray-500">Please check back later for our service offerings.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 sm:py-16 md:py-20 bg-[#006699] text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6">Need a Custom Service?</h2>
        <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 text-gray-200 max-w-2xl mx-auto">
            Don't see what you're looking for? Contact us for custom maintenance solutions tailored to your needs.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= SITE_URL ?>/contact.php" class="btn-secondary">
                <i class="fas fa-envelope mr-2"></i> Contact Us
            </a>
            <a href="<?= SITE_URL ?>/booking.php" class="bg-white text-[#F89E1B] px-8 py-3 rounded-lg hover:bg-gray-100 transition shadow-lg font-medium inline-flex items-center justify-center">
                <i class="fas fa-calendar-check mr-2"></i> Book Service
            </a>
        </div>
    </div>
</section>

<script>
function filterServices(category) {
    const items = document.querySelectorAll('.service-item');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update active button
    buttons.forEach(btn => {
        btn.classList.remove('active', 'bg-primary-600', 'text-white', 'border-primary-600');
        btn.classList.add('border-gray-300', 'text-gray-700');
    });
    event.target.classList.add('active', 'bg-primary-600', 'text-white', 'border-primary-600');
    event.target.classList.remove('border-gray-300', 'text-gray-700');
    
    // Filter items
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            item.classList.add('fade-in');
        } else {
            item.style.display = 'none';
        }
    });
}
</script>

<?php require_once 'includes/footer.php'; ?>
