<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <p>The items table:</p>

        <?php
        //Reference: https://www.w3schools.com/php/php_mysql_select.asp
        //database info
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "officemin";

        //mysql connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        //if cannot connect - display error message
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //query the games table
        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);

        //if there are results, display the table
        if ($result->num_rows > 0) {
            //header data
            echo "<table id=\"c\">
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Product</th>
                        <th>Price</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                //table data
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["brand"] . "</td>
                        <td>" . $row["product"] . "</td>
                        <td>" . $row["price"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        //close the database connection
        $conn->close();
        ?>

        <a href="index.php">Main Menu</a>
    </body>
</html>
