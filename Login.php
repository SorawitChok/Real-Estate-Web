<?php 
    require_once('connect.php'); 
    $state = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href ="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="LoginBack">
        <div class="LoginCard">
            <form action="loginProcess.php" method="post">
                <h1>Sign in</h1><br>
                <input name="email" class="curvebox" type="text" placeholder="Email"><br><br>
                <input name="password" class="curvebox" type="password" placeholder="Password"><br><br>
                <input type="submit" class="buttonWB" value="Sign in">
                <?php 
                    if($_GET)
                    {
                        $state = $_GET['state'];
                        if($state == 1)
                        {
                            echo "<p style='color:red;'>email or password is incorrect</p>";
                        }
                    }
                ?>
                <a class="StoR" href="Register.php"><span>&#8250;</span></a>
            </form>
        </div>
    </div>
</body>
</html>