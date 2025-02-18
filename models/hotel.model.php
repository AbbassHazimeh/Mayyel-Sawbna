<?php

include('../config/db.config.php');
function getAllHotels($conn)
{
    $query = "SELECT * FROM hotel WHERE 1";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $hotels = array();
    while ($row = $result->fetch_assoc()) {
        $hotels[] = $row;
    }
    return $hotels;
}

function getHotel($conn, int $id)
{
    $query = "SELECT * FROM hotel WHERE HOTEL_ID = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
