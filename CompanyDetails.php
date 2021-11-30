<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Company Details</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Company Details
        </div>
        <div class="reg1">
            <center class="btnadd">
                <div class="divcenter">
                <h1>You haven't added any records yet!</h1><br/>
                <input type="button" name="add" value="Add" onclick="location.href='AddCompany.php'"/>
                </div>
            </center>
        </div>
    </body>
</html>
