<?php
    require_once('connect.php');
    session_start();
    if(isset($_POST['sub']))
    {
        $type = $_POST['type'];
        $year = $_POST['year'];
        $heat = $_POST['heating'];
        $cool = $_POST['cooling'];
        $bed = $_POST['bed'];
        $bath = $_POST['bath'];
        $area = $_POST['area'];
        $park = $_POST['parking'];
        $hoa = $_POST['hoa'];
        $agent = $_POST['agent'];
        $desc = $_POST['desc'];
        $uid = $_SESSION['UID'];
        $zip = $_POST['zip'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $price = $_POST['price'];
        $pricesq = $_POST['priceper'];

        $q0 = 'select SalePropID from propertyforsale order by SalePropID desc limit 1;';
        $result0 = $mysqli -> query($q0);
        $row0 = $result0 -> fetch_array();

        $tempid = $row0['SalePropID'];
        $tempid = $tempid + 1;

        $q2 = "insert into location values ('$tempid','$zip','$lat','$long','$country','$state','$city','$street');";
        $result2 = $mysqli->query($q2);
        if(!$result2){
            echo "INSERT failed. Error: ".$mysqli->error ;
            return false;
        }

        $q = "insert into propertyforsale 
        values ('$tempid','$type','$year','$heat','$cool','$bed','$bath','$area','$park','$hoa','$desc',CURRENT_DATE,'$agent','$uid','$tempid');";
        $result=$mysqli->query($q);
        if(!$result){
            echo "INSERT failed. Error: ".$mysqli->error ;
            return false;
        }

        $countfiles = count($_FILES['file1']['name']);

        // Looping all files
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['file1']['name'][$i];

            $temp = explode(".", $_FILES["file1"]["name"][$i]);
            $newfilename = 'Cover_prop'.$tempid.'.'.end($temp);
            
            // Upload file
            move_uploaded_file($_FILES['file1']['tmp_name'][$i],'static/'.$newfilename);

            $path = '/static/'.$newfilename ;

            $q1 = "insert into salepropertypicture(SPictureName,SPicturePath,SalePropID) values ('$newfilename','$path','$tempid');";
            $result1=$mysqli->query($q1);
            if(!$result1){
                echo "INSERT failed. Error: ".$mysqli->error ;
                return false;
            }
        
        }

        $countfiles2 = count($_FILES['file2']['name']);

        // Looping all files
        for($i=0;$i<$countfiles2;$i++){
            $j = $i + 1;
            $filename = $_FILES['file2']['name'][$i];

            $temp = explode(".", $_FILES["file2"]["name"][$i]);
            $newfilename = 'prop'.$tempid.'_'.$j.'.'.end($temp);
            
            // Upload file
            move_uploaded_file($_FILES['file2']['tmp_name'][$i],'static/'.$newfilename);

            $path = '/static/'.$newfilename ;
            $q1 = "insert into salepropertypicture(SPictureName,SPicturePath,SalePropID) values ('$newfilename','$path','$tempid');";
            $result1=$mysqli->query($q1);
            if(!$result1){
                echo "INSERT failed. Error: ".$mysqli->error ;
                return false;
            }
        
        }

        $q3 = "insert into propertypricehistory (Date,Event,Price,PricePerSqft,SalePropID) values (CURRENT_DATE,'Listed for sale','$price','$pricesq','$tempid');";
        $result3 = $mysqli->query($q3);
        if(!$result3){
            echo "INSERT failed. Error: ".$mysqli->error ;
            return false;
        }
   
        header("Location: Landing.php");

    }
?>
