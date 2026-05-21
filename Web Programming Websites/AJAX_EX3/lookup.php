<?php
    $searchtext = $_POST['name'];
    $searchtext = trim($searchtext);
    $searchtext = filter_var($searchtext, FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp"=>"/^[0-9a-zA-Z !\-\.]{1,64}$/")));

    $index = 0;
    $matches = array();

    if(strlen($searchtext) > 0){
        require('credentials.php');
        $db = mysqli_connect($hostname, $username, $password, $database);
        if(mysqli_connect_errno()){
            die("Unable to connect to the database! " . mysqli_connect_error());
        }
        $searchtext = mysqli_real_escape_string($db, "%$searchtext%");
        $query = mysqli_prepare($db, "SELECT name
                                      FROM cars
                                      WHERE name LIKE ?"
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
        echo "{\"name\":[\"No mathces found\"]}";
    }
?>
