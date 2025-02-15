<?php
$hotelFolder = "../Hotel_Booking/assets";
$hotels = array_diff(scandir($hotelFolder), array('.', '..')); 

foreach ($hotels as $hotel) {
    $hotelPath = $hotelFolder . $hotel;
    
    if (is_dir($hotelPath)) {
        echo "<h2>$hotel</h2>";

        // Display main hotel image
        $mainImage = $hotelPath . "/Hotel.jpg";
        if (file_exists($mainImage)) {
            echo "<img src='$mainImage' alt='Main image of $hotel' width='200'><br>";
        }

        // Display room images
        $roomsPath = $hotelPath . "/Rooms";
        if (is_dir($roomsPath)) {
            $rooms = array_diff(scandir($roomsPath), array('.', '..'));
            foreach ($rooms as $room) {
                $roomImage = $roomsPath . "/" . $room;
                echo "<img src='$roomImage' alt='Room in $hotel' width='150' style='margin:5px;'>";
            }
        }
        echo "<hr>";
    }
}
?>
