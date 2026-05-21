<?php
    //see index.php for comment header block (with sources)

    //include header
    require('header.php');

    //form page
    echo <<<HTMLBLOCK

    <h1>Delete Reservation:</h1>
            <form onsubmit="return false">
                <label for="confirmation_num">Confirmation Number: </label>
                <input type="number" id="confirmation_num" name="confirmation_num" required min=1 autocomplete="off">
                <br>
                <button onclick="delete_reservation_menu();">Delete</button>
            </form>
    
            <div>&nbsp;</div>
            
            <div id="reservation">&nbsp;</div>
            
            <div>&nbsp;</div>

            <div id="delete_area">&nbsp;</div>
HTMLBLOCK;

    //include footer
    require('footer.php');

?>
