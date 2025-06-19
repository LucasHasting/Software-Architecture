<?php
    /*References: https://www.avalara.com/taxrates/en/state-rates/alabama/cities/florence.html#:~:text=Florence%20sales%20tax%20details,sales%20tax%20rate%20is%204.5%25.
                  Class Code/Notes
    */
    session_start();
    $subtotal = $_SESSION['subtotal'];
    $tax_rate = 0.095;
    $tax = round($subtotal * $tax_rate, 2);
    $total = round($tax + $subtotal, 2);
    $_SESSION['total'] = $total;
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tax</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <h3> Total Cost </h3>
        <p> Subtotal: $<?= $subtotal ?> </p>
        <p> Tax: $<?= $tax ?> </p>
        <p> Total: $<?= $total ?> </p>
        <p> <a href = "index.php"> Continue Shopping </a> </p>
        <p> <a href = "checkout.php"> Checkout </a> </p>
    </body>
</html>
