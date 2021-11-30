

<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
} elseif ($_SESSION['userType'] != "Admin") {
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
$productname = $productcategory = $productDescription = $mrp = $companySellingPrice = "";
$productnameErr = $productcategoryErr = $productDescriptionErr = $mrpErr = $companySellingPriceErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["productname"])) {
        $productnameErr = "Product Name is required";
    } else {
        $productname = test_input($_POST["productname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $productname)) {
            $productnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["productDescription"])) {
        $productDescriptionErr = "Descripton is required";
    } else {
        $productDescription = test_input($_POST["productDescription"]);
    }

    if (empty($_POST["mrp"])) {
        $mrpErr = "MRP is required";
    }

    if (empty($_POST["companySellingPrice"])) {
        $companySellingPriceErr = "Company Selling Price is required";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($productnameErr == "" && $productDescriptionErr == "" && $mrpErr == "" && $companySellingPriceErr == "") {
    if (isset($_POST['submit'])) {
        echo 'Hello';
        $productname = $_POST['productname'];
        $productcategory = $_POST['productcategory'];
        $productDescription = $_POST['productDescription'];
        $mrp = $_POST['mrp'];
        $companySellingPrice = $_POST['companySellingPrice'];

        if ($mrp > $companySellingPrice) {

            include './sqlConnection.php';
            $sql = "INSERT INTO tblProduct (productName,categoryId,productDescription,MRP,companySellingPrice) VALUES ('$productname',$productcategory,'$productDescription',$mrp,$companySellingPrice)";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                echo '<script type="text/javascript"> 
                            alert("You Successfully Added New Product"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
            } else {
                echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            </script>;';
            }
        } else {
            echo '<script type="text/javascript"> 
                            alert("Selling Price should be lesser than MRP");
                            </script>;';
        }

//        print_r(mysqli_error_list($connect));
    }
//    echo 'Hello2';
}
//echo 'Hello3';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Product Add</title>       
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Add Product
        </div>

        <div class="reg1">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">              
                <div class="otp">
                    <table class="border1" >
                        <tr>
                            <td><label> Product Name: </label></td>
                            <td><input type="text" name="productname" size="15" value="<?php echo $productname; ?>" placeholder="Enter Your Product Name"/></td>
                            <td><?php echo $productnameErr; ?></td>
                        </tr>
                        <tr>
                            <td><label>Product Category:</label></td>
                            <td>
    <!--                        <select class="select1">  
                                    <option value="-1" style=" font-weight: bold;">Select City</option>
                                    <option value="Surat">Surat</option>  
                                    <option value="Bardoli">Bardoli</option>  
                                    <option value="Vadodara">Vadodara</option>  
                                    <option value="Navasari">Navasari</option>  
                                    <option value="Vapi">Vapi</option>  
                                </select>-->

                                <select name="productcategory" class="select1">
                                    <option value="-1" disabled selected>-- Select Category --</option>
                                    <?php
                                    include './sqlConnection.php';
//                                    $connect = mysqli_connect("localhost", "root", "root", "SCMS") or die("Couldn't Connect!!");
                                    $records = mysqli_query($connect, "select * from tblCategory");

                                    while ($data = mysqli_fetch_array($records)) {
                                        if ($productcategory == $data['categoryId']) {
                                            echo "<option value='" . $data['categoryId'] . "' selected>" . $data['categoryName'] . "</option>";  // displaying data in option menu
                                        } else {
                                            echo "<option value='" . $data['categoryId'] . "'>" . $data['categoryName'] . "</option>";  // displaying data in option menu
                                        }
                                    }
                                    mysqli_close($connect);
                                    ?>
                                </select>

                            </td>
                            <td><?php echo $productcategoryErr; ?></td>
                        </tr>
<!--                        <tr>
                            <td><label>Product Category: </label></td>
                            <td><input type="text" name="productcategory" value="<?php echo $productcategory; ?>" placeholder="Enter Your Product Category"></td>
                            <td><?php echo $productcategoryErr; ?></td>
                        </tr>-->
                        <tr>
                            <td><label> Product Description: </label></td>
                            <td><textarea cols="31" rows="5" value="<?php echo $productDescription; ?>" name="productDescription" size="250" placeholder="Enter Your Product Description"><?php echo $productDescription; ?></textarea></td>
                            <td><?php echo $productDescriptionErr ?></td>
                        </tr>
                        <tr>
                            <td><label> Product MRP: </label></td>
                            <td><input type="number" step="0.01" name="mrp" size="10" value="<?php echo $mrp; ?>" placeholder="Enter Your Product MRP"/></textarea></td>
                            <td><?php echo $mrpErr ?></td>
                        </tr>
                        <tr>
                            <td><label> Company Selling Price: </label></td>
                            <td><input type="number" step="0.01" name="companySellingPrice" size="10" value="<?php echo $companySellingPrice; ?>" placeholder="Enter Your Company Selling Price"/></textarea></td>
                            <td><?php echo $companySellingPriceErr ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" name="reset" value="Reset"/>
                                <input type="submit" name="submit" value="Submit"/>
                            </td>
                        </tr>
                    </table>    
                </div>          
            </form>
        </div>
    </body>
</html>
