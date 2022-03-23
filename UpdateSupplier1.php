<?php

$conn = mysqli_connect("localhost", "root", "", "demo1");
        if ($conn->connect_errno) {
                die("Connection failed:" . $conn->connect_errno);
            }
            
$r = $_GET['r'];
$s = $_GET['s'];
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

//                    header("location:Login.php");
?>
<?php
$nameErr = $emailErr = $addressErr = $cityErr = $mobileErr = $pincodeErr = $passErr = $conPassErr = "";
$name = $email = $city = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["mail"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["address"])) {
        $addressErr = "address is required";
    } else {
        $address = test_input($_POST["address"]);
    }
    if (strlen($_POST['mobilenumber']) == 10 && ctype_digit($_POST['mobilenumber'])) {

        //valid
    } else {
        $mobileErr = "Enter Proper mobile number";
        //invalid
    }
    if (strlen($_POST['pincode']) == 6 && ctype_digit($_POST['pincode'])) {

        //valid
    } else {
        $pincodeErr = "Enter Proper pincode";
        //invalid
    }
    if (empty($_POST['pass'])) {
        $passErr = "Password is required";
    }

    if (empty($_POST['conpass'])) {
        $conPassErr = "Confirm Password is required";
    }

    if ($_POST['pass'] != $_POST['conpass']) {
        $conPassErr = "Password and Confirm password are not same.";
    }
//    if ($_POST["city"] == '-1') {
//                $cityErr = "city is required";
//            } else {
//                $city = test_input($_POST["city"]);
//            }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<html>     
    <head>         
        <meta charset="UTF-8">         
        <title>Update Supplier</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>     
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Update Supplier
        </div>

        <div class="reg1">
            <form action="#" method="GET">              
                <div class="otp"> 
                    <table class="border1" >
                        <tr>
                            <td><label> Name: </label></td>
                            <td><input type="text" name="name" value="<?php echo "$name"?>" size="15" placeholder="Enter Your Name"/></td>
                            <td><?php echo $nameErr; ?></td>
                        </tr>
                        <tr>
                            <td><label>Email Id: </label></td>
                            <td><input type="text" name="mail" value="<?php echo "$mail"?>" placeholder="Enter Email ID"></td>
                            <td><?php echo $emailErr; ?></td>
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
                                <input type="text" name="mobilenumber" value="<?php echo "$mobilenumber"?>" size="10" placeholder="Enter Mobile Number"/>
                            </td>
                            <td><?php echo $mobileErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Address: </label></td>
                            <td><textarea cols="31" rows="5" name="address" value="<?php echo "$address"?>" size="250" placeholder="Enter Your Address"/></textarea></td>
                            <td><?php echo $addressErr ?></td>
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

                                <select name="state" value="<?php echo "$state"?>" class="select1">
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

                                <select name="city" value="<?php echo "$city"?>" class="select1">
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
                            <td><input type="text" name="pincode" value="<?php echo "$pincode"?>" placeholder="Enter Pincode"></td>
                            <td><?php echo $pincodeErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Password: </label></td>
                            <td><input type="password" id="pass" name="pass" value="<?php echo "$pass"?>" placeholder="********"></td>
                            <td><?php echo $passErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Confirm Password: </label></td>
                            <td><input type="password" id="conpass" name="conpass" placeholder="********"></td>
                            <td><?php echo $conPassErr; ?></td>
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
        $nameErr = $emailErr = $addressErr = $cityErr = $mobileErr = $pincodeErr = $passErr = $conPassErr = "";

        if ($nameErr == "" && $emailErr == "" && $addressErr == "" && $cityErr == "" && $mobileErr == "" && $pincodeErr == "" && $passErr == "" && $conPassErr == "") {
            if (isset($_POST['VerifyOtp'])) {
                $name = $_POST['name'];
                $emailId = $_POST['mail'];
                $mobile = $_POST['mobilenumber'];
                $address = $_POST['address'];
                $cityId = $_POST['city'];
                $pincode = $_POST['pincode'];
                $pass = $_POST['pass'];
                $userType = "Supplier";
//            echo $name . "</br>";
//            echo $emailId . "</br>";
//            echo $mobile . "</br>";
//            echo $address . "</br>";
//            echo $cityId . "</br>";
//            echo $pincode . "</br>";
//            echo $pass . "</br>";
//            echo $userType . "</br>";
                $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL:" . mysqli_connect_error();
                    exit();
                }
//            $query = "insert into tblUser (userId,name,emailId,mobileNumber,address,cityId,pincode,password,userType) values('2',$name','$emailId','$mobile','$address','$cityId','$pincode','$pass','$userType')";

                $sql = "INSERT INTO `tblUser`(`name`, `emailId`, `mobileNumber`, `address`, `cityId`, `pincode`, `password`, `userType`) VALUES ('$name','$emailId','$mobile','$address','$cityId','$pincode','$pass','$userType')";
//            echo $sql;
                $result = mysqli_query($connect, $sql);

                $sqlGet = "SELECT * from tblUser WHERE emailId='$emailId'";

                $result = mysqli_query($connect, $sqlGet);
                $userId;
                if (mysqli_num_rows($result) == 1) {
//                echo mysqli_num_rows($result);
                    while ($data = mysqli_fetch_array($result)) {
                        $userId = $data['userId'];
                    }
                    echo "<br>" . $userId . "<br>";
                }


//            echo $result;
//            print_r(mysqli_error_list($connect));
//            mysqli_close($connect);
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
                    $mail->Body = "$code. is Your One Time Verfication(OTP) code to confirm your User ID at SCMS";
                    $mail->addAddress($_POST['mail']);
                    if ($mail->send()) {
//                        echo "mail sent";
                        echo '<script>alert("Mail Sent")</script>';
//                    addRegData();
                        echo "<center><a href='./VerifyOTP.php'>Enter OTP</a></center>";
                        $_SESSION['emailIdtoUpdatePass'] = $_POST['mail'];
                        $_SESSION['otpCode'] = $code;
                        $_SESSION['otpType'] = "Registration";
//                    header("location:Login.php");
                    } else {
//                        echo 'Not Sent';
                        echo '<script>alert("Mail Not Sent")</script>';
                    } $mail->smtpClose();
                }
            }

            function addRegData() {
                echo 'function called';
//            include_once 'sqlConnection.php';
            }

        }
        ?>        
    </body> 
</html>