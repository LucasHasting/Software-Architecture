<?php
//Reference: Class Code
session_start();

// PHP null coalescing operator ?? (PHP 7.0+)
$user = $_SESSION['user'] ?? "Guest";
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        Welcome, <?= $user ?>
        <p />
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "officemin";

        $con = mysqli_connect($servername, $username, $password, $dbname);
        if (!$con) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        $result = mysqli_query($con, "select count(*) from items");

        $row = mysqli_fetch_array($result);

        mysqli_close($con);
        ?>

        <h2>Main Menu</h2>
        <ul>
            <li><a href="register.php">Register a new user</a></li>
            <li><a href="insert.php">Create</a></li>
            <li><a href="select.php">Read</a></li>
            <li><a href="update.php">Update</a></li>
            <li><a href="delete.php">Delete</a></li>
        </ul>
    </body>
</html>
