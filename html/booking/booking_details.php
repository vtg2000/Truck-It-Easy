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
 <nav aria-label="breadcrumb" >
  <ol class="breadcrumb" style='background-color:transparent'>
    <li class="breadcrumb-item"><a href="../app/home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="goods.php">Goods</a></li>
    <li class="breadcrumb-item"><a href="trucks.php">Trucks</a></li>
    <li class="breadcrumb-item active" aria-current="page">Details</li>
  </ol>
</nav>

<h4 class='heading' style="color:white">Booking Details</h4>
 <div style='text-align:justify' class='animate-reveal animate-first'>
 <?php
if(isset($_POST['trucks']))
{
  $truck_fare = 0;
  $goods_fare = 0;
  $trucks = $_POST['trucks'];
  $_SESSION['trucks'] = $trucks;
  echo 'Initial location : ', $_SESSION['initial_loc'], '';
  echo '<br/>Final location    : ', $_SESSION['final_loc'];
  echo '<br/>Departure time : ', $_SESSION['dep_date'];
  echo '<br/>Arrival time : ', $_SESSION['arr_date'];
  echo '<br/>Total time of travel : ', $_SESSION['time'];
  echo '<br/>Total distance : ', $_SESSION['distance'];
  echo '<br/>Truck selected : ';

  $distance = (int)str_replace(' km','', $_SESSION['distance']);
  foreach ($_SESSION['trucks'] as $truck){ 
    
    $mytruck = $truck;
    $sql = 'SELECT * FROM "Trucks" where "truck_id"=$1;';
    $result = pg_query_params($conn, $sql, array($mytruck));
    while($row = pg_fetch_row($result)){
    echo $row[1]."<br />";
    
    $truck_fare = $truck_fare +  $distance * $row[6];
    
    }
    
 }
 echo 'Goods selected : <br>';
 
 $i = 0;

foreach ($_SESSION['goods'] as $good){ 
    
    $sql = 'SELECT * FROM "Goods" where "goods_id"=$1;';
    $result = pg_query_params($conn, $sql, array($good));
    while($row = pg_fetch_row($result)){
    echo $row[1] . ' &nbsp &nbsp';
    echo 'Quantity : ', $_SESSION['quantity'][$i], '<br/>';
    $goods_fare = $goods_fare + $distance * $row[5] * $_SESSION['quantity'][$i];
    $i = $i + 1;
    }
    
 } 

 echo 'Total fare : ', $truck_fare + $goods_fare, ' Rs </br>';
 $_SESSION['fare'] = $truck_fare + $goods_fare;
}
  
 ?>
 </div>
 
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