<?php
$conn = mysqli_connect("localhost", "root", "root", "SCMS");
if ($conn->connect_errno) {
    die("Connection failed:" . $conn->connect_errno);
}

$name = $_GET['name'];
$mail = $_GET['$mail'];
$mobilenumber = $_GET['$mobilenumber'];
$address = $_GET['$address'];
$state = $_GET['$state'];
$city = $_GET['$city'];
$pincode = $_GET['$pincode'];
$pass = $_GET['pass'];
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
            <form action="#" method="POST">      
                <div class="otp"> 
                    <table class="border1" >
                        <tr>
                            <td><label> Name: </label></td>
                            <td><input type="text" name="name" size="15" value="<?php echo "$name" ?>"  placeholder="Enter Your Name"/></td>
                        </tr>
                        <tr>
                            <td><label>Email Id: </label></td>
                            <td><input type="text" name="mail" value="<?php echo "$mail" ?>"  placeholder="Enter Email ID"></td>
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
                                <input type="text" name="mobilenumber" value="<?php echo "$mobilenumber" ?>" size="10" placeholder="Enter Mobile Number"/>
                            </td>
                        </tr>
                        <tr>
                            <td><label> Address: </label></td>
                            <td><textarea cols="31" rows="5" name="address" value="<?php echo "$address" ?>"  size="250" placeholder="Enter Your Address"/></textarea></td>
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

                                <select name="state" value="<?php echo "$state" ?>"  class="select1">
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

                                <select name="city" value="<?php echo "$city" ?>"  class="select1">
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
                            <td><input type="text" name="pincode" value="<?php echo "$pincode" ?>"  placeholder="Enter Pincode"></td>
                        </tr>
                        <tr>
                            <td><label> Password: </label></td>
                            <td><input type="password" id="pass" name="pass" value="<?php echo "$pass" ?>"  placeholder="********"></td>
                        </tr>
                        <tr>
                            <td><label> Confirm Password: </label></td>
                            <td><input type="password" id="conpass" name="conpass" placeholder="********"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" name="reset" value="Reset"/>
                                <input type="submit" name="Update" value="update"/>
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

    </body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "root", "SCMS");
if ($conn->connect_errno) {
    die("Connection failed:" . $conn->connect_errno);
}

if ($_GET['submit']) {
    $name = $_GET['name'];
    $mail = $_GET['$mail'];
    $mobilenumber = $_GET['$mobilenumber'];
    $address = $_GET['$address'];
    $state = $_GET['$state'];
    $city = $_GET['$city'];
    $pincode = $_GET['$pincode'];
    $pass = $_GET['pass'];

    $query = "UPDATE tblUser SET name='$name', mail='$mail', mobilenumber='$mobilenumber', address='$address', state='$state', city='$city', pincode='$pincode', pass='$pass' WHERE name='$name'";
    $data = mysqli_query($conn, $query);
    if ($data) {
        echo "<script>alert('Record Update')</script>";
    } else {
        echo "<script>alert('Failed to Update Record')</script>";
    }
}
?>

