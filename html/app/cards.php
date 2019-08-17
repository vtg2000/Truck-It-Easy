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
   <h4 class='heading' style="color:white; margin-top:80px">Your cards</h4>
        <div id='cards' style='color:white' class='animate-reveal animate-first'>
        
        <?php
        $sql = 'SELECT * FROM "Credit_Cards" where "user_id"=$1;';
        $result = pg_query_params($conn, $sql, array($_SESSION['user1'][6]));
        
        if ($result) {
          echo "<div class='card-group'>";
          while($row = pg_fetch_row($result)) {
            $num = wordwrap($row[2], 4, '-', true);
            echo "<div class='card1'>
            
            <div class='card-body'>
              <h5 class='card-title'>$num</h5>
              <h5 class='card-text'>Full name : $row[7]</h5>
              <p>CVV : $row[5]</p>
              <p class='card-text'><small class='text-muted'>$row[3] / $row[4]</small></p>
              
              <p>Balance : $row[6] Rs</p>
            </div>
            </div>
            
              ";
          }
          echo '<br></div><div style="margin-left:50px"><a href="add_card.php"> &nbspAdd a card</a></div>';
        }
        if(pg_num_rows($result) == 0){
            echo '<div>You have no cards yet. </div><br>';
            echo '<div><a href="add_card.php"> &nbspAdd a card</a></div></div>';
        }

        ?>
        </div>
   </div>
</body>
</head>
     