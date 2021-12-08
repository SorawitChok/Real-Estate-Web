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
    <link rel="stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Registration</title>
</head>
<body>
    
    <div class="RegisBack">
        <div class="RegisCard">
            <form action="registrationProcess.php" method="post">
                <h1>Sign Up</h1><br>
                <input class="curvebox" type="text" placeholder="Firstname" name="fname">
                <input class="curvebox" type="text" placeholder="Lastname" name="lname"><br><br>
                <input class="curvebox" type="text" placeholder="Tel." name="tel">
                <input class="curvebox" type="text" placeholder="Email" name="email"><br><br>
                <input class="curvebox" type="text" placeholder="gender" name="gender">
                <input class="curvebox" type="text" placeholder="zip" name="zip"><br><br>
                <input class="curvebox" type="password" placeholder="Password" name="password"><br><br>
                <input class="curvebox" type="password" placeholder="Password Confirmation" name="cpassword"><br><br>
                <input class="buttonWB" type="submit" value="Sign up" name="sub">
                <?php 
                    if($_GET)
                    {
                        $state = $_GET['state'];
                        if($state == 1)
                        {
                            echo "<p style='color:red;'>password and password confirmation not match</p>";
                        }
                    }
                ?>
                <a class="RtoS" href="Login.php"><span>&#8249;</span></a>
            </form>
        </div>
    </div>
</body>
</html>