<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
}
//error_reporting(0);
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
            New Orders
        </div>
        <div>
            <?php
            include 'sqlConnection.php';
            //$selectquery = "select * from tblUser order by $col desc";
            $UserId=$_SESSION['userId'];
            $selectquery = "select p.*,u.*,o.* from tblProduct p,tblUser u,tblOrders o where p.productId=o.productId and u.userId=o.buyerId and o.sellerId=$UserId and o.status='Ordered'";

            $query = mysqli_query($connect, $selectquery);

//            print_r($connect);
//            echo mysqli_error_list($connect);
//            echo mysqli_num_rows($query);
            if (mysqli_num_rows($query) > 0) {
                ?>
                <table class="tbl1">
                    <thead style="text-align: center;">
                    <th>Product Name</th>
                    <th>Buyer Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <?php if ($_SESSION['userType'] == "Admin") { ?>
                        <th colspan="2">Operation</th>
                    <?php } else if ($_SESSION['userType'] == "Supplier") { ?>
                        <th>Operation</th>
                    <?php } ?>
                    </thead>
                    <tbody>

                        <?php
                        while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td><?php echo $result['price']; ?></td>
                                <td><a href="OrderAccept.php?orderId=<?php echo $result['orderId']; ?>"><button style="width: 100%;">Accept Order</button></a></td>
                        
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
