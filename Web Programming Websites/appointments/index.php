<?php
/*
Name: Lucas Hasting
Description: CRUD Operations on the advising database
Date: 4/6/2026
Instructor: James Jerkins

Sources: Class Notes
         https://stackoverflow.com/questions/4227043/how-do-i-cancel-form-submission-in-submit-button-onclick-event
         https://www.php.net/manual/en/mysqli-stmt.bind-result.php
         https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector         
         https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isInteger
         https://www.w3schools.com/jsref/jsref_foreach.asp
         https://www.w3schools.com/mysql/mysql_exists.asp
*/


    //include header
    require('header.php');

    //index page - menu
    echo <<<HTMLBLOCK

    <table>
        <tr>
            <td>&bullet; <a href="list_avaliable.php">List Avaliable Advising Appointments</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="list_scheduled.php">List Scheduled Advising Appointments</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="add.php">Add Advising Appointment</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="edit.php">Edit an Advising Appointment</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="delete.php">Delete an Advising Appointment</a></td>
        </tr>
    </table>

HTMLBLOCK;

    //include footer
    require('footer.php');

?>
