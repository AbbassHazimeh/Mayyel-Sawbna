<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // trim to remove the space from beginning and end of the string
    // htmlspecialchars for preventing XSS(cross-site scripting) attacks
    // because htmlspecialchars handle only "", ENT_QUOTES ensure handle '' also

    $first_name = htmlspecialchars(trim($_POST["first_name"]), ENT_QUOTES, 'UTF-8');
    $last_name = htmlspecialchars(trim($_POST["last_name"]), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST["email"]), ENT_QUOTES, 'UTF-8');
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $phone = htmlspecialchars(trim($_POST["phone"]), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST["address"]), ENT_QUOTES, 'UTF-8');

    require_once __DIR__ . "/../config/db.config.php";
    require_once __DIR__ . "/../models/user.model.php";
    require_once __DIR__ . "/../services/signup.services.php";
    require_once __DIR__ . "/../config/session.config.php";

    $errors = [];

    // Validate inputs
    if (is_input_empty($first_name, $last_name, $email, $password, $confirm_password, $phone, $address)) {
        $errors["empty_input"] = "Fill in all fields";
    }
    if (!password_passwordConfirm_match($password, $confirm_password)) {
        $errors["password_not_match"] = "Password and Password Confirm do not match";
    }
    if (!is_email_valid($email)) {
        $errors["invalid_email"] = "Invalid email used!";
    }

    // If there are validation errors, store them in the session and redirect
    if (!empty($errors)) {
        $_SESSION["errors_signup"] = $errors;
        header("Location: ../views/signup.views.php");
        exit;
    }

    create_new_customer($conn, $first_name, $last_name, $email, $password, $phone, $address);
    // Redirect to login page upon success
    $_GET["signup"] = "success";
    header("Location: ../views/login.views.php");
    exit;

   
} else {
    header("Location: ../views/signup.views.php");
    exit;
}
