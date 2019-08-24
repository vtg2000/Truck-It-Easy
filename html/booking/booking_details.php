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
    <li class="breadcrumb-item"><a href="../booking/location.php">Location</a></li>
    <li class="breadcrumb-item"><a href="goods.php">Goods</a></li>
    <li class="breadcrumb-item"><a href="trucks.php">Trucks</a></li>
    <li class="breadcrumb-item active" aria-current="page">Details</li>
    <?php if(isset($_SESSION['fare']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/payment.php">Payment</a></li>';
    } ?>
  </ol>
</nav>

<h4 class='heading' style="color:white">Booking Details</h4>
 <div style='text-align:justify; margin-left: 100px' class='animate-reveal animate-first'>
 <?php
if(isset($_POST['trucks']))
{
  
  $trucks = $_POST['trucks'];
  $_SESSION['trucks'] = $trucks;
}
$truck_fare = 0;
  $goods_fare = 0;
  // $_SESSION['trucks'] = $trucks;
  echo 'Initial location <b>: ', $_SESSION['initial_loc'], '</b>';
  echo '<br/>Final location    <b>: ', $_SESSION['final_loc'], '</b>';
  echo '<br/>Departure time <b>: ', $_SESSION['dep_date'], '</b>';
  echo '<br/>Arrival time <b>: ', $_SESSION['arr_date'], '</b>';
  echo '<br/>Total time of travel <b>: ', $_SESSION['time'], '</b>';
  echo '<br/>Total distance <b>: ', $_SESSION['distance'], '</b>';
  

  $distance = (int)str_replace(' km','', str_replace(',','',$_SESSION['distance']));

 echo '<br>Goods selected : <br>';
 
 $i = 0;
 echo "<div class='card-group'>";
foreach ($_SESSION['goods'] as $good){ 
    
    $sql = 'SELECT * FROM "Goods" where "goods_id"=$1;';
    $result = pg_query_params($conn, $sql, array($good));
    
    while($row = pg_fetch_row($result)){
    // echo $row[1] . ' &nbsp &nbsp';
    echo "<div class='card'>
                <input class='rowid' value=$row[0] hidden></input>
                <img class='card-img-top' style='height:150px' src=$row[4] alt='Card image cap'>
                <div class='card-body'>
                  <h5 class='card-title'>$row[1]</h5>
                  <p class='card-text'>$row[6]</p>
                  <p>Weight : $row[3] Kgs</p>
                  <p class='card-text'><small class='text-muted'>$row[2]</small></p>
                  <span>Quantity: ",$_SESSION['quantity'][$i], "<span id='demo$row[0]'></span> </span>
                </div>
                </div>
              ";
    
    
    $goods_fare = $goods_fare + $distance * $row[5] * $_SESSION['quantity'][$i];
    $i = $i + 1;
    }
   
    
 } 
 echo "</div>";

 echo 'Truck selected : ';
 foreach ($_SESSION['trucks'] as $truck){ 
    
  $mytruck = $truck;
  $sql = 'SELECT * FROM "Trucks" where "truck_id"=$1;';
  $result = pg_query_params($conn, $sql, array($mytruck));
  echo "<div class='card-group'>";
  while($row = pg_fetch_row($result)){
    echo "<div class='card'>
    <img class='card-img-top' src=$row[5] alt='Card image cap'>
    <div class='card-body'>
      <h5 class='card-title'>$row[1]</h5>
      <p class='card-text'>$row[7]</p>
      <p>Capacity : $row[2] Kgs</p>
      <p class='card-text'><small class='text-muted'>Driver : $row[3]</small></p>
      <p class='card-text'><small class='text-muted'>Contact : $row[4]</small></p>
    </div>
    </div>
  ";
  
  $truck_fare = $truck_fare +  $distance * $row[6];
  
  }
  echo "</div>";
  
}
 echo '<b>Total fare : ', $truck_fare + $goods_fare, ' Rs </b></br>';
 $_SESSION['fare'] = $truck_fare + $goods_fare;
 
  
 ?>
 <a href='payment.php'>
 <button class='btn btn-success topay'>Proceed to Payment</button>
</a>
 </div>
 
 
 </div>
 <!-- end of main -->

 
 <script src="../../js/home.js"></script>
 </script>

 

</body>

</html>