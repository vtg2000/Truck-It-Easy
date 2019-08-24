 <!-- navbar -->
 <head>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
 <?php session_start() ?>
 <?php if($_SESSION['user1']):
 ?>
 <nav class="navbar navbar-dark fixed-top">
   <a class="navbar-brand" href="../app/home.php" ><i class="fa fa-truck fa-fw fa-flip-horizontal"></i>Truck It Easy!</a>
   <a href="../app/profile.php" class="nav-item nav-link ml-auto" style="color:white;"><?php echo $_SESSION["user1"][0];  ?></a>
   <a class="nav-item nav-link" href="../auth/login.php"
     style="text-decoration:none; color:white;">Logout<i class="fa fa-sign-out fa-fw"></i></a>
 </nav>
 <?php else:
    // if session is over, logout the user
      header("Location: http://localhost/Smart-Goods-System/html/auth/login.php"); 
      exit(); ?>
  <?php endif; ?> 
 <!-- sidebar -->
 <div class="sidenav">
    <!-- <a href="../app/home.php">Home</a> -->
    <a href="../app/home.php"><i class="fa fa-home fa-fw"></i>Home</a>
    <a href="../app/orders.php"><i class="fa fa-shopping-cart fa-fw"></i>My Orders</a>
    <a href="../app/cards.php"><i class="fa fa-credit-card fa-fw"></i>My Cards</a>
    <a href="../app/services.php"><i class="fa fa-cogs fa-fw"></i>Services</a>
    <a href="../app/contact.php"><i class="fa fa-phone fa-fw"></i>Contact Us</a>
    
  </div>


