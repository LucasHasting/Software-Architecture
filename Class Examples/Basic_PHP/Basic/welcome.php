<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //super global - flexible dictionary. 
        //Keys are names of inputs in the form. 
        //Values are in the input in the form.
        $name = $_POST["name"];
        $email = $_POST["email"];
        echo "Hello " . $name . ", your email is " . $email;
        ?>
    </body>
</html>
