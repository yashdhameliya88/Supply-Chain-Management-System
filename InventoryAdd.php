
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
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Stock</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
<?php
include 'HeaderPage.php';
?>
        <div class="div1">
            Add Stock
        </div>

        <div class="reg1">
            <form name="MyForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <table>
                    <tr>
                        <td><label> Product: </label></td>
                        <td>
                            <select class="select1" name="product">  
                                <option value="-1" style=" font-weight: bold;">Select Product Code</option>
<?php
include 'sqlConnection.php';
$query = "select * from tblProduct";
$records = mysqli_query($connect, $query);

while ($data = mysqli_fetch_array($records)) {

    echo "<option value='" . $data['productId'] . "'>" . $data['productName'] . "</option>";
}
?>
                                <!--                                <option value=""></option>  
                                                                <option value=""></option>  
                                                                <option value=""></option>  
                                                                <option value=""></option>  
                                                                <option value=""></option>  -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>  New Inventory: </label></td>
                        <td><input type="number" name="qtyInhand" required/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="reset" value="Reset"/>
                            <input type="submit" value="Submit"/>                            
                        </td> 
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['product'])) {
    $ProductId = $_POST['product'];
    $NewInventory = $_POST['qtyInhand'];
    echo $ProductId;
    echo $NewInventory;

    include 'sqlConnection.php';

    $query = "select inventory from tblProduct where productId=$ProductId";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
//    echo mysqli_num_rows($result);
    $oldInventory = $data['inventory'];
//    echo $oldInventory;
//    echo $NewInventory;
    $NewInventory = $NewInventory + $oldInventory;
//    echo $NewInventory;
    $query = "update tblProduct set inventory=$NewInventory where productId=$ProductId";
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo '<script type="text/javascript"> 
                            alert("Inventory Updated Successfully"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
    } else {
        echo '<script type="text/javascript"> 
                            alert("Inventory Not Updated Please Try Again"); 
                            </script>;';
    }
}
?>
