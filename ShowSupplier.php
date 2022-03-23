<?php
session_start();
error_reporting(0);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">         
        <title>Show Supplier</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Show Supplier
        </div>

        <?php
//        echo $_SESSION['userType'];
//        if ($_SESSION['userType'] != "Supplier") {
            $conn = mysqli_connect("localhost", "root", "root", "SCMS");
            if ($conn->connect_errno) {
                die("Connection failed:" . $conn->connect_errno);
            }

            if (isset($_REQUEST['col'])) {
                $col = $_REQUEST['col'];
                echo $col;
                $query = "select * from tblUser order by $col desc";
            } else {
                $query = "select * from tblUser";
            }
            //$query="select * from tbluser";
            $r = mysqli_query($conn, $query);

            echo"";
            if (mysqli_num_rows($r) > 0) {
                echo '<table class="tbl1" style="width: 100%; height: 100%;">';
                echo "<tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email ID</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Pincode</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>";
                while ($row = mysqli_fetch_assoc($r)) { {
                        echo "<tr>";
                        echo"<td>$row[userId]</td>";
                        echo"<td>$row[name]</td>";
                        echo"<td>$row[emailId]</td>";
                        echo"<td>$row[mobileNumber]</td>";
                        echo"<td>$row[address]</td>";
                        echo"<td>$row[cityId]</td>";
                        echo"<td>$row[pincode]</td>";
                        echo"<td><button>Update</button></td>";
                        echo"<td><a href=DeleteSupplier.php?r=$row[userId]><button>Delete</button></a></td>";
                        echo"</tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "<center><h1>Database is Empty!!!</h1></center>";
            }
//        }
        ?>

    </body>
</html>
