<?php

include 'sqlConnection.php';
$UserId = $_GET['UserIds'];

$deletequery = "delete from tblwarehouse where warehouseId=$UserId";

$query = mysqli_query($connect, $deletequery);

if ($query) {
    echo '<script type="text/javascript"> 
                            alert("Warehouse Deleted Successfully"); 
                            window.location.href = "./WarehouseShow.php";
                            </script>;';
} else {
    echo '<script type="text/javascript"> 
                            alert("Warehouse Not Deleted Please Try Again"); 
                            window.location.href = "./WarehouseShow.php";
                            </script>;';
}
?>