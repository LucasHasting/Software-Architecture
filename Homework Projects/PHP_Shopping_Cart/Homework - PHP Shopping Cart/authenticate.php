<?php

/* References: https://www.w3schools.com/php/php_form_validation.asp
  Class Code
 */

//start the session
session_start();

//set default values that will not authenticate for when the user does not use post to this file
$username = -1;
$password = -1;

//protect against input related attacks
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["user-name"]);
    $password = test_input($_POST["password"]);
}

//authenticate user
if ($username != -1 && $password != -1) {
    if (strlen($username) > 3 && strlen($password) > 3) {
        header("Location: success.php");
        $_SESSION["authenticated"] = true;
        die();
    }
}

//go back to checkout.php
$_SESSION["authenticated"] = false;
header("Location: checkout.php");

//function used to protect against input related attacks
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
