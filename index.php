<?php require_once 'includes/header.php'; ?>

<!-- Hero Section - Modern Split Design with Curved Divider -->
<section class="relative min-h-screen flex items-center overflow-hidden bg-[#006699]">
    <!-- Geometric Orange Stripes Background -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Top Left Diagonal Stripes -->
        <div class="absolute top-0 left-0 w-96 h-96">
            <svg class="w-full h-full" viewBox="0 0 400 400" fill="none">
                <path d="M0 80 L120 0 L200 0 L0 200 Z" fill="#F89E1B"/>
                <path d="M0 140 L180 0 L260 0 L0 260 Z" fill="#F89E1B" opacity="0.7"/>
                <path d="M0 200 L240 0 L320 0 L0 320 Z" fill="#F89E1B" opacity="0.5"/>
            </svg>
        </div>
        <!-- Bottom Right Diagonal Stripes -->
        <div class="absolute bottom-0 right-0 w-96 h-96">
            <svg class="w-full h-full" viewBox="0 0 400 400" fill="none">
                <path d="M400 320 L280 400 L200 400 L400 200 Z" fill="#F89E1B"/>
                <path d="M400 260 L220 400 L140 400 L400 140 Z" fill="#F89E1B" opacity="0.7"/>
                <path d="M400 200 L160 400 L80 400 L400 80 Z" fill="#F89E1B" opacity="0.5"/>
            </svg>
        </div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid lg:grid-cols-2 gap-0 items-center min-h-screen">
            
            <!-- Left Half - Content -->
            <div class="relative py-12 sm:py-16 lg:py-32 lg:pr-12">
                <!-- Subtle Background Decoration -->
                <div class="absolute top-0 left-0 w-64 h-64 bg-[#006699]/5 rounded-full blur-3xl -z-10"></div>
                <div class="absolute bottom-20 left-20 w-48 h-48 bg-[#F89E1B]/10 rounded-full blur-3xl -z-10"></div>
                
                <div class="space-y-6 sm:space-y-8 relative">
                    <!-- Trust Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 sm:px-5 sm:py-2.5 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#F89E1B] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#F89E1B]"></span>
                        </span>
                        <span class="text-white font-semibold text-xs sm:text-sm">Trusted by 450+ clients across KSA</span>
                    </div>
                    
                    <!-- Main Headline -->
                    <div class="space-y-3 md:space-y-4">
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black leading-[1.1] text-white">
                            Premium<br/>
                            <span class="text-[#F89E1B]">Maintenance</span><br/>
                            <span class="text-white">Solutions</span>
                        </h1>
                        <p class="text-lg md:text-2xl text-white/90 font-light leading-relaxed max-w-xl">
                            Experience that translates into comfort and lasting quality
                        </p>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-2 sm:pt-4">
                        <a href="<?= SITE_URL ?>/services.php" class="group px-6 py-3 sm:px-8 sm:py-4 bg-[#F89E1B] text-white rounded-2xl font-bold text-sm sm:text-base hover:bg-[#d47d10] transition-all duration-300 flex items-center justify-center gap-2 sm:gap-3 shadow-xl shadow-[#F89E1B]/20 hover:shadow-2xl hover:shadow-[#F89E1B]/30 transform hover:scale-[1.02]">
                            <i class="fas fa-th-large text-sm"></i>
                            Explore Services
                            <i class="fas fa-arrow-right text-xs sm:text-sm group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="<?= SITE_URL ?>/contact.php" class="group px-6 py-3 sm:px-8 sm:py-4 bg-white border-2 border-white text-[#006699] rounded-2xl font-bold text-sm sm:text-base hover:bg-white/90 transition-all duration-300 flex items-center justify-center gap-2 sm:gap-3 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                            <i class="fas fa-phone"></i>
                            Contact Us
                        </a>
                    </div>
                    
                    <!-- Rating & Badges -->
                    <div class="flex flex-col sm:flex-row sm:flex-wrap items-start sm:items-center gap-4 sm:gap-6 pt-6 sm:pt-8">
                        <!-- Rating -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="flex gap-0.5 sm:gap-1 text-[#F89E1B] text-base sm:text-lg">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold text-base sm:text-lg">4.9/5</p>
                                <p class="text-white/70 text-xs sm:text-sm">450+ reviews</p>
                            </div>
                        </div>
                        
                        <div class="hidden sm:block h-12 w-px bg-white/20"></div>
                        
                        <!-- Badge 1 -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-white/20 flex items-center justify-center">
                                <i class="fas fa-shield-check text-xl sm:text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold text-xs sm:text-sm">Licensed & Insured</p>
                                <p class="text-white/70 text-[10px] sm:text-xs">Full protection</p>
                            </div>
                        </div>
                        
                        <div class="hidden md:block h-12 w-px bg-white/20"></div>
                        
                        <!-- Badge 2 -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-white/20 flex items-center justify-center">
                                <i class="fas fa-certificate text-xl sm:text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold text-xs sm:text-sm">Certified Team</p>
                                <p class="text-white/70 text-[10px] sm:text-xs">Expert service</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bold Geometric Curved Divider -->
            <div class="hidden lg:block absolute left-1/2 top-0 bottom-0 -ml-8 pointer-events-none z-20">
                <svg class="h-full w-48" viewBox="0 0 200 1000" preserveAspectRatio="none">
                    <!-- Geometric border accent in blue at 45 degrees -->
                    <path d="M 100 0 L 167 250 L 100 500 L 167 750 L 100 1000" stroke="#006699" stroke-width="8" fill="none" stroke-linejoin="miter"/>
                    
                    <!-- Yellow accent line -->
                    <path d="M 167 250 L 100 500 L 167 750" stroke="#F89E1B" stroke-width="3" fill="none" stroke-linejoin="miter" opacity="0.7"/>
                </svg>
            </div>
            
            <!-- Right Half - Image Section -->
            <div class="relative lg:pl-12 py-8 sm:py-12 lg:py-0">
                <!-- Image Container with rounded corners and shadow -->
                <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/5] max-w-xl mx-auto lg:ml-auto">
                    <!-- Replace this image URL with your own -->
                    <img 
                        src="g5.jpg" 
                        alt="AFAQ Maintenance Services" 
                        class="w-full h-full object-cover"
                    />
                    
                    <!-- Overlay gradient for better text visibility if needed -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#006699]/20 to-transparent"></div>
                    
                    <!-- Optional: Floating badge on image -->
                    <div class="absolute top-4 right-4 sm:top-6 sm:right-6 bg-white/95 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 shadow-xl">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-[#F89E1B] flex items-center justify-center">
                                <i class="fas fa-tools text-base sm:text-xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-bold text-xs sm:text-sm">24/7 Available</p>
                                <p class="text-gray-600 text-[10px] sm:text-xs">Emergency Support</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#F89E1B]/10 rounded-full blur-3xl -z-10"></div>
                <div class="absolute -top-20 -left-10 w-48 h-48 bg-[#006699]/5 rounded-full blur-3xl -z-10"></div>
            </div>
            
        </div>
    </div>
    
    <!-- Background Decoration -->
    <div class="absolute top-10 right-10 w-20 h-20 border-4 border-[#006699]/10 rounded-full"></div>
    <div class="absolute bottom-20 left-20 w-16 h-16 border-4 border-[#F89E1B]/10 rounded-full"></div>
</section>
                    <div class="absolute bottom-10 right-10 w-32 h-32 border-4 border-[#F89E1B] rotate-45 opacity-80"></div>
                    <div class="absolute top-20 left-20 w-20 h-20 bg-[#F89E1B] rotate-12 opacity-60"></div>
                </div>
                
                <!-- Floating Info Badge on Image -->
                <div class="absolute bottom-10 right-10 bg-white/95 backdrop-blur-lg rounded-2xl p-5 shadow-2xl z-10 max-w-xs">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-[#F89E1B] rounded-xl flex items-center justify-center rotate-6">
                            <i class="fas fa-award text-2xl text-white -rotate-6"></i>
                        </div>
                        <div>
                            <p class="text-[#006699] font-black text-xl">450+</p>
                            <p class="text-gray-600 text-sm font-medium">Happy Clients</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Custom CSS for diagonal clip -->
    <style>
        @media (min-width: 1024px) {
            .clip-diagonal-left {
                clip-path: polygon(15% 0, 100% 0, 100% 100%, 0 100%);
            }
        }
    </style>
</section>

<!-- Services Section -->
<section class="relative py-20 bg-gradient-to-b from-white via-gray-50 to-white overflow-hidden">
    <!-- Background Glow Effect -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#006699] rounded-full blur-3xl opacity-5"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#F89E1B] rounded-full blur-3xl opacity-5"></div>
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-block mb-4 px-6 py-2 bg-gradient-to-r from-[#006699] to-[#004d73] rounded-full text-white text-sm font-bold shadow-lg">
                <i class="fas fa-tools mr-2"></i> WHAT WE OFFER
            </div>
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6">
                Premium <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#006699] to-[#004d73]">Services</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Experience excellence with our comprehensive maintenance solutions. 
                <span class="font-semibold text-[#F89E1B]">Professional, reliable, and affordable</span> - we've got you covered.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 max-w-6xl mx-auto">
            <?php
            require_once 'includes/database.php';
            $db = Database::getInstance();
            $services = $db->fetchAll("SELECT * FROM services WHERE status = 'active' LIMIT 6");
            
            foreach ($services as $service):
            ?>
            <div class="relative bg-white rounded-3xl border-2 border-[#006699]/20 overflow-hidden cursor-pointer group" onclick="window.location.href='<?= SITE_URL ?>/service.php?id=<?= $service['id'] ?>'">
                <!-- Animated Border Gradient -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#006699] via-[#F89E1B] to-[#006699] opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                <div class="relative bg-white rounded-3xl border border-[#006699]/30 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:scale-[1.02] m-[1px]">
                    <!-- Service Image -->
                    <div class="relative h-32 md:h-64 overflow-hidden bg-gradient-to-br from-blue-50 via-blue-100 to-blue-50">
                        <!-- Animated gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 via-transparent to-blue-600/20 group-hover:scale-110 transition-transform duration-700"></div>
                        
                        <?php if (!empty($service['image'])): ?>
                            <img src="<?= SITE_URL ?>/<?= htmlspecialchars($service['image']) ?>" 
                                 alt="<?= htmlspecialchars($service['title']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-125 group-hover:rotate-2 transition-all duration-700">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center relative z-10">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-200 opacity-50"></div>
                                <i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-wrench') ?> text-4xl md:text-7xl text-orange-500 relative z-10 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Shine effect -->
                        <div class="hidden md:block absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-30 transform -skew-x-12 group-hover:translate-x-full transition-all duration-1000"></div>
                        
                        <!-- Category Badge -->
                        <?php if (!empty($service['category'])): ?>
                        <div class="absolute top-2 right-2 md:top-4 md:right-4 z-20">
                            <span class="px-2 py-1 md:px-4 md:py-2 bg-gradient-to-r from-blue-500 to-blue-600 backdrop-blur-md text-white text-[10px] md:text-xs font-bold rounded-full shadow-lg md:shadow-2xl border border-white/30 group-hover:scale-110 transition-transform duration-300">
                                <?= htmlspecialchars($service['category']) ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                
                    <!-- Service Content -->
                    <div class="p-4 md:p-8 relative">
                        <!-- Decorative corner -->
                        <div class="hidden md:block absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-100 to-transparent rounded-bl-3xl opacity-50"></div>
                        
                        <!-- Icon and Title -->
                        <div class="flex items-start gap-2 md:gap-4 mb-3 md:mb-6 relative z-10">
                            <div class="flex-shrink-0 w-10 h-10 md:w-16 md:h-16 bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg md:shadow-2xl shadow-orange-500/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 border border-blue-200 md:border-2">
                                <i class="<?= htmlspecialchars($service['icon'] ?? 'fas fa-wrench') ?> text-sm md:text-2xl text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm md:text-xl font-extrabold text-gray-900 mb-1 md:mb-1.5 group-hover:text-orange-600 transition-colors duration-300 line-clamp-2"><?= htmlspecialchars($service['title']) ?></h3>
                                <div class="hidden md:flex items-center gap-2">
                                    <div class="flex text-blue-400 text-xs">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium">5.0</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 line-clamp-2 md:line-clamp-3 leading-relaxed">
                            <?= htmlspecialchars($service['short_description'] ?? substr($service['description'], 0, 100)) ?>...
                        </p>
                        
                        <!-- Features - Hidden on mobile -->
                        <div class="hidden md:flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-200">
                                <i class="fas fa-check-circle mr-1"></i> Certified
                            </span>
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-200">
                                <i class="fas fa-shield-alt mr-1"></i> Warranty
                            </span>
                        </div>
                        
                        <!-- Price and Action -->
                        <div class="flex items-center justify-between pt-3 md:pt-6 border-t border-gray-100 md:border-t-2">
                            <div>
                                <p class="text-[10px] md:text-xs text-gray-500 mb-0.5 md:mb-1 font-medium uppercase tracking-wide">From</p>
                                <p class="text-lg md:text-3xl font-black bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">
                                    <?= number_format($service['price'], 0) ?> 
                                    <span class="text-xs md:text-base font-semibold text-gray-500"><?= htmlspecialchars($service['price_unit'] ?? 'SAR') ?></span>
                                </p>
                            </div>
                            <button class="px-3 py-2 md:px-8 md:py-3.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg md:rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 font-bold text-xs md:text-sm shadow-lg shadow-orange-500/50 hover:shadow-xl hover:shadow-blue-600/50 hover:scale-105 transform">
                                <span class="hidden md:inline">Book Now</span>
                                <span class="md:hidden">Book</span>
                                <i class="fas fa-arrow-right ml-1 md:ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?= SITE_URL ?>/services.php" class="btn-primary">
                View All Services <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-24 bg-gradient-to-br from-gray-50 via-white to-blue-50 relative overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute inset-0 opacity-40">
        <div class="absolute top-10 right-10 w-72 h-72 bg-blue-200 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-blue-300 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-4 px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full text-white text-sm font-bold shadow-lg shadow-orange-500/50">
                <i class="fas fa-star mr-2"></i> WHY CHOOSE US
            </div>
            <h2 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6">
                Why <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-blue-700">AFAQ</span>?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                We stand out with our <span class="font-semibold text-orange-600">commitment to excellence</span> and customer satisfaction.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition-opacity duration-500"></div>
                <div class="relative bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-2 border-blue-300">
                    <div class="relative w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-orange-500/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-certificate text-4xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">Licensed Professionals</h3>
                    <p class="text-gray-600 leading-relaxed">All our technicians are certified and experienced professionals.</p>
                    <div class="mt-4 flex items-center text-orange-600 font-semibold text-sm">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
            </div>
            
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition-opacity duration-500"></div>
                <div class="relative bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-2 border-blue-300">
                    <div class="relative w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-orange-500/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-clock text-4xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">Round-the-clock customer support for your convenience.</p>
                    <div class="mt-4 flex items-center text-orange-600 font-semibold text-sm">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
            </div>
            
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition-opacity duration-500"></div>
                <div class="relative bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-2 border-blue-300">
                    <div class="relative w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-orange-500/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-dollar-sign text-4xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">Affordable Prices</h3>
                    <p class="text-gray-600 leading-relaxed">Competitive pricing without compromising on quality.</p>
                    <div class="mt-4 flex items-center text-orange-600 font-semibold text-sm">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
            </div>
            
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition-opacity duration-500"></div>
                <div class="relative bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-2 border-blue-300">
                    <div class="relative w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-orange-500/50 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-shield-alt text-4xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">Quality Guarantee</h3>
                    <p class="text-gray-600 leading-relaxed">100% satisfaction guarantee on all our services.</p>
                    <div class="mt-4 flex items-center text-orange-600 font-semibold text-sm">
                        <span>Learn more</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-orange-900 mb-4">What Our Clients Say</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Don't just take our word for it. Here's what our satisfied customers have to say.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
            <?php
            $testimonials = $db->fetchAll("SELECT * FROM testimonials WHERE status = 'active' ORDER BY created_at DESC LIMIT 3");
            
            foreach ($testimonials as $testimonial):
            ?>
            <div class="testimonial-card">
                <div class="rating-stars">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <i class="fas fa-star <?= $i < $testimonial['rating'] ? '' : 'text-gray-300' ?>"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-gray-700 mb-6 italic">"<?= htmlspecialchars($testimonial['message']) ?>"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center text-white font-bold text-xl mr-3">
                        <?= substr($testimonial['name'], 0, 1) ?>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900"><?= htmlspecialchars($testimonial['name']) ?></h4>
                        <p class="text-sm text-gray-600">Verified Customer</p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 hero-gradient text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-gray-200 max-w-2xl mx-auto">
            Book your maintenance service today and experience the AFAQ difference. 
            Professional service, guaranteed satisfaction.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= SITE_URL ?>/services.php" class="btn-secondary">
                <i class="fas fa-calendar-check mr-2"></i> Book Service Now
            </a>
            <a href="tel:+966501234567" class="bg-white text-orange-700 px-8 py-3 rounded-lg hover:bg-gray-100 transition shadow-lg font-medium inline-flex items-center justify-center">
                <i class="fas fa-phone mr-2"></i> Call Us Now
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
