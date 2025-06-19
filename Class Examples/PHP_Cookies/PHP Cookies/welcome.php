<?php

$usr=$_POST["name"];
$pwd=$_POST["pwd"];

if ($pwd == "bar") {
    echo "Welcome " . $usr;
    if (isset($_POST["remember"]) && $_POST["remember"] == "ON") {
        echo "remember";
        setcookie("user", $usr, time() + (60 * 3));
    } else {
        echo "forget";
    }
} else {
    echo "wrong username or password";
}
?>
