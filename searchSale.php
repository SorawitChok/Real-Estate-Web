<?php
session_start();
require_once('connect.php');

$search = $_POST['search'];

$q = "select * from PropertyForSale where LocationID in (select LocationID from Location where city like '%$search%');";

 $result = $mysqli->query($q);
 $_SESSION['searchq'] = array();
 while($row = $result -> fetch_array())
 {
     $temp = array();
     array_push($temp,$row['SalePropID'],$row['Type'],$row['YearBuilt'],$row['Heating'],$row['Cooling'],$row['NumOfBedroom'],$row['NumOfBathroom'],$row['TotalArea'],$row['Parking'],$row['HOA'],$row['Description'],$row['RegisteredDate'],$row['AgentID'],$row['LocationID']);
     array_push($_SESSION['searchq'],$temp);
 }


if(!$result){
    echo "Query failed. Error: ".$mysqli->error ;
}


header("Location: buy.php");
?>