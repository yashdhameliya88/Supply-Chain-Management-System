<?php
//session_start();
//error_reporting(0);
//if (isset($_POST['login'])) {
//    $userid = $_POST['userid'];
//    $pass = $_POST['pass'];
//
//    if ($userid == "admin" & $pass == "admin") {
//        $_SESSION['admin'] = $userid;
//        header("location:Admin.php");
//    }
//}
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
        <title>Verify OTP Page</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Check your email
        </div>
        <br/>
        <h5>You'll receive a code to verify here so you can reset your account password.</h5>
        <div class="reg1">
            <form name="MyForm" method="POST">
                <table class="border1" >
                    <tr>
                        <td><label> Code (OTP): </label></td>
                        <td><input type="text" name="otp" size="15" placeholder="Enter Your OTP Code" maxlength="4"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Verify" name="verify"/>
                        </td> 
                    </tr>
                    <tr>
                        <td></td>
                        <td><p style="width: 400px;">If you don't see the email, check other places it might be, like your junk, spam, social, or other folders.</p></td>
                    </tr>
                </table>
            </form>
        </div>

    </body>
    <?php
    $emailIdtoUpdatePass = $_SESSION['emailIdtoUpdatePass'];
//    echo $emailIdtoUpdatePass;
    $otpCode = $_SESSION['otpCode'];
//    echo $otpCode;
    if (isset($_POST['verify'])) {
        if (!empty($_POST['otp'])) {
            if ($otpCode == $_POST['otp']) {
                if ($_SESSION['otpType'] == "Registration") {
                    include './sqlConnection.php';
                    $qur = "UPDATE tblUser SET status=1 WHERE emailId='$emailIdtoUpdatePass'";
                    $q = mysqli_query($connect, $qur);
                    echo '<script type="text/javascript"> 
                        alert("OTP Verified Successfully");
                    window.location.href = "./Login.php";
                    </script>;';
                    
                } elseif ($_SESSION['otpType'] == "resetPass") {
                    echo '<script type="text/javascript"> 
                            alert("OTP Verified Successfully"); 
                            window.location.href = "./ResetPassword.php";
                            </script>;';
                }
            } else {
                echo '<script>alert("Wrong OTP")</script>';
            }
        } else {
            echo '<script>alert("Please Enter OTP")</script>';
        }
    }
    ?>
</html>
