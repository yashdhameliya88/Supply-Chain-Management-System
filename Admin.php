<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if(!isset($_SESSION['userId']))
{
    header("location:index.php");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Home Page</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
         <?php
        include 'HeaderPage.php';
        ?>
        
        <div class="div1">
            
        <?php echo $_SESSION['userType'];?> Home Page
        </div>
        
    </body>
</html>
