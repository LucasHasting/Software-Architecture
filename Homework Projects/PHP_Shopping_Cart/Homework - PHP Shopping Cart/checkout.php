<?php
//Reference: Class Code

/* References: https://www.php.net/manual/en/function.empty.php
  previous assignments
  class code
 */

//start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <ul>
            <?php
            //if the cart exists and is not empty, display the contents
            //otherwise, go back to index.php
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $item){
                    echo "<li>$item[0] $item[1]</li>";
                }
            } else {
                header("Location: index.php");
            }
            ?>
        </ul>
        <hr/>
            <form action="authenticate.php" method="POST">
                Username: <input type="text" name="user-name"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit">
            </form>
    </body>
</html>