<?php


ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 3600, // 1 Hour,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, // HTTPS only
    'httponly' => true // Prevents JavaScript from accessing session cookies
]);

session_start();

if(!isset($_SESSION["last_regeneration"])) {
    regenerate_session_id();
} else {
    $interval = 60 * 60;
    if(time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id () {
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
}

$timeout_duration = 1800; // 30 minutes

// Check if the session has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
    session_unset();
    session_destroy();   
    header("Location: login.php?session=expired");
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time();

function generateToken() {
    // bin2hex : convert binary to hexadecimal to generate CSRF (Cross-Site Request Forgery) token
    $token = bin2hex(random_bytes(32));

    return $token;
}
