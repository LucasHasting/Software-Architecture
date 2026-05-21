<?php
session_start();
require("header.php");

print "     <h1>Hello</h1>";

if(array_key_exists('lastvisit', $_SESSION)) {
    //welcome back
    $_SESSION['visits']++;
    print "     <p>Your last visit was on " . $_SESSION['lastvisit'] . "</p>";
    print "     <p>You have visited " . $_SESSION['visits'] . " times</p><br>";
    print "     <p>The browser you used last time was " . $_SESSION['browser'] . "</p>";
    $_SESSION['lastvisit'] = date('m-d-Y');
    $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
} else {
    //new visitor
    $_SESSION['visits'] = 1;
    $_SESSION['lastvisit'] = date('m-d-Y');
    $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
    print "     <p>welcome new user!</p><br>";
    print "     <p>Browser: " . $_SERVER['HTTP_USER_AGENT'] . "</p>";
}

require("footer.php");

?>
