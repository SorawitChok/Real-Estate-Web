<?php 
    require_once('connect.php'); 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <title>Willow</title>
</head>
<body>
    
    <div class="center">
        <ul>
            <li style="float: left;"><h2>Willow</h2></li>
            <li><a class="nav" href="buy.php">Buy</a></li>
            <li><a class="nav" href="sellProp.php">Sell</a></li>
            <li><a class="nav" href="#contact">Rent</a></li>
            <?php
                if(isset($_SESSION["UID"])){
                    echo '<li style="float: right;"><a class="navr" href="LogoutProcess.php">Log out</a></li>';
                    echo "<li style='float: right;'><p>Welcome, ".$_SESSION["FirstName"]."</p></li>";
                }
                else{
                    echo '<li style="float: right;"><a class="nav" href="Login.php">Sign in</a></li>';
                    echo '<li style="float: right;"><a class="nav" href="Register.php">Sign up</a></li>';
                }                        
            ?>
        </ul>
    </div>
    <div>
        <div class="backImg">

        </div>
        <div class="word">
            <h1>“A man travels the world over</h1>
            <h1>in search of what he needs</h1>
            <h1>and returns home to find it.”</h1>
            <h3>–George A. Moore</h3><br><br>
            <form action="searchSale.php" method="post"><input class="stylebox" type="text" placeholder="Search Location" name="search"><input class="searchstyle" type="submit" value="Search"></form>
        </div>
    </div>
    
    
    
</body>
</html>