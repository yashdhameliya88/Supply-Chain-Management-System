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
        <title>Add Company Page</title>
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Add Company
        </div>

        <div class="reg1">
            <form name="MyForm" method="POST">
                <table>
                    <tr>
                        <td><label> Company Name: </label></td>
                        <td><input type="text" name="companyname" size="50"/></td>
                    </tr>
                    <tr>
                    <tr>
                            <td><label> Address: </label></td>
                            <td><textarea cols="31" rows="5" value="address" name="address" size="250" placeholder="Enter Your Address"/></textarea></td>
                    </tr>                
                    <tr>
                        <td><label> Name: </label></td>
                        <td><input type="text" name="middlename" size="15"/></td>
                    </tr>
                    <tr>
                        <td><label> Email ID: </label></td>
                        <td><input type="text" name="email" name="email"/></td>
                    </tr>
                    <tr>
                        <td><label> Mobile Number: </label></td>
                        <td>
<!--                            <select>  
                                <option value="+91">+91</option>  
                                <option value="744">744</option>  
                                <option value="641">641</option>  
                                <option value="+1">+1</option>  
                                <option value="+64">+64</option>  
                            </select>  -->
                            <input type="text" name="mobilenumber" size="10"/>
                        </td>
                    </tr>
                    <tr>
                        <td><label> Address: </label></td>
                        <td><textarea cols="31" rows="5" value="address" size="250"/></textarea></td>
                    </tr>
                    <tr>
                        <td><label> City: </label></td>
                        <td>
                            <select class="select1">  
                                <option value="-1" style=" font-weight: bold;">Select City</option>
                                <option value="Surat">Surat</option>  
                                <option value="Bardoli">Bardoli</option>  
                                <option value="Vadodara">Vadodara</option>  
                                <option value="Navasari">Navasari</option>  
                                <option value="Vapi">Vapi</option>  
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label> Password: </label></td>
                        <td><input type="password" id="pass" name="pass"></td>
                    </tr>
                    <tr>
                        <td><label> Confirm Password: </label></td>
                        <td><input type="password" id="conpass" name="conpass"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="reset" value="Reset"/>
                            <input type="submit" value="Submit"/>                            
                        </td> 
                    </tr>
                    <tr>
                        <td></td>
                        <td><label style="color: blue;"> Have an account: <a href="loginPage.php" style="text-decoration: none;color: red;" onMouseOver="this.style.color = '#ffc107'"
                                                                             onMouseOut="this.style.color = 'red'">Click Here</a></label></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
