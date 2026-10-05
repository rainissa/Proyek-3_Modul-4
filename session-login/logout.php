<?php
session_start();
$_SESSION = []; // kosongkan data sesi
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], 
$p['httponly']);
}
session_destroy(); // hancurkan sesi di server
header('Location: login.php');
exit;