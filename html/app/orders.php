<?php include("sidebar.php"); ?>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/home.css">
  <link rel="stylesheet" href="../../css/welcome.css">
  <link rel="stylesheet" href="../../css/orders.css">


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

   <div class="div main">
   <h4 class='heading' style="color:white; margin-top:80px">Your orders</h4>
        <div id='orders' style='color:white' class='animate-reveal animate-first'>

        
        <?php
        $sql = 'SELECT * FROM "Booking" where "user_id"=$1;';
        $result = pg_query_params($conn, $sql, array($_SESSION['user1'][6]));
        $sql1 = 'SELECT * FROM "Goods_Booking" where "booking_id"=$1;';
        
        
        if ($result) {
          echo "<div class='card-group'>";
          while($row = pg_fetch_row($result)) {
            echo "<div class='card1'>
            
            <div class='card-body'>
              <h5 class='card-title'>From : $row[3]</h5>
              <h5 class='card-text'>To : $row[4]</h5>
              <p>Time : $row[5]</p>
              <p class='card-text'><small class='text-muted'>Departure : $row[6]</small></p>
              <p class='card-text'><small class='text-muted'>Arrival : $row[7]</small></p>
              ";
              $result1 = pg_query_params($conn, $sql1, array($row[0]));
                while($row1 = pg_fetch_row($result1))
                {
                $sql2 = 'SELECT * FROM "Goods" where "goods_id"=$1;';
                $result2 = pg_query_params($conn, $sql2, array($row1[0]));
                while($row2 = pg_fetch_row($result2)){
                echo "<p class='card-text'><small class='text-muted'>Goods : $row2[1]  &nbsp &nbsp &nbsp &nbsp &nbsp Quantity : $row1[2]</small></p>";
                }
                }

                $sql3 = 'SELECT * FROM "Trucks" where "truck_id"=$1;';
                $result3 = pg_query_params($conn, $sql3, array($row[2]));
                while($row3 = pg_fetch_row($result3)){
                  echo "<p class='card-text'><small class='text-muted'>Truck : $row3[1]</small></p>";
                  }
                  
              echo "<p>Fare : $row[9] Rs</p>
              </div>
              </div>
            ";
              
            

          }


        }
        if (pg_num_rows($result) == 0){
        
          echo 'No orders yet!';
        }
        ?>

        </div>
   </div>
</body>
</head>
     