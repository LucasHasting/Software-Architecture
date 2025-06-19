<?php
//See functions.php for references, contains functions
require "functions.php";

//start the session
session_start();

//get variables needed from POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['NOC']);
    $card = test_input($_POST['CN']);
    $exp_date = test_input($_POST['ED']);
    $sec_code = test_input($_POST['SC']);
}

//change header if needed
if_redirect();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Confirm</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <h3> Results </h3>
        <?php
        //check to see if the date and code are valid
        $flag = true;
        if (!validExpDate($exp_date)) {
            echo "<p> Invalid Expiration Date </p>\n";
            $flag = false;
        }

        if (!validSecCode($sec_code)) {
            echo "<p> Invalid Security Code </p>\n";
            $flag = false;
        }

        //if date and code are valid, check to see the card type (if valid)
        if ($flag) {
            switch (validCard($card)) {
                case 0:
                    echo "<p> Invalid Card Number </p>\n";
                    break;
                case 1:
                    echo "<p> Thank you $name for your VISA payment. </p>\n";
                    //destroy the session
                    session_destroy();
                    break;
                case 2:
                    echo "<p> Thank you $name for your AMEX payment. </p>\n";
                    //destroy the session
                    session_destroy();
                    break;
                case 3:
                    echo "<p> Thank you $name for your MASTERCARD payment. </p>\n";
                    //destroy the session
                    session_destroy();
                    break;
            }
        }
        ?>
        <p><a href = "index.php">Buy something else</a></p> 
    </body>
</html>
