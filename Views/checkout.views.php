<?php
// $room_id = $_GET["room_id"];
require_once __DIR__ . "/../config/db.config.php";
require_once __DIR__ . "/../services/checkout.sevices.php";
require_once __DIR__ . '/../controllers/checkout.controller.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/home.css" rel="stylesheet">
    <link href="../css/checkout.css" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <div class="nav-bar">
        <nav>
            <h1>Checkout</h1>
        </nav>
    </div>
    <div>
        <?php check_booking_errors(); ?>
    </div>
    <!-- Body of the Checkout -->
    <main>
        <div class="room-image">
            <?php setPathRoom($conn, 3) ?>
        </div>

        <div class="room-info">
            <div class="about-room">
                <?php setInfoRoom($conn, 3, "ALI"); ?>
            </div>
            <div>
                <?php DisplaypaymentContainer(); ?>
            </div>

        </div>
    </main>
    <script>
        function calculateAmount() {
            let check_in = document.getElementById('check_in').value;
            let check_out = document.getElementById('check_out').value;
            let priceText = document.getElementById('price').textContent;
            let amount = document.getElementById('amount');

            if (!check_in || !check_out) return;

            const price = parseFloat(priceText.slice(0, 3));
            const out_date = new Date(check_out);
            const outDate_int = out_date.getTime();
            const in_date = new Date(check_in);
            const inDate_int = in_date.getTime();

            if (out_date <= in_date) {
                amount.value = 0;
                return;
            }

            difference_in_millisecond = outDate_int - inDate_int;
            difference_in_days = difference_in_millisecond / (1000 * 60 * 60 * 24);
            amount.value = difference_in_days * price ;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>