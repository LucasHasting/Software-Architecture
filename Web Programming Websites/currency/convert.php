<?php

// ----------------------------------------------------------------------------
function show_header() {
    echo <<<HEAD

<!DOCTYPE html>
<html lang="en">
<head>
    <title>USD/CAD Currency Converter</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
HEAD;

}

// ----------------------------------------------------------------------------

function display_blank_form(){
    show_header();
    echo <<<FORM

    <div class="center">

    <h1>Currency Converter</h1>

    <form method="POST">
        <label for="amount">Amount: </label>
        <!--
        regex:
        \d{} => digit{number of digits}
        , => or
        -->
        <input type="text" id="amount" name="amount" placeholder="nnnnnn.nn" maxlength="9" pattern="\d{1,6}\.\d{2}" required autocomplete="off">

        <br>

        <fieldset>
            <legend>Conversion</legend>
            <input type="radio" id="fromus" name="conversion" value="USD" checked>
            <label for="fromus">U.S. Dollars to Canadian</label>
            <br>
            <input type="radio" id="fromca" name="conversion" value="CAD">
            <label for="fromca">Candian Dollars to U.S.</label>
        </fieldset>

        <br>

        <button type="submit" class="submit">Convert</button>
        <button type="reset">Clear</button>
    </form>

    </div>
FORM;
}

// ----------------------------------------------------------------------------

function display_response_page($message){
    show_header();
    echo <<<RESPONSE

    <div class="center"
    <h1>Currency Converter</h1>

    <p>$message</p>

    <a href="{$_SERVER['PHP_SELF']}">Convert again</a>
    </div>

RESPONSE;
}

// ----------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //display the blank form
        display_blank_form();
    } else {
        //get, validate, convert
        $amount = filter_var($_POST["amount"], FILTER_VALIDATE_FLOAT);
        $conversion = filter_var($_POST["conversion"], FILTER_VALIDATE_REGEXP, 
            array('options'=>array("regex"=>"/^USD|CAD$/")));
        $message = number_format($amount, 2) . " converted from ";

        if(!$amount || !$conversion){
            $message = "I did not understand your request.";
        }
        else if($conversion == "USD") {
            $message .= "U.S. dollars to Canadian dollars is ";
            $dollars = number_format($amount * 1.36, 2);
        } else {
            $message .= "Canadian dollars to U.S. dollars is ";
            $dollars = number_format($amount * 0.73, 2);
        }

        $message .= $dollars;

        //display response page
        display_response_page($message);
    }
?>
