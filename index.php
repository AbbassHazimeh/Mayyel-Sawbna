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
    <!-- NAVIBAR -->
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: rgb(0, 0, 51) !important;">
            <div class="container-fluid">
                <h3 style="color: #FFB602;">MAYEL</h3>
                <button style="background-color: #FFB602;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div style="color: #FFB602;" class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a style="color: #FFB602;" class="nav-link active" aria-current="page" href="/Views/signup.views.php">Signup</a>
                        <a style="color: #FFB602;" class="nav-link" href="/Views/login.views.php">Login</a>
                        <a style="color: #FFB602;" class="nav-link" href="#">About</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- SEARCH SECTION -->
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

    <!-- items -->
    <div class="items-div">
        <div class="card" style="width: 18rem;">
            <img src="../hotelBoking/assets/hotel-background.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary" style="background-color: rgb(0, 0, 51); ">Booking it</a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
            </div>
            <div class="contact-section">
                <p>📧 Email: <a href="mailto:contact@example.com">contact@example.com</a></p>
                <p>📞 Phone: <a href="tel:+1234567890">+1 234 567 890</a></p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>