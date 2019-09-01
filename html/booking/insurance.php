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

if(isset($_POST['trucks']))
{
  $trucks = $_POST['trucks'];
  $_SESSION['trucks'] = $trucks;
}
?>

   <div class="div main">
   <nav aria-label="breadcrumb" >
  <ol class="breadcrumb" style='background-color:transparent'>
    <li class="breadcrumb-item"><a href="../app/home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="../booking/location.php">Location</a></li>
    <li class="breadcrumb-item"><a href="goods.php">Goods</a></li>
    <li class="breadcrumb-item"><a href="trucks.php">Trucks</a></li>
    <li class="breadcrumb-item active" aria-current="page">Insurance</li>
    <li class="breadcrumb-item" ><a href="booking_details.php">Details</a></li>
    <?php if(isset($_SESSION['fare']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/payment.php">Payment</a></li>';
    } ?>
  </ol>
</nav>
<h4 class='heading' style="color:white">Insurance</h4>
        <div id='contact' style='color:white' class='animate-reveal animate-first'>
        <b>What is Transit Insurance?</b>
        <br>
        <p>Transit insurance or transport insurance policy for cargo covers a number of risks like damage to goods due to untoward perils such as earthquake, fire, explosion, and lightning. Transit Insurance in India also recompenses damages resulting due to derailment or overturning of the vessel. Transportation insurance also covers loss of goods due to the sinking of the vessel.</p>
        <br>
        <b> Transit Insurance Coverage </b>
        <p>Transit insurance policy offers coverage to all types of cargo against risks associated with fire, collision, lightning etc. The insurer shall offer compensation under the following circumstances:</p>
        <ul>
            <li>The transit insurance policy covers loss or damage to the freight during international transit via air or sea.</li>
            <li>It covers riots, strike, war, and civil commotion</li>
        </ul>
        <form method='post' action='booking_details.php'>
            <input type='checkbox' checked hidden name='insurance'>
            <div style='display:flex'>
            <button type='submit' class='btn btn-success' style='margin-top:0px; margin-right: 20px; margin-left: 350px'>Buy Insurance</button>
            <a href='booking_details.php' ><button class='btn btn-danger' type='button'>Skip</button></a>
            </div>
        </form>
       
        </div>
   </div>
</body>
</head>
     