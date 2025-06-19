<?php
/* References: https://www.w3schools.com/php/php_mysql_select.asp
  Class Code
 */

//start the session
session_start();

//if the user is not authenticated or the authentication does not exist, redirect to index.php
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>National Champions</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>
    <body>
        UNA Softball 2016 National Champions:
        <?php
        //database info
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "softball";

        //mysql connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        //if cannot connect - display error message
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //query the games table
        $sql = "SELECT * FROM games";
        $result = $conn->query($sql);

        //if there are results, display the table
        if ($result->num_rows > 0) {
            //header data
            echo "<table id=\"c\">
                    <tr>
                        <th>ID</th>
                        <th>Opponent</th>
                        <th>Site</th>
                        <th>Result</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                //table data
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["opponent"] . "</td>
                        <td>" . $row["site"] . "</td>
                        <td>" . $row["result"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        //close the database connection
        $conn->close();
        ?>
    </body>
</html>
