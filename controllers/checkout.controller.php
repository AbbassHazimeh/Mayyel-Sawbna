<?php

require_once __DIR__ . '/../models/room.model.php';
require_once __DIR__ . '/../services/checkout.sevices.php';
require_once __DIR__ . '/../models/booking.model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $check_in = $_POST['check-in-date'];
    $check_out = $_POST['check-out-date'];
    $payment_method = $_POST['payment-method'];
    $guests = (int) $_POST['guests'];
    $payment_amount = (float) $_POST['amount'];
    $date = date("Y-m-d");
    $token = $_POST['csrf_token'];

    if (!isset($_SESSION["csrf_token"]) || $token !== $_SESSION['csrf_token']) {
        header('Location: ../views/login.views.php');
        exit;
    }
    echo '1111111';
    $payment_error = [];
    if (empty_input($check_in, $check_out, $payment_method, $guests, $payment_amount)) {
        $payment_error['input_empty'] = "Invalid request, some input empty!";
    }
    echo '222222';
    if ($guests <= 0 || null) {
        $payment_error['invalid_guests'] = "Number of guests must be at least 1.";
    }
    echo '333333';
    if (strtotime($check_out) <= strtotime($check_in)) {
        $payment_error['invalid_dates'] = "Check-out date must be after check-in date.";
    }
    echo '44444';
    if (!empty($payment_error)) {
        $_SESSION["errors_payment"] = $payment_error;
        header("Location: ../Views/checkout.views.php");
        exit;
    }
    echo '555555';
    $newPayment = newPayment($conn, $payment_amount, $date, $payment_method);
    echo '666666';
    if ($newPayment) {
        $newBooknig = newBooking($conn, $newPayment, $_SESSION['user_id'], $check_in, $check_out, $guests);
        echo '777777';
        if ($newBooknig) {
            header('Location: ../Views/booking.views.php');
            echo '888888';
            exit;
        } else {
            header('Location: ../Views/checkout.views.php');
            echo '99999';
            exit;
        }
    } else {
        header('Location: ../Views/checkout.views.php');
        echo '10101010';
        exit;
    }
} 

function setPathRoom(mysqli $conn, int $room_id)
{
    $room = getRoomById($conn, $room_id);
    $room_path = $room['PATH_IMG'];
    setRoomImage($room_path);
}

function setInfoRoom(mysqli $conn, int $room_id, string $hotel_name)
{
    $room = getRoomById($conn, $room_id);
    $capacity = $room['CAPACITY'];
    $price = $room['ROOM_PRICE'];
    RoomInformation($hotel_name, $capacity, $price);
}
