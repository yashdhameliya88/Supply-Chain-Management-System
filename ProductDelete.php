<?php

session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
}
?>
<?php

include 'sqlConnection.php';
$ProductId = $_GET['ProductIds'];

$query = "select * from tblProduct where productId=$ProductId";
$result = mysqli_query($connect, $query);
$r = mysqli_fetch_assoc($result);
$inventory = $r['inventory'];
if ($inventory > 0) {
    echo '<script type="text/javascript"> 
                            alert("This Product can not be deleted because it has some inventory left over"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
} else {
//$deletequery = "delete from tblProduct where productId=$ProductId";
    $deletequery = "update tblProduct set deleted=1 where productId=$ProductId";
    $query = mysqli_query($connect, $deletequery);

//$deletequery = "delete from tbluser where UserId=$UserId";
//$query = mysqli_query($connect, $deletequery);

    if ($query) {
        echo '<script type="text/javascript"> 
                            alert("Data Deleted Successfully"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
    } else {
        echo '<script type="text/javascript"> 
                            alert("Data Not Deleted Please Try Again"); 
                            window.location.href = "./ProductShow.php";
                            </script>;';
    }
}
?>