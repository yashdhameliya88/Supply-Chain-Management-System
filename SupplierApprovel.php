
<?php

session_start();
if (!isset($_SESSION['userId'])) {
    header("location:index.php");
}
?>
<?php

require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'sqlConnection.php';


//$connect = mysqli_connect("localhost", "root", "root", "SCMS");

if ($connect->connect_errno) {
    die("Connection failed:" . $connect->connect_errno);
}

$userId = $_REQUEST['r'];
echo $userId;
$qur = "UPDATE tblSupplier SET status='Approved' WHERE supplierId='$userId'";
$q = mysqli_query($connect, $qur);

//        $qur = "delete from tblSupplier where userId=$userId";
//        $q1= mysqli_query($connect, $qur);
//        $qur = "delete from tblUser where userId=$userId";
//        $q = mysqli_query($connect, $qur);

if (!$qur) {
    echo mysqli_errno($connect);
} else {
//            echo 'deleted successfully';
//    print_r(mysqli_error_list($connect));
//            header("location:ShowSupplier.php");
//    echo '<script>alert("Approved Successfully")</script>';
//    header("refresh:2; url=SupplierNewRequests.php");

    $userid = $_SESSION['userId'];
    $query = "select s.*,u.* from tblSupplier s,tblUser u where s.userId=u.userId and s.supplierId=$userId";
    $result = mysqli_query($connect, $query);
    $r = mysqli_fetch_assoc($result);
    echo $userId . '<br>';
    echo mysqli_num_rows($result);
    $emailid = $r['emailId'];
    echo $userid;
    $emailID = $emailid;
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "maxveni015@gmail.com"; //Your Email ID
    $mail->Password = "Max@Veni#015"; //Enter Email ID
    $mail->Subject = "Approved!!";
    $mail->setFrom("scmsofficial2021@gmail.com"); //Your Email ID
    $mail->Body = "You have been approved as supplier in SCMS";
    $mail->addAddress($emailid);
    if ($mail->send()) {
        echo '<script type="text/javascript"> 
                            alert("Approved Successfully"); 
                            window.location.href = "./SupplierNewRequests.php";
                            </script>;';
    }
}
?>
