<?php 
    require_once '../config/session.config.php';
    require_once '../services/login.services.php'
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/signup.css" rel="stylesheet">
</head>

<body>
    <div class="form-div">
        <form action="../controllers/login.controller.php" method="post">
        <img src="../assets/Logo.png" class="logo">
            <span>
                <input name="email" class="form-control" type="email" placeholder="Email" require>
            </span>
            <span>
                <input name="password" type="password" class="form-control" placeholder="Password" require>
            </span>
            <span class="button-span">
                <button type="submit" class="btn btn-warning">Submit</button>
            </span>
            <span class="button-span">
                <a href="signup.views.php">Signup</a>
            </span>
            <?php check_login_errors(); ?>
        </form>
        
    </div>
    <div class="second-div">
        <h1 style="color: white;">Welcome..!</h1>
        <div class="logo-div">
            <div>
            <img src="../assets/Logo.png">
            </div>
            <h3>
                Find Your Perfect Stay,<br> <span>Anytime</span>,<br> <span>Anywhere...</span>
            </h3>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>