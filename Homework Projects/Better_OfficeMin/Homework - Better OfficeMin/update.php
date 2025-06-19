<?php
session_start();
//Reference: Class Code
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        Enter the ID of the item to update.
        <form action="display_for_update.php" method="post">
            ID: <input type="text" name="id" />
            <input type="submit" />
        </form>
    </body>
</html>
