
<?php
include("config/db.config.php");
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/home.css" rel="stylesheet">
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" >
            <div class="container-fluid">
                <img src="assets/Logo.png" alt="Website Logo" class="logo" style="margin-right: 2em;">
                <button style="background-color: #FFB602;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div style="color: #FFB602;" class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="/Views/signup.views.php">Signup</a>
                        <a class="nav-link" href="/Views/login.views.php">Login</a>
                        <a class="nav-link" href="#footer">About</a>
                        <a class="nav-link" href="#footer">Contact</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="first-div">
        <input class="form-control search-input" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
        <datalist id="datalistOptions">
            <option value="San Francisco">
            <option value="New York">
            <option value="Seattle">
            <option value="Los Angeles">
            <option value="Chicago">
        </datalist>
        <button id="search-button">Search</button>
    </div>
    <div class="items-div">
    <?php
$hotelFolder = "assets";
$hotels = array_diff(scandir($hotelFolder), array('.', '..'));
$counter = 1;
foreach ($hotels as $hotel) {
    $hotelPath = $hotelFolder . "/" . $hotel;
    if (is_dir($hotelPath)) {
        $mainImage = $hotelPath . "/" . $hotel . ".jpg";
        $hotelName = str_replace("_", " ", $hotel);
        $hotelName = substr($hotelName, 1);
        if (file_exists($mainImage)) {
            // Prepare SQL statement
            $stmt = $conn->prepare("SELECT LOCATION FROM hotel WHERE HOTEL_ID = ?");
            $stmt->bind_param("i", $counter);  
            $stmt->execute();
            $stmt->bind_result($location);  
            $stmt->fetch();  
            $stmt->close();
            
            echo '
                <div class="card" style="width: 18rem;">
                    <img src="' . htmlspecialchars($mainImage) . '" class="card-img-top" alt="' . htmlspecialchars($hotelName . ' Hotel') . '">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($hotelName) . '</h5>
                        <p class="card-text">' . htmlspecialchars($location) . '</p>
                        <a href="../Views/itemdetails.php?hotel_id='.$counter.'" class="btn btn-primary" style="background-color: rgb(0, 0, 51);">Booking it</a>
                    </div>
                </div>';
            $counter++;  
        } else {
            echo "<!-- Image not found: " . htmlspecialchars($mainImage) . " -->\n";
        }
    }
}
?>

</div>
    <footer id="footer">
        <div class="footer-container">
            <div class="footer-links">
                <a href="index.php" class="footer-link">Home</a>
                <a href="/Views/about.php" class="footer-link">About</a>
                <a href="#" class="footer-link">Services</a>
            </div>
            <div class="contact-section">
                <p>📧 Email: <a href="mailto:mayyelsawbna@gmail.com" class="footer-link">mayyelsawbna@gmail.com</a></p>
                <p>📞 Phone: <a href="tel:+96170839736" class="footer-link">+961 70 839 736</a></p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>