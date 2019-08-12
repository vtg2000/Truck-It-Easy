<?php
session_start();
// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");
// login validation
$email = $_POST['email'];
$password = $_POST['password'];

$sql = 'SELECT * FROM "Users" WHERE "email" = $1 AND "password" = $2;';

$result = pg_query_params($conn, $sql, array($email, $password));

if (pg_num_rows($result) > 0 ) {

  $user1 = pg_fetch_row($result);   
  $_SESSION["user1"] = $user1;
  if($user1[6] == 1)
    {
    header("Location: http://localhost/Smart-Goods-System/html/admin/admin.html"); 
    exit();
    }
    else
    {
    header("Location: http://localhost/Smart-Goods-System/html/app/home.php"); 
    exit();
    }
} 
else {
    header("Location: http://localhost/Smart-Goods-System/html/auth/login.php"); 
    exit();
}

?>

