<?php
session_start();
//if(!isset($_SESSION['userId']))
//{
//    header("location:index.php");
//}
?>
<?php
if (isset($_POST['Submit'])) {
    $pass = $_POST['pass'];
    $conPass = $_POST['conpass'];
}
?>


<?php
$passErr = $conPassErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['pass'])) {
        $passErr = "Password is required";
    }

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        $passErr = 'Password should be at least 8 characters in length and should include at least one upper case letter, one lower case letter, one number, and one special character.';
    }

    if (empty($_POST['conpass'])) {
        $conPassErr = "Confirm Password is required";
        
    }

    if ($_POST['pass'] != $_POST['conpass']) {
        $conPassErr = "Password and Confirm password are not same.";
    }
}
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
        <title>Reset Password Page</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            SCMS Password Reset
        </div>

        <div class="reg1">
            <form name="MyForm" method="POST">
                <table class="border1" >
                    <tr>
                        <td><label>New Password:</label></td>
                        <td><input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" placeholder="********" minlength="8"></td>
                        <td><?php echo $passErr; ?></td>
                    </tr>
                    <tr>
                        <td><label>Confirm New Password:</label></td>
                        <td><input type="password" id="conpass" name="conpass" value="<?php echo $conPass; ?>" placeholder="********" minlength="8"></td>
                        <td><?php echo $conPassErr; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="submit" name="Submit"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<?php
session_start();
if ($passErr == "" && $conPassErr == "") {
             $userId;
            if (isset($_POST['Submit'])) {
                $pass = $_POST['pass'];
            }
$emailIdtoUpdatePass = $_SESSION['emailIdtoUpdatePass'];
//echo $emailIdtoUpdatePass;

if (isset($_POST['Submit'])) {
    if (!empty($_POST['pass'])) {
        $pass = $_POST['pass'];
        $encPass = md5($pass);
        include 'sqlConnection.php';
        $connect;
        $query = "UPDATE `tblUser` SET `password`='$encPass' WHERE emailId = '$emailIdtoUpdatePass'";
        mysqli_query($connect, $query);

        if (empty(mysqli_error_list($connect))) {
            echo '<script type="text/javascript"> 
                            alert("Successfully Updated Password"); 
                            window.location.href = "./Login.php";
                            </script>;';
        } else {
//            echo 'Sorry ! We are facing Some Error!!!';
            echo '<script>alert("Sorry ! We are facing Some Error!!!")</script>';
        }
        print_r(mysqli_error_list($connect));
    }
}
}
?>