
<!DOCTYPE html>

<?php 
session_start();
session_destroy();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="../../css/welcome.css">

    <title style='color: white'>Login</title>
</head>

<body style='background-image: linear-gradient(to right, #780206,#061161);'>
    <nav class="navbar navbar-dark fixed-top">
        <a class="navbar-brand" href="../index.html">
            <div class='text-center'>Truck It Easy</div>
        </a>
        <div style='display:flex; flex-direction: row;'>
            <a class="nav-item nav-link" href='register.html' style="color:white">Register</a>
            <a class="nav-item nav-link" href="../index.html" style="text-decoration:none; color:white;">Home</a>
        </div>
    </nav>
    <div class='animate-reveal animate-first'>
        <h2 style='margin-top: 100px; color: white ' class='text-center'>Login</h2>
        <form action="validate.php" id="Myform" method='post'>
            <div
                style='display:flex; color:white; flex-direction: column; margin-left: 40vw; background-image:linear-gradient( #9D50BB, #6E48AA); margin-right:40vw; padding: 1.5vw; border-radius: 20px'>

                <label class='formLabel' for="">Email</label>
                <input required class='formInput' name="email">

                <label class='formLabel' for="">Password</label>
                <input required class='formInput' name='password' type="password">
                <br>
                <div>
                    <button class='btn-success' type='submit'
                        style='width:100px; margin:auto; display:block'>Login</button>
                </div>
                <br>
                <p style='font-size:12px'>Don't have an account? <a href='register.html'>Register now!</a></p>


            </div>


        </form>
    </div>
</body>

</html>