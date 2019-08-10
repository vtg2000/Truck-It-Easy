<?php

// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");

$name = $_POST['name'];
$weight = $_POST['weight'];
$category = $_POST['category'];
$pricefactor = $_POST['pricefactor'];
$description = $_POST['description'];

$sql = array('name'=>$name, 'weight'=>$weight, 'category'=>$category, 'price_factor'=>$pricefactor, 'description'=>$description);
$result = pg_insert($conn, 'Goods', $sql);

if($result){
    echo "Records added successfully.<br>";
} else{
    echo "ERROR: Could not able to execute";
}

$tname = $_POST['tname'];
$d_name = $_POST['d_name'];
$d_number = $_POST['d_number'];
$tpricefactor = $_POST['tpricefactor'];
$tcapacity = $_POST['tcapacity'];
$tdescription = $_POST['tdescription'];

$sql = array('name'=>$tname, 'd_name'=>$d_name, 'd_contact'=>$d_number, 'price_factor'=>$tpricefactor, 'capacity'=>$tcapacity, 'description'=>$tdescription);
$result = pg_insert($conn, 'Trucks', $sql);

if($result){
    echo "Records added successfully.<br>";
} else{
    echo "ERROR: Could not able to execute";
}

$sname = $_POST['sname'];
$scontact = $_POST['scontact'];
$rating = $_POST['rating'];
$sdescription = $_POST['sdescription'];

$sql = array('name'=>$sname, 'contact'=>$scontact, 'rating'=>$rating, 'description'=>$sdescription);
$result = pg_insert($conn, 'Services', $sql);

if($result){
    echo "Records added successfully.<br>";
} else{
    echo "ERROR: Could not able to execute";
}

header("Location: http://localhost/Smart-Goods-System/html/admin.html"); 
exit();