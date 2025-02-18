<?php

require_once '../config/db.config.php';
require_once '../controllers/home.controller.php';
require_once '../services/home.services.php';

function displayHotels($conn){

    $hotels = getAllHotels($conn);
    foreach($hotels as $hotel){
        displayCard($hotel["HOTEL_ID"],$hotel["IMAGE_PATH"],$hotel["HOTEL_NAME"],$hotel["LOCATION"]);
    }

}

