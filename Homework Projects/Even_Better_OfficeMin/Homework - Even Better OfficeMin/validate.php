<?php

// READ: https://www.w3schools.com/php/php_form_validation.asp
//   There is a good example at the bottom of the page.
//   Copy that test_input function here (or create your own).
//   This validate.php file should be "included" wherever test_input is called.
//   
// TODO: provide a test_input validation function that calls at least three
// functions to clean up and/or validate the $data that is passed in.
// More References: https://www.w3schools.com/php/func_string_explode.asp
//                  https://www.w3schools.com/php/func_array_end.asp
//                  https://www.w3schools.com/php/php_superglobals_server.asp
//redirect if the user manually types in validate.php
$split_url = explode("/", $_SERVER['SCRIPT_NAME']);
if (end($split_url) == "validate.php") {
    header("Location: index.php");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
