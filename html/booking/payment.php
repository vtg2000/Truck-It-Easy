<?php include("../app/sidebar.php"); ?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/welcome.css">

    <title>Truck It Easy</title>
</head>

<body>

    <?php

// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");

?>

    <!-- main -->
    <div class="div main" style='color:white'>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style='background-color:transparent'>
                <li class="breadcrumb-item"><a href="../app/home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../booking/location.php">Location</a></li>
                <li class="breadcrumb-item"><a href="goods.php">Goods</a></li>
                <li class="breadcrumb-item"><a href="trucks.php">Trucks</a></li>
                <li class="breadcrumb-item"><a href="booking_details.php">Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
        </nav>
    <div>
    <?php echo 'Payment amount : ', $_SESSION['fare'], ' Rs';?>
    </div>
    <a href='confirm_booking.php'>
    <button class='btn btn-success'>Confirm Booking and pay</button>
    </a>

    </div>


</body>
</head>