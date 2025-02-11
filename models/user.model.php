<?php

declare(strict_types=1);
require_once __DIR__ . "/../config/db.config.php";

function get_name(mysqli $conn, string $first_name, string $last_name)
{
    $query = "SELECT FIRST_NAME, _LAST_NAME FROM CUSTOMER WHERE FIRST_NAME = ? AND _LAST_NAME = ?";
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("ss", $first_name, $last_name);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();  // Returns associative array
}

function get_email(mysqli $conn, string $email)
{
    $query = "SELECT _EMAIL FROM CUSTOMER WHERE _EMAIL = ?";
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function set_user(mysqli $conn, string $first_name, string $last_name, string $email, string $_password, string $phone, string $_address)
{
    try {
        $query = "INSERT INTO customer (FIRST_NAME, _LAST_NAME, _EMAIL, _PASSWORD, PHONE_NUMBER, ADDRESS) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $_password, $phone, $_address);

        $stmt->execute();

        echo "User successfully registered!";
    } catch (mysqli_sql_exception $e) {
        echo 'ERROR REGISTERED: ' . $e->getMessage(); 
    }
}

function get_user_byemail(mysqli $conn, string $email)
{
    $query = "SELECT * FROM customer WHERE _EMAIL = ?";
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>
