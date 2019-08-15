<?php
session_start();




// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");


foreach ($_SESSION['trucks'] as $truck){ 
    // echo $truck."<br />";
    $mytruck = $truck;
    // getting truck id here, add user_id to this truck
 }

$sql = array('user_id'=>$_SESSION['user1'][6],'initial_loc'=>$_SESSION['initial_loc'], 'final_loc'=>$_SESSION['final_loc'], 
'dep_time'=>$_SESSION['dep_date'], 'arr_time'=>$_SESSION['arr_date'], 'eta'=>$_SESSION['time'], 'initial_loc'=>$_SESSION['initial_loc'],
'truck_id'=>$mytruck, 'distance'=>$_SESSION['distance']);

$result = pg_insert($conn, 'Booking', $sql);

$i = 0;
if($result){
   echo "Records added successfully.<br>";

   $sql = 'SELECT * from "Booking" where "user_id"= $1 and "truck_id"= $2 and "dep_time"= $3 and "arr_time"=$4;';
   $result = pg_query_params($conn, $sql,array($_SESSION['user1'][6], $mytruck, $_SESSION['dep_date'], $_SESSION['arr_date']));

   if (pg_num_rows($result) > 0 ) {

       $booking = pg_fetch_row($result);  
   }

   foreach ($_SESSION['goods'] as $good){ 
       
       $sql = array('booking_id'=>$booking[0], 'goods_id'=>$good, 'quantity'=>$_SESSION['quantity'][$i]);
       $i =$i + 1;
       $result = pg_insert($conn, 'Goods_Booking', $sql);
       if($result){
       
           // echo "Records added successfully in Goods_Booking.<br>";
    } 
    else
    {
        echo 'yeah ofc';
    }
}
    header("Location: http://localhost/Smart-Goods-System/html/app/home.php"); 
    exit();


}
else{
   echo "sometthing goofed";
}



?>