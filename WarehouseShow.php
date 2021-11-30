
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
        <title>User Profile</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Warehouse Details
        </div>
        <br/>
        <div class="tblpadding1">
            <?php
            include 'sqlConnection.php';
            $userId = $_SESSION['userId'];
//            echo $userId;
            //$selectquery = "select * from tblUser order by $col desc";
//            $selectquery = "select * from tbluser where userId=$userId";
            $selectquery = "select s.*,w.*,c.* from tblSupplier s,tblWarehouse w,tblcity c where s.userId=$userId and c.cityId=w.cityId and s.warehouseid=w.warehouseid";

            
            $query = mysqli_query($connect, $selectquery);

//            echo mysqli_num_rows($query);
            if (mysqli_num_rows($query) > 0) {
                $result = mysqli_fetch_assoc($query);
                ?>
                <table style="float: right;">
                    <tr>
                        <td><a href="warehouseEdit.php?warehouseId=<?php echo $result['warehouseId']; ?>"><input type="submit" class="btn-green" value="Edit" name="edit"/></td>
                        <!--<td><input type="submit" class="btn-blue" value="Change Password" name="changepassword"/></td>-->
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
        <br/><br/>
        <div class="tblpadding1">
            <?php
            include 'sqlConnection.php';
            //$selectquery = "select * from tblUser order by $col desc";
//            $selectquery = "select * from tbluser where userId=$userId";

            $query = mysqli_query($connect, $selectquery);

            if (mysqli_num_rows($query) > 0) {
                $result = mysqli_fetch_assoc($query);
                ?>

                <table class="tbl2" style="padding-left: 100px;">

                    <tbody>
                        <tr>
                            <th>Warehouse Name</th>
                            <td><?php echo $result['warehouseName']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $result['warehouseAddress']; ?></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><?php echo $result['cityName'];?></td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>
    </body>
</html>
