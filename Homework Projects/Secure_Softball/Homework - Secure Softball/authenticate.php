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

if ($username != -1 && $password != -1) {
//authenticate user
    $_SESSION['authenticated'] = (
            strlen($username) > 3 && $password === "letmein"
            );
}

//go back to index.php
header("Location: index.php");

//function used to protect against input related attacks
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
