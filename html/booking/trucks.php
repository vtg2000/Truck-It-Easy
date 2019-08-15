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
  <div class="div main">
   <!-- truck selector -->
   <div id='truck' class='animate-reveal animate-first'>
   <form method='post' action='booking_details.php'>
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
                  <input type='checkbox' name='trucks[]' value=$row[0]>
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
 

  <!-- <script src="../../js/maps.js"></script> -->
  <script src="../../js/home.js"></script>
 

<?php
if(isset($_POST['goods']))
{
  $goods = $_POST['goods'];
  $quantities = $_POST['quantity'];
  $_SESSION['goods'] = $goods;
  $_SESSION['quantity'] = [];
  // echo 'hiii', $_POST['quantity'];
  foreach ($quantities as $quantity){
    if($quantity != 0)
    {
      // echo 'inside if',$quantity;
      array_push($_SESSION['quantity'], $quantity);
    
    }
    // getting goods id here, add userid and goodsid to new table user_goods
 }
}
else
{
  echo 'noo yada';
}


?>
</body>

</html>