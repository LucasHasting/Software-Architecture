<?php
session_start();

include "validate.php";

$uname = $pwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = test_input($_POST['uname']);
    $pwd = test_input($_POST['pwd']);
} else {
    header("Location: index.php");
}

if (!empty($uname) && !empty($pwd)) {
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

    $sql = "SELECT password FROM users where username = '$uname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0 && password_verify($pwd, $result->fetch_assoc()["password"])) {
        $_SESSION['user'] = $uname;
        header("location: index.php");
        exit;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
    <body>
        Invalid username and/or password.

        <a href="index.php">Main Menu</a>
    </body>
</html>
