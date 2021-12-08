<?php
    if(isset($_POST['sub']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $tel = $_POST['tel'];
        $gender = $_POST['gender'];
        $zip = $_POST['zip'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
  
        require_once('connect.php');
        if($password == $cpassword)
        {
            $q = "insert into userinfo (Email,Password,FirstName,LastName,Gender,Telephone,Zip_Postal,RegisteredDate)
                  values ('$email','$password','$fname','$lname','$gender','$tel','$zip',CURRENT_DATE());";
            $result=$mysqli->query($q);
            if(!$result){
                echo "INSERT failed. Error: ".$mysqli->error ;
                return false;
            }
            header("Location: Login.php");
        }
        else
        {
            $state = 1;
            header("Location: Register.php?state=".$state);
        }
    }
    
?>
<!-- AIzaSyBAO_DoQnOAlLXtIAYApJTfc3CIeoXtPSw -->