<?php
//see index.php for comment header block (with sources)

//-----------------------------------------------------------------------------
//Valdiation Functions (the name describes what we are validating):

function valid_date($date){
    $date = trim($date);
    $date = filter_var($date, FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp"=>"/^\d{4}-\d{2}-\d{2}$/")));
    if(strlen($date) > 0){
        return $date;
    } else {
        die("error: bad input");
    }
}

function valid_type($type){
    $type = trim($type);
    if(strlen($type) === 1 && ($type === "T" || $type === "P" || $type === "F")){
        return $type;
    } else {
        die("error: bad input");
    }
}

function valid_name($name){
    $name = trim($name);
    if(strlen($name) > 0 && strlen($name) <= 64){
        return $name;
    } else {
        die("error: bad input");
    }
}

function valid_id($id){
    $id = trim($id);
    if(strlen($id) > 0 && strlen($id) <= 4){
        return $id;
    } else {
        die("error: bad input");
    }
}

function valid_email($email){
    $email = trim($email);
    $email = filter_var($email, FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp"=>"/^.+@.+\..+$/")));
    if(strlen($email) > 4 && strlen($email) <= 64){
        return $email;
    } else {
        die("error: bad input");
    }
}

function valid_confirm_num($c_num){
    $c_num = filter_var($c_num, FILTER_VALIDATE_INT,
    array("options"=>array("min_range"=>1, "max_range"=>99999999999)));
    if($c_num){
        return $c_num;
    } else {
        die("error: bad input");
    }
}

?>
