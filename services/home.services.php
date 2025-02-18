<?php

function displayCard(int $id,string $path,string $hotelName,string $location){
    echo '
    <div class="card" style="width: 18rem;">
        <img src="'. $path .' " class="card-img-top" alt="' . htmlspecialchars($hotelName . ' Hotel') . '">
        <div class="card-body">
            <h5 class="card-title">' . htmlspecialchars($hotelName) . '</h5>
            <p class="card-text">' . htmlspecialchars($location) . '</p>
            <a href="Views/itemdetails.php?hotel_id=' . $id . '" class="btn btn-primary" style="background-color: rgb(0, 0, 51);">Booking it</a>
        </div>
    </div>';
}

?>