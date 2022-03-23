<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">         
        <title>Add Warehouse</title>         
        <link rel="stylesheet" href="CSS\SCMSStyle.css">
    </head>
    <body>
        <?php
        include 'HeaderPage.php';
        ?>
        <div class="div1">
            Add Warehouse
        </div>
        <div class="reg1">
            <form action="#" method="POST">              
                <div class="otp"> 
                    <table class="border1" >
                        <tr>
                            <td><label> Warehouse ID: </label></td>
                            <td><input type="text" name="warehouseid" size="10" placeholder="Enter Your Warehouse ID"/></td>
                        </tr>
                        <tr>
                            <td><label>Warehouse Name: </label></td>
                            <td><input type="text" name="warehousename" placeholder="Enter Warehouse Name"></td>
                        </tr>
                        <tr>
                            <td><label> Warehouse Address: </label></td>
                            <td><textarea cols="31" rows="5" value="warehouseaddress" size="250" placeholder="Enter Your Warehouse Address"/></textarea></td>
                        </tr>
                        <tr>
                            <td><label> State: </label></td>
                            <td>
                                <select class="select1">  
                                    <option value="-1" style=" font-weight: bold;">Select State</option>
                                    <option value="Surat">Gujarat</option>  
                                    <option value="Bardoli">Maharastra</option>  
                                    <option value="Vadodara">Panjab</option>  
                                    <option value="Navasari">Varanashi</option>  
                                    <option value="Vapi">Uttar Pradesh</option>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label> City: </label></td>
                            <td>
                                <select class="select1">  
                                    <option value="-1" style=" font-weight: bold;">Select City</option>
                                    <option value="Surat">Surat</option>  
                                    <option value="Bardoli">Bardoli</option>  
                                    <opti556694884on value="Vadodara">Vadodara</option>  
                                        <option value="Navasari">Navasari</option>  
                                        <option value="Vapi">Vapi</option>  
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" name="reset" value="Reset"/>
                                <input type="submit" class="sh"name="submit" value="Submit"/>
                            </td>
                        </tr>
                        </table>    
                </div>          
            </form>
        </div>
    </body>
</html>
