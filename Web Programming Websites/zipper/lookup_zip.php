<?php
    //see index.html for comment header block (with sources)
    
    //get post data and validate
    $searchtext_city = $_POST['city'];
    $searchtext_city = trim($searchtext_city);
    $searchtext_city = filter_var($searchtext_city, FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp"=>"/^[a-zA-Z \-]{1,50}$/")));

    $searchtext_state = $_POST['state'];
    $searchtext_state = trim($searchtext_state);
    $searchtext_state = filter_var($searchtext_state, FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp"=>"/^[a-zA-Z \-]{1,20}$/")));
   
    //declare variables used 
    $index = 0;
    $matches = array();

    //query using prepared statement
    if(strlen($searchtext_city) > 0 && strlen($searchtext_state) > 0){
        require('credentials.php');
        $db = mysqli_connect($hostname, $username, $password, $database);
        if(mysqli_connect_errno()){
            die("Unable to connect to the database! " . mysqli_connect_error());
        }

        $query = mysqli_prepare($db, "SELECT DISTINCT zip
                                      FROM uszipcodes
                                      WHERE city = ? AND state = ?
                                      ORDER BY zip"
        );

        mysqli_stmt_bind_param($query, "ss", $searchtext_city, $searchtext_state);

        //exec query, build matches array, close
        if(mysqli_stmt_execute($query)) {
            mysqli_stmt_bind_result($query, $zip);
            while(mysqli_stmt_fetch($query)){
                $matches[$index++] = $zip;
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
