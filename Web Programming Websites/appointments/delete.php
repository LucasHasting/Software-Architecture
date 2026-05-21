<?php
//see index.php for comment header block (with sources)

//NOTE: when deleting users from the database with not real but valid ID, database
//succeeds but does not acutally delete from the database, throws off malicious users

//include header/footer and state transitions
require("header.php");
if(isset($_POST["deleteButton"]))
    deleteList();
else
    displayList();
require("footer.php");

// ----------------------------------------------------------------------------
//function used to display a list of students to delete with checkboxes
function displayList(){
    $background = 0;

    echo <<<HTMLBLOCK
    <form method="POST" action="delete.php" onsubmit="return(valid_number_list('apptid[]'));">
        <table>
            <tr>
                <th>Delete</th>
                <th>Name</th>
                <th>Email</th>
                <th>L Number</th>
                <th>Start</th>
                <th>End</th>
            </tr>
HTMLBLOCK;

    //connect to database, check for errors
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno())
        die("Unable to connect to database " . mysqli_connect_error());

    //build query
    $query = "SELECT start,end,SID,PK 
              FROM appts 
              WHERE SID IS NOT NULL 
              ORDER BY start";

    //execute query and check for errors
    $appts = mysqli_query($db, $query);

    if(!$appts){
        $query_message = "Query failed: " . mysqli_error($db);
        mysqli_close($db);
        die($query_message);
    }

    //iterate over row set, display each row and alternate the backfround between light/dark
    while($row = mysqli_fetch_array($appts)){
        $start = $row[0];
        $end = $row[1];
        $sid = $row[2];
        $id = $row[3];
    
        $student_query = "SELECT name,email,Lnum 
                          FROM students 
                          WHERE ID = \"$sid\"";
        
        $student = mysqli_query($db, $student_query);
    
        if(!$student){
            $query_message = "Query failed: " . mysqli_error($db);
            mysqli_close($db);
            die($query_message);
        }

        $student_result = mysqli_fetch_array($student);
        $name = $student_result[0];
        $email = $student_result[1];
        $Lnum = $student_result[2];

        if($background++ % 2 == 0){
            echo "  <tr style=\"background-color: white\">\n";
        } else {
            echo "  <tr style=\"background-color: lightgrey\">\n";
        }

        echo <<<TABLEDATA
            <td><input type="checkbox" name="apptid[]" value="$id"></td>
            <td>$name</td>
            <td>$email</td>
            <td>$Lnum</td>
            <td>$start</td>
            <td>$end</td>
        </tr>

TABLEDATA;
    }

    //delete button, input validated with js
    echo <<<FORMBLOCK
    </table>

    <p>
    <input type="submit" name="deleteButton" value="Delete Selected">
    </p>
    </form>
FORMBLOCK;
    
    //close database
    mysqli_close($db);
}

function deleteList(){
    //init result as 0
    $result = 0;

    //connect to db
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno())
        die("Unable to connect to database " . mysqli_connect_error());
    
    //grab the data
    $delete = $_POST['apptid'];

    //build query (prepared statement)
    $query = mysqli_prepare($db, 'UPDATE appts SET SID=NULL WHERE PK=?'); 

    //iterate over the form data
    foreach($delete as $index => $recordID){
        //bind
        $recordID = filter_var($recordID, FILTER_VALIDATE_INT,
        array("options"=>array("min_range"=>0)));
        if($recordID){
            mysqli_stmt_bind_param($query, "i", $recordID);
        
            //execute
            if(mysqli_stmt_execute($query)){
                //increment counter on success
                $result++;
            }
        }
    }

    //display results
    if($result > 0){
        echo <<<SUCCESSBLOCK
    <div class="center">
        <h2>SUCCESS!! $result records deleted</h2>
    </div>
SUCCESSBLOCK;
    } else {
        echo <<<SUCCESSBLOCK
    <div class="center">
        <h2>ERRRRRRRRRRRRRRRRRRRRRRRRRRRR</h2>
    </div>
SUCCESSBLOCK;

    }

    //close database and prepared statement
    mysqli_stmt_close($query);
    mysqli_close($db);
}
?>
