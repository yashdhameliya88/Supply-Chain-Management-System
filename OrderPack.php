<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$userType = $_SESSION['userType'];
echo $userType;
$UserId = $_SESSION['userId'];
$orderId = $_GET['orderId'];
//$orderId = 1;
echo $orderId;

include 'sqlConnection.php';

if ($userType == "Supplier") {
    $query = "select * from tblSupplier where userId=$UserId";
    echo $query;
    $result = mysqli_query($connect, $query);
    $r = mysqli_fetch_assoc($result);
    $warehouseId = $r['warehouseId'];
    echo $warehouseId;

    if (is_null($warehouseId)) {
        echo '<script type="text/javascript"> 
                            alert("You do not have any warehouse"); 
                            window.location.href = "./OrdersAccepted.php";
                            </script>;';
    } else {


        $query = "select * from tblSupplier where userId=$UserId";
        echo $query;
        $result = mysqli_query($connect, $query);
        $r = mysqli_fetch_assoc($result);
        $warehouseId = $r['warehouseId'];
        echo $warehouseId;

        $query = "select * from tblOrders where orderId=$orderId";
        $result = mysqli_query($connect, $query);
        $r = mysqli_fetch_assoc($result);
        $productId = $r['productId'];
        $quantity = $r['quantity'];


        $query = "select * from tblWarehouseStockDetails where warehouseId=$warehouseId and productId=$productId";
        $result = mysqli_query($connect, $query);

        $r = mysqli_fetch_assoc($result);
        $availablequantity = $r['quantity'];
        echo mysqli_num_rows($result);
        if (mysqli_num_rows($result) == 0) {
            echo '<script type="text/javascript"> 
                            alert("You Do not have this product in your stock"); 
                            window.location.href = "./OrdersAccepted.php";
                            </script>;';
        } elseif ($quantity > $availablequantity) {
            echo '<script type="text/javascript"> 
                            alert("You Do not have enough quantity of this product in your stock"); 
                            window.location.href = "./OrdersAccepted.php";
                            </script>;';
        } else {
            $quantity = $availablequantity - $quantity;
            $query = "UPDATE tblWarehouseStockDetails set quantity=$quantity where warehouseId=$warehouseId and productId=$productId";
            $result = mysqli_query($connect, $query);
            $query = "UPDATE tblOrders set status='Packed' where orderId=$orderId";
            $result = mysqli_query($connect, $query);

            if ($result) {
                echo '<script type="text/javascript"> 
                            alert("Order is ready for shipment"); 
                            window.location.href = "./OrdersAccepted.php";
                            </script>;';
            } else {
                echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            window.location.href = "./OrdersAccepted.php"; 
                            </script>;';
            }
        }
    }
} elseif ($userType == "Admin") {
    $query = "select * from tblOrders where orderId=$orderId";
    $result = mysqli_query($connect, $query);
    $r = mysqli_fetch_assoc($result);
    $productId = $r['productId'];
    $quantity = $r['quantity'];

    $query = "select * from tblProduct where productId=$productId";
    $result = mysqli_query($connect, $query);
    $r = mysqli_fetch_assoc($result);
    $availablequantity = $r['inventory'];
    if ($quantity > $availablequantity) {
        echo '<script type="text/javascript"> 
                            alert("You Do not have enough quantity of this product in your stock"); 
                            window.location.href = "./OrdersAccepted.php";
                            </script>;';
    } else {
        $quantity = $availablequantity - $quantity;
        $query = "UPDATE tblOrders set status='Packed' where orderId=$orderId";
        $result = mysqli_query($connect, $query);

        $query = "UPDATE tblProduct set inventory=$quantity where productId=$productId";
        $result = mysqli_query($connect, $query);
        if ($result) {
            echo '<script type="text/javascript"> 
                            alert("Order is ready for shipment"); 
                            window.location.href = "./OrdersAccepted.php";
                            </script>;';
        } else {
            echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            window.location.href = "./OrdersAccepted.php"; 
                            </script>;';
        }
    }
}

