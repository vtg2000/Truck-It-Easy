<?php
   session_start();
   unset($_SESSION["valid"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
    <title>Login</title>
</head>
<body style='background-image: linear-gradient(lightblue, rgb(3, 121, 160)); height: 100vh;'>
        
        <div  >
        <h2 style='margin-top: 100px;  ' class='text-center'>Login</h2>
        <form action="home.php" id="Myform" method='post' >
            <div style = 'display:flex; color:white; flex-direction: column; margin-left: 40vw; background-image:linear-gradient( rgb(122, 113, 252), rgb(241, 11, 192)); margin-right:40vw; padding: 2vw; border-radius: 20px'>
            
            <label class = 'formLabel' for="">Email</label>
            <input required class = 'formInput' name="email">
           
            <label class = 'formLabel' for="">Password</label>
            <input required class = 'formInput' name='password' type="password">
            <br>
            <button class = 'btn-success' type='submit'>Submit</button>
            
        </div>
       

        </form>
    </div>
    </body>
</html>