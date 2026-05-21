<?php
//see index.php for comment header block (with sources)

//NOTE: when adding users to the database with not real but valid ID, database
//succeeds but does not acutally add to the database, throws off malicious users

//include header/footer and state transitions
require("header.php");

if(isset($_POST["addButton"]))
    addAppointment();
else
    displayForm();

require("footer.php");

// ----------------------------------------------------------------------------

//used to display the form
function displayForm(){
    //beggining of drop down
    echo <<<HTMLBLOCK
    <p>Select an appointment and L Number</p>
    <form method="POST" action="add.php" onsubmit="return(valid_number('id') && valid_number('appointment_id'));">
        <select name="appointment_record" id="appointment_id">
HTMLBLOCK;
    
    //query the database to get all avaliable appointments
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);

    if(mysqli_connect_errno())
        die("Unable to connect to database: " . mysqli_connect_error());

    $appointments = mysqli_query($db, "SELECT PK,start,end
                                   FROM appts 
                                   WHERE SID IS NULL
                                   ORDER BY start");

    if(!$appointments)
        die("Query failed: " . mysqli_error($db));
    
    while($row = mysqli_fetch_array($appointments)){
        $id = $row[0];
        $start = $row[1];
        $end = $row[2];

        echo "    <option value=\"$id\">$start to $end</option>\n";
    }

    echo <<<HTMLBLOCK2
        </select>
        <select name="student_record" id="id">
HTMLBLOCK2;
    
    //query the database to get all avaliable students
    $students = mysqli_query($db, "SELECT ID,Lnum,name
                                   FROM students
                                   ORDER BY Lnum");
    
    if(!$students)
        die("Query failed: " . mysqli_error($db));
    
    while($row = mysqli_fetch_array($students)){
        $id = $row[0];
        $Lnum = $row[1];
        $name = $row[2];
        echo "    <option value=\"$id\">$name: $Lnum</option>\n";
    }

    //submit button that sends the item to be added in the database (validated with js)
    echo <<<FORMBLOCK
    </select>
    <p>
        <input type="submit" name="addButton" value="Add Appointment">
    </p>
   </form>
FORMBLOCK;

    //close the database handler
    mysqli_close($db);
}

function addAppointment(){
    //get data from form
    $appointment = $_POST['appointment_record'];
    $student = $_POST['student_record'];

    //validate data
    $appointment = trim($appointment);    
    $appointment = filter_var($appointment, FILTER_VALIDATE_INT, array("options"=>array("min_range"=>"1")));
    
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
        $query = mysqli_prepare($db, "UPDATE appts SET SID=? WHERE PK=? AND SID IS NULL");

        //bind parameters
        mysqli_stmt_bind_param($query, "ii", $student, $appointment);

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
            <h2>An error occurred. Unable to add record.</h2>
        </div>
FAIL;
        } 
    
        //close database and prepared statement
        mysqli_stmt_close($query);
        mysqli_close($db);
    } else {
        //display error
        echo <<<'FAILBLOCK'
        <div class="center">
            <h2>An error occurred. Unable to add record.</h2>
        </div>
FAILBLOCK;
    }
}

?>
