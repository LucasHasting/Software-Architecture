<?php
/*
Name: Lucas Hasting
Description: CRUD Operations/AJAX with campground database
Date: 5/5/2026
Instructor: James Jerkins

Sources: Class Notes/Textbook/Previous Assignments
         https://stackoverflow.com/questions/4227043/how-do-i-cancel-form-submission-in-submit-button-onclick-event
         https://www.php.net/manual/en/mysqli-stmt.bind-result.php
         https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector         
         https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isInteger
         https://www.w3schools.com/jsref/jsref_foreach.asp
         https://www.w3schools.com/mysql/mysql_exists.asp
         https://stackoverflow.com/questions/22061723/regex-date-validation-for-yyyy-mm-dd
         https://stackoverflow.com/questions/15496156/regex-to-match-anything
         https://coreui.io/blog/how-to-check-if-string-is-number-in-javascript/#method-1-using-the-isnan-function
         https://www.php.net/count
*/
    //include header
    require('header.php');

    //index page - menu
    echo <<<HTMLBLOCK
   <h1>Yet Another Campground Reservation Web Application</h1>

    <table>
        <tr>
            <td>&bullet; <a href="reserve_menu.php">Reserve a Camping Site</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="show_menu.php">Show Your Reservation</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="delete_menu.php">Delete Your Reservation</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="date_menu.php">Show a Reservation by Date</a></td>
        </tr>
    </table>

HTMLBLOCK;

    //include footer
    require('footer.php');

?>
