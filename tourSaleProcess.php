<?php
    require_once("connect.php");
    session_start();
    if(isset($_POST['sub']))
    {
        $finish = $_POST['finish'];
        $visit = $_POST['visit'];
        $id = $_POST['id'];

        $q = "insert into toursale (VisitDateTime,FinishDateTime,UID,SalePropID) values ('".$visit."','".$finish."','".$_SESSION['UID']."','".$id."');";
        $result = $mysqli->query($q);
        if(!$result){
            echo "INSERT failed. Error: ".$mysqli->error ;
            return false;
        }
        header("Location: Landing.php");
    }
?>