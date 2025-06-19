<?php
//See functions.php for references, contains functions
require "functions.php";

//start the session
session_start();

//change header if needed
if (!isset($_SESSION["total"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shop</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <h3> Login: </h3>
        <form method="post" action="checkout.php">
            Username: <input type="text" name="user" required> <br>
            Password: <input type="password" name="pass" required> <br>
            <input type="submit">
        </form>
    </body>
</html>
