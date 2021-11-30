<?php
error_reporting(0);
session_start();
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
        <link rel="stylesheet" href="./bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <script src="./bootstrap-5.0.0-beta2-dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
        <title>Navbar SCMS</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid" style="background-color: #272D83;">
                <a class="navbar-brand" href="http://localhost/SCMS/index.php" style="color: yellow;"onMouseOver="this.style.color = 'white'"
                   onMouseOut="this.style.color = 'yellow'">SCMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if ($_SESSION['userType']=="Admin") { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Suppliers
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="SupplierMainAdd.php">Add Main Supplier</a></li>
                                <li><a class="dropdown-item" href="SupplierShow.php">Supplier Details</a></li>
                                <li><a class="dropdown-item" href="SupplierNewRequests.php">Supplier Requests</a></li>
                                <li><a class="dropdown-item" href="SupplierShowRejected.php">Rejected Supplier</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Stock
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="InventoryAdd.php">Add Stock</a></li>
                                <li><a class="dropdown-item" href="ProductInventoryDetails.php">Stock Details</a></li>
                            </ul>
                        </li>
<!--                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Warehouse
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="WarehouseAdd.php">Add Warehouse</a></li>
                                <li><a class="dropdown-item" href="WarehouseShow.php">Warehouse Details</a></li>
                            </ul>
                        </li>-->
<!--                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Company
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="CompanyDetails.php">Company Details</a></li>
                            </ul>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="ProductAdd.php">Add Product</a></li>
                                <li><a class="dropdown-item" href="ProductShow.php">Product Details</a></li>
                                
                                <li><a class="dropdown-item" href="CategoryAdd.php">Add Category</a></li>
                            </ul>
                        </li>
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Orders
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="OrdersNew.php">New Orders</a></li>
                                <li><a class="dropdown-item" href="OrdersAccepted.php">Accepted Orders</a></li>
                                <li><a class="dropdown-item" href="PackedOrders.php">Packed Orders</a></li>
                                <li><a class="dropdown-item" href="OrdersDelivered.php">Delivered Orders</a></li>
                            </ul>
                        </li>
                <?php } else if($_SESSION['userType']=="Supplier") { ?>
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Suppliers
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="SupplierShow.php">Supplier Details</a></li>
                                <li><a class="dropdown-item" href="SupplierNewRequests.php">Supplier Requests</a></li>
                            </ul>
                        </li>
<!--                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Inventory
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Add Inventory</a></li>
                                <li><a class="dropdown-item" href="#">Inventory Details</a></li>
                            </ul>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="ProductShow.php">Product Details</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Warehouse
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="WarehouseAdd.php">Add Warehouse</a></li>
                                <li><a class="dropdown-item" href="WarehouseShow.php">Warehouse Details</a></li>
                                <li><a class="dropdown-item" href="WarehouseStockDetails.php">Warehouse Stock Details</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Orders
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="OrdersNew.php">New Orders</a></li>
                                <li><a class="dropdown-item" href="OrdersAccepted.php">Accepted Orders</a></li>
                                <li><a class="dropdown-item" href="PackedOrders.php">Packed Orders</a></li>
                                <li><a class="dropdown-item" href="OrdersDelivered.php">Delivered Orders</a></li>
                                <li><a class="dropdown-item" href="OrdersMy.php">My Orders</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (!$_SESSION['userType']) { ?>
                            <li><a class="Nav-Right-Header" href="Login.php"> Login</a></li>  
                            <li><a class="Nav-Right-Header" href="Registration.php"> Registration</a></li>
                            <?php } else { ?>
                            <li><a  class="Nav-Right-Header" href="UserProfile.php">Welcome, <?php echo $_SESSION['userName']; ?></a></li>  
                            <li><a class="Nav-Right-Header" href="Logout.php"> Logout</a></li>
                        <?php } ?>

                    </ul>
<!--                    <form class="d-flex">
                        <a href="loginPage.php"><button type="button" class="btn btn-info">Login</button></a>  
                        <a href="Registration.php"><button type="button" class="btn btn-light">Registration</button></a>
                    </form>-->
                </div>
            </div>
        </nav>
    </body>
</html>