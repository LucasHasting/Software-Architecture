<?php
    //see index.html for comment header block (with sources)
    
    //get post data and validate
    $searchtext = $_POST['city'];
    $searchtext = trim($searchtext);
    $searchtext = filter_var($searchtext, FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp"=>"/^[a-zA-Z \-]{1,50}$/")));

    //declare variables used
    $index = 0;
    $matches = array();

    //query using prepared statement
    if(strlen($searchtext) > 0){
        require('credentials.php');
        $db = mysqli_connect($hostname, $username, $password, $database);
        if(mysqli_connect_errno()){
            die("Unable to connect to the database! " . mysqli_connect_error());
        }

        $query = mysqli_prepare($db, "SELECT DISTINCT state
                                      FROM uszipcodes
                                      WHERE city = ?
                                      ORDER BY state_code"
        );

        mysqli_stmt_bind_param($query, "s", $searchtext);

        //exec query, build matches array, close
        if(mysqli_stmt_execute($query)) {
            mysqli_stmt_bind_result($query, $car);
            while(mysqli_stmt_fetch($query)){
                $matches[$index++] = $car;
            }
        }

        mysqli_stmt_close($query);
        mysqli_close($db);
    }

    //build JSON response
    if($index > 0){
        echo "{\"name\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"$matches[$i]\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "]}";
    } else {
        echo "{\"name\":[\"No matches found\"]}";
    }
?>
