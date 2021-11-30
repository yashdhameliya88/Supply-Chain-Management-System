
<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
} elseif ($_SESSION['userType'] != "Supplier") {
    header("location:Admin.php");
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$nameErr = $addressErr = "";
$name = $address = "";
$warehouseId = $_GET['warehouseId'];
include 'sqlConnection.php';
$query = "select * from tblWarehouse where warehouseId=$warehouseId";
$result = mysqli_query($connect, $query);
$r = mysqli_fetch_assoc($result);

$name = $r['warehouseName'];
$address = $r['warehouseAddress'];
$cityId = $r['cityId'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["warehousename"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["warehousename"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["warehouseaddress"])) {
        $addressErr = "address is required";
    } else {
        $address = test_input($_POST["warehouseaddress"]);
    }
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
        <title>Add Warehouse</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Add Warehouse
        </div>
        <div class="reg1">
            <form action="#" method="POST">              
                <div class="otp"> 
                    <table class="border1" >
                        <tr>
                            <td><label>Warehouse Name: </label></td>
                            <td><input type="text" name="warehousename" placeholder="Enter Warehouse Name" value="<?php echo $name; ?>" required></td>
                            <td><?php echo $nameErr; ?></td>
                        </tr>
                        <tr>
                            <td><label> Warehouse Address: </label></td>
                            <td><textarea cols="31" rows="5" value="<?php echo $address; ?>" name="warehouseaddress" size="250" placeholder="Enter Your Warehouse Address" required><?php echo $address; ?></textarea></td>
                            <td><?php echo $addressErr ?></td>
                        </tr>
<!--                        <tr>
                            <td><label> State: </label></td>
                            <td>
                                <select class="select1">  
                                    <option value="-1" style=" font-weight: bold;">Select State</option>
                                    <option value="Surat">Gujarat</option>  
                                    <option value="Bardoli">Maharastra</option>  
                                    <option value="Vadodara">Panjab</option>  
                                    <option value="Navasari">Varanashi</option>  
                                    <option value="Vapi">Uttar Pradesh</option>  
                                </select>
                                <select name="state" class="select1">
                                    <option value="-1" disabled selected>-- Select State --</option>
                        <?php
//                                    include './sqlConnection.php';
////                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
//                                    $records = mysqli_query($connect, "select * from tblState");
//
//                                    while ($data = mysqli_fetch_array($records)) {
//                                        echo "<option value='" . $data['stateId'] . "'>" . $data['stateName'] . "</option>";  // displaying data in option menu
//                                    }
//                                    mysqli_close($connect);
                        ?>
                                </select>
                            </td>
                        </tr>-->
                        <tr>
                            <td><label> City: </label></td>
                            <td>
<!--                                <select class="select1">  
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
                                    include './sqlConnection.php';
//                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                                    $records = mysqli_query($connect, "select * from tblCity");

                                    while ($data = mysqli_fetch_array($records)) {
                                        if($cityId = $data['cityId'])
                                        {
                                        echo "<option value='" . $data['cityId'] . "' selected>" . $data['cityName'] . "</option>";  // displaying data in option menu
                                        }
                                        else{
                                            echo "<option value='" . $data['cityId'] . "'>" . $data['cityName'] . "</option>";  // displaying data in option menu
                                        }
                                    }
                                    mysqli_close($connect);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" name="reset" value="Reset"/>
                                <input type="submit" class="sh"name="submit" value="Submit"/>
                            </td>
                        </tr>
                    </table>    
                </div>          
            </form>
        </div>
    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    if ($nameErr == "" && $addressErr == "") {
        $warehousename = $_POST['warehousename'];
        $warehouseaddress = $_POST['warehouseaddress'];
        $city = $_POST['city'];
        $userId = $_SESSION['userId'];
//            echo '<br>'.$warehousename;
//            echo '<br>'.$warehouseaddress;
//            echo '<br>'.$city;

        include './sqlConnection.php';

//        $sql = "SELECT * FROM tblSupplier where userId=$userId and warehouseId IS NOT NULL";
//        $result = mysqli_query($connect, $sql);
//        echo mysqli_num_rows($result);
//        if (mysqli_num_rows($result) > 0) {
//            echo '<h1>You already have a warehouse!!!</h1>';
//        } else {
//            $sql = "INSERT INTO tblWarehouse (warehouseName,warehouseAddress,cityId) VALUES ('$warehousename','$warehouseaddress',$city)";
        $sql = "UPDATE tblWarehouse set warehouseName='$warehousename', warehouseAddress='$warehouseaddress', cityId=$city  where warehouseId=$warehouseId";
        $result = mysqli_query($connect, $sql);
//            print_r($connect);
        echo $result;

        if ($result) {
            echo '<script type="text/javascript"> 
                            alert("Data Updated Successfully"); 
                            window.location.href = "./WarehouseShow.php";
                            </script>;';
        } else {
            echo '<script type="text/javascript"> 
                            alert("Data Not Updated Please Try Again"); 
                            </script>;';
        }

//            $sql = "UPDATE tblSupplier SET warehouseId=" . mysqli_insert_id($connect) . " WHERE userId=$userId";
//            $result = mysqli_query($connect, $sql);
//            print_r(mysqli_error_list($connect));
//        }
    }
}
?>