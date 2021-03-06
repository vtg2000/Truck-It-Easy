<?php include("../app/sidebar.php"); ?>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/home.css">
  <link rel="stylesheet" href="../../css/welcome.css">

  <title>Truck It Easy</title>
</head>

<body>
  <?php
// storing booking info in session variables
if(isset($_POST['initial']))
{
  $_SESSION['initial_loc'] = $_POST['initial'];
  $_SESSION['final_loc'] = $_POST['final'];
 
}
if(isset($_POST['distance']))
{
  $_SESSION['distance'] = $_POST['distance'];
  $_SESSION['time'] = $_POST['time'];
  $_SESSION['dep_date'] = $_POST['date'];
  $_SESSION['arr_date'] = $_POST['adate'];
}
?>

  <?php

// db connection
$servername = "localhost";
$username = "postgres";
$password = "";
$dbname = "postgres";
$conn = pg_connect("dbname=$dbname host=localhost port=5432 user=$username password=vtg@2000 connect_timeout=5");

?>

  <!-- main -->
  
  <div class="div main" id='main'>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style='background-color:transparent'>
        <li class="breadcrumb-item"><a href="../app/home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="../booking/location.php">Location</a></li>
        <li class="breadcrumb-item active" aria-current="page">Goods</li>
        <?php if(isset($_SESSION['goods']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/trucks.php">Trucks</a></li>';
    } ?>
        <?php if(isset($_SESSION['trucks']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/insurance.php">Insurance</a></li>';
    } ?>
    <?php if(isset($_SESSION['insurance']) || isset($_SESSION['trucks']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/booking_details.php">Details</a></li>';
    } ?>
        <?php if(isset($_SESSION['fare']))
    {
      echo '<li class="breadcrumb-item"><a href="../booking/payment.php">Payment</a></li>';
    } ?>
      </ol>
    </nav>
    <!-- goods selector -->
    <h4 class='heading' style="color:white">Select the Goods</h4>
    <div id='goods' class='animate-reveal animate-first'>
      <form method='post' action='trucks.php'>

        <?php
      if(isset($_POST['search']))
      {
        $sql = 'SELECT * FROM "Goods" where lower("name") like lower($1);';
        $value = array('%'.$_POST['search'].'%');
        $result = pg_query_params($conn, $sql, $value);
      }
      elseif(isset($_POST['Electronics']))
      {
        $sql = 'SELECT * FROM "Goods" where "category" = $1;';
        $result = pg_query_params($conn, $sql, array("Electronics"));
      }
      elseif(isset($_POST['Furniture']))
      {
        $sql = 'SELECT * FROM "Goods" where "category" = $1;';
        $result = pg_query_params($conn, $sql, array("Furniture"));
      }
      elseif(isset($_POST['Other']))
      {
        $sql = 'SELECT * FROM "Goods" where "category" = $1;';
        $result = pg_query_params($conn, $sql, array("Other"));
      }
      else{
      $sql = 'SELECT * FROM "Goods";';
      $result = pg_query($conn, $sql);
      }
      
      $rows = pg_num_rows($result);
      if ($result) {
          echo "<input id='numrow' value=$rows hidden></input>";
          echo "<div class='card-group'>";

          while($row = pg_fetch_row($result)) {
              echo "<div class='card'>
                <input class='rowid' value=$row[0] hidden></input>
                <img class='card-img-top' style='height:150px' src=$row[4] alt='Card image cap'>
                <div class='card-body'>
                  <h5 class='card-title'>$row[1]</h5>
                  <p class='card-text'>$row[6]</p>
                  <p>Weight : $row[3] Kgs</p>
                  <p class='card-text'><small class='text-muted'>$row[2]</small></p>
                  <input type='checkbox' name='goods[]' value=$row[0] id='mycheck$row[0]'>
                  <input type='range' min='0' max='30' value='0' class='slider' name='quantity[]' id='myRange$row[0]' hidden>
                  <span>Quantity: <span id='demo$row[0]'></span> </span>
                </div>
                </div>
              ";
          }
          echo "</div>";
      } else {
          echo "0 results";
      }
      
      ?>
        <button class="btn-success" type='submit' id='goods_submit' style='background-color:grey '
          disabled>Submit</button>
      </form>
    </div>

    <!-- end of main -->
  </div>

  <div class='right-sidebar'>
  <h2>Search<i class="fa fa-search fa-fw"></i></h2>

  <form method="post" action="goods.php">
  
  <input placeholder='Enter Goods name' onkeyup='showUser(this.value)' name='search'>

  <?php if(isset($_POST['search']))
  {
    
    echo 
    "<button type='submit' style='margin-top: 12px; margin-left: 30px'>Clear results</button>"
   ;
  }
  ?>
 
  <button type='submit' hidden></button>
  </form>

  <h2>Filter<i class="fa fa-filter fa-fw"></i></h2>
  <h5>By Category</h5>

  <form id="form" method="post" action="goods.php">

  <input type='checkbox' name='Electronics' onchange="filterGoods(this.attributes['name'].value)">
  <label>Electronics</label>
  <br>
  
  <input type='checkbox' name='Furniture' onchange="filterGoods(this.attributes['name'].value)">
  <label>Furniture</label>
  <br>

  <input type='checkbox' name='Other' onchange="filterGoods(this.attributes['name'].value)">
  <label>Other</label>
  <br>

  <input type='checkbox' name='None' onchange="filterGoods(this.attributes['name'].value)">
  <label>All</label>
  <br>
  
  </form>

  </div>
  


  <!-- <script src="../../js/maps.js"></script> -->
  <script src="../../js/home.js"></script>
  <script src="../../js/goods.js"></script>
  <script>

function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

function filterGoods(str)
{
  console.log('aaxx')
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("main").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../booking/goods_filter.php?q="+str,true);
        xmlhttp.send();
        sleep(100).then(() => {
          giveAttr();
});

}

function showUser(str) {
  console.log('aaxx')
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("main").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","../booking/goods_search.php?q="+str,true);
        xmlhttp.send();
        sleep(100).then(() => {
          giveAttr();
});

        
}

function giveAttr()       
{
let check = []
let slider = []
let output = []

let something = document.getElementsByClassName('rowid')

for( let j = 0; j < something.length; j++)
{
  let i = something[j].value

  slider[i] = document.getElementById("myRange"+i);
  output[i] = document.getElementById("demo"+i);
  output[i].innerHTML = slider[i].value;
  slider[i].onchange = (e) => 
  {
    console.log(i)
    output[i].innerHTML = e.target.value
    if(slider[i].value == 0)
    {
      check[i].checked = false;
      slider[i].hidden = true;
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
      if(checkedOne)
    {
      document.getElementById('goods_submit').disabled = false;
      document.getElementById('goods_submit').style.backgroundColor = 'green';
    }
    else{
      document.getElementById('goods_submit').disabled = true;
      document.getElementById('goods_submit').style.backgroundColor = 'grey';
    }
    }
  }
}


for( let j = 0; j < something.length; j++)
{
  let i = something[j].value
  check[i] = document.getElementById("mycheck"+i);
  slider[i] = document.getElementById("myRange"+i);
  output[i] = document.getElementById("demo"+i);  
  console.log(i)  
  check[i].onclick=()=>
  {
    console.log('hii')
    slider[i].hidden ?
    (slider[i].hidden = false, slider[i].value = 1 )
    : (slider[i].hidden = true,  slider[i].value = 0);
    
    output[i].innerHTML = slider[i].value;
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
    
    if(checkedOne)
    {
      document.getElementById('goods_submit').disabled = false;
      document.getElementById('goods_submit').style.backgroundColor = 'green';
    }
    else{
      document.getElementById('goods_submit').disabled = true;
      document.getElementById('goods_submit').style.backgroundColor = 'grey';
    }
      
    }
}

}
    


</script>


</body>

</html>