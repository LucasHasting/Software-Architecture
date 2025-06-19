<?php
//References: class code
//start the session
session_start();

//if authenticated, show confirmation message
//otherwise, go back to index.php
if (!(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])) {
    header("Location: index.php");
}
?>
<html>
    <head>
        <title>Confirmation</title>
    </head>
    <body>
        <p>Enjoy your items</p>
    </body>
</html>
