<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Years, but again</title>
    </head>

    <body>
        <p> The salary for each year is listed below: </p>
        <ul> 
            <?php
            session_start();
            echo "<li> Year 0 salary: $" . $_SESSION['initial_savings'] . " </li>\n";
            $intrest_rate = $_SESSION['interest_rate'] / 100;
            $salary = ($intrest_rate * $_SESSION['initial_savings']) + $_SESSION['initial_savings'];
            for ($i = 0; $i < $_POST['n']; $i++) {
                echo "<li> Year " . $i + 1 . " salary: \$" . round($salary,2) . " </li>\n";
                $salary = $salary + ($salary * $intrest_rate);
            }
            ?>
        </ul>

    </body>
</html>
