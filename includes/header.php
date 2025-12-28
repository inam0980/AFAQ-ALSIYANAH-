<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth.php';

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> - Professional Maintenance Services</title>
    <meta name="description" content="AFAQ ALSIYANAH ALDAWLIYAH EST provides professional maintenance services for residential and commercial properties in Saudi Arabia.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#e6f2f8',
                            100: '#b3dae8',
                            200: '#80c2d8',
                            300: '#4daac8',
                            400: '#1a92b8',
                            500: '#006699',
                            600: '#005580',
                            700: '#004466',
                            800: '#00334d',
                            900: '#002233',
                            950: '#001119',
                        },
                        accent: {
                            50: '#fff4e6',
                            100: '#ffe0b3',
                            200: '#ffcc80',
                            300: '#ffb84d',
                            400: '#ffa41a',
                            500: '#F89E1B',
                            600: '#e68a00',
                            700: '#b36b00',
                            800: '#804d00',
                            900: '#4d2e00',
                        },
                        gold: {
                            50: '#fff4e6',
                            100: '#ffe0b3',
                            200: '#ffcc80',
                            300: '#ffb84d',
                            400: '#ffa41a',
                            500: '#F89E1B',
                            600: '#e68a00',
                            700: '#b36b00',
                            800: '#804d00',
                            900: '#4d2e00',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* AFAQ Design Theme - Blue & Orange with Diagonal Stripes */
        @keyframes pulse-slow {
            0%, 100% {
                opacity: 1;
                box-shadow: 0 0 20px rgba(248, 158, 27, 0.3), 0 0 30px rgba(0, 102, 153, 0.2);
            }
            50% {
                opacity: 0.8;
                box-shadow: 0 0 40px rgba(248, 158, 27, 0.6), 0 0 50px rgba(0, 102, 153, 0.4);
            }
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        @keyframes gradient {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
        
        .animate-gradient {
            animation: gradient 3s ease infinite;
        }
        
        /* Diagonal Stripe Pattern */
        .diagonal-stripes {
            background: linear-gradient(135deg, 
                #006699 0%, #006699 45%, 
                #F89E1B 45%, #F89E1B 55%, 
                #006699 55%, #006699 100%);
            background-size: 100px 100px;
        }
        
        /* Chevron Arrow Pattern */
        .chevron-pattern::before {
            content: '»»»»»';
            color: [#006699]
            font-size: 2rem;
            font-weight: bold;
        }
        
        /* Blue Glow Effects */
        .blue-glow {
            box-shadow: 0 0 30px rgba(0, 102, 153, 0.5);
        }
        
        .orange-glow {
            box-shadow: 0 0 30px rgba(248, 158, 27, 0.5);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-[#006699] text-white py-2 hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center text-sm">
                <div class="flex space-x-6">
                    <a href="tel:+966506561717" class="flex items-center hover:text-[#F89E1B] transition">
                        <i class="fas fa-phone-alt mr-2"></i>
                        0506561717
                    </a>
                    <a href="mailto:afaqalsiyanah.est@gmail.com" class="flex items-center hover:text-[#F89E1B] transition">
                        <i class="fas fa-envelope mr-2"></i>
                        afaqalsiyanah.est@gmail.com
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="hover:text-[#F89E1B] transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-[#F89E1B] transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-[#F89E1B] transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-[#F89E1B] transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="<?= SITE_URL ?>/index.php" class="flex items-center space-x-3">
                    <img src="<?= SITE_URL ?>/logo.png" alt="AFAQ Logo" class="h-20 md:h-24 lg:h-28 w-auto">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="<?= SITE_URL ?>/index.php" class="nav-link <?= $currentPage == 'index' ? 'active' : '' ?>">Home</a>
                    <a href="<?= SITE_URL ?>/about.php" class="nav-link <?= $currentPage == 'about' ? 'active' : '' ?>">About</a>
                    <a href="<?= SITE_URL ?>/services.php" class="nav-link <?= $currentPage == 'services' ? 'active' : '' ?>">Services</a>

                    <a href="<?= SITE_URL ?>/contact.php" class="nav-link <?= $currentPage == 'contact' ? 'active' : '' ?>">Contact</a>
                    <a href="<?= SITE_URL ?>/faq.php" class="nav-link <?= $currentPage == 'faq' ? 'active' : '' ?>">FAQ</a>
                    
                    <?php if (isLoggedIn()): ?>
                        <a href="<?= SITE_URL ?>/user/dashboard.php" class="btn-primary">
                            <i class="fas fa-user mr-2"></i> Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?= SITE_URL ?>/login.php" class="btn-outline">Login</a>
                        <a href="<?= SITE_URL ?>/register.php" class="btn-primary">Sign Up</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="<?= SITE_URL ?>/index.php" class="mobile-nav-link">Home</a>
                    <a href="<?= SITE_URL ?>/about.php" class="mobile-nav-link">About</a>
                    <a href="<?= SITE_URL ?>/services.php" class="mobile-nav-link">Services</a>

                    <a href="<?= SITE_URL ?>/contact.php" class="mobile-nav-link">Contact</a>
                    <a href="<?= SITE_URL ?>/faq.php" class="mobile-nav-link">FAQ</a>
                    
                    <?php if (isLoggedIn()): ?>
                        <a href="<?= SITE_URL ?>/user/dashboard.php" class="btn-primary text-center">Dashboard</a>
                    <?php else: ?>
                        <a href="<?= SITE_URL ?>/login.php" class="btn-outline text-center">Login</a>
                        <a href="<?= SITE_URL ?>/register.php" class="btn-primary text-center">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
