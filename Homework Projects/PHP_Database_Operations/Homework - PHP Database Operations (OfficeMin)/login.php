<?php session_start() ?>
<?php
if (isset($_SESSION['user'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        You must login before making changes.
        <form action="authenticate.php" method="post">
            Username: <input type="text" name="uname"><br>
            Password: <input type="password" name="pwd"><br>
            <input type="submit">
        </form>
    </body>
</html>
