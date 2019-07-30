<html>
<body>

Welcome <?php echo $_POST["name"]; ?><br>
Your age is <?php echo $_POST["age"]; ?><br>
Your password is: <?php echo $_POST["password"]; ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Smart Goods System";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$location = $_POST['location'];
$password = $_POST['password'];
$phone = $_POST['phone'];

$sql = "INSERT INTO `User`(`name`, `contact`, `email`, `age`, `location`, `password`) 
VALUES('".$name."', '".$phone."','".$email."',".$age.",'".$location."','".$password."');";
$result = $conn->query($sql);

if($result){
    echo "Records added successfully.<br>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$sql = "SELECT name, age, email FROM User;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<br>Name: " . $row["name"] . "<br>Age: " . $row["age"]. "<br> Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}


?>


</body>
</html>