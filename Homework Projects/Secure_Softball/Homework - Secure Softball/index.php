<?php
//Reference: Class Code
//start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>
    <body>
        <?php
        //check if athentication information exists and if the user is authenticated
        if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
            ?>
            <h3>Login</h3>
            <?php
            //if the authentication information exists and the user is not authenticated, display an error
            if (isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
                echo '<p> Error: invalid username or password</p>';
            }
            ?>
            <form action="authenticate.php" method="POST">
                Username: <input type="text" name="user-name"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit">
            </form>
            <?php
        } else {
            ?>
            <!-- if the user is authenticated, display the link to lions2016.php !-->
            <a href="lions2016.php">Championship Season</a>
            <?php
        }
        ?>
    </body>
</html>
