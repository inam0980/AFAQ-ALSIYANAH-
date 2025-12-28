<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';

// Logout user
Auth::logout();

// Redirect to homepage
header('Location: ' . SITE_URL . '/index.php');
exit;
?>
