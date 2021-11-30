<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$orderId =$_GET['orderId'];
echo $orderId;

include 'sqlConnection.php';

$query = "UPDATE tblOrders set status='Delivered' where orderId=$orderId";
$result = mysqli_query($connect, $query);

if ($result) {
        echo '<script type="text/javascript"> 
                            alert("Order Accepted Successfully"); 
                            window.location.href = "./PackedOrders.php";
                            </script>;';
    } else {
        echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            window.location.href = "./PackedOrders.php"; 
                            </script>;';
    }