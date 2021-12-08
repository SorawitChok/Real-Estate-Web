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
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href = "style.css">
    <title>Book hotel</title>
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
    <br>
    <div class='mybody'>
        <div class="row">
            <div class="col-50">
                <div class="container" style="max-height:80vh;">
                <?php
                    $id = $_GET['id'];
                    $q = "select * from PropertyForSale where SalePropID = '$id';";
                    $result = $mysqli->query($q);
                    $row = $result->fetch_array();
                    $ql = "select State,City,Street,ZipCode from location where LocationID =".$row['LocationID'].";";
                    $resultl = $mysqli->query($ql);
                    $rowl = $resultl->fetch_array();
                    $qp = "select Price,PricePerSqft from propertypricehistory where SalePropID ='$id' order by Date DESC limit 1;";
                    $result2=$mysqli->query($qp);
                    $count = $result2->num_rows;
                    if($count==1){
                        $rowp = $result2->fetch_array();
                        $price = number_format($rowp['Price']);
                    }
                    echo "<h1 style='font-weight: 200;'>".$price."$</h1><p>".$row['NumOfBedroom']."bds | ".$row['NumOfBathroom']."ba | ".$row['TotalArea']."</p>";
                    echo "<p>".$rowl['Street'].", ".$rowl['City'].", ".$rowl['State']."</p><br>";
                    echo '<div class="row" >';
                    echo '<div class="col-25">';
                            echo '<div style="overflow-y:scroll; height:65vh;">';
                    $qpic = "select SPicturePath from SalePropertyPicture where SalePropID =".$id.";";
                    $resultpic=$mysqli->query($qpic);
                    while($rowpic = $resultpic->fetch_array())
                    {
                        echo '<img src=".'.$rowpic['SPicturePath'].'" width="400" height="250">';
                    }
                            echo '</div>';
                    echo '</div>';
                    echo '<div class="col-50">';
                    $qa = "select FirstName, LastName, RealEstateLicense, OtherLicense, BrokerID from Agent where AgentID = ".$row['AgentID']." ;";
                    $resulta = $mysqli->query($qa);
                    $rowa = $resulta -> fetch_array();
                    $qb = "select BrokerName from Broker where BrokerID = ".$rowa['BrokerID'].""; 
                    $resultb = $mysqli->query($qb);
                    $rowb = $resultb -> fetch_array();
                        echo'<h3 style="font-weight: 200; color: rgb(1, 165, 165);">Agent Informations</h3>';
                        echo'<div class="row"><div class="col-15"><p>Agent: '.$rowa['FirstName'].' '.$rowa['LastName'].'</p></div>';
                        echo'<div class="col-15"><p>Broker: '.$rowb['BrokerName'].'</p></div></div>';
                        echo'<br><hr><br>';
                        echo '<form action="tourSaleProcess.php" method="post">';
                        echo '<div class="row">';
                            echo '<div class="col-50">';
                            echo '<label for="checkin">Start tour: </label>';
                            echo'<input type="datetime-local" name="visit" >';
                            echo'</div>';
                            echo'<div class="col-50">';
                            echo'<label for="checkout">Finish tour: </label>';
                            echo'<input type="datetime-local" name="finish" >';
                            echo'</div>';
                            echo'</div>';
                            echo'<input type="hidden" value="'.$id.'" name="id">';
                            echo '<input type="submit" name="sub" class="btn">';
                        echo '</form>';
                    echo'</div>';
                echo'</div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>