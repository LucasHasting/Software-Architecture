<?php
session_start();

$username = $_POST["user-name"];
$password = $_POST["password"];

if($username === $password) {
    $_SESSION['user-name'] = $username;
    $_SESSION['password'] = $password;
    header("Location: important.php");
} else {
    header("Location: index.php");
}
