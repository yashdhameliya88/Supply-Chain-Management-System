
<?php
session_start();
error_reporting(0);
if (isset($_SESSION['userId'])) {
    header("location:Admin.php");
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

//error_reporting(0);
//header("location:Login.php");
?>
<?php
if (isset($_POST['VerifyOtp'])) {
    $name = $_POST['name'];
    $emailId = $_POST['mail'];
    $mobile = $_POST['mobilenumber'];
    $address = $_POST['address'];
    $stateId = $_POST['state'];
    $cityId = $_POST['city'];
    $pincode = $_POST['pincode'];
    $pass = $_POST['pass'];
    $conPass = $_POST['conpass'];
    $userType = "Supplier";
}
?>
<?php
$nameErr = $emailErr = $addressErr = $cityErr = $mobileErr = $pincodeErr = $passErr = $conPassErr = "";
$name = $email = $city = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $email = test_input($_POST["mail"]);
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

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        $passErr = 'Password should be at least 8 characters in length and should include at least one upper case letter, one lower case letter, one number, and one special character.';
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
        <title>Registration Page</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>     
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Registration Page
        </div>

        <div class="reg1">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">              
                <div class="otp">
                    <table class="border1" >
                        <tr>
                            <td><label> Name: </label></td>
                            <td><input type="text" name="name" size="15" value="<?php echo $name; ?>" placeholder="Enter Your Name"/></td>
                            <td><?php echo $nameErr; ?></td>
                        </tr>
                        <tr>
                            <td><label>Email Id: </label></td>
                            <td><input type="text" name="mail" value="<?php echo $emailId; ?>" placeholder="Enter Email ID"></td>
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
                                <input type="text" name="mobilenumber" size="10" value="<?php echo $mobile; ?>" placeholder="Enter Mobile Number" maxlength="10"/>
                            </td>
                            <td><?php echo $mobileErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Address: </label></td>
                            <td><textarea cols="31" rows="5" value="<?php echo $address; ?>" name="address" size="250" placeholder="Enter Your Address"/><?php echo $address; ?></textarea></td>
                            <td><?php echo $addressErr ?></td>
                        </tr>
                        <tr>
                            <td><label> State: </label></td>
                            <td>
                                <select id="state" name="state" class="select1">
                                    <option value="-1" disabled selected>-- Select State --</option>
                                    <?php
//                                    include './sqlConnection.php';
////                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
//                                    $records = mysqli_query($connect, "select * from tblState");
//
//                                    while ($data = mysqli_fetch_array($records)) {
//                                        
//                                            echo "<option value='" . $data['stateId'] . "'>" . $data['stateName'] . "</option>";
//                                        
//                                    }
//                                    mysqli_close($connect);
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td><label> City: </label></td>
                            <td>
                                <select id="city" name="city" class="select1">

                                    <option value="-1" disabled selected>-- Select City --</option>
                                    <?php
//                                    include './sqlConnection.php';
////                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
//                                    $records = mysqli_query($connect, "select * from tblCity");
//
//                                    while ($data = mysqli_fetch_array($records)) {
//                                        if ($cityId == $data['cityId']) {
//                                            echo "<option value='" . $data['cityId'] . "'selected>" . $data['cityName'] . "</option>";  // displaying data in option menu
//                                        } else {
//                                            echo "<option value='" . $data['cityId'] . "' >" . $data['cityName'] . "</option>";
//                                        }
//                                    }
//                                    mysqli_close($connect);
                                    ?>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td><label>PinCode: </label></td>
                            <td><input type="text" name="pincode" value="<?php echo $pincode; ?>" placeholder="Enter Pincode" maxlength="6"></td>
                            <td><?php echo $pincodeErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Password: </label></td>
                            <td><input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" placeholder="********"></td>
                            <td><?php echo $passErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Confirm Password: </label></td>
                            <td><input type="password" id="conpass" name="conpass" value="<?php echo $conPass; ?>" placeholder="********"></td>
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
        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, category_id){
  		$.ajax({
  			url : "StateCity.php",
  			type : "POST",
  			data: {type : type, id : category_id},
  			success : function(data){
  				if(type == "cityData"){
  					$("#city").html(data);
  				}else{
  					$("#state").append(data);
  				}
  				
  			}
  		});
  	}

  	loadData();

  	$("#state").on("change",function(){
  		var country = $("#state").val();

  		if(state != ""){
  			loadData("cityData", country);
  		}else{
  			$("#city").html("");
  		}

  		
  	})
  });
</script>

        <?php
        session_start();
        if ($nameErr == "" && $emailErr == "" && $addressErr == "" && $cityErr == "" && $mobileErr == "" && $pincodeErr == "" && $passErr == "" && $conPassErr == "") {
            $userId;
            if (isset($_POST['VerifyOtp'])) {
                $name = $_POST['name'];
                $emailId = $_POST['mail'];
                $mobile = $_POST['mobilenumber'];
                $address = $_POST['address'];
                $cityId = $_POST['city'];
                $stateId = $_POST['state'];
                $pincode = $_POST['pincode'];
                $pass = $_POST['pass'];
                $userType = "Supplier";
                $supplierLevel = 0;
                $parentSupplier = 0;



//            echo $name . "</br>";
//            echo $emailId . "</br>";
//            echo $mobile . "</br>";
//            echo $address . "</br>";
//            echo $cityId . "</br>";
//            echo $pincode . "</br>";
//            echo $pass . "</br>";
//            echo $userType . "</br>";
//            echo $result;
//            print_r(mysqli_error_list($connect));
//            mysqli_close($connect);
            }
            
            include './sqlConnection.php';
        $sqlexists = "select * from tbluser where (emailId='$emailId');";
        $resexists = mysqli_query($connect,$sqlexists);
        if (mysqli_num_rows($resexists) > 0) {
        
        $rowexists = mysqli_fetch_assoc($resexists);
        
        if ($emailId==$rowexists['emailId'])
        {
            echo '<script type="text/javascript"> 
                            alert("Email ID already exists"); 
                            window.location.href = "./Registration.php";
                            </script>;';
        }
        }
        else
        {
            
            
            include './sqlConnection.php';
            $query = "SELECT * from tblSupplier WHERE supplierLevel=0";
            $result = mysqli_query($connect, $query);
//            echo mysqli_num_rows($result);

            if (mysqli_num_rows($result) == 0) {
                echo "<h1>Sorry We don't have any parent supplier to assign to you</h1>";
            } else {
                include './sqlConnection.php';
                $query = "SELECT count(u.userId) as total FROM tblUser u,tblSupplier s WHERE u.cityId IN (SELECT cityId FROM tblCity WHERE stateId=$stateId) and u.userType='Supplier' and s.supplierLevel!=0";
                $result = mysqli_query($connect, $query);
                $data1 = mysqli_fetch_assoc($result);
                echo "data1" . $data1['total'];

                if ($data1['total'] > 0) {
                    $supplierLevel = 2;
                } else {
                    $supplierLevel = 1;
                }
                echo "<br><h2>$supplierLevel</h2><br>";

                if ($supplierLevel == 2) {
                    $query = "select s.supplierId as sid from tblCity c,tblUser u,tblSupplier s where c.cityId=u.cityId and u.userId=s.userId and c.stateId=$stateId and s.supplierLevel=1";
                    $result = mysqli_query($connect, $query);
                    $data2 = mysqli_fetch_assoc($result);
                    echo "<br><h1>" . mysqli_num_rows($result) . "</h1><br>";
                    $parentSupplier = $data2['sid'];
                } elseif ($supplierLevel == 1) {
                    $query = "select s.supplierId as sid from tblUser u,tblSupplier s where u.userId=s.userId and s.supplierLevel=0";
                    $result = mysqli_query($connect, $query);
                    $data2 = mysqli_fetch_assoc($result);
                    $parentSupplier = $data2['sid'];
                }
                echo "<h1>Parent $parentSupplier</h1>";
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
                        $mail->setFrom("scmsofficial2021@gmail.com"); //Your Email ID
                        $mail->Body = "$code. is Your One Time Verfication(OTP) code to confirm your User ID at SCMS for Registration";
                        $mail->addAddress($_POST['mail']);
                        if ($mail->send()) {
//                            echo '<script>alert("Mail Sent")</script>';
//                            echo "<center><a href='./VerifyOTP.php'>Enter OTP</a></center>";

                            $_SESSION['emailIdtoUpdatePass'] = $_POST['mail'];
                            $_SESSION['otpCode'] = $code;
                            $_SESSION['otpType'] = "Registration";

//                        $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                            include './sqlConnection.php';
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL:" . mysqli_connect_error();
                                exit();
                            }

                            $encPass=md5($pass);
                            $sql = "INSERT INTO `tblUser`(`name`, `emailId`, `mobileNumber`, `address`, `cityId`, `pincode`, `password`, `userType`) VALUES ('$name','$emailId','$mobile','$address','$cityId','$pincode','$encPass','$userType')";
                            $result = mysqli_query($connect, $sql);
                            $sql2 = "INSERT INTO tblSupplier (`supplierLevel`,`parentSupplierId`,`userId`,`status`) VALUES ($supplierLevel,$parentSupplier," . mysqli_insert_id($connect) . ",'Not Approved')";
                            $result2 = mysqli_query($connect, $sql2);

                            print_r(mysqli_error_list($connect));
                            $query = "SELECT * from tblOTP WHERE emailId='$emailId'";
                            $result = mysqli_query($connect, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $sql = "UPDATE tblOTP SET otp='$code', generatedTime=now() WHERE emailId='$emailId'";
                                $result4 = mysqli_query($connect, $sql);
                            } else {
                                $sql3 = "INSERT INTO tblOTP (`emailId`,`otp`) VALUES ('$emailId','$code')";
                                $result3 = mysqli_query($connect, $sql3);
                            }



//                            print_r(mysqli_error_list($connect));

                            $sqlGet = "SELECT * from tblUser WHERE emailId='$emailId'";

                            $result = mysqli_query($connect, $sqlGet);

                            if (mysqli_num_rows($result) == 1) {
                                while ($data = mysqli_fetch_array($result)) {
                                    $userId = $data['userId'];
                                }
                            }
                            print_r(mysqli_error_list($connect));
                            echo '<script type="text/javascript"> 
                            alert("Mail Sent"); 
                            window.location.href = "./VerifyOTP.php";
                            </script>;';
//                    header("location:Login.php");
                        } else {
//                        echo 'Not Sent';
                            echo $mail->ErrorInfo;
//                            echo '<script>alert("Mail Not Sent")</script>';
                            echo '<script type="text/javascript"> 
                            alert("Mail Not Sent"); 
                            window.location.href = "./Registration.php";
                            </script>;';
                        } $mail->smtpClose();
                    }
                }
            }

            function addRegData() {
                echo 'function called';
//            include_once 'sqlConnection.php';
            }

        }
        }
        ?>       

    </body> 
</html>