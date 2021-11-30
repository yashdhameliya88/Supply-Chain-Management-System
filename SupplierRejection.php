<?php
session_start();
if(!isset($_SESSION['userId']))
{
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

//$connect = mysqli_connect("localhost", "root", "root", "SCMS");
include 'sqlConnection.php';
if ($connect->connect_errno) {
    die("Connection failed:" . $connect->connect_errno);
}

$userId = $_REQUEST['r'];
echo $userId;
$qur = "UPDATE tblSupplier SET status='Rejected' WHERE supplierId='$userId'";
$q = mysqli_query($connect, $qur);

//        $qur = "delete from tblSupplier where userId=$userId";
//        $q1= mysqli_query($conn, $qur);
//        $qur = "delete from tblUser where userId=$userId";
//        $q = mysqli_query($conn, $qur);

if (!$qur) {
    echo mysqli_errno($connect);
} else {
//            echo 'deleted successfully';
//    print_r(mysqli_error_list($connect));
//            header("location:ShowSupplier.php");
//    echo '<script>alert("Rejected Successfully")</script>';
//    header("refresh:1; url=SupplierNewRequests.php");

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
    $mail->Subject = "Rejected!!";
    $mail->setFrom("scmsofficial2021@gmail.com"); //Your Email ID
    $mail->Body = "You have been rejected as supplier in SCMS. If you have any query please contacts us emailId";
    $mail->addAddress($emailid);
    if ($mail->send()) {
    echo '<script type="text/javascript"> 
                            alert("Supplier Rejected"); 
                            window.location.href = "./SupplierNewRequests.php";
                            </script>;';
    }
}
?>
