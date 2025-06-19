<?php
    //Reference: Class Code/Notes
    session_start();
    $_SESSION['quantity-PB'] = $_POST['quantity-PB'];
    $_SESSION['quantity-S'] = $_POST['quantity-S'];
    $_SESSION['quantity-C'] = $_POST['quantity-C'];
    $_SESSION['subtotal'] = round($_SESSION['quantity-PB'] * 2.99 
        + $_SESSION['quantity-S'] * 0.99
        + $_SESSION['quantity-C'] * 1.99
        , 2);
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Order Summary</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <h3>Order Summary</h3>
        <p>
            The subtotal is $<?= $_SESSION['subtotal'] ?> 
        </p>
        <form method="post" action="tax_page.php">
            <p>
                <input type="submit" name="next" value="Next &gt;">
            </p>
        </form>
    </body>
</html>
