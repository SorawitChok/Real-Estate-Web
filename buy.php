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
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script src="index.js"></script>
</head>
<body style="overflow:hidden;">
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
    <div id="map"></div>
    <div class="side" style="overflow-y:scroll; height:94vh;">
    <form action="searchSale.php" method="post"><input class="styleboxb" type="text" placeholder="Search Location" name="search"><input class="searchstyleb" type="submit" value="Search"></form>
    <h3 style="text-align:center; margin-top:20px;">Property for sale</h3>
        <?php 
            if(isset($_SESSION["searchq"])){
                $i = 0;
                foreach($_SESSION['searchq'] as $row)
                {
                    $qp = "select Price from propertypricehistory where SalePropID =".$row[0]." order by Date DESC limit 1;";
                    $result=$mysqli->query($qp);
                    $count = $result->num_rows;
                    if($count==1){
                        $rowp = $result->fetch_array();
                        $price = number_format($rowp['Price']);
                    }
                    echo "<a href='buyPage.php?id=".$row[0]."' style='color:black;'><div class='card'>";
                    $qpic = "select SPicturePath from SalePropertyPicture where SalePropID =".$row[0]." and SPictureName like '%cover%';";
                    $result=$mysqli->query($qpic);
                    $count = $result->num_rows;
                    if($count==1){
                        $rowpic = $result->fetch_array();
                        echo "<img style='height:170px; width:330px;' src='.".$rowpic['SPicturePath']."'>";
                    }
                    echo "<h4>".$price." $</h4>";
                    echo "<p style='font-size:16px;'>".$row[5]."bds  ".$row[6]."ba  ".$row[7]."</p>";
                    if($row[1]=="Condominium")
                    {
                        echo "<p style='font-size:12px;'>Condo for sale</p>";
                    }
                    elseif($row[1]=="Single Family Residence")
                    {
                        echo "<p style='font-size:12px;'>House for sale</p>";
                    }
                    else{
                        echo "<p style='font-size:12px;'>".$row[1]." for sale</p>";
                    }
                    $q = "select Street,City,State,ZipCode,Latitude,Longtitude from Location where LocationID = ".$row[13].";";
                    $result=$mysqli->query($q);
                    $count = $result->num_rows;
                    if($count==1){
                        $row1 = $result->fetch_array();
                        $lat = $row1['Latitude'];
                        $lng = $row1['Longtitude'];
                        $se = $row1['Street'];
                        $sa = $row1['State'];
                        $c = $row1['City'];
                        $z = $row1['ZipCode'];
                        echo "<div  style='display: none;' id='".$i."lat'>".$lat."</div>";
                        echo "<div  style='display: none;' id='".$i."lng'>".$lng."</div>";
                        $i++;
                    }
                    echo "<p style='font-size:12px;'>".$se.", ".$c.", ".$sa." ".$z."</p>";
                    echo "</div></a>";
                }
                echo "<div style='display: none;' id='count'>$i</div>";
                echo "<script src='indexCluster.js'></script>";
            }
        ?>
        <br>
    </div>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAO_DoQnOAlLXtIAYApJTfc3CIeoXtPSw&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    
    
    
</body>
</html>