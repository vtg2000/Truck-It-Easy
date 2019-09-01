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
  echo '';
}

$cap = 0;
$i = 0;
foreach ($_SESSION['goods'] as $good){ 
    
  $sql = 'SELECT * FROM "Goods" where "goods_id"=$1;';
  $result = pg_query_params($conn, $sql, array($good));
  while($row = pg_fetch_row($result)){
  $cap = $cap + $row[3] * $_SESSION['quantity'][$i];
  }
  $i =$i + 1;
} 
// echo $cap;


?>

  <!-- main -->
  <div class="div main">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style='background-color:transparent'>
        <li class="breadcrumb-item"><a href="../app/home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="../booking/location.php">Location</a></li>
        <li class="breadcrumb-item"><a href="goods.php">Goods</a></li>
        <li class="breadcrumb-item active" aria-current="page">Trucks</li>
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
    <!-- truck selector -->
    <h4 class='heading' style="color:white">Select the Truck</h4>
    <div id='truck' class='animate-reveal animate-first'>
      <form method='post' action='insurance.php'>

        <?php
        if(isset($_POST['search']))
        {
          $sql = 'SELECT * FROM "Trucks" where lower("name") like lower($1);';
          $value = array('%'.$_POST['search'].'%');
          $result = pg_query_params($conn, $sql, $value);
        }
        elseif(isset($_POST['c2500']))
        {
          $sql = 'SELECT * FROM "Trucks" where "capacity" <= $1;';
          $result = pg_query_params($conn, $sql, array(5000));
        }
        elseif(isset($_POST['c3500'])){
          $sql = 'SELECT * FROM "Trucks" where "capacity" <= $1 and "capacity" >= $2;';
          $result = pg_query_params($conn, $sql, array(10000, 5000));
        }
        elseif(isset($_POST['c4500'])){
          $sql = 'SELECT * FROM "Trucks" where "capacity" <= $1 and "capacity" >= $2;';
          $result = pg_query_params($conn, $sql, array(15000, 10000));
        }
        elseif(isset($_POST['c5500']))
        {
          $sql = 'SELECT * FROM "Trucks" where "capacity" >= $1;';
          $result = pg_query_params($conn, $sql, array(15000));
        }
        else{
      $sql = 'SELECT * FROM "Trucks" order by "capacity";';

      $result = pg_query($conn, $sql);
        }

      if ($result) {
        
          echo "<div class='card-group'>";

          while($row = pg_fetch_row($result)) {
              echo "<div class='card'>
                <img class='card-img-top' src=$row[5] alt='Card image cap'>
                <div class='card-body'>
                  <h5 class='card-title'>$row[1]</h5>
                  <p class='card-text'>$row[7]</p>
                  <p>Capacity : $row[2] Kgs</p>
                  
                 <p class='card-text'><small class='text-muted'>Driver : $row[3]</small></p>
                  <p class='card-text'><small class='text-muted'>Contact : $row[4]</small></p>
                  <input type='checkbox' name='trucks[]'"; if($row[2] < $cap){echo "disabled";} echo" value=$row[0]>";
                  if($row[2] < $cap)
                  {
                    echo "<p class='card-text' style='color:red'>Insufficient capacity</p>";
                  }
                echo "</div>
                
                
                </div>
              ";
              
          }
          echo "</div>";
      } else {
          echo "0 results";
      }
      
      if(isset($cap))
      { 
        $sql1 = 'SELECT * FROM "Trucks" where "capacity" >= $1 order by "capacity";';
        $result1 = pg_query_params($conn, $sql1, array($cap));
      
      if($result1)
      {
        echo "<h3 style='color: white; margin-left:50px'>Recommended</h3>";
        echo "<div class='card-group'>";

          if($row = pg_fetch_row($result1)) {
              echo "<div class='card'>
                <img class='card-img-top' src=$row[5] alt='Card image cap'>
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
      }
    }
      ?>

      
        <button class="btn-success" id='trucks_submit' type='submit' style='background-color:grey'
          disabled>Submit</button>
      </form>
    </div>
    <!-- end of main -->
  </div>

  <div class='right-sidebar'>
  <h2>Search<i class="fa fa-search fa-fw"></i></h2>
  <form method="post" action="trucks.php">
  
  <input placeholder='Enter Truck name' name='search'>
  <?php if(isset($_POST['search']))
  {
    
    echo 
    "<button type='submit' style='margin-top: 12px; margin-left: 30px'>Clear results</button>"
   ;
  }
  ?>
  <button type='submit' hidden></button>
  </form>
  <h2>Filter<i class="fa fa-filter fa-fw"></i></h2>
  <h5>By Capacity</h5>

  <form id="form" method="post" action="trucks.php">

  <input type='radio' name='c2500' onchange="document.getElementById('form').submit();">
  <label><5000 Kgs</label>
  <br>
  
  <input type='radio' name='c3500' onchange="document.getElementById('form').submit();">
  <label>>5000 Kgs <10000 Kgs</label>
  <br>

  <input type='radio' name='c4500' onchange="document.getElementById('form').submit();">
  <label>>10000 Kgs <15000 Kgs</label>
  <br>

  <input type='radio' name='c5500' onchange="document.getElementById('form').submit();">
  <label>>15000 Kgs</label>
  <br>
  
  <input type='radio' name='None' onchange="document.getElementById('form').submit();">
  <label>All</label>
  <br>

  </form>

  </div>


  <!-- <script src="../../js/maps.js"></script> -->
  <script src="../../js/home.js"></script>


  <script src="../../js/trucks.js"></script>
</body>

</html>