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
// storing booking info in session variables
if(isset($_POST['initial']))
{
  $_SESSION['initial_loc'] = $_POST['initial'];
  $_SESSION['final_loc'] = $_POST['final'];
}
?>

  <?php

// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");

?>

  <!-- main -->
  <div class="div main">
    <!-- goods selector -->
    <div id='goods' class='animate-reveal animate-first'>
      <form type='post' action='trucks.php'>
        <h4 class='heading' style="color:white">Select the Goods</h4>
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
                  <input type='checkbox' name=$row[0]>
                </div>
                </div>
              ";
          }
          echo "</div>";
      } else {
          echo "0 results";
      }
      
      ?>
        <button class="btn-success" type='submit'>Submit</button>
      </form>
    </div>
    <!-- end of main -->
  </div>


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