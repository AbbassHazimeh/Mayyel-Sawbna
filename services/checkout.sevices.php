<?php
session_start();
require_once(dirname(__DIR__) . "../models/room.model.php");
require_once(dirname(__DIR__) . "../config/db.config.php");



function DisplaypaymentContainer()
{

    echo '
        <form class="from-class" method="post" action="../controllers/checkout.controller.php">
    <span>
        <label for="check-in-date">Check in date</label>
        <input id="check_in" onChange="calculateAmount()" name="check-in-date" class="form-control" type="date" required>
    </span>

    <span>
        <label for="check-out-date">Check out date</label>
        <input id="check_out" onChange="calculateAmount()" name="check-out-date" class="form-control" type="date" required>
    </span>

    <span>
        <label for="guests">Guests</label>
        <input name="guests" class="form-control" type="number" required>
    </span>

    <span>
        <label for="amount">Amount ($)</label>
        <input id="amount" name="amount" class="form-control" type="number" placeholder="Amount in $" required readonly>
    </span>

    <span>
        <label for="payment-method" style="display: block;">Payment Method</label>
        <select name="payment-method" required>
            <option value="PayPal">PayPal</option>
            <option value="Visa">Visa</option>
            <option value="Mastercard">Mastercard</option>
        </select>
    </span>

    <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">

    <span>
        <button type="submit" name="confirm">Confirm</button>
    </span>
    </form>';
}

function RoomInformation(string $hotel_name, int $capacity, float $price)
{
    echo '
      <h1>' . $hotel_name . '</h1>
      <h4>Room for ' . $capacity . ' person</h4>
      <h4 id="price">' . $price . '$ per day</h4>
    ';
}

function setRoomImage(string $path)
{
    echo '
        <img class="image-class" src="' . $path . '" alt="room image" >';
}

function empty_input(string $check_in, string $check_out, string $payment_method, int $guests, float $payment_amount){
   return empty($check_in) || empty($check_out) || empty($payment_method) || empty($guests) || empty($payment_amount);
}

// errors
function check_booking_errors(): void {
    if (isset($_SESSION['input_empty'])) { 
        $errors = $_SESSION['input_empty']; 
        echo "<br>";
        foreach ($errors as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        unset($_SESSION['errors_login']);
    } 
}

