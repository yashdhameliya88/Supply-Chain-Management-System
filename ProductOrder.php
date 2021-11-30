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
            <!--<table class="tbl1">-->
             <table class="tbl2" style="padding-left: 100px;">
                <tbody style="text-align: left;">
                    <tr>
                        <th>Product Name</th>
                        <td><?php echo $result['productName']; $ProductId=$result['productId'];?></td>
                        
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
                        <td><?php echo $result['companySellingPrice'];  $price = $result['companySellingPrice'];?></td>
                    </tr>
                <form ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <tr>
                        <th>Quantity<th/>
                    <input type="number" name="quantity" placeholder="Enter Your Quantity" min="1" required/>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" name="submit" placeholder="Order" value="Order" style="width: 30%"/></td>
                        <!--<td><a href="#"><button style="width: 30%;">Order</button></td>-->
                    </tr>
                    </form>
                
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

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $quantity = $_POST['quantity'];
//    echo $ProductId;
    $buyer=$_SESSION['userId'];
//    echo $buyer;
    include './sqlConnection.php';
    
    $query = "select * from tblSupplier where userId=$buyer";
    $result = mysqli_query($connect, $query);
    
//    echo mysqli_num_rows($result);
    $r= mysqli_fetch_assoc($result);
    
    $parentSupplier = $r['parentSupplierId'];
//    echo $seller;
    if(is_null($parentSupplier))
    {
        echo 'null';
        $query = "select * from tblUser where userType='Admin'";
        $result = mysqli_query($connect, $query);
        $r= mysqli_fetch_assoc($result);
        $seller=$r['userId'];
//        $seller = -1;
//        echo $seller;
    }
    else{
        $query = "select * from tblSupplier where supplierId=$parentSupplier";
        $result = mysqli_query($connect, $query);
        $r= mysqli_fetch_assoc($result);
        $seller=$r['userId'];
    }
//    echo $price;
//    echo $quantity;
    
    $query = "INSERT INTO `tblOrders`( `productId`, `buyerId`, `sellerId`, `quantity`, `price`, `status`) VALUES ($ProductId,$buyer,$seller,$quantity,$price,'Ordered')";
    $result = mysqli_query($connect, $query);
    
    if ($result) {
        echo '<script type="text/javascript"> 
                            alert("You Successfully Placed Order"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
    } else {
        echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            </script>;';
    }
    
    
    
}
?>
