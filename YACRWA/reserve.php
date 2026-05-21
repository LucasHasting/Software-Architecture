<?php
//see index.php for comment header block (with sources)

//start session
session_start();

//include header/footer, validation functions, menu
require_once("functions.php");
require("header.php");
displayList();
require("footer.php");

// ----------------------------------------------------------------------------
//function used to display a reserve list
function displayList(){
    //get dates and put into proper format
    $in = valid_date($_POST["in"]);
    $out = valid_date($_POST["out"]);
    $type = valid_type($_POST["type"]);

    //compare dates -> ensures its real
    if($in > $out){
        die("error: invalid data");
    }

    //store in session for later
    $_SESSION["in"] = $in;
    $_SESSION["out"] = $out;

    $background = 0;

    //start of revserve table list
    echo <<<HTMLBLOCK
    <div id="theForm">
    <form method="POST" action="reserve.php" onsubmit="return false;">
        <table>
            <tr>
                <th>Reserve</th>
                <th>Site ID</th>
            </tr>
HTMLBLOCK;

    //connect to database, check for errors
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno())
        die("Unable to connect to database " . mysqli_connect_error());

    //build query using prepared statement
    $query = "SELECT site.site_id 
              FROM reservations 
              RIGHT JOIN site ON site.site_id = reservations.site_id 
              WHERE reservations.site_id IS NULL AND site_type = ?";
    
    $prepared_query = mysqli_prepare($db, $query); 
    mysqli_stmt_bind_param($prepared_query, "s", $type);

    //execute query and check for errors
    if(!mysqli_stmt_execute($prepared_query)){
        $query_message = "Query failed: " . mysqli_error($db);
        mysqli_close($db);
        die($query_message);
    }

    $reserv = mysqli_stmt_get_result($prepared_query);
    
    //iterate over row set, display each row and alternate the backfround between light/dark
    while($row = mysqli_fetch_array($reserv)){
        $id = $row[0];

        if($background++ % 2 == 0){
            echo "  <tr style=\"background-color: white\">\n";
        } else {
            echo "  <tr style=\"background-color: lightgrey\">\n";
        }

        echo <<<TABLEDATA
            <td><input type="checkbox" name="ids[]" value="$id" onchange="reserveUserInfo()"></td>
            <td>$id</td>
        </tr>

TABLEDATA;
    }

    //reserve button, and AJAX placeholders
    echo <<<FORMBLOCK
    </table>
    
    <div>&nbsp;</div>
            
    <span id="user">&nbsp;</span>

    </form>
    </div>
                    
    <div>&nbsp;</div>
            
FORMBLOCK;
    
    //close database and prepared statement
    mysqli_stmt_close($prepared_query);
    mysqli_close($db);
}

