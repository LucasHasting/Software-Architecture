<?php
    //see index.php for comment header block (with sources)

    //include header
    require('header.php');

    //form page
    echo <<<HTMLBLOCK

    <h1>Display Reservation(s):</h1>
            <form onsubmit="return false;">
                <label for="fname">First Name: </label>
                <input type="text" id="fname" name="fname" required autocomplete="off" minlength="1" maxlength="64">
                <br>
                <label for="lname">Last Name: </label>
                <input type="text" id="lname" name="lname" required autocomplete="off" minlength="1" maxlength="64">
                <br>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" required maxlength="64" autocomplete="off">
                <br>
                <button onclick="show(1);">Display</button>
            </form>
            
            <form onsubmit="return false">
                <label for="confirmation_num">Confirmation Number: </label>
                <input type="number" id="confirmation_num" name="confirmation_num" required autocomplete="off" min=1>
                <br>
                <button onclick="show(2);">Display</button>
            </form>
    
            <div>&nbsp;</div>
            
            <div id="reservation">&nbsp;</div>

HTMLBLOCK;

    //include footer
    require('footer.php');

?>
