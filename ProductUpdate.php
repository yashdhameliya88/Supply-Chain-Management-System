<?php
session_start();
if(!isset($_SESSION['userId']))
{
    header("location:index.php");
}
elseif($_SESSION['userType']!="Admin")
{
    header("location:Admin.php");
}
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
        <title>Update Product</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Update Product Details
        </div>

        <div class="reg1">
            <form action="#" method="POST">              
                <div class="otp">

                    <?php
                    include 'sqlConnection.php';
                    $ProductId = $_GET['ProductId'];
                    //$selectquery = "select * from tblUser order by $col desc";
                    $selectquery = "select * from tblProduct where productId=$ProductId";

                    $query = mysqli_query($connect, $selectquery);

                    $result = mysqli_fetch_assoc($query);


                    if (isset($_POST['submit'])) {
                        $productname = $_POST['productname'];
                        $productcategory = $_POST['productcategory'];
                        $productDescription = $_POST['productDescription'];
                        $mrp = $_POST['mrp'];
                        $companySellingPrice = $_POST['companySellingPrice'];

                        $updatequery = "update tblProduct set productName='$productname',categoryId='$productcategory',productDescription='$productDescription',MRP='$mrp',companySellingPrice='$companySellingPrice' where productId=$ProductId";
                        $query = mysqli_query($connect, $updatequery);
                        print_r(mysqli_error_list($connect));
                        if ($query) {
                            echo '<script type="text/javascript"> 
                            alert("Data Updated Successfully"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
                            
                        } else {
                            echo '<script type="text/javascript"> 
                            alert("Data Not Updated Please Try Again"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
                            
                        }
                    }
                    ?>

                    <table class="border1" >
                        <tr>
                            <td><label> Product Name: </label></td>
                            <td><input type="text" name="productname" size="15" value="<?php echo $result['productName']; ?>" placeholder="Enter Your Product Name"/></td>
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

//                                    while ($data = mysqli_fetch_array($records)) {
//                                        echo "<option value='" . $data['categoryId'] . "' >" . $data['categoryName'] . "</option>";  // displaying data in option menu
//                                    }
                                    
                                    while ($data = mysqli_fetch_array($records)) {
                                        if ($data['categoryId'] == $result['categoryId']) {
                                            echo "<option value='" . $data['categoryId'] . "' selected>" . $data['categoryName'] . "</option>";  // displaying data in option menu
                                        } else {
                                            echo "<option value='" . $data['categoryId'] . "' >" . $data['categoryName'] . "</option>";  // displaying data in option menu
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
                            <td><input type="text" name="productcategory" value="<?php echo $result['categoryId']; ?>" placeholder="Enter Your Product Category"></td>
                            <td><?php echo $productcategoryErr; ?></td>
                        </tr>-->
                        <tr>
                            <td><label> Product Description: </label></td>
                            <td><textarea cols="31" rows="5" name="productDescription" size="250" placeholder="Enter Your Product Description"/><?php echo $result['productDescription']; ?></textarea></td>
                            <td><?php echo $productDescriptionErr ?></td>
                        </tr>
                        <tr>
                            <td><label> Product MRP: </label></td>
                            <td><input type="number" step="0.01" name="mrp" size="10" value="<?php echo $result['MRP']; ?>" placeholder="Enter Your Product MRP"/></textarea></td>
                            <td><?php echo $mrpErr ?></td>
                        </tr>
                        <tr>
                            <td><label> Company Selling Price: </label></td>
                            <td><input type="number" step="0.01" name="companySellingPrice" size="10" value="<?php echo $result['companySellingPrice']; ?>" placeholder="Enter Your Company Selling Price"/></textarea></td>
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
