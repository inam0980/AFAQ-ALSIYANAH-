<?php require_once 'includes/header.php'; ?>

<!-- Hero Banner -->
<section class="py-8 md:py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="relative overflow-hidden rounded-3xl shadow-2xl">
            <!-- Background Image - Right Half -->
            <div class="absolute inset-0">
                <!-- Left Half - Gradient -->
                <div class="absolute inset-y-0 left-0 w-full md:w-1/2 bg-gradient-to-br from-[#006699] via-[#005080] to-[#003d66]"></div>
                
                <!-- Right Half - Image -->
                <div class="hidden md:block absolute inset-y-0 right-0 w-1/2">
                    <img 
                        src="g3.png" 
                        alt="AFAQ Maintenance Services" 
                        class="w-full h-full object-cover"
                    />
                    <!-- Overlay to blend with gradient -->
                    <div class="absolute inset-0 bg-gradient-to-r from-[#006699] via-[#006699]/50 to-transparent"></div>
                </div>
                
                <!-- Curved Geometric Divider -->
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 -ml-8 pointer-events-none z-20">
                    <svg class="h-full w-48" viewBox="0 0 200 1000" preserveAspectRatio="none">
                        <!-- Geometric border accent in orange at 45 degrees -->
                        <path d="M 100 0 L 167 250 L 100 500 L 167 750 L 100 1000" stroke="#F89E1B" stroke-width="8" fill="none" stroke-linejoin="miter"/>
                        
                        <!-- Blue accent line -->
                        <path d="M 167 250 L 100 500 L 167 750" stroke="#006699" stroke-width="3" fill="none" stroke-linejoin="miter" opacity="0.7"/>
                    </svg>
                </div>
                
                <!-- Animated decorations -->
                <div class="absolute top-0 left-0 w-96 h-96 bg-[#F89E1B]/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
            </div>
            
            <div class="relative z-10 py-12 md:py-16">
                <div class="container mx-auto px-6 md:px-8">
                    <div class="md:w-1/2 md:pr-16">
                        <div class="inline-block mb-4 px-4 py-1.5 bg-white/10 backdrop-blur-sm rounded-full text-white text-xs font-bold border border-white/20">
                            <i class="fas fa-building mr-1.5"></i> EST. 2010
                        </div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black mb-4 drop-shadow-2xl text-white">
                            AFAQ Is Your Complete<br/>
                            <span class="text-[#F89E1B]">Maintenance Partner</span>
                        </h1>
                        <p class="text-sm md:text-base text-white/90 leading-relaxed mb-6 drop-shadow-lg">
                            We have evolved as a customer-centric company, constantly striving to create value for our clients by offering 
                            reliable maintenance services through professional expertise. Our services are designed to cater to the requirements 
                            of residential and commercial properties across Saudi Arabia.
                        </p>
                        
                        <!-- Statistics Bar -->
                        <div class="grid grid-cols-3 gap-2 md:gap-3 mt-6">
                            <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                                <h3 class="text-2xl md:text-3xl font-black text-[#F89E1B] mb-0.5">450+</h3>
                                <p class="text-white/80 font-semibold uppercase text-[10px] md:text-xs">Happy Clients</p>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                                <h3 class="text-2xl md:text-3xl font-black text-[#F89E1B] mb-0.5">500+</h3>
                                <p class="text-white/80 font-semibold uppercase text-[10px] md:text-xs">Projects Completed</p>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                                <h3 class="text-2xl md:text-3xl font-black text-[#F89E1B] mb-0.5">15+</h3>
                                <p class="text-white/80 font-semibold uppercase text-[10px] md:text-xs">Years Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Who Are We Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Who Are <span class="text-[#006699]">We?</span>
                </h2>
            </div>
            
            <div class="bg-gradient-to-br from-gray-50 to-white p-8 md:p-12 rounded-3xl border-2 border-[#006699]/10 shadow-xl">
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    <span class="font-bold text-[#006699] text-2xl">AFAQ ALSIYANAH ALDAWLIYAH EST</span> is a complete maintenance service provider 
                    that delivers true value for your investment.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    We offer our customers a great service experience each time they choose AFAQ by providing a vast range of maintenance 
                    solutions under one roof. Maintaining high standards in quality and professionalism, AFAQ offers reliable services at 
                    competitive prices and over a period of time has emerged as the destination of choice for property owners and managers alike.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    We primarily operate across <span class="font-semibold text-[#F89E1B]">Saudi Arabia</span> with comprehensive 
                    <span class="font-semibold text-[#F89E1B]">"Professional Maintenance"</span> services. Our services cater to the needs 
                    of residential homes, commercial buildings, and industrial facilities by offering AC maintenance, plumbing, electrical work, 
                    painting, carpentry, and cleaning services.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                Vision & <span class="text-[#006699]">Mission</span>
            </h2>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Vision -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-4 border-[#006699]">
                <div class="w-16 h-16 bg-[#006699] rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-4 uppercase">Our Vision</h3>
                <p class="text-gray-700 leading-relaxed">
                    Be the <span class="font-bold text-[#006699]">#1 trusted maintenance provider</span> across Saudi Arabia, recognized for 
                    excellence, reliability, and customer satisfaction.
                </p>
            </div>
            
            <!-- Mission -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-4 border-[#F89E1B]">
                <div class="w-16 h-16 bg-[#F89E1B] rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-4 uppercase">Our Mission</h3>
                <p class="text-gray-700 leading-relaxed">
                    To serve residential and commercial clients by providing them with the <span class="font-bold text-[#F89E1B]">best possible quality</span>, 
                    widest range of services in a professional environment with competitive pricing.
                </p>
            </div>
            
            <!-- Purpose -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-4 border-[#006699]">
                <div class="w-16 h-16 bg-gradient-to-br from-[#006699] to-[#F89E1B] rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-heart text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-4 uppercase">Purpose</h3>
                <p class="text-gray-700 leading-relaxed">
                    We exist to <span class="font-bold text-[#006699]">fulfill property maintenance needs</span> and create value for 
                    our entire ecosystem - clients, employees, and partners.
                </p>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Our Journey Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Where Do We <span class="text-[#006699]">Come From?</span>
                </h2>
            </div>
            
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-[#006699]/20 hidden md:block"></div>
                
                <div class="space-y-12">
                    <!-- 2010 -->
                    <div class="relative">
                        <div class="md:flex items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right">
                                <div class="bg-gradient-to-br from-[#006699] to-[#004d73] text-white p-6 rounded-2xl shadow-xl">
                                    <h3 class="text-3xl font-black mb-3">2010</h3>
                                    <p class="text-white/90 leading-relaxed">
                                        AFAQ ALSIYANAH ALDAWLIYAH EST was founded in Riyadh, Saudi Arabia. We opened our first office 
                                        with a vision to provide professional maintenance services.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden md:block absolute left-1/2 w-6 h-6 bg-[#F89E1B] rounded-full border-4 border-white shadow-lg transform -translate-x-1/2"></div>
                            <div class="md:w-1/2"></div>
                        </div>
                    </div>
                    
                    <!-- 2015 -->
                    <div class="relative">
                        <div class="md:flex items-center">
                            <div class="md:w-1/2"></div>
                            <div class="hidden md:block absolute left-1/2 w-6 h-6 bg-[#F89E1B] rounded-full border-4 border-white shadow-lg transform -translate-x-1/2"></div>
                            <div class="md:w-1/2 md:pl-12">
                                <div class="bg-gradient-to-br from-[#F89E1B] to-[#d68416] text-white p-6 rounded-2xl shadow-xl">
                                    <h3 class="text-3xl font-black mb-3">2015</h3>
                                    <p class="text-white/90 leading-relaxed">
                                        Expanded our team to 25+ certified professionals. Achieved a significant milestone by completing 
                                        200+ projects and serving 150+ satisfied clients.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 2020 -->
                    <div class="relative">
                        <div class="md:flex items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right">
                                <div class="bg-gradient-to-br from-[#006699] to-[#004d73] text-white p-6 rounded-2xl shadow-xl">
                                    <h3 class="text-3xl font-black mb-3">2020</h3>
                                    <p class="text-white/90 leading-relaxed">
                                        Crossed 400+ completed projects with 350+ happy clients. Introduced advanced service management 
                                        systems for better customer experience.
                                    </p>
                                </div>
                            </div>
                            <div class="hidden md:block absolute left-1/2 w-6 h-6 bg-[#F89E1B] rounded-full border-4 border-white shadow-lg transform -translate-x-1/2"></div>
                            <div class="md:w-1/2"></div>
                        </div>
                    </div>
                    
                    <!-- Today -->
                    <div class="relative">
                        <div class="md:flex items-center">
                            <div class="md:w-1/2"></div>
                            <div class="hidden md:block absolute left-1/2 w-6 h-6 bg-[#F89E1B] rounded-full border-4 border-white shadow-lg transform -translate-x-1/2"></div>
                            <div class="md:w-1/2 md:pl-12">
                                <div class="bg-gradient-to-br from-[#F89E1B] to-[#d68416] text-white p-6 rounded-2xl shadow-xl">
                                    <h3 class="text-3xl font-black mb-3">Today</h3>
                                    <p class="text-white/90 leading-relaxed">
                                        Over 500+ projects completed, 450+ satisfied clients, and recognized as one of the leading 
                                        maintenance companies in the region. We continue to grow and serve with excellence.
                                    </p>
                                </div>
                            </div>
                        </div>in mobile viewws i want two cards of services should visbile parallely 

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<section class="relative py-28 bg-gradient-to-br from-gray-900 via-gold-900 to-gray-900 text-white overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 left-10 w-96 h-96 bg-orange-500 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-400 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="inline-block mb-6 px-6 py-2 bg-gradient-to-r bg-[#006699] rounded-full text-white text-sm font-bold shadow-2xl shadow-[#F89E1B]/50">
            <i class="fas fa-rocket mr-2"></i> GET STARTED TODAY
        </div>
        
        <h2 class="text-5xl md:text-7xl font-black mb-8 leading-tight">
            Join Our Growing <span class="text-[#F89E1B]">Family</span>
        </h2>
        <p class="text-2xl mb-12 text-gray-300 max-w-3xl mx-auto leading-relaxed">
            Experience the <span class="text-[#F89E1B] font-bold">AFAQ</span> difference. Book your service today and join 450+ satisfied clients!
        </p>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="<?= SITE_URL ?>/booking.php" class="px-10 py-5 bg-[#F89E1B] text-white rounded-2xl hover:bg-[#006699] transition-all duration-300 font-black text-xl shadow-2xl hover:scale-105 transform inline-flex items-center justify-center">
                <i class="fas fa-calendar-check mr-3"></i> Book Now
            </a>
            <a href="<?= SITE_URL ?>/contact.php" class="px-10 py-5 bg-white/10 backdrop-blur-lg border-2 border-white/30 text-white rounded-2xl hover:bg-white/20 transition-all duration-300 font-bold text-xl shadow-xl hover:scale-105 transform inline-flex items-center justify-center">
                <i class="fas fa-phone mr-3"></i> Contact Us
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
