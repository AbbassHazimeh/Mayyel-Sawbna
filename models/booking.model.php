<?php

require_once(dirname(__DIR__) .'../config/db.config.php');

function newPayment(mysqli $conn, float $amount, string $payment_date, string $payment_method ) {
    $query = "INSERT INTO `payment` (`AMOUNT`, `PAYMENT_DATE`, `PAYMENT_METHOD_`) 
              VALUES (?, ?, ?);";

    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die($conn->error);
    }

    $stmt->bind_param("dss", $amount, $payment_date, $payment_method);

    if ($stmt->execute()) {
        $payment_id = $stmt->insert_id; 
        $stmt->close();
        return $payment_id;
    } else {
        $stmt->close();
        return false;
    }
}


function newBooking(mysqli $conn, int $payment_id, int $customer_id, string $check_in_date, string $check_out_date, int $number_of_guests) {
    $query = "INSERT INTO `booking` (`PAYMENT_ID`, `CUSTOMER_ID`, `CHECK_IN_DATE`, `CHECK_OUT_DATE`, `NUMBER_OF_GUESTS_`)
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iissi", $payment_id, $customer_id, $check_in_date, $check_out_date, $number_of_guests);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function getAllBooking(mysqli $conn, $customer_id){
   $query = "SELECT * FROM booking WHERE CUSTOMER_ID = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $customer_id);
   $stmt->execute();
   $result = $stmt->get_result();
   
   $bookings = array();
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    return $bookings;
}