    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white mt-20 mb-20 md:mb-0">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-[#006699] p-2 rounded-lg">
                            <i class="fas fa-tools text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">AFAQ</h3>
                            <p class="text-xs text-gray-300">ALSIYANAH ALDAWLIYAH EST</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Professional maintenance solutions for residential and commercial properties. 
                        Your trusted partner for quality service.
                    </p>
                    <div class="flex space-x-3 mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-blue-400">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="<?= SITE_URL ?>/index.php" class="footer-link">Home</a></li>
                        <li><a href="<?= SITE_URL ?>/about.php" class="footer-link">About Us</a></li>
                        <li><a href="<?= SITE_URL ?>/services.php" class="footer-link">Our Services</a></li>

                        <li><a href="<?= SITE_URL ?>/contact.php" class="footer-link">Contact Us</a></li>
                        <li><a href="<?= SITE_URL ?>/faq.php" class="footer-link">FAQ</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-blue-400">Our Services</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                            AC Maintenance
                        </li>
                        <li class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                            Plumbing Services
                        </li>
                        <li class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                            Electrical Work
                        </li>
                        <li class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                            Painting Services
                        </li>
                        <li class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                            Carpentry
                        </li>
                        <li class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-check-circle text-blue-400 mr-2"></i>
                            Cleaning Services
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-blue-400">Contact Info</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start text-sm">
                            <i class="fas fa-map-marker-alt text-blue-400 mr-3 mt-1"></i>
                            <span class="text-gray-300">Riyadh, Saudi Arabia</span>
                        </li>
                        <li class="flex items-center text-sm">
                            <i class="fas fa-phone-alt text-blue-400 mr-3"></i>
                            <a href="tel:+966501234567" class="text-gray-300 hover:text-blue-400 transition">
                                +966 50 123 4567
                            </a>
                        </li>
                        <li class="flex items-center text-sm">
                            <i class="fas fa-envelope text-blue-400 mr-3"></i>
                            <a href="mailto:info@afaq.com" class="text-gray-300 hover:text-blue-400 transition">
                                info@afaq.com
                            </a>
                        </li>
                        <li class="flex items-start text-sm">
                            <i class="fas fa-clock text-blue-400 mr-3 mt-1"></i>
                            <div class="text-gray-300">
                                <p>Sun - Thu: 8:00 AM - 6:00 PM</p>
                                <p>Friday: Closed</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-violet-800 mt-8 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400 text-center md:text-left">
                        © <?= date('Y') ?> AFAQ ALSIYANAH ALDAWLIYAH EST. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-sm text-gray-400 hover:text-blue-400 transition">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-blue-400 transition">Terms of Service</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-blue-400 transition">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-2xl z-50">
        <div class="flex justify-around items-center h-16">
            <!-- Home -->
            <a href="<?= SITE_URL ?>/index.php" class="flex flex-col items-center justify-center flex-1 h-full hover:bg-gray-50 transition <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'text-blue-600' : 'text-gray-600'; ?>">
                <i class="fas fa-home text-xl mb-1"></i>
                <span class="text-xs font-medium">Home</span>
            </a>
            
            <!-- Services -->
            <a href="<?= SITE_URL ?>/services.php" class="flex flex-col items-center justify-center flex-1 h-full hover:bg-gray-50 transition <?php echo (basename($_SERVER['PHP_SELF']) == 'services.php' || basename($_SERVER['PHP_SELF']) == 'service.php') ? 'text-blue-600' : 'text-gray-600'; ?>">
                <i class="fas fa-tools text-xl mb-1"></i>
                <span class="text-xs font-medium">Services</span>
            </a>
            
            <!-- Account / Dashboard -->
            <?php if (Auth::isLoggedIn()): ?>
                <a href="<?= SITE_URL ?>/user/dashboard.php" class="flex flex-col items-center justify-center flex-1 h-full hover:bg-gray-50 transition text-gray-600">
                    <i class="fas fa-user text-xl mb-1"></i>
                    <span class="text-xs font-medium">Account</span>
                </a>
            <?php else: ?>
                <a href="<?= SITE_URL ?>/login.php" class="flex flex-col items-center justify-center flex-1 h-full hover:bg-gray-50 transition <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'text-blue-600' : 'text-gray-600'; ?>">
                    <i class="fas fa-sign-in-alt text-xl mb-1"></i>
                    <span class="text-xs font-medium">Login</span>
                </a>
            <?php endif; ?>
            
            <!-- More Menu -->
            <div class="relative flex-1 h-full">
                <button id="mobileMoreBtn" class="flex flex-col items-center justify-center w-full h-full hover:bg-gray-50 transition text-gray-600" type="button">
                    <i class="fas fa-bars text-xl mb-1"></i>
                    <span class="text-xs font-medium">More</span>
                </button>
                
                <!-- More Menu Dropdown -->
                <div id="mobileMoreMenu" class="hidden absolute bottom-full right-0 mb-2 w-48 bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden">
                    <a href="<?= SITE_URL ?>/about.php" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 text-gray-700">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i> About Us
                    </a>
                    <a href="<?= SITE_URL ?>/contact.php" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 text-gray-700">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i> Contact
                    </a>
                    <a href="<?= SITE_URL ?>/faq.php" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 text-gray-700">
                        <i class="fas fa-question-circle mr-2 text-blue-500"></i> FAQ
                    </a>
                    <?php if (Auth::isLoggedIn()): ?>
                        <?php if (!Auth::isAdmin()): ?>
                            <a href="<?= SITE_URL ?>/user/profile.php" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 text-gray-700">
                                <i class="fas fa-user-cog mr-2 text-blue-500"></i> Profile
                            </a>
                            <a href="<?= SITE_URL ?>/user/bookings.php" class="block px-4 py-3 hover:bg-gray-50 transition border-b border-gray-100 text-gray-700">
                                <i class="fas fa-list mr-2 text-blue-500"></i> My Bookings
                            </a>
                        <?php endif; ?>
                        <a href="<?= SITE_URL ?>/<?= Auth::isAdmin() ? 'admin' : 'user' ?>/logout.php" class="block px-4 py-3 hover:bg-gray-50 transition text-red-600">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    <?php else: ?>
                        <a href="<?= SITE_URL ?>/register.php" class="block px-4 py-3 hover:bg-gray-50 transition text-gray-700">
                            <i class="fas fa-user-plus mr-2 text-blue-500"></i> Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Scroll to Top Button -->
    <button id="scroll-top" class="scroll-top-btn hidden">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
    <script>
    // Mobile More Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const moreBtn = document.getElementById('mobileMoreBtn');
        const moreMenu = document.getElementById('mobileMoreMenu');
        
        if (moreBtn && moreMenu) {
            moreBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                moreMenu.classList.toggle('hidden');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!moreMenu.contains(e.target) && !moreBtn.contains(e.target)) {
                    moreMenu.classList.add('hidden');
                }
            });
            
            // Close menu when clicking a link inside
            moreMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    moreMenu.classList.add('hidden');
                });
            });
        }
    });
    </script>
</body>
</html>
