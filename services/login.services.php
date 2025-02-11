<?php

require_once '../models/user.model.php';

function is_email_valid(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function compare_passwords(mysqli $conn, string $email, string $password): bool {
    $user = get_user_byemail($conn, $email);

    if ($user && password_verify($password, $user['_PASSWORD'])) {
        return true;
    }
    return false;
}

function check_login_errors(): void {
    if (isset($_SESSION['errors_login'])) { 
        $errors = $_SESSION['errors_login']; 

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        unset($_SESSION['errors_login']); // Fixed incorrect session key
    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<br>";
        echo '<p class="form-success">Signup successful!</p>'; // Changed class to "form-success" for clarity
    }
}
