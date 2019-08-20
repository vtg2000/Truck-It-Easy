 <!-- navbar -->
 <?php session_start() ?>
 <?php if($_SESSION['user1']):
 ?>
 <nav class="navbar navbar-dark fixed-top">
   <a class="navbar-brand" href="../app/home.php" >Truck It Easy!</a>
   <a href="../app/profile.php" class="nav-item nav-link ml-auto" style="color:white;"><?php echo $_SESSION["user1"][0];  ?></a>
   <a class="nav-item nav-link" href="../auth/login.php"
     style="text-decoration:none; color:white;">Logout</a>
 </nav>
 <?php else:
    // if session is over, logout the user
      header("Location: http://localhost/Smart-Goods-System/html/auth/login.php"); 
      exit(); ?>
  <?php endif; ?> 
 <!-- sidebar -->
 <div class="sidenav">
    <!-- <a href="../app/home.php">Home</a> -->
    <a href="../app/home.php">Home</a>
    <a href="../app/orders.php">My Orders</a>
    <a href="../app/cards.php">My Cards</a>
    <a href="../app/services.php">Services</a>
    <a href="../app/contact.php">Contact Us</a>
  </div>


