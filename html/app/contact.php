<?php include("sidebar.php"); ?>
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

   <div class="div main">
   <h4 class='heading' style="color:white; margin-top:80px">Contact Us</h4>
        <div id='contact' style='color:white' class='animate-reveal animate-first'>
        <br>
        <br>
        <div style='margin-left: 320px'>
        <h2>How can we help?
        </h2>
        <br>

        <p>Email us at <a href="mailto:support@truckiteasy.com">support@truckiteasy.com</a></p>
        <p>Or call our 24/7 helpline : 9167309967</p>
        </div>
        </div>
   </div>
</body>
</head>
     