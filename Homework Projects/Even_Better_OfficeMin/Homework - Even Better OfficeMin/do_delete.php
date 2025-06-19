<?php
//Reference: Class Code, https://www.w3schools.com/php/php_mysql_delete.asp
include "validate.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["brand"])) {
            $brand = test_input($_POST["brand"]);
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

        // sql to delete a record
        $sql = "DELETE FROM items WHERE brand='$brand'";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Record deleted successfully</p>";
        } else {
            echo "<p>Error deleting record: " . $conn->error . "</p>";
        }

        $conn->close();
        ?>

        <a href="index.php">Main Menu</a>
    </body>
</html>
