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
  <!-- breadcrumb -->
  <nav aria-label="breadcrumb"  >
  <ol class="breadcrumb" style='background-color:transparent'>
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  
    <li class="breadcrumb-item"><a href="../booking/location.php">Location</a></li>
    
    <?php if(isset($_SESSION['time']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/goods.php">Goods</a></li>';
    } ?>
    <?php if(isset($_SESSION['goods']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/trucks.php">Trucks</a></li>';
    } ?>
    <?php if(isset($_SESSION['trucks']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/insurance.php">Insurance</a></li>';
    } ?>
    <?php if(isset($_SESSION['insurance']) || isset($_SESSION['trucks']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/booking_details.php">Details</a></li>';
    } ?>
        <?php if(isset($_SESSION['fare']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/payment.php">Payment</a></li>';
    } ?>
  </ol>
  </nav>
    <!-- location selector -->
    <div id='start' class='animate-reveal animate-first'>
      <h2 style='color:white; margin-left: 325px;  '>Welcome to Truck It Easy!</h2>
      <a href='../booking/location.php' style='text-decoration:none'>
      <button class='btn btn-success' style='margin-bottom: 10px'>Start booking</button>
      </a>
    </br>

    <?php if(isset($_SESSION['fare']) || isset($_SESSION['insurance']))
    {
      echo "
      <a href='../booking/booking_details.php'>
      <button class='btn btn-success' style='margin-left:435px;'>Continue booking</button>
      </a>
      ";
    }
    elseif(isset($_SESSION['trucks']))
    {
      echo "
      <a href='../booking/insurance.php'>
      <button class='btn btn-success' style='margin-left:435px'>Continue booking</button>
      </a>
      ";
    }
    elseif(isset($_SESSION['goods']))
    {
      echo "
      <a href='../booking/trucks.php'>
      <button class='btn btn-success' style='margin-left:435px'>Continue booking</button>
      </a>
      ";
    }
    elseif(isset($_SESSION['time']))
    {
      echo "
      <a href='../booking/goods.php'>
      <button class='btn btn-success' style='margin-left:435px'>Continue booking</button>
      </a>
      ";
    }
      ?>
    

    
      
    </div>

    
  </div>

  <script src="../../js/maps.js"></script>
  <script src="../../js/home.js"></script>

</body>
</html>