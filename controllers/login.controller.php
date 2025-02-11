<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = htmlspecialchars(trim($_POST["email"]), ENT_QUOTES, 'UTF-8');
    $password = trim($_POST["password"]);

    try {
        require_once '../config/db.config.php';
        require_once '../services/login.services.php';
        require_once '../models/user.model.php';
        require_once '../config/session.config.php';

        $errors = []; 

        if (!is_email_valid($email)) {
            $errors['invalid_email'] = 'Invalid email, please try again';
        }

        if (!compare_passwords($conn, $email, $password)) {
            $errors['incorrect_password'] = 'Incorrect password';
        }

        if (!empty($errors)) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../views/login.views.php");
            exit;
        } else {
            
            $customer = get_user_byemail($conn, $email);
            $_SESSION["user_id"] = $customer["CUSTOMER_ID"];

            $token = generateToken();
            $_SESSION["csrf_token"] = $token;
            header("Location: ../index.php");
            $conn->close(); // Properly close MySQLi connection
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../views/signup.views.php");
    exit;
}
