<?php
session_start();
require_once __DIR__ ."/../models/booking.model.php";
require_once __DIR__ ."/../config/db.config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="../css/booking.css" rel="stylesheet">
    <title>Booking</title>
</head>
<body>
<div class="nav-bar">
        <nav>
            <h1>Booking Queue</h1>
        </nav>
    </div>
    <div>
        <?php
              $books = getAllBooking($conn, 1);
              foreach($books as $book){
                  echo "<div class='booking'>";
                  echo "<h3>Booking ID: ".$book['BOOKING_ID']."</h3>";
                  echo "<p>Check In Date: ".$book['CHECK_IN_DATE']."</p>";
                  echo "<p>Check Out Date: ".$book['CHECK_OUT_DATE']."</p>";
                  echo "<p>Number of Guests: ".$book['NUMBER_OF_GUESTS_']."</p>";
                  echo "</div>";
              }
         ?>
    </div>
</body>
</html>