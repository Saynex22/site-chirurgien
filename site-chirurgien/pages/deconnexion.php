<?php
require_once '../includes/fonctions.php';

$_SESSION = [];

// Suppression du cookie de session
if (ini_get('session.use_cookies')) {
    $parametres = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600,
        $parametres['path'], $parametres['domain'],
        $parametres['secure'], $parametres['httponly']);
}

session_destroy();

rediriger('../index.php');
