<?php    
session_start();
    $host = "localhost";  
    $user = "root";  
    $password = 'krsna';  
    $db_name = "gmail_authentication";  
    $otp = $_POST['otp'];
    $email = $_SESSION['email'];
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    } else{
        $sql = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND otp='$otp'");
        $count = mysqli_num_rows($sql);
        if($count > 0){
            mysqli_query($con, "Update user SET otp='' where email='$email'");
            echo "yes";
        } else {
            echo "no";
        }
    }     
?>  