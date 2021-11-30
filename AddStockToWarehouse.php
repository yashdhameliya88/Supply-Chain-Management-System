<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$orderId = $_GET['orderId'];
echo $orderId;
$UserId = $_SESSION['userId'];
echo $UserId;
include './sqlConnection.php';



$query = "select * from tblSupplier where userId=$UserId";
echo $query;
$result = mysqli_query($connect, $query);
$r = mysqli_fetch_assoc($result);
$warehouseId = $r['warehouseId'];
echo $warehouseId;

if(is_null($warehouseId)){
    echo '<script type="text/javascript"> 
                            alert("You do not have any warehouse to add stock"); 
                            window.location.href = "./OrdersMy.php";
                            </script>;';
}
else{
$query = "select * from tblOrders where orderId=$orderId";
$result = mysqli_query($connect, $query);
$r = mysqli_fetch_assoc($result);
$productId = $r['productId'];
$quantity = $r['quantity'];

$query = "select * from tblWarehouseStockDetails where warehouseId=$warehouseId and productId=$productId";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    $r = mysqli_fetch_assoc($result);
    $oldQuantity = $r['quantity'];
    $quantity = $quantity + $oldQuantity;
    $query = "UPDATE tblWarehouseStockDetails set quantity=$quantity where warehouseId=$warehouseId and productId=$productId";
} else {
    $query = "INSERT INTO `tblWarehouseStockDetails`(`warehouseId`, `productId`, `quantity`) VALUES ($warehouseId,$productId,$quantity)";
}
$result = mysqli_query($connect, $query);

if ($result) {
    $query = "UPDATE tblOrders set status='Stocked' where orderId=$orderId";
    $result = mysqli_query($connect, $query);
    echo '<script type="text/javascript"> 
                            alert("Stock added to warehouse"); 
                            window.location.href = "./OrdersMy.php";
                            </script>;';
} else {
    echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            window.location.href = "./OrdersMy.php"; 
                            </script>;';
}

}
