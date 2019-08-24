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

<?php
if (isset($_POST['edname']))
{
  $sql = 'UPDATE "Users" set "name" = $1, "contact" = $2, "email"=$3, "age"=$4, "location"=$5, "password"=$6 where "id" = $7;';
  $result = pg_query_params($conn, $sql ,array($_POST['edname'], $_POST['edphone'], $_POST['edemail'], $_POST['edage'], $_POST['edlocation'],$_POST['edpassword'], $_SESSION['user1'][6] ));
  if($result)
  {
    $_SESSION['user1'][0] = $_POST['edname'];
    $_SESSION['user1'][1] = $_POST['edphone'];
    $_SESSION['user1'][2] = $_POST['edemail'];
    $_SESSION['user1'][3] = $_POST['edage'];
    $_SESSION['user1'][4] = $_POST['edlocation'];
    $_SESSION['user1'][5] = $_POST['edpassword'];
  }
  header("Location: http://localhost/Smart-Goods-System/html/app/profile.php"); 
}


?>

   <div class="div main">
   <h4 class='heading' style="color:white; margin-top:80px">Profile</h4>
       

        <div class='animate-reveal animate-first' style='margin-left: 230px; margin-top: 50px'>
        <div id='profile' style='color:white; margin-top:10px; margin-left: 100px; width: 400px; text-align: justify'>
        <div>Name : <?php echo $_SESSION['user1'][0] ; ?></div>
        <div>Phone no : <?php echo $_SESSION['user1'][1] ; ?></div>
        <div>Email : <?php echo $_SESSION['user1'][2] ; ?></div>
        <div>Age : <?php echo $_SESSION['user1'][3] ; ?></div>
        <div>Location : <?php echo $_SESSION['user1'][4] ; ?></div>
        </div>
        <a href='edit_profile.php'>   <button class='btn btn-success' style='margin-left:150px'>Edit profile</button>
        
        
        </div>
        
   </div>
  
   </a>

</body>
</head>
     