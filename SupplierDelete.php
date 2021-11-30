<?php

session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
}
?>
<?php

include 'sqlConnection.php';
$UserId = $_GET['UserIds'];

$query = "select * from tblsupplier where UserId=$UserId and supplierLevel=0";
$result = mysqli_query($connect, $query);

echo mysqli_num_rows($result);
if (mysqli_num_rows($result) >= 1) {
    echo '<script type="text/javascript"> 
                            alert("This is main supplier, this supplier can not be deleted."); 
                            window.location.href = "./SupplierShow.php";
                            </script>;';
} else {
    $deletequery = "UPDATE tblsupplier set status='Deleted' where UserId=$UserId";
//$deletequery = "delete from tblsupplier where UserId=$UserId";
    $query = mysqli_query($connect, $deletequery);

//$deletequery = "delete from tbluser where UserId=$UserId";
//$query = mysqli_query($connect, $deletequery);

    if ($query) {
        echo '<script type="text/javascript"> 
                            alert("Data Deleted Successfully"); 
                            window.location.href = "./SupplierShow.php";
                            </script>;';
    } else {
        echo '<script type="text/javascript"> 
                            alert("Data Not Deleted Please Try Again"); 
                            window.location.href = "./SupplierShow.php";
                            </script>;';
    }
}
?>