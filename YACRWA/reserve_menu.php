<?php
    //see index.php for comment header block (with sources)

    //include header
    require('header.php');

    //form menu
    echo <<<HTMLBLOCK

    <h1>Reserve a Camp Site</h1>
            
            <form method="POST" action="reserve.php" onsubmit="return valid_reserve();">
                <label for="in">Check-in Date:</label>
                <input type="date" name="in" id="in" required>
                <br>
                <label for="out">Check-out Date:</label>
                <input type="date" name="out" id="out" required>
                <br>
                <label for="type">Site Type: </label>
                <select name="type" id="type" required>
                    <option value="" disabled selected>Select a site</option>
                    <option value="T">Tent site</option>
                    <option value="P">RV site, power hookups only</option>
                    <option value="F">RV site, full hookups (power, water, and sewer)</option>
                </select>
                <br><br>
                <input type="submit" name="reserveButton" value="Search">
            </form>

HTMLBLOCK;

    //include footer
    require('footer.php');

?>
