<?php require_once 'includes/header.php'; ?>

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
                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3 px-2 sm:px-3 py-1 sm:py-1.5 bg-white/90 backdrop-blur-sm rounded-full text-[#F89E1B] text-[10px] sm:text-xs font-bold shadow-lg">
                        <i class="fas fa-question-circle mr-1"></i> FAQ
                    </div>
                    <i class="fas fa-question-circle text-4xl sm:text-6xl text-white opacity-20"></i>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="flex items-start gap-3 sm:gap-4 mb-3 sm:mb-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-[#F89E1B] rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-comments text-lg sm:text-xl text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 mb-1">Frequently Asked Questions</h1>
                            <p class="text-xs sm:text-sm md:text-base text-gray-600">Find answers to common questions about our services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 sm:py-16 md:py-20 bg-white">
        <div class="max-w-4xl mx-auto">
            <!-- General Questions -->
            <div class="mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-[#006699] mb-4 sm:mb-6 flex items-center">
                    <i class="fas fa-question-circle mr-3 text-[#F89E1B]"></i>
                    General Questions
                </h2>
                <div class="space-y-3 sm:space-y-4">
                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-4 sm:p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-base sm:text-lg text-gray-900 pr-3">What services does AFAQ provide?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-4 sm:p-6 pt-0 text-sm sm:text-base text-gray-700">
                            <p>AFAQ ALSIYANAH ALDAWLIYAH EST provides comprehensive maintenance services including AC maintenance, plumbing, electrical work, painting, carpentry, and cleaning services. We serve both residential and commercial properties across Saudi Arabia.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">What areas do you serve?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>We primarily serve Riyadh and surrounding areas. However, for large projects, we can extend our services to other major cities in Saudi Arabia. Please contact us to discuss your specific location.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">How can I book a service?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>You can book a service through our online booking form, by calling us at +966 50 123 4567, or by sending us an email at info@afaq.com. We'll confirm your appointment within 24 hours.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">Are your technicians certified?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>Yes, all our technicians are certified, licensed, and have years of experience in their respective fields. We ensure that our team is properly trained and up-to-date with the latest industry standards.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Payments -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-[#006699] mb-6 flex items-center">
                    <i class="fas fa-dollar-sign mr-3 text-[#F89E1B]"></i>
                    Pricing & Payments
                </h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">How much do your services cost?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>Our pricing varies depending on the type of service and the scope of work. The prices listed on our services page are starting prices. For an accurate quote, please book a consultation or contact us with your specific requirements.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">What payment methods do you accept?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>We accept cash, bank transfers, and credit/debit cards. Payment is typically due upon completion of the service. For larger projects, we may arrange a payment schedule.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">Do you provide free estimates?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>Yes, we provide free estimates for most services. Simply contact us or book a consultation, and we'll assess your needs and provide a detailed quote at no charge.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Delivery -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-[#006699] mb-6 flex items-center">
                    <i class="fas fa-tools mr-3 text-[#F89E1B]"></i>
                    Service Delivery
                </h2>
                <div class="space-y-4">
                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">How quickly can you respond to a service request?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>For regular service requests, we typically schedule appointments within 24-48 hours. For emergency services, we can often respond within 2-4 hours depending on availability and location.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">Do you offer emergency services?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>Yes, we offer 24/7 emergency services for urgent maintenance needs such as plumbing leaks, electrical failures, and AC breakdowns. Contact us immediately at +966 50 123 4567 for emergency assistance.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">Do you provide warranties on your work?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>Yes, we provide warranties on our workmanship. The warranty period varies depending on the type of service. We also use quality materials that come with manufacturer warranties where applicable.</p>
                        </div>
                    </div>

                    <div class="faq-item bg-white rounded-lg border border-[#006699]/20 shadow-lg overflow-hidden">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition">
                            <span class="font-bold text-lg text-gray-900">Can I reschedule or cancel my appointment?</span>
                            <i class="fas fa-chevron-down text-[#F89E1B] transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden p-6 pt-0 text-gray-700">
                            <p>Yes, you can reschedule or cancel your appointment. We kindly request at least 24 hours notice for cancellations or rescheduling to avoid any cancellation fees.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Still Have Questions -->
<section class="py-12 sm:py-16 md:py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <i class="fas fa-question-circle text-4xl sm:text-6xl text-[#F89E1B] mb-4 sm:mb-6"></i>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#006699] mb-3 sm:mb-4">Still Have Questions?</h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 mb-6 sm:mb-8">
                Can't find the answer you're looking for? Our customer support team is here to help.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?= SITE_URL ?>/contact.php" class="btn-primary">
                    <i class="fas fa-envelope mr-2"></i> Contact Us
                </a>
                <a href="tel:+966501234567" class="btn-secondary">
                    <i class="fas fa-phone mr-2"></i> Call Us Now
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = question.querySelector('i');
        
        question.addEventListener('click', () => {
            // Close all other FAQs
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.querySelector('.faq-answer').classList.add('hidden');
                    otherItem.querySelector('.faq-question i').style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current FAQ
            answer.classList.toggle('hidden');
            if (answer.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
