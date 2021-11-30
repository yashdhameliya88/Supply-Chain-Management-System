<?php
session_start();
if(!isset($_SESSION['userId']))
{
    header("location:index.php");
}
//elseif($_SESSION['userType']!="Admin")
//{
//    header("location:Admin.php");
//}
?>
<?php
error_reporting(0);
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
            Update Users Details
        </div>

        <div class="reg1">
            <form action="#" method="POST">              
                <div class="otp">

                    <?php
                    include 'sqlConnection.php';
                    $UserId = $_GET['UserId'];
                    //$selectquery = "select * from tblUser order by $col desc";
                    $selectquery = "select * from tblUser where UserId=$UserId";

                    $query = mysqli_query($connect, $selectquery);

                    $result = mysqli_fetch_assoc($query);   


                    if (isset($_POST['submit'])) {
                        $name = $_POST['name'];
                        $emailId = $_POST['mail'];
                        $mobile = $_POST['mobilenumber'];
                        $address = $_POST['address'];
                        $pincode = $_POST['pincode'];

                        $updatequery = "update tblUser set name='$name',mobileNumber='$mobile',address='$address',pincode='$pincode' where UserId=$UserId";
                        $query = mysqli_query($connect, $updatequery);

                        if ($query) {
                            echo '<script type="text/javascript"> 
                            alert("Data Updated Successfully"); 
                            window.location.href = "./SupplierShow.php";
                            </script>;';
                            
                        } else {
                            echo '<script type="text/javascript"> 
                            alert("Data Not Updated Please Try Again"); 
                            </script>;';
                            
                        }
                    }
                    ?>

                    <table class="border1" >
                        <tr>
                            <td><label> Name: </label></td>
                            <td><input type="text" name="name" value="<?php echo $result['name']; ?>" size="15" placeholder="Enter Your Name" required/></td>
                            <td><?php echo $nameErr; ?></td>
                        </tr>
                        <tr>
                            <td><label>Email Id: </label></td>
                            <td><input type="text" name="mail" value="<?php echo $result['emailId']; ?>" placeholder="Enter Email ID" disabled required></td>
                            <!--<td><?php // echo $emailErr;        ?></td>-->
                        </tr>
                        <tr>
                            <td><label> Mobile Number: </label></td>
                            <td>
                                <input type="text" name="mobilenumber" value="<?php echo $result['mobileNumber']; ?>" size="10" placeholder="Enter Mobile Number" required/>
                            </td>
                            <td><?php echo $mobileErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Address: </label></td>
                            <td><textarea cols="31" rows="5" name="address" size="250" placeholder="Enter Your Address" required/><?php echo $result['address']; ?></textarea></td>
                            <td><?php echo $addressErr ?></td>
                        </tr>


                        <tr>
                            <td><label>PinCode: </label></td>
                            <td><input type="text" name="pincode" value="<?php echo $result['pincode']; ?>" placeholder="Enter Pincode"></td>
                            <td><?php echo $pincodeErr; ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" name="reset" value="Reset"/>
                                <input type="submit" class="sh"name="submit" value="Update"/>
                            </td>
                        </tr>

                    </table>    
                </div>          
            </form>
        </div>

    </body>
</html>
