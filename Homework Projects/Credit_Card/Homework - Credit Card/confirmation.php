<?php
    /*
    References: https://www.w3schools.com/php/php_switch.asp
                https://www.w3schools.com/php/php_arrays_access.asp
                https://www.w3schools.com/php/php_functions.asp
                https://www.w3schools.com/php/php_if_else.asp
                https://www.w3schools.com/php/php_casting.asp
                https://www.w3schools.com/php/php_looping_foreach.asp 
                https://www.geeksforgeeks.org/how-to-iterate-over-characters-of-a-string-in-php/
                Class Code/Notes
    */

    //get variables needed from POST
    $name = $_POST['NOC'];
    $card = $_POST['CN'];
    $exp_date = $_POST['ED'];
    $sec_code = $_POST['SC'];

    /* 
    description: determines the type of card if the card is valid
    
    return values for validCard function:
    0 - invalid
    1 - visa
    2 - amex
    3 - master card
    */
    function validCard($card) {
        if((strlen($card) == 16
                 || strlen($card) == 13)
                && $card[0] == "4"
                && allNumeric($card)){
                return 1;
        } elseif(strlen($card) == 15
                && $card[0] == "3"
                && ($card[1] == "4"
                    || $card[1] == "7")
                && allNumeric($card)){
                    return 2;
        } elseif(strlen($card) == 16
                && $card[0] == "5"
                && ((int) $card[1] <= 5)
                && ((int) $card[1] >= 1)
                && allNumeric($card)) {
                    return 3;
        }
        return 0;
    }
    
    //function returns true if a date is a valid format, false otherwise
    //does not consider the range in the date
    function validExpDate($exp_date) {
        return (strlen($exp_date) == 5
            && is_numeric($exp_date[0])
            && is_numeric($exp_date[1])
            && is_numeric($exp_date[3])
            && is_numeric($exp_date[4])
            && $exp_date[2] == "/");
    }

    //function returns true if the security code is valid (3 digits), false otherwise
    function validSecCode($sec_code) {
        return (strlen($sec_code) == 3
            && allNumeric($sec_code));
    }

    //function returns true if all the characters in a string are numeric
    function allNumeric($text){
        $flag = true;

        foreach (str_split($text) as $character){
            $flag = $flag && is_numeric($character);
        }

        return $flag;
    }
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
        if(!validExpDate($exp_date)) {
            echo "<p> Invalid Expiration Date </p>\n";
            $flag = false;
        }

        if(!validSecCode($sec_code)) {
            echo "<p> Invalid Security Code </p>\n";
            $flag = false;
        }

        //if date and code are valid, check to see the card type (if valid)
        if($flag) {
            switch (validCard($card)) {
                case 0:
                    echo "<p> Invalid Card Number </p>\n";
                    break;
                case 1:
                    echo "<p> Thank you $name for your VISA payment. </p>\n";
                    break;
                case 2:
                    echo "<p> Thank you $name for your AMEX payment. </p>\n";
                    break;
                case 3:
                    echo "<p> Thank you $name for your MASTERCARD payment. </p>\n";
                    break;
            }
        }
    ?>
</body>
</html>
