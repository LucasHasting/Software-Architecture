<?php
//See functions.php for references, contains functions
require "functions.php";

//start the session
session_start();

//change header if needed
if_redirect();

//processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subtotal = $_SESSION['subtotal'];
    $tax_rate = 0.095;
    $tax = round($subtotal * $tax_rate, 2);
    $total = round($tax + $subtotal, 2);
    $_SESSION['total'] = $total;
}
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
        <p> <a href = "authentication.php"> Checkout </a> </p>
    </body>
</html>
