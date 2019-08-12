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
// login validation

?>
  
  <!-- main -->
  <div class="div main">
    <!-- location selector -->
    <div id='start' class='animate-reveal animate-first'>
      <h2 style='color:white; margin-left: 325px; margin-top: 100px;'>Welcome to Truck It Easy!</h2>
      <button onclick='start_booking()' class='btn btn-success'>Start booking</button>
    </div>

    <div id='location' hidden>
      <h4 class='heading' style="color:white; margin-left:300px; margin-top:100px;">Enter Starting location and
        Destination</h4>
      <form method='post' action='../booking/goods.php'>
      <div style="display: none">

        <input id="origin-input" name="initial" class="controls" required type="text"
          placeholder="Enter an origin location">

        <input id="destination-input" required name="final" class="controls" type="text"
          placeholder="Enter a destination location">


        <div id="mode-selector" class="controls">
          <input type="radio" name="type" id="changemode-walking" checked="checked">
          <label for="changemode-walking">Walking</label>

          <input type="radio" name="type" id="changemode-transit">
          <label for="changemode-transit">Transit</label>

          <input type="radio" name="type" id="changemode-driving">
          <label for="changemode-driving">Driving</label>
        </div>
      </div>
      <div style='margin-left:100px' id="map"></div>

      <button class="btn-success" type='submit'>Submit</button>
      </form>

    </div>

    <!-- amount, confirm booking -->
    <!-- billing -->

    <!-- end of main -->
  </div>

  <script src="../../js/maps.js"></script>
  <script src="../../js/home.js"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpKECr67jAUyEUgY95Izgo1jSHiA4LRc0&libraries=places&callback=initMap"
    async defer></script>
</body>
</html>