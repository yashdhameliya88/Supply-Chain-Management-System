<!DOCTYPE html> <!-- To change this license header, choose License Headers in Project Properties. To change this template file, choose Tools | Templates and open the template in the editor. --> 
<?php
require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<html>     
    <head>         
        <meta charset="UTF-8">         
        <title>Add Main Supplier Page</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>     
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Add Main Supplier
        </div>

        <div class="reg1">
            <form action="#" method="POST">              
                <div class="otp"> 
                    <table class="border1" >
                        <tr>
                            <td><label> Name: </label></td>
                            <td><input type="text" name="name" size="15" placeholder="Enter Your Name"/></td>
                        </tr>
                        <tr>
                            <td><label>Email Id: </label></td>
                            <td><input type="text" name="mail" placeholder="Enter Email ID"></td>
                        </tr>
                        <tr>
                            <td><label> Mobile Number: </label></td>
                            <td>
    <!--                            <select>  
                                    <option value="+91">+91</option>  
                                    <option value="744">744</option>  
                                    <option value="641">641</option>  
                                    <option value="+1">+1</option>  
                                    <option value="+64">+64</option>  
                                </select>  -->
                                <input type="text" name="mobilenumber" size="10" placeholder="Enter Mobile Number"/>
                            </td>
                        </tr>
                        <tr>
                            <td><label> Address: </label></td>
                            <td><textarea cols="31" rows="5" value="address" name="address" size="250" placeholder="Enter Your Address"/></textarea></td>
                        </tr>
                        <tr>
                            <td><label> State: </label></td>
                            <td>
    <!--                            <select class="select1">  
                                    <option value="-1" style=" font-weight: bold;">Select City</option>
                                    <option value="Surat">Surat</option>  
                                    <option value="Bardoli">Bardoli</option>  
                                    <option value="Vadodara">Vadodara</option>  
                                    <option value="Navasari">Navasari</option>  
                                    <option value="Vapi">Vapi</option>  
                                </select>-->

                                <select name="state" class="select1">
                                    <option value="-1" disabled selected>-- Select State --</option>
                                    <?php
                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                                    $records = mysqli_query($connect, "select * from tblState");

                                    while ($data = mysqli_fetch_array($records)) {
                                        echo "<option value='" . $data['stateId'] . "'>" . $data['stateName'] . "</option>";  // displaying data in option menu
                                    }
                                    mysqli_close($connect);
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td><label> City: </label></td>
                            <td>
    <!--                            <select class="select1">  
                                    <option value="-1" style=" font-weight: bold;">Select City</option>
                                    <option value="Surat">Surat</option>  
                                    <option value="Bardoli">Bardoli</option>  
                                    <option value="Vadodara">Vadodara</option>  
                                    <option value="Navasari">Navasari</option>  
                                    <option value="Vapi">Vapi</option>  
                                </select>-->

                                <select name="city" class="select1">
                                    <option value="-1" disabled selected>-- Select City --</option>
                                    <?php
                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                                    $records = mysqli_query($connect, "select * from tblCity");

                                    while ($data = mysqli_fetch_array($records)) {
                                        echo "<option value='" . $data['cityId'] . "'>" . $data['cityName'] . "</option>";  // displaying data in option menu
                                    }
                                    mysqli_close($connect);
                                    ?>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td><label>PinCode: </label></td>
                            <td><input type="text" name="pincode" placeholder="Enter Pincode"></td>
                        </tr>
                        <tr>
                            <td><label> Password: </label></td>
                            <td><input type="password" id="pass" name="pass" placeholder="********"></td>
                        </tr>
                        <tr>
                            <td><label> Confirm Password: </label></td>
                            <td><input type="password" id="conpass" name="conpass" placeholder="********"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" name="reset" value="Reset"/>
                                <input type="submit" class="sh"name="VerifyOtp" value="Send OTP"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><label style="color: blue;"> Have an account: <a href="Login.php" style="text-decoration: none;color: red;" onMouseOver="this.style.color = '#ffc107'"
                                                                                 onMouseOut="this.style.color = 'red'">Click Here</a></label></td>
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
        if(isset($_POST['VerifyOtp']))
        {
            $name = $_POST['name'];
            $emailId = $_POST['mail'];
            $mobile = $_POST['mobilenumber'];
            $address = $_POST['address'];
            $cityId = $_POST['city'];
            $pincode = $_POST['pincode'];
            $pass = $_POST['pass'];
            $userType = "Supplier";
            echo $name . "</br>";
            echo $emailId . "</br>";
            echo $mobile . "</br>";
            echo $address . "</br>";
            echo $cityId . "</br>";
            echo $pincode . "</br>";
            echo $pass . "</br>";
            echo $userType . "</br>";
            $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL:" . mysqli_connect_error();
                exit();
            }
//            $query = "insert into tblUser (userId,name,emailId,mobileNumber,address,cityId,pincode,password,userType) values('2',$name','$emailId','$mobile','$address','$cityId','$pincode','$pass','$userType')";

            $sql = "INSERT INTO `tblUser`(`name`, `emailId`, `mobileNumber`, `address`, `cityId`, `pincode`, `password`, `userType`) VALUES ('$name','$emailId','$mobile','$address','$cityId','$pincode','$pass','$userType')";
            echo $sql;
            $result = mysqli_query($connect, $sql);

            echo $result;
            print_r(mysqli_error_list($connect)) ;
//            echo $a1;
            mysqli_close($connect);
        }
//        if (isset($_POST['VerifyOtp'])) {
//            if ($_POST['user'] == $_SESSION['mail'] && $_POST['otp'] == $_SESSION['otp']) {
//                session_start();
//                $_SESSION['loginUser'] = $_POST['user'];
//            } else {
//                echo " <script>alert('Login Failed!!')</script> ";
//            }
//        }
        $code = rand(1111, 9999);
        if (isset($_POST['VerifyOtp'])) {
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
                $mail->Subject = "Check Mail";
                $mail->setFrom("maxveni015@gmail.com"); //Your Email ID
                $mail->Body = "$code. is Your One Time Verfication(OTP) code to confirm your User ID at SCMS for Reset Password...";
                $mail->addAddress($_POST['mail']);
                if ($mail->send()) {
                    echo "mail sent";
//                    addRegData();
                    header("location:ResetPassword.php");
                } else {
                    echo 'Not Sent';
                } $mail->smtpClose();
            }
        }

        function addRegData() {
            echo 'function called';
//            include_once 'sqlConnection.php';
        }
        ?>        
    </body> 
</html>