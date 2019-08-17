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
        <h4 class='heading' style="color:white; margin-top:80px">Add a card</h4>
        <form action="add_card.php" id="Myform" method='post'>
            <div
                style='display:flex; color:white; flex-direction: column; width: 200px; margin-left: 350px'>

                <label class='formLabel' for="">Name on card</label>
                <input required class='formInput' name='full_name'>

                <label class='formLabel' for="">Number</label>
                <input required class='formInput' name="card_number">

                <label class='formLabel' for="">CVV</label>
                <input required class='formInput' name='cvv'>

                <label class='formLabel' for="">Month</label>
                <input required class='formInput' name='month'>

                <label class='formLabel' for="">Year</label>
                <input required class='formInput' name='year'>

                <label class='formLabel' for="">Balance</label>
                <input required class='formInput' name='balance'>

                <br>
                <div>
                    <button class='btn-success' type='submit'
                        style='width:100px; margin:auto; display:block'>Add </button>
                </div>
                

            </div>


        </form>

    </div>
</body>
</head>

<?php

if(isset($_POST['full_name']))
{
    $sql = array('full_name'=>$_POST['full_name'], 'card_number'=>$_POST['card_number'], 'cvv'=>$_POST['cvv'],
    'month'=>$_POST['month'], 'year'=>$_POST['year'], 'balance'=>$_POST['balance'], 'user_id'=>$_SESSION["user1"][6]);
    $result = pg_insert($conn, 'Credit_Cards', $sql);
    if($result){
        echo "<div style='color:green; margin-left: 350px'>Credit Card added successfully</div><br>";
    }
}



?>