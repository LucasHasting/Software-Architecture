<?php
session_start();
$_SESSION['initial_savings'] = $_POST['initial_savings'];
$_SESSION['interest_rate'] = $_POST['interest_rate'];
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Years</title>
    </head>

    <body>
        <p>The details submitted were as follows: </p>
        <ul>
            <li> Initial Savings: <?= $_POST['initial_savings'] ?> </li>
            <li> Interest Rate: <?= $_POST['interest_rate'] ?>% </li>         
        </ul>
        <form method="post" action="result.php">
            <p>
                <label for="n">Number of years:</label>
                <input type="number" name="n" min="0" id="n" required>
            </p>
            <p>
                <input type="submit" name="next" value="Next &gt;">
            </p>
        </form>
    </body>
</html>
