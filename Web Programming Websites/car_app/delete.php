<?php

require("header.php");
displayList();
require("footer.php");

// ----------------------------------------------------------------------------
function displayList(){
    $background = 0;

    echo <<<HTMLBLOCK
    <form method="POST" action="delete.php">
        <table>
            <tr>
                <th>Delete</th>
                <th>Name</th>
                <th>Production Years</th>
                <th>Range</th>
            </tr>
HTMLBLOCK;

    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno())
        die("Unable to connect to database " . mysqli_connect_error());

    $cars = mysqli_query($db, 'SELECT name, productionYears, miles, ID FROM cars ORDER BY name');
    if (!$cars){
        die("Query failed " . mysqli_error($db));
    }

    //iterate over row set, display each row and alternate the backfround between light/dark
    while($row = mysqli_fetch_array($cars)){
        $name = $row[0];
        $years = $row[1];
        $range = $row[2];
        $id = $row[3];

        if($background++ % 2 == 0){
            echo "    <tr style=\"background-color: white\">\n";
        } else {
            echo "    <tr style=\"background-color: lightgrey\">\n";
        }

        echo <<<TABLEDATA
          <td><input type="checkbox" id="carid[]" name="carid[]" value="$id"></td>
          <td>$name</td>
          <td>$years</td>
          <td>$range</td>
          </tr>
TABLEDATA;
    }

    //delete button
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
    $result = 0;

    //connect to db
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno())
        die("Unable to connect to database " . mysqli_connect_error());
    
    //grab the data
    $delete = $_POST['carid'];

    //build query
    $query = mysqli_prepare($db, 'DELETE FROM cars WHERE ID=?');

    //iterate over the form data
    foreach($delete as $index => $recordID){
        //bind
        $recordID = filter_var($recordID, FILTER_VALIDATE_INT,
        array("options"=>array("min_range"=>0)));
        if($recordID){
            mysqli_bind_param($query, "i", $recordID);
            
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

    mysqli_stmt_close($query);
    mysqli_close($db);
}
?>
