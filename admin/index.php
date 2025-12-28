<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

// Redirect to dashboard if already logged in as admin
if (Auth::isLoggedIn() && Auth::isAdmin()) {
    header('Location: ' . SITE_URL . '/admin/dashboard.php');
    exit;
}

// Otherwise redirect to admin login
header('Location: ' . SITE_URL . '/admin/login.php');
exit;
