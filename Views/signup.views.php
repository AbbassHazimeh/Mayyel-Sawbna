<?php 
    require_once '../config/session.config.php';
    require_once '../services/signup.services.php'
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/signup.css" rel="stylesheet">
</head>

<body>
    <div class="form-div">
        <form action="../controllers/signup.controller.php" method="post">
        <img src="../assets/Logo.png" class="logo">
            <!-- first name -->
            <div class="input-group">
                <span>
                    <input name="first_name" class="form-control" type="text" placeholder="First Name" required>
                </span>
                <!-- last name -->
                <span>
                    <input name="last_name" class="form-control" type="text" placeholder="Last Name" required>
                </span>
            </div>
            <!-- email -->
            <span>
                <input name="email" class="form-control" type="email" placeholder="Email" required>
            </span>
            <!-- password -->
            <span>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
                <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </div>
            </span>
            <!-- confirm password -->
            <span>
                <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
            </span>
            <!-- phone and address -->
            <div class="input-group">
                <span>
                    <input name="phone" class="form-control" type="tel" placeholder="Phone Number" required>
                </span>
                <span>
                    <input name="address" class="form-control" type="text" placeholder="Address" required>
                </span>
            </div>
            <span class="button-span">
                <button type="submit" class="btn btn-warning">Submit</button>
            </span>
            <span class="button-span">
                <a href="login.views.php">Do you have an account?</a>
            </span>
            <?php check_signup_errors(); ?>
        </form>
    </div>
    <div class="second-div">
        <h1 style="color: white;">Register Now!</h1>
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