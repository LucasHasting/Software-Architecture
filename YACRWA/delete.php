<?php
    //see index.php for comment header block (with sources)
    
    //start the session
    session_start();

    //include header
    require("header.php");
    
    //validated in show.php
    $c_num = $_SESSION["confirmation_num"];

    //connect to database, check for errors
    require('credentials.php');
    $db = mysqli_connect($hostname, $username, $password, $database);
    if(mysqli_connect_errno())
        die("Unable to connect to database " . mysqli_connect_error());

    //build query using prepared statement
    $query = "DELETE FROM reservations WHERE confirm_num=?"; 
    $prepared_query = mysqli_prepare($db, $query); 
    mysqli_stmt_bind_param($prepared_query, "s", $c_num);

    //execute query and check for errors
    if(!mysqli_stmt_execute($prepared_query)){
        $query_message = "Query failed: " . mysqli_error($db);
        mysqli_close($db);
        die($query_message);
    }

    //display success message
    echo "<h2>Successfully Deleted Confirmation Number: $c_num</h2>";

    //close prepared statement, db, and session    
    mysqli_stmt_close($prepared_query);
    mysqli_close($db);
    session_unset();
    
    //include footer
    require("footer.php");
?>
