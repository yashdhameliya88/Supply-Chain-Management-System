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
        <title>Product Order</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Product Order
        </div>
        <div>
            <?php
            include 'sqlConnection.php';
            $ProductId = $_GET['ProductIds'];
            //$selectquery = "select * from tblUser order by $col desc";
            $selectquery = "select * from tblProduct where productId=$ProductId";

            $query = mysqli_query($connect, $selectquery);

            while ($result = mysqli_fetch_assoc($query)) {
            ?>
            <table class="tbl1">
                <thead style="text-align: left;">
                    <tr>
                        <th>Product Name</th>
                        <td><?php echo $result['productName']; ?></td>
                    </tr>
                    <tr>
                        <th>Product Category</th>
                        <td><?php echo $result['categoryId']; ?></td>
                    </tr>
                    <tr>
                        <th>Product Description</th>
                        <td><?php echo $result['productDescription']; ?></td>
                        
                    </tr>
                    <tr>
                        <th>Product MRP</th>
                        <td><?php echo $result['MRP']; ?></td>
                    </tr>
                    <tr>
                        <th>Company Selling Price</>
                        <td><?php echo $result['companySellingPrice']; ?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><a href="#"><button style="width: 30%;">Order</button></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </body>
</html>
