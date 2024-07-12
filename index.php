<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login With Gmail</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="frm">  
        <h1>Login</h1>  
        <form name="otp_login" onsubmit="return validation()">  
            <div class="first_box">  
                <label>Email: </label>  
                <input type="email" id="user" name="email" />  
                <span id="email_eror" class="filed_error"></span>
            </div>   
            <div class="first_box">
                <button id="btn" type="button" onclick="sendOtp()">Send OTP</button>
            </div> 
            
            <div class="second_box">  
                <label>OTP: </label>  
                <input type="text" id="otp" name="otp" /> 
                <span id="otp_eror" class="filed_error"></span> 
            </div>   
            <div class="second_box">
                <button id="btn" type="button" onclick="submitOtp()">Submit OTP</button>
            </div> 
        </form>  
    </div>  

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>  
        function sendOtp(){
            var email = jQuery('#user').val();
            jQuery.ajax({
                url: 'connection.php',
                type: 'POST',
                data: {email: email},
                success: function(res){
                    console.log(res)
                    if(res == 'yes'){
                        jQuery('.second_box').show();
                        jQuery('.first_box').hide();
                    } else {
                        $('#email_eror').html("Please Enter Valid Email address");~
                        jQuery('.second_box').hide();
                        jQuery('.first_box').show();
                    }
                    // Handle the response
                },
                error: function(){
                    alert('Error in sending OTP');
                }
            });
        }

        function submitOtp(){
            var otp = jQuery('#otp').val();
            jQuery.ajax({
                url: 'connection.php',
                type: 'POST',
                data: {otp: otp},
                success: function(res){
                    console.log(res)
                    if(res == 'yes'){
                        console.log('verified')
                    window.location.href="google.com"
                    } else {
                        // $('#otp_eror').html("Please Enter Valid OTP");~
                        // jQuery('.second_box').hide();
                        // jQuery('.first_box').show();
                    }
                    // Handle the response
                },
                error: function(){
                    alert('Error in sending OTP');
                }
            });
        }

        function validation() {  
            var email = document.otp_login.email.value;
            if (email === "") {
                alert("Email is empty");  
                return false;  
            }
            return true;                             
        }  
    </script>
    <style>
        .second_box{
            display:none;
        }
        .filed_error{
            color:red;
        }
    </style>
</body>
</html>
