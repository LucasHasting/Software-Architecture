<?php
// A three-page application that uses NO HTML FORMS.
// TODO: Create a shopping cart, using a PHP array, by saving items into the
// cart and saving the cart into the session.  Use the same concepts as in 
// your JSP solution.
// References: previous assignments and class code
//start the session
session_start();

if (!isset($_SESSION['cart'])) {
    //create an empty cart and add it to the session
    $cart = [];
    $_SESSION['cart'] = $cart;
} else {
    //add the brand and product to the php array
    if (isset($_GET['brand']) && isset($_GET['product'])) {
        $cart = $_SESSION['cart'];
        array_push($cart, [$_GET['brand'], $_GET['product']]);
        $_SESSION['cart'] = $cart;
    }
}
?>
<html>
    <head>
        <title>Shopping Cart</title>
    </head>
    <body>
        <!-- TODO: Create a HTML link to the checkout page (checkout.php).
            If there is nothing in the cart, send them back here from
            checkout.php. Otherwise, show the contents and challenge for
            credentials.  test the credentials in success.php and
            show the message only if the credentials are "valid" (username
            and password are the same and more than 3 characters).
        -->
        <p><a href="checkout.php">Checkout</a></p>
        <hr/>
        <?php
        //TODO: display each item in the db table -->
        //database info
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bestbye";

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
            while ($row = $result->fetch_assoc()) {
                //table data
                $brand = $row["brand"];
                $product = $row["product"];
                $price = $row["price"];
                //TODO: Transform each row into a link using a query string.
                //Make sure that the link references this same page and that the
                //query string has the brand/product info only (no price, qty, etc.)
                echo "<p><a href=\"index.php?brand=$brand&product=$product\"> $brand $product </a><p>\n";
            }
        } else {
            echo "0 results";
        }

        //close the database connection
        $conn->close();
        ?>


        <hr/>
        <ul>
            <!-- TODO: display the contents of the cart here -->
            <?php
            if (isset($cart)) {
                foreach ($cart as $item) {
                    echo "<li>$item[0] $item[1]</li>";
                }
            }
            ?>
        </ul>

    </body>
</html>
