<?php
//Reference: Class Code, https://www.w3schools.com/php/php_mysql_insert.asp
include "validate.php";

// TODO: insert data gathered from the insert.php form into the database
if ($_SERVER["REQUEST_METHOD"] == "POST" 
        && isset($_POST["brand"])
        && isset($_POST["product"])
        && isset($_POST["price"])) {
    $brand = test_input($_POST["brand"]);
    $product = test_input($_POST["product"]);
    $price = test_input($_POST["price"]);
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

$sql = "INSERT INTO items (brand, product, price)
VALUES ('$brand', '$product', '$price')";

$conn->query($sql);
        
$conn->close();

// after the insert send the user back to the main menu
header("location:index.php");

