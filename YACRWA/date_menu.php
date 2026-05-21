<?php
    //see index.php for comment header block (with sources)

    //include header
    require('header.php');

    //form page
    echo <<<HTMLBLOCK

    <h1>Display Reservation(s):</h1>

            <form onsubmit="return false;">
                <label for="date">Check-in Date:</label>
                <input type="date" name="date" id="date" required>
                <button onclick="show(3);">Display</button>
            </form>
    
            <div>&nbsp;</div>
            
            <div id="reservation">&nbsp;</div>

HTMLBLOCK;

    //include footer
    require('footer.php');

?>
