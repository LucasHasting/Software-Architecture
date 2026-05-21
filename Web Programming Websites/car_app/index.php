<?php

    require('header.php');

    echo <<<HTMLBLOCK

    <table>
        <tr>
            <td>&bullet; <a href="listing.php">Show EV's</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="add.php">Add EV's</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="edit.php">Edit EV's</a></td>
        </tr>
        <tr>
            <td>&bullet; <a href="delete.php">Delete EV's</a></td>
        </tr>
    </table>

HTMLBLOCK;

    require('footer.php');

?>
