<?php
/* References: Class Code
  https://www.w3schools.com/php/php_mysql_select_where.asp
  https://www.w3schools.com/Php/func_mysqli_fetch_assoc.asp
 */

include "validate.php";

session_start();
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    header("location:login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = test_input($_POST["id"]);
} else {
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
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

        $sql = "SELECT * FROM items where id = '" . $id . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            Header("Location:index.php");
            exit;
        }

        $conn->close();

        $brand = $row['brand'];
        $product = $row['product'];
        $price = $row['price'];
        ?>
        <form name="f" action="do_update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            Brand: <input type="text" name="brand" value="<?= $brand ?>"><br/>
            Product: <input type="text" name="product" value="<?php echo $product; ?>"><br/>
            Price: <input type="text" name="price" value="<?php echo $price; ?>"><br/>
            <br/>
            <input type="submit" value="Update">
        </form>

    </body>
</html>
