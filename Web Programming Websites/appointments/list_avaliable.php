<?php
//see index.php for comment header block (with sources)

// ----------------------------------------------------------------------------

//header, footer, content
require("header.php");
displayList();
require("footer.php");

// ----------------------------------------------------------------------------

function displayList(){
    //used for background
    $background = 0;

    //table of appointments
    echo <<<HTMLBLOCK
    <table>
        <tr>
            <th>Start</th>
            <th>End</th>
        </tr>
HTMLBLOCK;

    //connect to database
    require("credentials.php");
    $db = mysqli_connect($hostname, $username, $password, $database);

    //true if there is an error
    if(mysqli_connect_errno()){
        die("Unable to connect to database: " . mysqli_connect_error());
    }

    //buid query
    $query = "SELECT start,end 
              FROM appts 
              WHERE SID IS NULL 
              ORDER BY start";

    //execute, check for errors
    $appts = mysqli_query($db, $query);

    if(!$appts){
        $query_message = "Query failed: " . mysqli_error($db);
        mysqli_close($db);
        die($query_message);
    }

    //display results
    while($row = mysqli_fetch_array($appts)){
        $start = $row[0];
        $end = $row[1];

        if($background++ % 2 == 0){
            echo "  <tr style=\"background-color: white\">\n";
        } else {
            echo "  <tr style=\"background-color: lightgrey\">\n";
        }

        echo <<<TABLEDATA
            <td>$start</td>
            <td>$end</td>
        </tr>

TABLEDATA;
    }
    echo "  </table>";

    //close the database
    mysqli_close($db);
}

?>
