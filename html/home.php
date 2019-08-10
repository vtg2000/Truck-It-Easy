<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/welcome.css">

  <title>Truck It Easy</title>
</head>

<body>


<?php
session_start();

// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");
// login validation

?>
  <!-- navbar -->
  <?php if($_SESSION['user1']):
  ?>
  <nav class="navbar navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Truck It Easy</a>
    <a class="nav-item nav-link" style="color:white"><?php echo $_SESSION["user1"][0];  ?></a>
    <a class="nav-item nav-link" onclick="logout()" href="login.php" style="text-decoration:none; color:white;">Logout</a>
  </nav>

  <!-- sidebar -->
  <div class="sidenav">
    <a href="home.php">Home</a>
    <a href="services.php">Services</a>
    <a href="#">My Orders</a>
    <a href="#">Contact Us</a>
  </div>

  <!-- main -->
  <div class="div main">
    <!-- location selector -->
    <div id='location' class='animate-reveal animate-first'>
      <h4 class='heading' style="color:white; margin-left:300px; margin-top:100px;">Enter Starting location and Destination</h4>
      
      <div style="display: none">
        <input id="origin-input" class="controls" required type="text" placeholder="Enter an origin location">

        <input id="destination-input" class="controls" type="text" placeholder="Enter a destination location">

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
      
      
      <button class="btn-success" onclick='hideloc()' >Submit</button>
      
    
    </div>

    <!-- goods selector -->
    <div id='goods' hidden=true>
      <h4 class='heading' style="color:white">Select the goods</h4>
      <?php
      $sql = 'SELECT * FROM "Goods";';

      $result = pg_query($conn, $sql);

      if ($result) {
        
          echo "<div class='card-group'>";

          while($row = pg_fetch_row($result)) {
              echo "<div class='card'>
                <img class='card-img-top' src='' alt='Card image cap'>
                <div class='card-body'>
                  <h5 class='card-title'>$row[1]</h5>
                  <p class='card-text'>$row[7]</p>
                  <p>Weight : $row[3] Kgs</p>
                  <p class='card-text'><small class='text-muted'>$row[2]</small></p>
                  <input type='checkbox'>
                </div>
                </div>
              ";
          }
          echo "</div>";
      } else {
          echo "0 results";
      }
      
      ?>
      <button class="btn-success" onclick='hidegoods()'>Submit</button>
    </div>

    <!-- truck selector -->
    <div id='truck' hidden=true>
      <h4 class='heading' style="color:white">Select the Truck</h4>
      <?php
      $sql = 'SELECT * FROM "Trucks";';

      $result = pg_query($conn, $sql);

      if ($result) {
        
          echo "<div class='card-group'>";

          while($row = pg_fetch_row($result)) {
              echo "<div class='card'>
                <img class='card-img-top' src='' alt='Card image cap'>
                <div class='card-body'>
                  <h5 class='card-title'>$row[1]</h5>
                  <p class='card-text'>$row[7]</p>
                  <p>Capacity : $row[2] Kgs</p>
                  <p class='card-text'><small class='text-muted'>Driver : $row[3]</small></p>
                  <p class='card-text'><small class='text-muted'>Contact : $row[4]</small></p>
                  <input type='checkbox'>
                </div>
                </div>
              ";
          }
          echo "</div>";
      } else {
          echo "0 results";
      }
      
      ?>
      <button class="btn-success">Submit</button>
    </div>
    <!-- amount, confirm booking -->
    <!-- billing -->

  <!-- end of main -->
  </div>
    <?php else:
      header("Location: http://localhost/Smart-Goods-System/html/login.php"); 
      exit(); ?>
    <?php endif; ?>

  <script src="../js/maps.js"></script>
  <script src="../js/home.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpKECr67jAUyEUgY95Izgo1jSHiA4LRc0&libraries=places&callback=initMap"
    async defer></script>
    <script>
    
    function logout(){
      console.log('hello');
      
    }</script>

   
</body>

</html>
