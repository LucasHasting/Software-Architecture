<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Money</title>
</head>

<body>
<form method="post" action="num_of_years.php">
    <p>
        <label for="initial_savings">Initial Savings:</label>
        <input type="number" name="initial_savings" min="0" step="any" id="initial_savings" required>
    </p>
    <p>
        <label for="interest_rate">Interest Rate:</label>
        <input type="number" name="interest_rate" min="0" step="any" id="interest_rate" required>
        %
    </p>
    <p>
        <input type="submit" name="next" value="Next &gt;">
    </p>
</form>
</body>
</html>
