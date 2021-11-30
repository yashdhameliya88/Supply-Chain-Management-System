<?php
session_start();
error_reporting(0);
if (isset($_SESSION['userId'])) {
    header("location:Admin.php");
}
?>
<?php
require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//error_reporting(0);
//require_once './sqlConnection.php';
$passErr = $userErr = "";
$userId = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['pass'])) {
        $passErr = "Password is required";
    }

    if (empty($_POST['userid'])) {
        $userErr = "User Id is required";
    }
}
if (isset($_POST['login'])) {
    $userid = $_POST['userid'];
    $pass = $_POST['pass'];
    $encPass = md5($pass);
//    echo $encPass;
//    if ($userid == "admin" & $pass == "admin") {
//        $_SESSION['admin'] = $userid;
//        $_SESSION['userId']=$userid;
//        $_SESSION['userType']=$userid;
//        $_SESSION['userName']=$userid;
//        header("location:Admin.php");
//    }
    include './sqlConnection.php';
    $query = "SELECT * from tblUser WHERE emailId='$userid' and password='$encPass'";
    $result = mysqli_query($connect, $query);
    $userType;
    $userId;
    $status;
    $statusOfSupplier;
//    echo '3';
//    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) == 1) {
//        echo mysqli_num_rows($result);
        while ($data = mysqli_fetch_array($result)) {
            $status = $data['status'];
            $userId = $data['userId'];
            $userType = $data['userType'];
            $userName = $data['name'];
        }
//        echo '2';
        if ($status == 1) {

//            echo '1';
            $query = "SELECT * from tblSupplier WHERE userId='$userId'";
            $result = mysqli_query($connect, $query);
            echo mysqli_num_rows($result);
            while ($data = mysqli_fetch_array($result)) {
                $statusOfSupplier = $data['status'];
            }

            if ($userType == "Supplier") {
                if ($statusOfSupplier == "Approved") {
                    $_SESSION['userId'] = $userId;
                    $_SESSION['userType'] = $userType;
                    $_SESSION['userName'] = $userName;
//                    header("location:Admin.php");
                    echo '<script type="text/javascript"> 
                            alert("Login Successfully"); 
                            window.location.href = "./Admin.php";
                            </script>;';
                } else {
//                    echo '<h1>You are not Approved by Admin Yet!!!</h1>';
                    echo '<script type="text/javascript"> 
                            alert("You are not Approved by Admin Yet!!!"); 
                            </script>;';
                }
            } elseif ($userType == "Admin") {
                $_SESSION['userId'] = $userId;
                $_SESSION['userType'] = $userType;
                $_SESSION['userName'] = $userName;
//                header("location:Admin.php");
                echo '<script type="text/javascript"> 
                            alert("Login Successfully"); 
                            window.location.href = "./Admin.php";
                            </script>;';
            }
        } else {
//            echo '<h1>You are not Verified your email Yet!!!</h1>';
//            echo '<script type="text/javascript"> 
//                            alert("You are not Verified your Email Yet!!!"); 
//                            </script>;';
            include './sqlConnection.php';

            
            $code = rand(1111, 9999);
//            echo $userid;
            $emailID = $userid;
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = "true";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "maxveni015@gmail.com"; //Your Email ID
            $mail->Password = "Max@Veni#015"; //Enter Email ID
            $mail->Subject = "Check Mail";
            $mail->setFrom("scmsofficial2021@gmail.com"); //Your Email ID
            $mail->Body = "$code. is Your One Time Verfication(OTP) code to confirm your User ID at SCMS";
            $mail->addAddress($userid);
//            echo '123';
            if ($mail->send()) {
//                            echo '<script>alert("Mail Sent")</script>';
//                            echo "<center><a href='./VerifyOTP.php'>Enter OTP</a></center>";

                $_SESSION['emailIdtoUpdatePass'] = $userid;
                $_SESSION['otpCode'] = $code;
                $_SESSION['otpType'] = "Registration";

//                        $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                include './sqlConnection.php';
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL:" . mysqli_connect_error();
                    exit();
                }
                $query = "SELECT * from tblOTP WHERE emailId='$userId'";
                $result = mysqli_query($connect, $query);
                if (mysqli_num_rows($result) > 0) {
                    $sql = "UPDATE tblOTP SET otp='$code', generatedTime=now() WHERE emailId='$userid'";
                    $result4 = mysqli_query($connect, $sql);
                } else {
                    $sql3 = "INSERT INTO tblOTP (`emailId`,`otp`) VALUES ('$userid','$code')";
                    $result3 = mysqli_query($connect, $sql3);
                }
                echo '<script type="text/javascript"> 
                            alert("We have sent an email for otp please check your mail!!!"); 
                            window.location.href = "./VerifyOTP.php";
                            </script>;';
            } else {
                echo '<script type="text/javascript"> 
                            alert("Mail Not Sent"); 
                            
                            </script>;';
            }
        }
    } else {
        echo '<script type="text/javascript"> 
                            alert("Please Eneter Correct Email Id and Password"); 
                            
                            </script>;';
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>

<?php
include 'HeaderPage.php';
?>
        <div class="div1">
            Login Page
        </div>

        <div class="reg1">
            <form name="MyForm" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <table class="border1" >
                    <tr>
                        <td><label> User ID: </label></td>
                        <td><input type="text" name="userid" value="<?php echo $userid; ?>" size="15" placeholder="Enter Your User ID"></td>
                        <td><?php echo $userErr; ?></td>
                    </tr>
                    <tr>
                        <td><label> Password: </label></td>
                        <td><input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" placeholder="********"></td>
                        <td><?php echo $passErr; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="reset" value="Reset" name="reset"/>
                            <input type="submit" value="Login" name="login"/>                            
                        </td> 
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                    <center>
                        <a href="ForgotPassword.php" style="text-decoration: none;color: blue;" onMouseOver="this.style.color = 'red'"
                           onMouseOut="this.style.color = 'blue'">Forgot Password?</a><a> | </a>
                        <a href="Registration.php" style="text-decoration: none;color: blue;" onMouseOver="this.style.color = '#ffc107'"
                           onMouseOut="this.style.color = 'blue'">Registration for SCMS</a>
                    </center>
                    </td>

                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
