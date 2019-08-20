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

?>

   <div class="div main">
   <h4 class='heading' style="color:white; margin-top:80px">Profile</h4>
        <div id='profile' style='color:white; margin-top:10px; margin-left: 100px; width: 400px; text-align: justify' class='animate-reveal animate-first'>
        
        <div>Name : <?php echo $_SESSION['user1'][0] ; ?></div>
        <div>Phone no : <?php echo $_SESSION['user1'][1] ; ?></div>
        <div>Email : <?php echo $_SESSION['user1'][2] ; ?></div>
        <div>Age : <?php echo $_SESSION['user1'][3] ; ?></div>
        <div>Location : <?php echo $_SESSION['user1'][4] ; ?></div>
        </div>
   </div>
</body>
</head>
     