<html>
<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Smart Goods System";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} ;

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT email, password FROM User WHERE email = '".$email."' AND password = '".$password."';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        
        echo 'You are logged in.';
        echo 'Welcome '. $email;
    }
} else {
    echo "Account does not exist";
}


?>


</body>
</html>