<?php
    //see index.html for comment header block (with sources)
    
    //start session
    session_start();
    
    //include validation functions
    require_once("functions.php");
    
    //get post data and validate
    $fname = valid_name($_POST['fname']);
    $lname = valid_name($_POST['lname']);
    $email = valid_email($_POST['email']);
    $ids   = explode(",",$_POST['ids']);
    for ($i = 0; $i < count($ids); $i++){
        $ids[$i] = valid_id($ids[$i]);
    } 

    //get session data -> validated in reserve.php
    $in =   $_SESSION["in"];
    $out =  $_SESSION["out"];
   
    //declare variables used
    $index = 0;
    $matches = array();

    //connect to the database
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno()){
        die("Unable to connect to the database! " . mysqli_connect_error());
    }

    //using prepared statements - add record to reservations table
    $query = mysqli_prepare($db, "INSERT INTO reservations (site_id, check_in, check_out, first_name, last_name, email)
                                  VALUES (?,?,?,?,?,?)"
    );


    //exec query
    foreach ($ids as $id){
        mysqli_stmt_bind_param($query, "ssssss", $id, $in, $out, $fname, $lname, $email);
        mysqli_stmt_execute($query);    
    }

    //close original query
    mysqli_stmt_close($query);

    //select all confirmation numbers
    $query = mysqli_prepare($db, "SELECT confirm_num
                                  FROM reservations
                                  WHERE site_id = ?
                                  ORDER BY confirm_num"
    );

    //exec query
    foreach ($ids as $id){
        mysqli_stmt_bind_param($query, "s", $id);
        if(mysqli_stmt_execute($query)){
            mysqli_stmt_bind_result($query, $confirm);
            if(mysqli_stmt_fetch($query)){
                $matches[$index++] = $confirm;
            }
        }
    }
    
    //close prepared statement, db, session
    mysqli_stmt_close($query);
    mysqli_close($db);
    session_unset();

    //build JSON response
    if($index > 0){
        echo "{\"ids\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"$ids[$i]\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "],\"confirmation_numbers\":[";
        for($i = 0; $i < $index; $i++){
            echo "\"$matches[$i]\"";
            if($i+1 < $index){
                echo ",";
            }
        }
        echo "]}";
    } else {
        echo "{\"ids\":[\"None\"], \"confirmation_numbers\":[\"None\"]}";
    }
?>
