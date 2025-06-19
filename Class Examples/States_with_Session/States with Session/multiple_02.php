<?php
//add to the session super global
session_start();
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['family_name'] = $_POST['family_name'];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Multiple form 2</title>
    </head>

    <body>
        <form method="post" action="multiple_03.php">
            <p>
                <label for="age">Age:</label>
                <input type="number" name="age" id="age">
            </p>
            <p>
                <input type="submit" name="next" value="Next &gt;">
            </p>
        </form>
    </body>
</html>
