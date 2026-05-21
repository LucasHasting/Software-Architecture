<?php

require("header.php");
if (array_key_exists("editButton", $_POST)) {
   processEdit();
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
    <p>Select the EV to edit</p>
    <form method="POST" action="edit.php">
        <select name="record">
HTMLBLOCK;

    //query the database to get the car names and primary key (ID)
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);

    if(mysqli_connect_errno())
        die("Unable to connect to database: " . mysqli_connect_error());

    $cars = mysqli_query($db, "
    SELECT name, id 
    FROM cars 
    ORDER BY name");

    if(!$cars)
        die("Query failed: " . mysqli_error($db));
    
    while($row = mysqli_fetch_array($cars)){
        $name = $row[0];
        $id = $row[1];
        echo "    <option value=\"$id\">$name</option>\n";
    }

    //submit button that sends the item to be edited
    echo <<<FORMBLOCK
    </select>
    <p>
        <input type="submit" name="updateButton" value="Update Selected">
    </p>
   </form>
FORMBLOCK;

    mysqli_close($db);
}

// ----------------------------------------------------------------------------
function editForm(){
    //get values from POST
    $id = $_POST["record"];

    //validate values
    $id = filter_var($id, FILTER_VALIDATE_INT, 
        array("options"=>array("min_range"=>0)));

    //prepare query, bind params, execute to get record to edit
    require("credentials.php");
    $db = mysqli_connect($hostname, $username, $password, $database);
        
    if(mysqli_connect_errno())
        die("Unable to connect to database: " . mysqli_connect_error());

    $query = mysqli_prepare($db, "
    SELECT name, productionYears, miles 
    FROM cars 
    WHERE ID=?"
    );
    
    mysqli_stmt_bind_param($query, "i", $id);
    
    //display form with values and "update" button
    if(mysqli_stmt_execute($query)) {
        mysqli_stmt_bind_result($query, $name, $years, $range);
        mysqli_stmt_fetch($query);
        echo <<<UPDATE_DOC
        <form method="POST" action="edit.php"
        <table>
          <tr>
            <th><label for="name">Model: </label></th>
            <th><label for="years">Year: </label></th>
            <th><label for="range">Range: </label></th>
          </tr>

          <tr>
            <td><input type="text" id="model" name="model" required maxlength="64" autocomplete="off" value="$name"></td>
            <td><input type="text" id="years" name="years" required maxlength="9" pattern="^[0-9]{4}-$|^[0-9]{4}-[0-9]{4}$" autocomplete="off" value="$years"></td>
            <td>
                <input type="numeric" id="range" name="range" required pattern="^[0-9]{1,5}$" maxlength="64" autocomplete="off" value="$range">
                <input type="hidden" id="record" name="record" value="$id">
            </td>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="float:right"><input type="submit" name="editButton" value="Update EV"></td>
         </tr>
        </table>
        </form>

UPDATE_DOC; //Note: should use $_SESSION 
    } else {
        die("Query error " . mysqli_error($db));
    }
    
    mysqli_stmt_close($query);
    mysqli_close($db);
}

// ----------------------------------------------------------------------------
function processEdit(){
    //get post vars
    $name  = $_POST["model"];
    $years = $_POST["years"];
    $range = $_POST["range"];
    $id    = $_POST["record"];

    //validate vars
    $name = trim($name);    
    $name = filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9a-zA-Z!-\.]{1,64}$/")));

    $years = trim($years);    
    $years = filter_var($years, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]{4}-$|^[0-9]{4}-[0-9]{4}$/")));

    $range = trim($range);    
    $range = filter_var($range, FILTER_VALIDATE_INT, array("options"=>array("min_range"=>"1", "max_range"=>"99999")));

    $id = trim($id);
    $id = filter_var($id, FILTER_VALIDATE_INT, array("options"=>array("min_range"=>"0")));

    //if data is ok
    if($name != FALSE && $years != FALSE && $range != FALSE && $id != FALSE){
        //make database connection
        require("credentials.php");
        $db = mysqli_connect($hostname, $username, $password, $database);

        if(mysqli_connect_errno()){
            die("Unable to connect to the database: " . mysqli_connect_error());
        }
    
        //create prepared statement
        $query = mysqli_prepare($db, "UPDATE cars SET name=?, productionYears=?, miles=? WHERE ID=?"); //XXX

        //bind parameters
        mysqli_stmt_bind_param($query, "ssii", $name, $years, $range, $id);

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
            <h2>An error occurred = 1. Unable to add record</h2>
        </div>
FAIL;
        }
        
        //close query/db
        mysqli_stmt_close($query);
        mysqli_close($db);
    } else {
        //display error
        echo <<<'FAILBLOCK'
        <div class="center">
            <h2>An error occurred = 2. Unable to add record</h2>
        </div>
FAILBLOCK;
    }
}
?>
