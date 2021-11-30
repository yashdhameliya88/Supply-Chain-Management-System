
<?php
session_start();
if(!isset($_SESSION['userId']))
{
    header("location:index.php");
}
elseif($_SESSION['userType']!="Admin")
{
    header("location:Admin.php");
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
        <title>Add Category</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Add Category
        </div>

        <div class="reg1">
            <form name="MyForm" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <table>
                    <tr>
                        <td><label>  Category Name: </label></td>
                        <td><input type="text" name="categoryName" value="categoryName"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="reset" value="Reset"/>
                            <input type="submit" value="Add"/>                            
                        </td> 
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $categoryName = $_POST['categoryName'];
    echo $categoryName;
    
    include './sqlConnection.php';
    $query = "INSERT INTO `tblCategory`(`categoryName`) VALUES ('$categoryName')";
    $result = mysqli_query($connect, $query);
    
    if ($result) {
        echo '<script type="text/javascript"> 
                            alert("You Successfully Added New Category"); 
                            window.location.href = "./index.php";
                            </script>;';
    } else {
        echo '<script type="text/javascript"> 
                            alert("Something went wrong please try again!!!"); 
                            </script>;';
    }
}
?>