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

    //table of students and appointments
    echo <<<HTMLBLOCK
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>L Number</th>
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

    //buid the query
    $query = "SELECT appts.start, appts.end, students.name, students.email, students.Lnum
              FROM appts, students 
              WHERE appts.SID=students.ID
              ORDER BY appts.start";

    //execute query, check for error
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
        $name = $row[2];
        $email = $row[3];
        $Lnum = $row[4];

        if($background++ % 2 == 0){
            echo "  <tr style=\"background-color: white\">\n";
        } else {
            echo "  <tr style=\"background-color: lightgrey\">\n";
        }

        echo <<<TABLEDATA
            <td>$name</td>
            <td>$email</td>
            <td>$Lnum</td>
            <td>$start</td>
            <td>$end</td>
        </tr>

TABLEDATA;
    }
    echo "  </table>";

    //close database
    mysqli_close($db);
}

?>
