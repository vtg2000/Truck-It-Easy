<?php
session_start();

// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");


if(isset($_POST['full_name']))
{
$_SESSION['full_name'] = $_POST['full_name'];
$_SESSION['amount'] = $_POST['amount'];
$_SESSION['month'] = $_POST['month'];
$_SESSION['year'] = $_POST['year'];
$_SESSION['cvv'] = $_POST['cvv'];
$_SESSION['card_number'] = $_POST['card_number'];

}

foreach ($_SESSION['trucks'] as $truck){ 
    $mytruck = $truck;
 }

$sql = array('user_id'=>$_SESSION['user1'][6],'initial_loc'=>$_SESSION['initial_loc'], 'final_loc'=>$_SESSION['final_loc'], 
'dep_time'=>$_SESSION['dep_date'], 'arr_time'=>$_SESSION['arr_date'], 'eta'=>$_SESSION['time'], 'initial_loc'=>$_SESSION['initial_loc'],
'truck_id'=>$mytruck, 'distance'=>$_SESSION['distance'], 'fare'=>$_SESSION['fare']);

$result = pg_insert($conn, 'Booking', $sql);

$i = 0;
// insert booking data into booking
if($result){
   echo "Records added successfully.<br>";

   $sql = 'SELECT * from "Booking" where "user_id"= $1 and "truck_id"= $2 and "dep_time"= $3 and "arr_time"=$4;';
   $result = pg_query_params($conn, $sql,array($_SESSION['user1'][6], $mytruck, $_SESSION['dep_date'], $_SESSION['arr_date']));

   if (pg_num_rows($result) > 0 ) {
       $booking = pg_fetch_row($result);  
   }

   // insert goods data into goods_booking
   foreach ($_SESSION['goods'] as $good)
    { 
       $sql = array('booking_id'=>$booking[0], 'goods_id'=>$good, 'quantity'=>$_SESSION['quantity'][$i]);
       $i =$i + 1;
       $result = pg_insert($conn, 'Goods_Booking', $sql);
       if($result){
        echo "Records added successfully in Goods_Booking.<br>";
        } 
    }

    // check credit cards of user
    $sql4 = 'SELECT * from "Credit_Cards" where "user_id"= $1;';
    $result4 = pg_query_params($conn, $sql4 ,array($_SESSION['user1'][6]));
    $numrows = pg_num_rows($result4);
    if ($numrows > 0 ) {
        while($numrows > 0){
        echo (pg_num_rows($result4));
        
        $card = pg_fetch_row($result4);  

        $sql = array('booking_id'=>$booking[0], 'user_id'=>$_SESSION['user1'][6], 'amount'=>$_SESSION['amount'], 'card_number'=>$_SESSION['card_number'],
        'month'=>$_SESSION['month'], 'year'=>$_SESSION['year'], 'cvv'=>$_SESSION['cvv'], 'full_name'=>$_SESSION['full_name'] );

        $new_amount = $card[6] - $_SESSION['amount'];
        $flag = 0;
        // checking if form data is valid credit card
        if($new_amount > 0 && $card['2'] == $_SESSION['card_number'] && $card['3'] == $_SESSION['month'] && $card['4'] == $_SESSION['year'] && $card['5'] == $_SESSION['cvv'] && $card[7] == $_SESSION['full_name'])
            {
            // if yes, insert data into payment and update credit card info
                $flag = 1;
                $result = pg_insert($conn, 'Payment', $sql);
                if($result){
                    echo "Records added successfully in payment.<br>";
                    // $new_amount = $card[6] - $_SESSION['amount'];
                    echo $new_amount;
                    $sql6 = 'UPDATE "Credit_Cards" set "balance" = $1 where "card_id" = $2;';
                    $result6 = pg_query_params($conn, $sql6 ,array($new_amount, $card['0'] ));
                    if($result6)
                    {
                        echo 'successfully updates card data';
                    }
                    unset($_SESSION['goods']);
                    unset($_SESSION['fare']);
                    unset($_SESSION['trucks']);
                    unset($_SESSION['time']);
                    header("Location: http://localhost/Smart-Goods-System/html/booking/payment_success.php"); 
                    exit();
                }
            }
            else{
                // else payment is unsuccessful
                echo $new_amount, $card['2'] == $_SESSION['card_number'] , $card['2'];
                echo 'payment unsuccessful in else 1';
            }
            $numrows = $numrows - 1;
    }}
    else
    {
        echo 'payment unsuccessful in else 2';
        $sql5 = 'DELETE from "Booking" where "booking_id"= $1;';
        $result5 = pg_query_params($conn, $sql5 ,array($booking[0]));
        // hence delete booking data, cascades onto other tables
        if($result5)
        {
            echo 'successfully deleted booking data';
        }
        header("Location: http://localhost/Smart-Goods-System/html/booking/payment.php?failure"); 
        exit();
    }
    if($flag == 0)
    {
        $sql5 = 'DELETE from "Booking" where "booking_id"= $1;';
        $result5 = pg_query_params($conn, $sql5 ,array($booking[0]));
        // hence delete booking data, cascades onto other tables
        if($result5)
        {
            echo 'successfully deleted booking data';
        }
        header("Location: http://localhost/Smart-Goods-System/html/booking/payment.php?failure"); 
        exit();
    }
}
else{
   echo "sometthing goofed";
}



?>