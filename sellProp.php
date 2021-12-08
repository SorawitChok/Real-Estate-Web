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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleform.css">
    <title>Sell Property</title>
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
                    echo "<li style='float: right;'><a class='nav2' style='pointer-event:none; cursor:default; color:black;'>Welcome, ".$_SESSION["FirstName"]."</a></li>";
                }
                else{
                    echo '<li style="float: right;"><a class="nav" href="Login.php">Sign in</a></li>';
                    echo '<li style="float: right;"><a class="nav" href="Register.php">Sign up</a></li>';
                }                        
            ?>
        </ul>
    </div>
    <h3 style="font-weight: 400;">Sell Property</h3>      
    <div class="row">
        <div class="col-50">
            <div class="container">
                <form action="sellPropProcess.php" method="post" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-50" style="font-weight: 200;">
                          <h3 style="font-weight: 200;">Property Information</h3>
                          <label for="type">Property Type</label>
                          <select name="type" >
                              <option value="Apartment">Apartment</option>
                              <option value="Condominium">Condominium</option>
                              <option value="Sigle Family Residence">Sigle Family Residence</option>
                          </select>
                          <label for="year">Year Built</label>
                          <input type="text" name="year" placeholder="e.g. 1998">
                          <div class="row">
                            <div class="col-50">
                                <label for="heating">Heating</label>
                                <input type="text" name="heating" placeholder="e.g. Central Heat, Gas">
                            </div>
                            <div class="col-50">
                                <label for="cooling">Cooling</label>
                                <input type="text" name="cooling" placeholder="e.g. Central Air">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-50">
                                <label for="bed">Number Of Bedroom</label>
                                <input type="text" name="bed" placeholder="e.g. 3">
                            </div>
                            <div class="col-50">
                                <label for="bath">Number Of Bathroom</label>
                                <input type="text" name="bath" placeholder="e.g. 5">
                            </div>
                        </div>
                        <label for="area">Total Area</label>
                        <input type="text" name="area" placeholder="e.g. 1650 sqft">
                        <label for="parking">Parking</label>
                        <input type="text" name="parking" placeholder="e.g. 1 Attached garage space">
                        <label for="hoa">Homeowner Association Fee (HOA)</label>
                        <input type="text" name="hoa" placeholder="e.g. 500">
                        <label for="agent">Agent</label>
                          <?php 
                            $qrt = 'select * from Agent;';
                            $result2 = $mysqli -> query($qrt);
                            echo '<select name="agent" >';
                            while($row2 = $result2->fetch_array())
                            {
                                echo '<option value="'.$row2['AgentID'].'">'.$row2['FirstName'].' '.$row2['LastName'].'</option>';
                            }
                            echo '</select>';
                          ?>
                          <label for="desc">Description</label>
                          <input type="text" name="desc">
                          <label >Cover Property Pictures</label>
                          <input type="file" name="file1[]" id="file1">
                          <label >Property Pictures</label>
                          <input type="file" name="file2[]" id="file2" multiple>
                          <hr>
                          <h3 style="font-weight: 200;">Location Information</h3>
                          <label for="zip">Zip Code</label>
                          <input type="text" name='zip' placeholder='e.g. 10170'>
                          <div class="row">
                            <div class="col-50">
                                <label for="lat">Latitude</label>
                                <input type="text" name="lat" placeholder="e.g. 42.35xxxx81">
                            </div>
                            <div class="col-50">
                                <label for="long">Longtitude</label>
                                <input type="text" name="long" placeholder="e.g. -71.05xxxx91">
                            </div>
                        </div>
                        <label for="country">Country</label>
                        <input type="text" name='country' placeholder='e.g. Canada'>
                        <label for="state">State</label>
                        <input type="text" name='state' placeholder='e.g. British Columbia'>
                        <label for="city">City</label>
                        <input type="text" name='city' placeholder='e.g. Vancouver'>
                        <label for="street">Street</label>
                        <input type="text" name='street' placeholder='e.g. 45 Province St APT 1808'>
                        <hr>
                        <div class="row">
                            <div class="col-50">
                                <label for="lat">Price</label>
                                <input type="text" name="price" placeholder="e.g. 2000000">
                            </div>
                            <div class="col-50">
                                <label for="long">Price/sqft</label>
                                <input type="text" name="priceper" placeholder="e.g. 2450">
                            </div>
                        <input type="submit" value="Submit" name='sub' class="btn">
                </form>
            </div>
        </div>
    </div>  
</body>
</html>