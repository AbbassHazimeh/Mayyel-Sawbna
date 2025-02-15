<?php
include("../config/db.config.php");
$hotel_id = $_GET['hotel_id'];
$sql = "SELECT r.ROOM_ID, r.ROOM_PRICE, r.CAPACITY, h.HOTEL_NAME, h.LOCATION
        FROM ROOM_ r
        JOIN HOTEL h ON r.HOTEL_ID = h.HOTEL_ID
        WHERE h.HOTEL_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotel_id); // Bind the hotel ID parameter
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
$hotel_details = $rows[0];
$room_details = [];
foreach ($rows as $row) {
    $room_details[$row['ROOM_ID']] = [
        'price' => $row['ROOM_PRICE'],
        'capacity' => $row['CAPACITY']
    ];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $hotel_details['HOTEL_NAME']; ?> - Room Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/itemdetails.css">

</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="../assets/Logo.png" alt="Website Logo" class="logo" style="margin-right: 2em;">
                <button style="background-color: #FFB602;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div style="color: #FFB602;" class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="signup.views.php">Signup</a>
                        <a class="nav-link" href="login.views.php">Login</a>
                        <a class="nav-link" href="about.php">About</a>
                        <a class="nav-link" href="#footer">Contact</a>


                    </div>
                </div>
            </div>
        </nav>
    </div>

<!-- First fix the PHP/HTML structure -->
<div class="room-container">
    <h1>Rooms for <?php echo $hotel_details['HOTEL_NAME']; ?></h1>
    <p>Location: <?php echo $hotel_details['LOCATION']; ?></p>
    <?php
    $hotelFolder = "../assets";
    $hotels = array_diff(scandir($hotelFolder), array('.', '..'));
    if (!isset($_GET['hotel_id'])) {
        die("Hotel ID not provided");
    }
    $hotelId = (int)$_GET['hotel_id'];
    $targetHotel = null;
    foreach ($hotels as $hotel) {
        if (strpos($hotel, $hotelId . '_') === 0) {
            $targetHotel = $hotel;
            break;
        }
    }
    if ($targetHotel === null) {
        die("Hotel not found");
    }
    $roomsPath = $hotelFolder . "/" . $targetHotel . "/Rooms";
    if (!is_dir($roomsPath)) {
        die("Rooms directory not found");
    }
    $roomFiles = array_diff(scandir($roomsPath), array('.', '..'));
    $rooms = [];
    foreach ($roomFiles as $file) {
        if (preg_match('/Room_(\d+)H' . $hotelId . '/', $file, $matches)) {
            $roomId = $matches[1];
            if (!isset($rooms[$roomId])) {
                $rooms[$roomId] = [];
            }
            $rooms[$roomId][] = $file;
        }
    }
    ?>
<div class="image-grid">
    <?php foreach ($rooms as $roomId => $images): ?>
        <?php foreach ($images as $image): ?>
            <div class="image-box">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($roomsPath . '/' . $image); ?>"
                         class="card-img-top"
                         alt="Room <?php echo htmlspecialchars($roomId); ?> Image">
                    <p>
                    <?php echo isset($room_details[$roomId]) ? htmlspecialchars($room_details[$roomId]['price']) : 'N/A'; ?> USD, 
                    <?php echo isset($room_details[$roomId]) ? htmlspecialchars($room_details[$roomId]['capacity']) : 'N/A'; ?> guests
                    </p>
                    <a href="#"><button type="button" class="book">Book</button></a>
                    <!-- Take the user to the chckout page -->
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<footer id="footer">
    <div class="footer-container">
        <div class="footer-links">
            <a href="../index.php" class="footer-link">Home</a>
            <a href="about.php" class="footer-link">About</a>
            <a href="#" class="footer-link">Services</a>
        </div>
        <div class="contact-section">
            <p>📧 Email: <a href="mailto:mayyelsawbna@gmail.com" class="footer-link">mayyelsawbna@gmail.com</a></p>
            <p>📞 Phone: <a href="tel:+96170839736" class="footer-link">+961 70 839 736</a></p>
        </div>
    </div>
</footer>

</html>

<?php
$stmt->close();
$conn->close();
?>