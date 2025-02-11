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
            <h2 style="color: #FFB602">MAYEL <sub>sawbna</sub></h2>
            <!-- email -->
            <span>
                <input name="email" class="form-control" type="email" placeholder="Email" require>
            </span>
            <!-- password -->
            <span>
                <input name="password" type="password" class="form-control" placeholder="Password" require>
                <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </div>
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
        <h1 style="color: #FFB602;">Welcome..!</h1>
        <div class="logo-div">
            <div>
                <h1>MAYEL<br>SAWBNA</h1>
            </div>
            <h3>
                Find Your Perfect Stay,<br> Anytime,<br> Anywhere.
            </h3>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>