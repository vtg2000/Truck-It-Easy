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
<nav class="navbar navbar-dark fixed-top">
    <a class="navbar-brand" href="home.php">Truck It Easy</a>
    <a class="nav-item nav-link" style="color:white"><?php echo $_SESSION['user1'][0];  ?></a>
    <a class="nav-item nav-link" onclick="logout()" href="login.php" style="text-decoration:none; color:white;">Logout</a>
  </nav>

  <!-- sidebar -->
  <div class="sidenav">
    <a href="home.php">Home</a>
    <a href="services.php">Services</a>
    <a href="#">My Orders</a>
    <a href="#">Contact Us</a>
  </div>

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