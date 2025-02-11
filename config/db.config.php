<?php

$host = 'localhost';
$dbname = 'hotel_booking';
$dbusername = 'root';
$dbpassword = '';

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
