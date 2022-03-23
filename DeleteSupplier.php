<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">         
        <title>Delete Supplier</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
//        include 'database_connnnection.php';
        $conn = mysqli_connect("localhost", "root", "root", "SCMS");
        if ($conn->connect_errno) {
                die("Connection failed:" . $conn->connect_errno);
            }
            
        $userId=$_REQUEST['r'];
        $qur="delete from tblUser where userId=$userId";
        $q= mysqli_query($conn, $qur);
        if(!$qur)
        {
            echo mysqli_errno($conn);
        }
 else {
//            echo 'deleted successfully';
            echo '<script>alert("Deleted Successfully")</script>';
//            header("location:ShowSupplier.php");
    header("refresh:2; url=ShowSupplier.php");
 }
        // put your code here
        ?>
    </body>
</html>