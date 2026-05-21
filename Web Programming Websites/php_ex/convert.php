<?php
    $amount = $_GET["amount"];
    $conversion = $_GET["conversion"];
    $message = "$amount converted from ";

    if($conversion == "USD") {
        $message .= "U.S. dollars to Canadian dollars is ";
        $dollars = $amount * 1.36;
    } else {
        $message .= "Canadian dollars to U.S. dollars is ";
        $dollars = $amount * 0.73;
    }

    $message .= number_format($dollars, 2, '.', '');

    echo <<<PAGE

<!DOCTYPE html>
<html lang="en">
<head>
    <title>USD/CAD Currency Converter</title>
    <meta charset="UTF-8">
    <link rek="stylesheet" href="currency.css">
</head>

<body>
    <div class="center"
    <h1>Currency Converter</h1>

    <p>$message</p>

    <a href="index.html">Convert again</a> 
    </div>
    
PAGE;

?>
