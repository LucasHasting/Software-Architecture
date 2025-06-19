<?php

include "validate.php";

session_start();
// TODO: make sure no one can access this page without logging in first
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    header("location:login.php");
    exit;
}

// TODO: validate the input data and place each value into the appropriate
// variable so that the UPDATE below will work properly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = test_input($_POST["brand"]);
    $product = test_input($_POST["product"]);
    $price = test_input($_POST["price"]);
    $id = test_input($_POST["id"]);
} else {
    header("Location:index.php");
    exit;
}

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

$sql = "UPDATE items SET brand='$brand', product='$product', price=$price WHERE id=$id";

$conn->query($sql);

$conn->close();

header("location:index.php");

