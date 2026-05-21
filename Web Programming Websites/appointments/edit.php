<?php
//see index.php for comment header block (with sources)

//NOTE: when editing users in the database with not real but valid ID, database
//succeeds but does not acutally edit the database, throws off malicious users

//start the session
session_start();

//include header/footer and state transitions
require("header.php");
if (array_key_exists("editButton", $_POST)) {
   editAppointment();
} else if(array_key_exists('updateButton', $_POST)){
   editForm();
} else {
    displayList();
}
require("footer.php");


// ----------------------------------------------------------------------------
function displayList(){
    //draw the form
    echo <<<HTMLBLOCK
    <p>Select the appointment to edit</p>
    <form method="POST" action="edit.php" onsubmit="return valid_number('id');">
        <select name="appointment_record" id="id">
HTMLBLOCK;

    //query the database to get appointments and students associated with them
    //check for errors
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);

    if(mysqli_connect_errno())
        die("Unable to connect to database: " . mysqli_connect_error());

    $students = mysqli_query($db, "SELECT appts.PK, students.name, appts.start, appts.end
                               FROM students, appts 
                               WHERE appts.SID=students.ID 
                               ORDER BY appts.start");

    if(!$students)
        die("Query failed: " . mysqli_error($db));
    
    while($row = mysqli_fetch_array($students)){
        $id = $row[0];
        $name = $row[1];
        $start = $row[2];
        $end = $row[3];
        echo "    <option value=\"$id\">$name from $start to $end</option>\n";
    }

    //submit button that sends the item to be edited, validated with js
    echo <<<FORMBLOCK
    </select>
    <p>
        <input type="submit" name="updateButton" value="Edit Selected">
    </p>
   </form>
FORMBLOCK;

    //close the database
    mysqli_close($db);
}

// ----------------------------------------------------------------------------
function editForm(){
    //get data from form
    $appointment = $_POST['appointment_record'];

    //validate data
    $appointment = trim($appointment);
    $appointment = filter_var($appointment, FILTER_VALIDATE_INT, array("options"=>array("min_range"=>"1")));

    //if data ok
    if($appointment != FALSE){
        //save appointment to session
        $_SESSION['appointment_record'] = $appointment;

        //beggining of drop down
        echo <<<HTMLBLOCK
        <p>Select A new student</p>
    <form method="POST" action="edit.php" onsubmit="return(valid_number('id'));">
        <select name="student_record" id="id">
HTMLBLOCK;

        //connect to database
        require('credentials.php');
        $db = mysqli_connect($hostname, $username, $password, $database);
    
        if(mysqli_connect_errno())
            die("Unable to connect to database: " . mysqli_connect_error());
    
        //create prepared statement, execue it, check for errors
        $student = mysqli_prepare($db, "SELECT students.ID
                                        FROM students, appts 
                                        WHERE appts.SID=students.ID AND appts.PK=?");
     
        mysqli_stmt_bind_param($student, "i", $appointment);

        if(!mysqli_stmt_execute($student)){
            die("Query failed: " . mysqli_error($db));
        }
    
        //get results
        mysqli_stmt_bind_result($student, $student_id);
        mysqli_stmt_fetch($student);

        //close prepared statement
        mysqli_stmt_close($student);

        //query the database to get all avaliable students, check for errors
        $students = mysqli_query($db, "SELECT ID,Lnum,name
                                       FROM students
                                       ORDER BY Lnum");

        if(!$students)
            die("Query failed: " . mysqli_error($db));

        while($row = mysqli_fetch_array($students)){
            $id = $row[0];
            $Lnum = $row[1];
            $name = $row[2];
            if($student_id == $id)
                echo "    <option value=\"$id\" selected>$name: $Lnum</option>\n";
            else
                echo "    <option value=\"$id\">$name: $Lnum</option>\n";
        }

        //submit button that sends the item to be edited in the database, validated with js
        echo <<<FORMBLOCK
    </select>
    <p>
        <input type="submit" name="editButton" value="Add Appointment">
    </p>
   </form>
FORMBLOCK;
    } else {
        //display error
        echo <<<'FAILBLOCK'
        <div class="center">
            <h2>An error occurred. Unable to edit record.</h2>
        </div>
FAILBLOCK;
    }

    //close the database handler
    mysqli_close($db);
}

function editAppointment(){
    //get data from form
    $appointment = $_SESSION['appointment_record'];
    $student = $_POST['student_record'];

    //validate data
    $student = trim($student);
    $student = filter_var($student, FILTER_VALIDATE_INT, array("options"=>array("min_range"=>"1")));


    //if data is ok
    if($appointment != FALSE && $student != FALSE){
        //make database connection
        require("credentials.php");
        $db = mysqli_connect($hostname, $username, $password, $database);

        if(mysqli_connect_errno()){
            die("Unable to connect to the database: " . mysqli_connect_error());
        }

        //create prepared statement
        $query = mysqli_prepare($db, "UPDATE appts SET SID=? WHERE PK=? AND SID IS NOT NULL
                                      AND EXISTS(SELECT ID FROM students WHERE ID=?)");

        //bind parameters
        mysqli_stmt_bind_param($query, "iii", $student, $appointment, $student);

        //execute query, display result
        if(mysqli_stmt_execute($query)){
            echo <<<'SUCCESS'
        <div class="center">
            <h2>Success!!!!</h2>
        </div>
SUCCESS;
        } else {
            echo <<<'FAIL'
        <div class="center">
            <h2>An error occurred. Unable to edit record.</h2>
        </div>
FAIL;

        }

        //close database and prepared statement
        mysqli_stmt_close($query);
        mysqli_close($db);
        
        //delete session contents
        session_unset();
    } else {
        //display error
        echo <<<'FAILBLOCK'
        <div class="center">
            <h2>An error occurred. Unable to edit record.</h2>
        </div>
FAILBLOCK;
    }
}

?>
