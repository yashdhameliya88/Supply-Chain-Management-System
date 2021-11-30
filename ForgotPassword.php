
<?php
session_start();
if(isset($_SESSION['userId']))
{
    header("location:index.php");
}
?>

<!DOCTYPE html> <!-- To change this license header, choose License Headers in Project Properties. To change this template file, choose Tools | Templates and open the template in the editor. --> 
<?php
require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

error_reporting(0);
?>
<html>     
    <head>         
        <meta charset="UTF-8">         
        <title>Reset Password Page</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>     
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            SCMS Password Reset
        </div>


        <h1>How do you want to reset your password?</h1>
        <h5>You can use the information associated with your account.</h5>
        <div class="reg1">
            <form action="#" method="POST">              
                <div class="otp"> 
                    <table class="border1" >
                        <tr>
                            <td><label>Email Id: </label></td>
                            <td><input type="text" name="mail" placeholder="Enter Email ID" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" class="sh"name="VerifyOtp" value="Send OTP"/></td>
                        </tr>
                    </table>    

                    <!--                <label> Enter OTP: </label>                 
                                    <input type="text" name="otp">                 
                                    <br/><input type="submit" name="login" value="Login"/>             -->
                </div>          
            </form>
        </div>
<?php
        session_start();
if (isset($_POST['VerifyOtp'])) {
    $emailId = $_POST['mail'];
    $query = "select * from tblUser where emailId='$emailId'";
    include 'sqlConnection.php';
    $res = mysqli_query($connect, $query);
    
    if (mysqli_num_rows($res) == 1) {
        
        
    if (isset($_POST['VerifyOtp'])) {
            $sendermail = $_POST['sendermail'];
            $password = $_POST['password'];
            
            if (isset($_POST['mail'])) {
                $code = rand(1111, 9999);
                $emailID = $_POST['mail'];
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = "true";
                $mail->SMTPSecure = "tls";
                $mail->Port = "587";
                $mail->Username = "maxveni015@gmail.com"; //Your Email ID
                $mail->Password = "Max@Veni#015"; //Enter Email ID
//                    $mail->Username = $sendermail; //Your Email ID
//                    $mail->Password = $password; //Enter Email ID
                $mail->Subject = "Check Mail";
                $mail->setFrom("maxveni015@gmail.com"); //Your Email ID
//                    $mail->setFrom($sendermail); //Your Email ID
                $mail->Body = "$code. is Your One Time Verfication(OTP) code to confirm your Email ID at SCMS for Reset Password...";

                $mail->addAddress($_POST['mail']);
            }
            if ($mail->send()) {

                $_SESSION['emailIdtoUpdatePass'] = $_POST['mail'];
                $_SESSION['otpCode'] = $code;
                $_SESSION['otpType'] = "resetPass";

                include './sqlConnection.php';
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL:" . mysqli_connect_error();
                    exit();
                }
               
                $query = "SELECT * from tblOTP WHERE emailId='$emailId'";
                $result = mysqli_query($connect, $query);
                if (mysqli_num_rows($result) > 0) {
                    $sql = "UPDATE tblOTP SET otp='$code', generatedTime=now() WHERE emailId='$emailId'";
                    $result4 = mysqli_query($connect, $sql);
                } else {
                    $sql3 = "INSERT INTO tblOTP (`emailId`,`otp`) VALUES ('$emailId','$code')";
                    $result3 = mysqli_query($connect, $sql3);
                }

                $sqlGet = "SELECT * from tblUser WHERE emailId='$emailId'";
                $result = mysqli_query($connect, $sqlGet);

                if (mysqli_num_rows($result) == 1) {
                    while ($data = mysqli_fetch_array($result)) {
                        $userId = $data['userid'];
                    }
                }
                print_r(mysqli_error_list($connect));

                echo '<script type="text/javascript"> 
                            alert("Mail Sent"); 
                            window.location.href = "./VerifyOTP.php";
                            </script>;';
            } else {
//                    echo '<script>alert("Mail Not Sent")</script>';
//                echo "$count. mail Not sent.<br/>";
                echo '<script>alert("Mail Not Sent")</script>';
            } $mail->smtpClose();
        }    
        
    } else {
        echo '<script>alert("Please Enter Correct Email id")</script>';
    }
}
?> 
    </body> 
</html>