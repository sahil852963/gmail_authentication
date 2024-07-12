<?php      
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

    $host = "localhost";  
    $user = "root";  
    $password = 'krsna';  
    $db_name = "gmail_authentication";  
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    } else{
        $sql = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
        $count = mysqli_num_rows($sql);
        if($count > 0){
            $otp = rand(1111, 9999);
            mysqli_query($con, "Update user SET otp='$otp' where email='$email'");
            echo "yes";
            $mail = new PHPMailer(true);
    
            try {
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.gmail.com';                      
                $mail->SMTPAuth   = true;                                  
                $mail->Username   = 'shalinikumari4322@gmail.com';           
                $mail->Password   = 'yvkrtwibelpteigv';                     
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                    
                $mail->setFrom('shalinikumari4322@gmail.com', 'OTP Verification');
                $mail->addAddress($email);      
                
                $mail->isHTML(true);                                  
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = 'Your OTP code is <b>' . $otp . '</b>';
            
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "no";
        }
    } 

?>