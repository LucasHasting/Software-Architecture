<?php
    //see index.html for comment header block (with sources)

    //start session
    session_start();
    
    //include validation functions
    require_once("functions.php");
    
    //get post data and validate, set condition in query as needed
    if(isset($_POST["date"])){
        $date = valid_date($_POST["date"]);
        $condition = "WHERE check_in = ?";
    } else if (isset($_POST["confirmation_num"])){
        $confirmation = valid_confirm_num($_POST["confirmation_num"]);
        $condition = "WHERE confirm_num = ?";
        
        //save to session if we end up deleting it
        $_SESSION["confirmation_num"] = $_POST["confirmation_num"];
    } else if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"])){
        $fname = valid_name($_POST["fname"]);
        $lname = valid_name($_POST["lname"]);
        $email = valid_email($_POST["email"]);
        $condition = "WHERE first_name = ? AND last_name = ? AND email = ?";
    } else {
        die("error: bad input");
    }

    //declare variables used
    $index = 0;
    $matches = array();

    //conect to database
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno()){
        die("Unable to connect to the database! " . mysqli_connect_error());
    }

    //select everything based on POST
    $query = mysqli_prepare($db, "SELECT site_id, confirm_num, check_in, check_out, first_name, last_name, email
                                  FROM reservations " . $condition . "
                                  ORDER BY confirm_num"
    );
    
    //bind statement
    if(isset($_POST["date"])){
        mysqli_stmt_bind_param($query, "s", $date);
    } else if (isset($_POST["confirmation_num"])){
        mysqli_stmt_bind_param($query, "s", $confirmation);
    } else if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"])){
        mysqli_stmt_bind_param($query, "sss", $fname, $lname, $email);
    } else {
        die("how did this happen");
    }

    //exec query, build matches array
    if(mysqli_stmt_execute($query)) {
        mysqli_stmt_bind_result($query, $id, $confirm, $in, $out, $fname, $lname, $email);
        while(mysqli_stmt_fetch($query)){
            $matches[$index++] = [$id, $confirm, $in, $out, $fname, $lname, $email];
        }
    }

    //close database and prepared statement
    mysqli_stmt_close($query);
    mysqli_close($db);

    //build JSON response
    if($index > 0){
        echo "{\"ids\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][0]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"confirmation_numbers\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][1]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"in\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][2]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"out\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][3]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"fname\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][4]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"lname\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][5]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"email\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"{$matches[$i][6]}\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "]}";
    } else {
        echo "{\"ids\":[\"None\"], \"confirmation_numbers\":[\"None\"], \"in\": [\"None\"],";
        echo "\"out\": [\"None\"], \"fname\": [\"None\"], \"lname\": [\"None\"], \"email\": [\"None\"]}";
    }
?>
