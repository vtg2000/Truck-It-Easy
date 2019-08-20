<?php include("../app/sidebar.php"); ?>
<html>

<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
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

            <form method='post' action='confirm_booking.php'>

                <!-- Credit card form content -->
                <div class="tab-content" style='width:500px; margin-left: 200px'>

                    <!-- credit card info-->
                    <div id="nav-tab-card" class="tab-pane fade show active">

                        <div class="form-group">
                            <label for="username">Full name (on the card)</label>
                            <input type="text" name="full_name" placeholder=<?php echo $_SESSION['user1'][0];?> required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Card number</label>
                            <div class="input-group">
                                <input type="text" name="card_number" placeholder="Your card number" class="form-control"
                                    required>
                                <div class="input-group-append">
                                    <span class="input-group-text text-muted">
                                        <i class="fa fa-cc-visa mx-1"></i>
                                        <i class="fa fa-cc-amex mx-1"></i>
                                        <i class="fa fa-cc-mastercard mx-1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><span class="hidden-xs">Expiration</span></label>
                                    <div class="input-group">
                                        <input type="number" placeholder="MM" name="month" class="form-control" required>
                                        <input type="number" placeholder="YY" name="year" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
                                        <i class="fa fa-question-circle"></i>
                                    </label>
                                    <input type="text" name='cvv' required class="form-control">
                                </div>

                            </div>

                        <div class="row" style='margin-left: 30px'>
                        <label>Payment amount (Rs)</label>
                        <input name='amount' style='margin-left: 30px' readonly value=<?php echo $_SESSION['fare'];?>>
                        </div>




                        </div>

                    </div>
                    <!-- End -->


                </div>
                <a href='confirm_booking.php'>
                    <button class='btn btn-success' type='submit' style='margin-left: 340px'>Confirm Booking and Pay</button>
                </a>
            </form>
        </div>


</body>
</head>