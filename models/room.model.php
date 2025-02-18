<?php

declare(strict_types=1);
require_once __DIR__ . "/../config/db.config.php";                    

function getAllRooms($conn)
{
    $query = "SELECT * FROM room_ WHERE 1";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = array();
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    return $rooms;
}


function getRoomById(mysqli $conn ,int $room_id) {

    $query = "SELECT * FROM room_ WHERE ROOM_ID = ?;";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $room_id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

