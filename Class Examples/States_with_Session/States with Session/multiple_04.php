<?php
session_start();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Multiple form 4</title>
    </head>

    <body>
        <p>The details submitted were as follows: </p>
        <ul>
            <li> First Name: <?= $_SESSION['first_name'] ?> </li>
            <li> Family Name: <?= $_SESSION['family_name'] ?> </li>
            <li> Age: <?= $_SESSION['age'] ?> </li>
            <li> Address: <?= $_POST['address'] ?> </li>
            <li> Town/City: <?= $_POST['city'] ?> </li>
            <li> Country: <?= $_POST['country'] ?> </li>            
        </ul>
        <ul>
        </ul>
    </body>
</html>
