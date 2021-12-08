<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
require_once('connect.php');
$q = "select UID,FirstName from userinfo where Email = '$email' and Password = '$password';";
$result=$mysqli->query($q);
$count = $result->num_rows;
if($count==1){
    $row = $result->fetch_array();
    $_SESSION['UID'] = $row['UID'];
    $_SESSION['FirstName'] = $row['FirstName'];
    header("Location: Landing.php");
}
elseif($count != 1){
    $state = 1;
    header("Location: login.php?state=".$state);
}
?>