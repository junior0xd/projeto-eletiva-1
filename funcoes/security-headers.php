<?php
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'");
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');
?>