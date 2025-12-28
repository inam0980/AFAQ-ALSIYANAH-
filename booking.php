<?php 
require_once 'includes/header.php';
require_once 'includes/database.php';
$db = Database::getInstance();

// Get all active services for the dropdown
$services = $db->fetchAll("SELECT id, title, price FROM services WHERE status = 'active' ORDER BY title ASC");

// Pre-select service if coming from service page
$selectedService = isset($_GET['service']) ? intval($_GET['service']) : 0;

// Handle form submission
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!Auth::verifyCsrf($_POST['csrf_token'] ?? '')) {
        $message = 'Invalid security token. Please try again.';
        $messageType = 'error';
    } else {
        // Validate and sanitize input
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $serviceId = intval($_POST['service_id'] ?? 0);
        $bookingDate = trim($_POST['booking_date'] ?? '');
        $bookingTime = trim($_POST['booking_time'] ?? '');
        $notes = trim($_POST['notes'] ?? '');
        
        // Validation
        $errors = [];
        
        if (empty($name)) $errors[] = 'Name is required';
        if (empty($phone)) $errors[] = 'Phone is required';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
        if (empty($address)) $errors[] = 'Address is required';
        if ($serviceId === 0) $errors[] = 'Please select a service';
        if (empty($bookingDate)) $errors[] = 'Booking date is required';
        if (empty($bookingTime)) $errors[] = 'Booking time is required';
        
        if (empty($errors)) {
            try {
                // Get service details
                $service = $db->fetchOne("SELECT * FROM services WHERE id = ?", [$serviceId]);
                
                // Insert booking
                $userId = isLoggedIn() ? $_SESSION['user_id'] : null;
                
                $bookingId = $db->insert(
                    "INSERT INTO bookings (user_id, name, phone, email, address, city, service_id, booking_date, booking_time, notes, total_amount, created_at) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())",
                    [$userId, $name, $phone, $email, $address, $city, $serviceId, $bookingDate, $bookingTime, $notes, $service['price']]
                );
                
                if ($bookingId) {
                    // Send confirmation email (optional - requires mail configuration)
                    // mail($email, "Booking Confirmation", "Your booking has been confirmed...");
                    
                    $message = 'Booking submitted successfully! We will contact you shortly to confirm.';
                    $messageType = 'success';
                    
                    // Clear form
                    $_POST = [];
                } else {
                    $message = 'Failed to submit booking. Please try again.';
                    $messageType = 'error';
                }
            } catch (Exception $e) {
                $message = 'An error occurred. Please try again later.';
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
<section class="relative bg-[#006699] text-white py-20 md:py-28 overflow-hidden">
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
        <div class="max-w-4xl mx-auto text-center">
            <!-- Badge -->
            <div class="inline-block mb-6 px-6 py-2 bg-[#F89E1B] rounded-full text-white text-sm font-bold shadow-lg">
                <i class="fas fa-calendar-check mr-2"></i> ONLINE BOOKING
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black mb-6">
                Book <span class="text-[#F89E1B]">Your Service</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 leading-relaxed max-w-3xl mx-auto">
                Schedule your maintenance service in just a few steps and get <span class="text-[#F89E1B] font-semibold">instant confirmation</span>
            </p>
            
            <!-- Decorative Icons -->
            <div class="flex justify-center gap-8 mt-8">
                <div class="flex items-center gap-2 text-white">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <span class="text-sm font-medium">Quick</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <i class="fas fa-shield-check text-2xl"></i>
                    <span class="text-sm font-medium">Secure</span>
                </div>
                <div class="flex items-center gap-2 text-white">
                    <i class="fas fa-clock text-2xl"></i>
                    <span class="text-sm font-medium">24/7</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form -->
<section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto">
            <?php if ($message): ?>
            <div class="alert alert-<?= $messageType ?> mb-6">
                <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?> mr-3 text-xl"></i>
                <div>
                    <?= $message ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Main Form Card -->
            <div class="relative bg-white rounded-3xl border-2 border-orange-400 shadow-2xl overflow-hidden hover:border-blue-500 transition-colors duration-300">
                <!-- Gradient Border Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-600 opacity-0 hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                
                <div class="relative bg-white rounded-3xl p-6 md:p-12 m-[2px]">
                    <!-- Header with Icon -->
                    <div class="mb-10 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-gold-400 via-gold-500 to-gold-600 rounded-2xl shadow-2xl shadow-gold-500/50 mb-6 transform hover:rotate-6 transition-transform duration-300">
                            <i class="fas fa-clipboard-list text-3xl text-white"></i>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-3">
                            Service <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold-500 to-gold-600">Booking</span>
                        </h2>
                        <p class="text-lg text-gray-600">Fill in the details below and we'll get back to you shortly</p>
                        <div class="mt-4 h-1 w-24 bg-gradient-to-r from-gold-400 to-gold-600 rounded-full mx-auto"></div>
                    </div>

                <form method="POST" id="booking-form" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Personal Information -->
                    <div class="bg-gradient-to-br from-gold-50 to-amber-50 rounded-2xl p-6 md:p-8 mb-8 border-2 border-gold-200">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-gold-500 to-gold-600 rounded-xl flex items-center justify-center shadow-lg shadow-gold-500/50">
                                <i class="fas fa-user text-xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">
                                Personal Information
                            </h3>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" id="name" name="name" required 
                                       class="form-input" placeholder="Enter your full name"
                                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" required 
                                       class="form-input" placeholder="+966 50 123 4567"
                                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            </div>
                            <div class="form-group md:col-span-2">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" id="email" name="email" required 
                                       class="form-input" placeholder="your@email.com"
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Location Information -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 md:p-8 mb-8 border-2 border-blue-200">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/50">
                                <i class="fas fa-map-marker-alt text-xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">
                                Location Details
                            </h3>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group md:col-span-2">
                                <label for="address" class="form-label">Full Address *</label>
                                <textarea id="address" name="address" required rows="3" 
                                          class="form-input" placeholder="Enter your complete address"><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" name="city" 
                                       class="form-input" placeholder="e.g., Riyadh"
                                       value="<?= htmlspecialchars($_POST['city'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Service Details -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 md:p-8 mb-8 border-2 border-green-200">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/50">
                                <i class="fas fa-tools text-xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">
                                Service Details
                            </h3>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-group md:col-span-2">
                                <label for="service_id" class="form-label">Select Service *</label>
                                <select id="service_id" name="service_id" required class="form-input">
                                    <option value="">Choose a service...</option>
                                    <?php foreach ($services as $service): ?>
                                    <option value="<?= $service['id'] ?>" 
                                            <?= ($selectedService == $service['id'] || (isset($_POST['service_id']) && $_POST['service_id'] == $service['id'])) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($service['title']) ?> - SAR <?= number_format($service['price'], 2) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="booking_date" class="form-label">Preferred Date *</label>
                                <input type="date" id="booking_date" name="booking_date" required 
                                       class="form-input" min="<?= date('Y-m-d') ?>"
                                       value="<?= htmlspecialchars($_POST['booking_date'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="booking_time" class="form-label">Preferred Time *</label>
                                <input type="time" id="booking_time" name="booking_time" required 
                                       class="form-input"
                                       value="<?= htmlspecialchars($_POST['booking_time'] ?? '') ?>">
                            </div>
                            <div class="form-group md:col-span-2">
                                <label for="notes" class="form-label">Additional Notes</label>
                                <textarea id="notes" name="notes" rows="4" 
                                          class="form-input" placeholder="Any specific requirements or details..."><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl border-2 border-purple-200 mb-8">
                        <label class="flex items-start cursor-pointer group">
                            <input type="checkbox" required class="mt-1 mr-4 w-6 h-6 text-gold-600 border-2 border-gray-300 rounded-lg focus:ring-4 focus:ring-gold-500/50 transition-all">
                            <span class="text-base text-gray-700 leading-relaxed">
                                I agree to the <a href="#" class="text-gold-600 font-semibold hover:underline">Terms & Conditions</a> 
                                and understand that this is a booking request. Final confirmation will be provided by the <span class="font-bold text-gold-600">AFAQ</span> team.
                            </span>
                        </label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col md:flex-row gap-4">
                        <button type="submit" class="flex-1 px-8 py-5 bg-gradient-to-r from-gold-500 via-gold-600 to-gold-500 text-white rounded-2xl hover:from-gold-600 hover:to-gold-700 transition-all duration-300 font-black text-lg shadow-2xl shadow-gold-500/50 hover:shadow-gold-600/60 hover:scale-105 transform">
                            <i class="fas fa-paper-plane mr-3"></i> Submit Booking Request
                        </button>
                        <button type="reset" class="px-8 py-5 bg-white border-3 border-gray-300 text-gray-700 rounded-2xl hover:border-gold-500 hover:text-gold-600 transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl">
                            <i class="fas fa-redo mr-3"></i> Reset Form
                        </button>
                    </div>
                </div>
                </form>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <!-- Card 1 -->
                <div class="relative group cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-600 rounded-2xl opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                    <div class="relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center border-t-4 border-blue-500">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg shadow-orange-500/50 mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <i class="fas fa-headset text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">24/7 Support</h3>
                        <p class="text-gray-600 leading-relaxed">We're here to help anytime you need assistance</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="relative group cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-600 rounded-2xl opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                    <div class="relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center border-t-4 border-green-500">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg shadow-green-500/50 mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <i class="fas fa-shield-check text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">Secure Booking</h3>
                        <p class="text-gray-600 leading-relaxed">Your data is encrypted and safe with us</p>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="relative group cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-r from-gold-400 to-gold-600 rounded-2xl opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                    <div class="relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center border-t-4 border-gold-500">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-gold-500 to-gold-600 rounded-2xl shadow-lg shadow-gold-500/50 mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <i class="fas fa-clock text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">Quick Response</h3>
                        <p class="text-gray-600 leading-relaxed">Get confirmation within 24 hours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
