<?php 

declare(strict_types=1);
require_once __DIR__ . "/../config/db.config.php";

function is_input_empty(string $first_name, string $last_name, string $email, string $password, string $passwordConfirm, string $phone, string $address): bool {
    return empty($first_name) || empty($last_name) || empty($email) 
        || empty($password) || empty($passwordConfirm) || empty($phone) || empty($address);
}

function password_passwordConfirm_match(string $password, string $confirm_password): bool {
    return $password === $confirm_password;
}

function is_email_valid(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function create_new_customer(mysqli $conn, string $first_name, string $last_name, string $email, string $password, string $phone, string $address): void {
    
    try {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        set_user($conn, $first_name, $last_name, $email, $hashed_password, $phone, $address);
    } catch (mysqli_sql_exception $e) {
        die("Query failed: " . $e->getMessage());
    } finally {
        $conn->close(); // Properly close the MySQLi connection
    }

}

function check_signup_errors(): void {
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        unset($_SESSION['errors_signup']);
    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<br>";
        echo '<p class="form-success">Signup successful!</p>';
        
        session_destroy(); 
    }
}
