<?php

session_start();
include "validate.php";

// define variables and set to empty values
$form_username = $pwd = $repeat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_username = test_input($_POST["form_username"]);
    $pwd = test_input($_POST["pwd"]);
    $repeat = test_input($_POST["repeat"]);
} else {
    header("Location: index.php");
}

// TODO: make sure that pwd and repeat match.  If they don't match, send the 
// user back to the form with an appropriate error message.

if (!($pwd === $repeat)) {
    $_SESSION['error'] = "Error: password's do not match";
    header("Location: register.php");
    die;
}

// TODO: make sure that the new user is not already in the database.  If the
// new username has already been used, send the user back to the form with an 
// appropriate error message.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "officemin";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users where username = '$form_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['error'] = "Error: user already exists";
    header("Location: register.php");
    die;
}

// TODO: insert the new user into the database
$sql = "INSERT INTO users(username, password) VALUES('$form_username', '$repeat')";
$conn->query($sql);

// TODO: close the database connection
$conn->close();

// if we made it here, we have a new user; send them to the homepage
header("location:index.php");

