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
   <h4 style='margin-top: 70px; color: white ' class='text-center'>Edit Profile</h4>
        <div id='edit-pro' style='color:white' class='animate-reveal animate-first'>
        <form action='profile.php' method='post'>
        
        <div style='display:flex; color:white; flex-direction: column;margin-left: 20vw; margin-right:20vw; padding: 1.5vw; border-radius: 20px'>

        <label>Name</label>
        <input value="<?php echo $_SESSION['user1'][0] ?>" name='edname'>

        <label>Email</label>
        <input value="<?php echo $_SESSION['user1'][2] ?>" name='edemail'>

        <label>Phone</label>
        <input value="<?php echo $_SESSION['user1'][1] ?>" name='edphone'>

        <label>Age</label>
        <input value="<?php echo $_SESSION['user1'][3] ?>" name='edage'>

        <label>Location</label>
        <input value="<?php echo $_SESSION['user1'][4] ?>" name='edlocation'>

        <label>Password</label>
        <input value="<?php echo $_SESSION['user1'][5] ?>" name='edpassword' type='password'>

        <button class='btn btn-success' style='width:100px; margin:auto; display:block; margin-top:20px' type='submit'>Edit</button>
        </div>
        </form>
        </div>
   </div>
</body>
</head>
     