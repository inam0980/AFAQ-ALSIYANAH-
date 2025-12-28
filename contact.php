<?php 
require_once 'includes/header.php';

// Handle contact form submission
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid security token';
        $messageType = 'error';
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $msg = trim($_POST['message'] ?? '');
        
        $errors = [];
        if (empty($name)) $errors[] = 'Name is required';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
        if (empty($msg)) $errors[] = 'Message is required';
        
        if (empty($errors)) {
            try {
                require_once 'includes/database.php';
                $db = Database::getInstance();
                $db->insert(
                    "INSERT INTO contact_messages (name, email, phone, subject, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())",
                    [$name, $email, $phone, $subject, $msg]
                );
                
                $message = 'Thank you for contacting us! We will respond to your message shortly.';
                $messageType = 'success';
                $_POST = [];
            } catch (Exception $e) {
                $message = 'Failed to send message. Please try again.';
                $messageType = 'error';
            }
        } else {
            $message = implode('<br>', $errors);
            $messageType = 'error';
        }
    }
}
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
        </div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl border border-[#006699]/20 shadow-2xl overflow-hidden">
                <div class="relative h-24 sm:h-32 bg-[#006699] flex items-center justify-center">
                    <div class="absolute top-2 right-2 px-2 sm:px-3 py-1 sm:py-1.5 bg-white/90 backdrop-blur-sm rounded-full text-[#F89E1B] text-xs sm:text-sm font-bold shadow-lg">
                        <i class="fas fa-envelope mr-1"></i> CONTACT
                    </div>
                    <i class="fas fa-envelope text-4xl sm:text-6xl text-white opacity-20"></i>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="flex items-start gap-3 sm:gap-4 mb-3 sm:mb-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-[#006699] rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-phone-alt text-lg sm:text-xl text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 mb-1">Contact Us</h1>
                            <p class="text-xs sm:text-sm md:text-base text-gray-600">We'd love to hear from you. Get in touch!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 sm:py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <!-- Contact Info -->
            <div class="space-y-6">
                <!-- Main Info Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-[#006699] rounded-3xl opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                    <div class="relative bg-white rounded-2xl sm:rounded-3xl border-2 border-[#006699]/30 shadow-2xl p-5 sm:p-8">
                        <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#006699] rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-info-circle text-xl sm:text-2xl text-white"></i>
                            </div>
                            <h3 class="text-2xl sm:text-3xl font-black text-gray-900">Get In Touch</h3>
                        </div>
                        
                        <div class="space-y-4 sm:space-y-6">
                            <div class="flex items-start p-3 sm:p-4 bg-[#006699]/5 rounded-xl sm:rounded-2xl border border-[#006699]/20 hover:shadow-lg transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-[#006699] rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg mr-3 sm:mr-4">
                                    <i class="fas fa-map-marker-alt text-white text-base sm:text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1 text-base sm:text-lg">Address</h4>
                                    <p class="text-gray-600">Riyadh, Saudi Arabia</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 bg-[#006699]/5 rounded-2xl border border-[#006699]/20 hover:shadow-lg transition-all duration-300">
                                <div class="flex-shrink-0 w-12 h-12 bg-[#006699] rounded-xl flex items-center justify-center shadow-lg mr-4">
                                    <i class="fas fa-phone-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1 text-lg">Phone</h4>
                                    <a href="tel:+966501234567" class="text-gray-600 hover:text-[#F89E1B] font-medium transition">
                                        +966 50 123 4567
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 bg-[#006699]/5 rounded-2xl border border-[#006699]/20 hover:shadow-lg transition-all duration-300">
                                <div class="flex-shrink-0 w-12 h-12 bg-[#006699] rounded-xl flex items-center justify-center shadow-lg mr-4">
                                    <i class="fas fa-envelope text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1 text-lg">Email</h4>
                                    <a href="mailto:info@afaq.com" class="text-gray-600 hover:text-[#F89E1B] font-medium transition">
                                        info@afaq.com
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 bg-[#006699]/5 rounded-2xl border border-[#006699]/20 hover:shadow-lg transition-all duration-300">
                                <div class="bg-[#F89E1B]/10 p-3 rounded-lg mr-4">
                                    <i class="fas fa-clock text-[#F89E1B] text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Working Hours</h4>
                                    <p class="text-gray-600 text-sm">Sun - Thu: 8:00 AM - 6:00 PM</p>
                                    <p class="text-gray-600 text-sm">Friday: Closed</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-8 border-t">
                            <h4 class="font-bold text-gray-900 mb-4">Follow Us</h4>
                        <div class="flex space-x-3">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl sm:rounded-3xl blur-xl opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative bg-gradient-to-br from-red-500 to-red-600 rounded-2xl sm:rounded-3xl shadow-2xl p-5 sm:p-8 text-white overflow-hidden">
                        <!-- Animated pulse ring -->
                        <div class="absolute top-4 right-4 w-20 h-20">
                            <div class="absolute inset-0 bg-white/30 rounded-full animate-ping"></div>
                            <div class="absolute inset-0 bg-white/20 rounded-full"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl shadow-xl mb-4">
                                <i class="fas fa-exclamation-circle text-4xl text-white animate-pulse"></i>
                            </div>
                            <h3 class="text-2xl font-black mb-3">Emergency Service</h3>
                            <p class="text-red-100 mb-6 leading-relaxed">Available 24/7 for urgent maintenance needs. We respond immediately!</p>
                            <a href="tel:+966501234567" class="block w-full bg-white text-red-600 font-black py-4 rounded-xl text-center hover:bg-red-50 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105">
                                <i class="fas fa-phone mr-2 animate-pulse"></i> Call Now - 24/7
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="">
                <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?> mb-6">
                    <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?> mr-3 text-xl"></i>
                    <div><?= $message ?></div>
                </div>
                <?php endif; ?>

                <div class="relative bg-white rounded-2xl sm:rounded-3xl border-2 border-[#006699]/30 shadow-2xl overflow-hidden hover:border-[#F89E1B] transition-all duration-300">
                    <div class="absolute inset-0 bg-[#006699] opacity-0 hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                    
                    <div class="relative bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 md:p-12 m-[2px]">
                        <div class="text-center mb-6 sm:mb-10">
                            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-[#006699] rounded-xl sm:rounded-2xl shadow-2xl mb-4 sm:mb-6">
                                <i class="fas fa-paper-plane text-2xl sm:text-3xl text-white"></i>
                            </div>
                            <h2 class="text-2xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-2 sm:mb-3">
                                Send Us a <span class="text-[#006699]">Message</span>
                            </h2>
                            <p class="text-lg text-gray-600">Fill out the form and our team will get back to you within 24 hours</p>
                            <div class="mt-4 h-1 w-24 bg-[#F89E1B] rounded-full mx-auto"></div>
                        </div>
                    
                    <form method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Your Name *</label>
                                <input type="text" id="name" name="name" required 
                                       class="form-input" placeholder="Enter your name"
                                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" id="email" name="email" required 
                                       class="form-input" placeholder="your@email.com"
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" id="phone" name="phone" 
                                       class="form-input" placeholder="+966 50 123 4567"
                                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" id="subject" name="subject" 
                                       class="form-input" placeholder="What is this about?"
                                       value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Message *</label>
                            <textarea id="message" name="message" required rows="6" 
                                      class="form-input" placeholder="Write your message here..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary w-full md:w-auto">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-0">
    <div class="w-full h-96">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.4010277594895!2d46.6753!3d24.7136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQyJzQ5LjAiTiA0NsKwNDAnMzEuMSJF!5e0!3m2!1sen!2ssa!4v1234567890" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
