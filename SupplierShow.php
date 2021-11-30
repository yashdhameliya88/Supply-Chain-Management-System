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
        <title>Show Suppliers</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Show Suppliers
        </div>
        <div>
            <?php
                    session_start();
            include 'sqlConnection.php';
            $user_id=$_SESSION['userId'];
            //$selectquery = "select * from tblUser order by $col desc";
            $selectquery;
            if($_SESSION['userType'] == "Supplier")
            {
//                echo 'a';
                $selectquery = "select c.*,u.*,s.* from tblCity c,tblUser u,tblSupplier s where c.cityId=u.cityId and u.userId=s.userId and s.status ='Approved' and s.parentSupplierId=(select supplierId from tblSupplier where userId=$user_id)";
            }
            else
            {
//                echo 'b';
                $selectquery = "select c.*,u.*,s.* from tblCity c,tblUser u,tblSupplier s where c.cityId=u.cityId and u.userId=s.userId and s.status ='Approved'";
            }

//            echo $selectquery;
            $query = mysqli_query($connect, $selectquery);

            if (mysqli_num_rows($query) > 0) {
                ?>
                <table class="tbl1">
                    <thead style="text-align: center;">
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th colspan="2">Operation</th>
                    </thead>
                    <tbody>

                        <?php
                        while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                        <tr>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['emailId']; ?></td>
                            <td><?php echo $result['mobileNumber']; ?></td>
                            <td><?php echo $result['address']; ?></td>
                            <td><?php echo $result['pincode']; ?></thd>
                            <td><center><a href="SupplierUpdate.php?UserId=<?php echo $result['userId']; ?>"><i class="fa fa-edit" aria-edit="true"></i></center></td>
                        <td><center><a href="SupplierDelete.php?UserIds=<?php echo $result['userId']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></center></td>
                        </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    echo "<center><h1>You Don't Have supplier network</h1></center>";
                }
                ?>
            </table>
        </div>
    </body>
</html>
