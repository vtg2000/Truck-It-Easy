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
// login validation
?>
  <div class="div main">

    <div id='goods'>

      <?php
      $sql = 'SELECT * FROM "Services";';

      $result = pg_query($conn, $sql);

      if ($result) {
        
          echo "<div class='card-group card-group-services animate-reveal animate-first'>";

          while($row = pg_fetch_row($result)) {
              echo "<div class='card'>
                <img class='card-img-top' src='' alt='Card image cap'>
                <div class='card-body'>
                  <h5 class='card-title'>$row[1]</h5>
                  <p class='card-text'>$row[2]</p>
                  <p>Rating : $row[3]/10 </p>
                  <p class='card-text'><small class='text-muted'>$row[4]</small></p>
                  
                </div>
                </div>
              ";
          }
          echo "</div>";
      } else {
          echo "0 results";
      }
     
      
      ?>

      </div>
    </div>
    </body>
</html>