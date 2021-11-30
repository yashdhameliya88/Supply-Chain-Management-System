<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
}
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
        <title>Product Show</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Warehouse Stock Details
        </div>
        <div>
            <?php
            include 'sqlConnection.php';
            $userId=$_SESSION['userId'];
            //$selectquery = "select * from tblUser order by $col desc";
            $selectquery = "select p.*,c.*,s.*,i.* from tblProduct p,tblCategory c,tblSupplier s,tblWarehouseStockDetails i where p.categoryId=c.categoryId and s.warehouseId=i.warehouseid and p.productId=i.productId and s.userId=$userId";

            $query = mysqli_query($connect, $selectquery);

            if (mysqli_num_rows($query) > 0) {
                ?>
                <table class="tbl1">
                    <thead style="text-align: center;">
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Description</th>
                    <th>Product MRP</th>
                    <th>Company Selling Price</th>
                    <th>Quantity</th>
                    </thead>
                    <tbody>

                        <?php
                        while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['categoryName']; ?></td>
                                <td><?php echo $result['productDescription']; ?></td>
                                <td><?php echo $result['MRP']; ?></td>
                                <td><?php echo $result['companySellingPrice']; ?></td>
                                <td><?php echo $result['quantity'];?></td>
                                
                        </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    echo "<center><h1>Database is Empty!!!</h1></center>";
                }
                ?>
            </table>
        </div>
    </body>
</html>
