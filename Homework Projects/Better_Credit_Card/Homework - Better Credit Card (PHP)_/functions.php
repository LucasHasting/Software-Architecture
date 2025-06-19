<?php

/*
  References: https://www.w3schools.com/php/php_switch.asp
  https://www.w3schools.com/php/php_arrays_access.asp
  https://www.w3schools.com/php/php_functions.asp
  https://www.w3schools.com/php/php_if_else.asp
  https://www.w3schools.com/php/php_casting.asp
  https://www.w3schools.com/php/php_looping_foreach.asp
  https://www.geeksforgeeks.org/how-to-iterate-over-characters-of-a-string-in-php/
  https://www.w3schools.com/php/php_form_validation.asp
  https://www.avalara.com/taxrates/en/state-rates/alabama/cities/florence.html#:~:text=Florence%20sales%20tax%20details,sales%20tax%20rate%20is%204.5%25.
  https://stackoverflow.com/questions/8104998/how-to-call-function-of-one-php-file-from-another-php-file-and-pass-parameters-t
  https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/password
  https://www.w3schools.com/php/php_superglobals_server.asp
  https://www.w3schools.com/php/func_string_explode.asp
  https://www.w3schools.com/php/func_array_end.asp
  Class Code/Notes
 */

//redirect if the user manually types in functions.php
$split_url = explode("/", $_SERVER['SCRIPT_NAME']);
if (end($split_url) == "functions.php") {
    header("Location: index.php");
}

/*
  description: determines the type of card if the card is valid

  return values for validCard function:
  0 - invalid
  1 - visa
  2 - amex
  3 - master card
 */

function validCard($card) {
    if ((strlen($card) == 16 || strlen($card) == 13) && $card[0] == "4" && allNumeric($card)) {
        return 1;
    } elseif (strlen($card) == 15 && $card[0] == "3" && ($card[1] == "4" || $card[1] == "7") && allNumeric($card)) {
        return 2;
    } elseif (strlen($card) == 16 && $card[0] == "5" && ((int) $card[1] <= 5) && ((int) $card[1] >= 1) && allNumeric($card)) {
        return 3;
    }
    return 0;
}

//function returns true if a date is a valid format, false otherwise
//does not consider the range in the date
function validExpDate($exp_date) {
    return (strlen($exp_date) == 5 && is_numeric($exp_date[0]) && is_numeric($exp_date[1]) && is_numeric($exp_date[3]) && is_numeric($exp_date[4]) && $exp_date[2] == "/");
}

//function returns true if the security code is valid (3 digits), false otherwise
function validSecCode($sec_code) {
    return (strlen($sec_code) == 3 && allNumeric($sec_code));
}

//function returns true if all the characters in a string are numeric
function allNumeric($text) {
    $flag = true;

    foreach (str_split($text) as $character) {
        $flag = $flag && is_numeric($character);
    }

    return $flag;
}

//function validates input to prevent an attack
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//function returns true if the user is authenticated
function authenticated($user, $pass) {
    return $user == $pass && $user != "" && $pass != "";
}

//function returns the input if it is valid, 0 otherwise
function ignore_input($input) {
    if (!allNumeric($input)) {
        return 0;
    } else {
        return $input;
    }
}

//function to check if redirection is needed, and redirects if needed
//uses POST
function if_redirect() {
    if (empty($_POST)) {
        header("Location: index.php");
    }
}
