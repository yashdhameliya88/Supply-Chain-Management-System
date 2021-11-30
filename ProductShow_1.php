<?php
session_start();
if(!isset($_SESSION['userId']))
{
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
            Show Product
        </div>
        <div>
            <?php
            include 'sqlConnection.php';
            //$selectquery = "select * from tblUser order by $col desc";
            $selectquery = "select * from tblProduct where deleted = 0";

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
                    <th colspan="2">Operation</th>
                    </thead>
                    <tbody>

                        <?php
                        while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['categoryId']; ?></td>
                                <td><?php echo $result['productDescription']; ?></td>
                                <td><?php echo $result['MRP']; ?></td>
                                <td><?php echo $result['companySellingPrice']; ?></thd>
                                <td><center><a href="ProductUpdate.php?ProductId=<?php echo $result['productId']; ?>"><i class="fa fa-edit" aria-edit="true"></i></center></td>
                        <td><center><a href="ProductDelete.php?ProductIds=<?php echo $result['productId']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></center></td>
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
