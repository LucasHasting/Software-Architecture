<?php

$today = date('m-d-Y');

//lasts for a year, good for whole site
setcookie('last_visit', $today, time() + (365 * 24 * 60 * 60), '/');

require("header.php");

if(array_key_exists('last_visit', $_COOKIE)){
    print "Nice to see you again. Your last visit was on " . $_COOKIE['last_visit'];
} else {
    print "Welcome. Enjoy the site";
}

require("footer.php");
?>
