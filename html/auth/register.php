<html>
<body>

Welcome <?php echo $_POST["name"]; ?><br>
Your age is <?php echo $_POST["age"]; ?><br>
Your password is: <?php echo $_POST["password"]; ?>

<?php
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");



$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$location = $_POST['location'];
$password = $_POST['password'];
$phone = $_POST['phone'];

$sql = array('name'=>$name, 'age'=>$age, 'email'=>$email, 'location'=>$location, 'password'=>$password, 'contact'=>$phone);
$result = pg_insert($conn, 'Users', $sql);

if($result){
    echo "Records added successfully.<br>";
    header("Location: http://localhost/Smart-Goods-System/html/auth/login.php?success"); 
    exit();
} else{
    // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
?>
</body>
</html>