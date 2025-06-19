<?php
//See functions.php for references
//restart the session
session_start();
session_destroy();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shop</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <h3> Cool Store: </h3>
        <form method="post" action="order_summary.php">
            Peanut Butter: <input type="text" name="quantity-PB" required> $2.99 <br>
            Spoon: <input type="text" name="quantity-S" required> $0.99 <br>
            Crackers: <input type="text" name="quantity-C" required> $1.99 <br>
            <input type="submit">
        </form>
    </body>
</html>
