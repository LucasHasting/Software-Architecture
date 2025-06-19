<?php
    //Reference: Class Code/Notes
    session_start();
    $total = $_SESSION['total'];
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
</head>

<body>
    <h3>Checkout</h3>
    <p> The amount to charge: $<?= $total ?> </p>
    <form method="post" action="confirmation.php">
        Name on Card: <input type="text" name="NOC" required> <br>
        Card Number: <input type="text" name="CN" min="0" required> <br>
        Expiration Date: <input type="text" name="ED" value="mm/yy" maxlength="5" required> <br>
        Security Code: <input type="text" name="SC" maxlength = "3" required> <br>
        <input type="submit">
</form>
</body>
</html>
