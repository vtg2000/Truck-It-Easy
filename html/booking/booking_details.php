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
 <?php
if(isset($_POST['trucks']))
{
  $trucks = $_POST['trucks'];
  $_SESSION['trucks'] = $trucks;
  echo 'Initial location : ', $_SESSION['initial_loc'];
  echo '<br/>Final location : ', $_SESSION['final_loc'];
  echo '<br/>Departure time : ', $_SESSION['dep_date'];
  echo '<br/>Arrival time : ', $_SESSION['arr_date'];
  echo '<br/>Total time of travel : ', $_SESSION['time'];
  echo '<br/>Total distance : ', $_SESSION['distance'];
  echo '<br/>Truck selected : ';
  foreach ($_SESSION['trucks'] as $truck){ 
    echo $truck."<br />";
    $mytruck = $truck;
    // getting truck id here, add user_id to this truck
 }
 echo 'Goods selected : ';

foreach ($_SESSION['goods'] as $good){ 
    echo $good."<br />";
    // getting goods id here, add userid and goodsid to new table user_goods
 } 
 echo ' Quantities : ';
 foreach( $_SESSION['quantity'] as $quantity)
 {
     echo $quantity."<br/>";
 }
}
 ?>
 
 <a href='confirm_booking.php'>
 <button class='btn btn-success'>Confirm Booking</button>
</a>
 </div>
 <!-- end of main -->

 <script src="../../js/maps.js"></script>
 <script src="../../js/home.js"></script>
 <script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpKECr67jAUyEUgY95Izgo1jSHiA4LRc0&libraries=places&callback=initMap"
   async defer></script>
 <script>
   function logout() {
     console.log('hello');

   }
 </script>

 

</body>

</html>